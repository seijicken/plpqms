<?php

session_start();
require_once("connection.php");

if (isset($_GET['file_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['file_id']);
    $sql = "SELECT * FROM upload_files WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $file_size = $file['SIZE'];
        $file_name = $file['NAME'];
        $file_department = $file['DEPARTMENT'];
        $file_path = "../uploads/{$file_department}/{$file_name}";
        
        if ($file_size != 0 && file_exists($file_path)) {
            downloadFile($file_path, $file, $conn, $id);
        } elseif ($file_size == 0) {
            $file_path .= ".txt";
            if (file_exists($file_path)) {
                downloadFile($file_path, $file, $conn, $id);
            } else {
                echo "File does not exist.";
            }
        } else {
            echo "Failed to load PDF document.";
        }
    } else {
        echo "File not found in the database.";
    }
}

function downloadFile($file_path, $file, $conn, $id) {
    $download_count = $file['DOWNLOAD'];
    $new_count = $download_count + 1;
    $name = $file['NAME'];
    $department = $file['DEPARTMENT'];
    $size = $file['SIZE'];
    $email = $file['EMAIL'];

    date_default_timezone_set("Asia/Manila");
    $month = date("F");
    $year = date("Y");
    $time = date("h:i:s A");

    // Log the download and update the download count before sending the file
    $log_query = "INSERT INTO download_log (id, NAME, DEPARTMENT, SIZE, DOWNLOAD, MONTH, TIME, YEAR, ACC_STATUS, EMAIL)
                  VALUES ('$id', '$name', '$department', '$size', '1', '$month', '$time', '$year', 'Admin', '$email')";
    $update_query = "UPDATE upload_files SET DOWNLOAD = '$new_count' WHERE id = '$id'";

    if (mysqli_query($conn, $log_query)) {
        echo "Download log inserted successfully.";
    } else {
        error_log("Download log insert error: " . mysqli_error($conn));
        echo "Failed to log download.";
    }

    if (mysqli_query($conn, $update_query)) {
        echo "Download count updated successfully.";
    } else {
        error_log("Download count update error: " . mysqli_error($conn));
        echo "Failed to update download count.";
    }

    // File download headers
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_path));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));

    // Send the file to the user
    readfile($file_path);
    exit;
}
?>
