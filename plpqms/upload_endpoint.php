<?php
header('Content-Type: application/json');

$response = ['success' => false];

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
    $uploadFile = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        $response['success'] = true;
        $response['message'] = 'File successfully uploaded';
    } else {
        $response['message'] = 'File upload failed';
    }
} else {
    $response['message'] = 'No file received';
}

echo json_encode($response);
?>
