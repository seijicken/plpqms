import tensorflow as tf
import os
import sys
import io
import logging

logging.basicConfig(encoding='utf-8')
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

# Get the directory where the script is located
script_dir = os.path.dirname(os.path.realpath(__file__))

# Construct dataset paths relative to the script's directory
directories = {
    "fraud_training": os.path.join(script_dir, '../signatures/HR/fraud/training'),
    "fraud_validation": os.path.join(script_dir, '../signatures/HR/fraud/validation'),
    "legit_training": os.path.join(script_dir, '../signatures/HR/legit/training'),
    "legit_validation": os.path.join(script_dir, '../signatures/HR/legit/validation')
}

# Function for Sobel edge detection
def sobel_edges(image):
    image = tf.cast(image, tf.float32) / 255.0
    gray = tf.image.rgb_to_grayscale(image)
    grad_x = tf.image.sobel_edges(gray)[..., 0]
    grad_y = tf.image.sobel_edges(gray)[..., 1]
    edges = tf.sqrt(tf.square(grad_x) + tf.square(grad_y))
    edges = (edges - tf.reduce_min(edges)) / (tf.reduce_max(edges) - tf.reduce_min(edges) + 1e-6)
    edges = tf.image.resize(edges, [64, 64])
    edges = tf.expand_dims(edges, axis=-1)
    return edges

# Function to load and preprocess datasets with label prefix
def load_and_preprocess_dataset(directory, label_offset):
    dataset = tf.keras.utils.image_dataset_from_directory(
        directory,
        labels='inferred',
        label_mode='int',
        color_mode='rgb',
        batch_size=32,
        image_size=(64, 64),
        shuffle=True
    )
    return dataset.map(lambda x, y: (sobel_edges(x), y + label_offset))

# Function to count number of subdirectories (classes) in a directory
def count_classes(directory):
    return len([name for name in os.listdir(directory) if os.path.isdir(os.path.join(directory, name))])

# Count classes to determine offsets
num_fraud_classes = count_classes(directories["fraud_training"])
num_legit_classes = count_classes(directories["legit_training"])

# Load datasets with offsets and apply Sobel edges
training_set_fraud = load_and_preprocess_dataset(directories["fraud_training"], 0)
validation_set_fraud = load_and_preprocess_dataset(directories["fraud_validation"], 0)
training_set_legit = load_and_preprocess_dataset(directories["legit_training"], num_fraud_classes)
validation_set_legit = load_and_preprocess_dataset(directories["legit_validation"], num_fraud_classes)

# Combine the datasets
combined_training_set = training_set_fraud.concatenate(training_set_legit)
combined_validation_set = validation_set_fraud.concatenate(validation_set_legit)

# Define the CNN model
cnn_combined = tf.keras.models.Sequential([
    tf.keras.layers.Conv2D(32, 3, activation='relu', input_shape=[64, 64, 1]),
    tf.keras.layers.Conv2D(32, 3, activation='relu'),
    tf.keras.layers.MaxPool2D(2, 2),
    tf.keras.layers.Conv2D(64, 3, activation='relu'),
    tf.keras.layers.Conv2D(64, 3, activation='relu'),
    tf.keras.layers.MaxPool2D(2, 2),
    tf.keras.layers.Flatten(),
    tf.keras.layers.Dense(512, activation='relu'),
    tf.keras.layers.Dropout(0.5),
    tf.keras.layers.Dense(num_fraud_classes + num_legit_classes, activation='softmax')
])

# Compile the model
cnn_combined.compile(
    optimizer=tf.keras.optimizers.Adam(
        learning_rate=tf.keras.optimizers.schedules.ExponentialDecay(
            initial_learning_rate=0.001,
            decay_steps=10000,
            decay_rate=0.9,
            staircase=True
        )
    ),
    loss='sparse_categorical_crossentropy',
    metrics=['accuracy']
)

# Early stopping callback
early_stopping_callback = tf.keras.callbacks.EarlyStopping(
    monitor='val_accuracy',
    patience=5,
    restore_best_weights=True,
    verbose=1
)

# Train the model
training_history_combined = cnn_combined.fit(
    combined_training_set,
    epochs=60,
    validation_data=combined_validation_set,
    callbacks=[early_stopping_callback]
)

# Save the model
cnn_combined.save(os.path.join(script_dir, 'trained_signatures_model.h5'))

# Print final validation accuracy
val_accuracy = training_history_combined.history['val_accuracy'][-1] * 100
print(f"Final validation accuracy: {val_accuracy:.2f}%")