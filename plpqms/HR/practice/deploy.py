import sys
import numpy as np
import tensorflow as tf
import cv2
import os
import fitz  
import io
import logging

logging.basicConfig(encoding='utf-8')
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

cnn = tf.keras.models.load_model("../HR/practice/trained_signatures_model.h5")

# Check if the correct number of command-line arguments is provided
if len(sys.argv) != 4:
    print("Usage: python deploy.py <image_path> <form filename> <department>")
    sys.exit(1)

# Get the image path from the command-line arguments
image_path = sys.argv[1]
formname = sys.argv[2]
department = sys.argv[3]

# Load the combined model (for dynamic model filenaming)
#cnn = tf.keras.models.load_model("../HR/practice/model-" + formname + ".h5")

# Read the image
img = cv2.imread(image_path, cv2.IMREAD_UNCHANGED)

# Check if the image is successfully read
if img is None:
    print(f"Error: Unable to read image at {image_path}")
    sys.exit(1)

# Function to remove white background and keep transparency
def remove_background_transparent(image):
    # Convert image to grayscale
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Threshold to get only the black background
    _, mask = cv2.threshold(gray, 1, 255, cv2.THRESH_BINARY)

    # Invert the mask
    mask = cv2.bitwise_not(mask)

    # Convert the image to RGBA (add an alpha channel)
    image_rgba = cv2.cvtColor(image, cv2.COLOR_BGR2BGRA)

    # Set the alpha channel of areas where mask is 0 (white background) to 0 (fully transparent)
    image_rgba[:, :, 3] = mask

    return image_rgba

# Remove white background and keep transparency
img = remove_background_transparent(img)

# Preprocess the image for prediction
def preprocess_image(image):
    # Resize to match the input size of the CNN
    resized_image = cv2.resize(image, (64, 64))

    # Convert to grayscale
    gray = cv2.cvtColor(resized_image, cv2.COLOR_BGRA2GRAY)

    # Apply Sobel edge detection
    edges_x = cv2.Sobel(gray, cv2.CV_64F, 1, 0, ksize=3)
    edges_y = cv2.Sobel(gray, cv2.CV_64F, 0, 1, ksize=3)
    edges = np.sqrt(np.square(edges_x) + np.square(edges_y))

    # Normalize the edges
    edges = (edges - np.min(edges)) / (np.max(edges) - np.min(edges) + 1e-6)

    # Expand dimensions to match expected shape for CNN
    edges = np.expand_dims(edges, axis=0)
    edges = np.expand_dims(edges, axis=-1)

    return edges

# Preprocess the image
edges = preprocess_image(img)

# Make prediction
predictions = cnn.predict(edges)

# Define confidence thresholds
fraud_confidence_threshold = 0.9
legit_confidence_threshold = 0.7
unknown_confidence_threshold = 0.5

# Determine the predicted class and label
predicted_index = np.argmax(predictions[0])
predicted_confidence = np.max(predictions[0])

if predicted_confidence < unknown_confidence_threshold:
    predicted_class = "Forged"
    predicted_label = "Forged"
else:
    # Define class names
    script_dir = os.path.dirname(os.path.abspath(__file__))
    directories = {
        "fraud_testing": os.path.join(script_dir, '../signatures/HR/fraud/testing'),
        "legit_testing": os.path.join(script_dir, '../signatures/HR/legit/testing')
    }

    # Scan fraud testing directory to get fraud class names
    fraud_class_names = sorted([name for name in os.listdir(directories["fraud_testing"]) if os.path.isdir(os.path.join(directories["fraud_testing"], name))])

    # Scan legit testing directory to get legit class names
    legit_class_names = sorted([name for name in os.listdir(directories["legit_testing"]) if os.path.isdir(os.path.join(directories["legit_testing"], name))])

    # Combine both fraud and legit class names with prefix
    class_names = ['fraud_' + name for name in fraud_class_names] + ['legit_' + name for name in legit_class_names]

    predicted_label = class_names[predicted_index]
    if predicted_confidence >= fraud_confidence_threshold and predicted_label.startswith('fraud_'):
        predicted_class = "Forged"
        predicted_label = predicted_label.replace('fraud_', '')
    elif predicted_confidence >= legit_confidence_threshold and predicted_label.startswith('legit_'):
        predicted_class = "Real"
        predicted_label = predicted_label.replace('legit_', '')
    else:
        predicted_class = "Forged"
        predicted_label = "Forged"

# Output the result
print(f"Predicted signature: {predicted_class}")
print(f"Predicted person: {predicted_label}")
print(f"Prediction confidence: {predicted_confidence}")

# Save the image with white background and black signature
white_bg_image = np.ones_like(img) * 255
gray_img = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
mask = gray_img < 255
white_bg_image[mask] = img[mask]

# Invert the signature color: from black signature on white background to white signature on black background
inverted_image = cv2.bitwise_not(white_bg_image)

# Save the image to a temporary file
temp_image_path = "temp_white_background.png"
cv2.imwrite(temp_image_path, inverted_image)

# Load the existing PDF
pdf_path = "../HR/uploads/" + department + "/" + formname
print("PDF Path: " + pdf_path)
doc = fitz.open(pdf_path)

# Identify the page where you want to insert the image (e.g., page 0)
page = doc[0]

if predicted_class == "Real":
    image_width = 100  
    image_height = 50

    text = "GRETA M. ROSARIO"
    text_instances = page.search_for(text)
    
    if text_instances:
        # Use the first instance of the text found
        text_rect = text_instances[0]
        
        # Calculate the position for the image slightly above the text
        x1 = text_rect.x0
        y1 = text_rect.y0 - image_height + 15  
        x2 = x1 + image_width
        y2 = y1 + image_height
        
        image_rect = fitz.Rect(x1, y1, x2, y2)
        page.insert_image(image_rect, filename=temp_image_path)

        output_pdf_path = "../HR/uploads/" + department + "/updated_template/" + formname
        print("Output Path: " + output_pdf_path)
        doc.save(output_pdf_path)
        doc.close()

        print(f"Signature inserted into {output_pdf_path}")
    else:
        print(f"Text '{text}' not found, skipping PDF update")
else:
    print("No real signature found, skipping PDF update")

os.remove(temp_image_path)