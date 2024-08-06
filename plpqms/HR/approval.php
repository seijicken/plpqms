<?php
session_start();

require_once("connection.php");
include 'sweetAlert.php';

// Check if file_id parameter is set and not empty
if (isset($_GET['file_id']) && !empty($_GET['file_id'])) {
    $file_id = mysqli_real_escape_string($conn, $_GET['file_id']);

    // Debugging: Log the received control number
    error_log('Control Number received: ' . $file_id);

    // Check if 'predicted_class' session variable exists and handle accordingly
    if (isset($_SESSION['predicted_class'])) {
        $predicted_class = $_SESSION['predicted_class'];  // Retrieve predicted class from session
        $predicted_label = isset($_SESSION['predicted_label']) ? $_SESSION['predicted_label'] : 'Not Set';  // Retrieve predicted label from session for optional debugging

        // Optionally log or echo predicted class and label for debugging
        error_log('Predicted class: ' . $predicted_class);
        error_log('Predicted label: ' . $predicted_label);

        // Clear predicted class and label from session after processing
        unset($_SESSION['predicted_class']);
        unset($_SESSION['predicted_label']);

        // Update file_status based on predicted_class
        if ($predicted_class === 'Forged') {
            $sql2 = "UPDATE upload_files SET file_status = 'In Progress' WHERE id = '$file_id'";
        } else {
            $sql2 = "UPDATE upload_files SET file_status = 'Approved' WHERE id = '$file_id'";
        }

        error_log('SQL Query: ' . $sql2);
        $result = mysqli_query($conn, $sql2);

        if ($result) {
            // Debugging: Log the result of the query
            $affected_rows = mysqli_affected_rows($conn);
            error_log('Update Result: ' . $affected_rows);

            // Display appropriate Swal.fire message based on prediction
            if ($predicted_class === 'Forged') {
                echo "<script type='text/javascript'>Swal.fire({
                    icon: 'error',
                    title: 'Forged Signature',
                    text: 'The signature on this document is suspected to be forged. Approval remains in progress.',
                    confirmButtonColor: '#00396D',
                    confirmButtonText: 'Okay',
                    timer: 5000
                }).then(function(){
                    window.history.back();
                })</script>";
            } else {
                echo "<script type='text/javascript'>Swal.fire({
                    icon: 'success',
                    title: 'Approved',
                    text: 'Your Document Has Been Approved',
                    confirmButtonColor: '#00396D',
                    confirmButtonText: 'Okay',
                    timer: 3000
                }).then(function(){
                    window.history.back();
                })</script>";
            }
        } else {
            // Debugging: Log SQL error if update fails
            error_log('SQL Error: ' . mysqli_error($conn));
            echo "Failed to update file status.";
        }
    } else {
        // If 'predicted_class' session variable is not set, handle accordingly
        error_log('Predicted class session variable not set.');
        echo "Failed to get file Control Number. Please ensure you provide a valid file Control Number.";
    }
} else {
    // Debugging: Log if control number parameter is missing or empty
    error_log('Control Number parameter missing or empty.');
    echo "Failed to get file Control Number. Please ensure you provide a valid file Control Number.";
}
?>
