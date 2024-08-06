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
        $file_path = "uploads/{$file_department}/{$file_name}";
        
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

    // Declare fixed values as variables
    $one = 1; // For the download count in the log
    $acc_status = 'HR'; // For account status in the log

    // Prepared statement for logging the download
    $log_query = $conn->prepare("INSERT INTO download_log (NAME, DEPARTMENT, SIZE, DOWNLOAD, MONTH, TIME, YEAR, ACC_STATUS, EMAIL) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($log_query === false) {
        error_log("Prepare failed: " . $conn->error);
        echo "Failed to log download.";
        return;
    }
    $log_query->bind_param('ssiisssss', $name, $department, $size, $one, $month, $time, $year, $acc_status, $email);
    if ($log_query->execute()) {
        echo "Download log inserted successfully.";
    } else {
        error_log("Download log insert error: " . $log_query->error);
        echo "Failed to log download.";
    }
    $log_query->close();

    // Prepared statement for updating the download count
    $update_query = $conn->prepare("UPDATE upload_files SET DOWNLOAD = ? WHERE id = ?");
    if ($update_query === false) {
        error_log("Prepare failed: " . $conn->error);
        echo "Failed to update download count.";
        return;
    }
    $update_query->bind_param('ii', $new_count, $id);
    if ($update_query->execute()) {
        echo "Download count updated successfully.";
    } else {
        error_log("Download count update error: " . $update_query->error);
        echo "Failed to update download count.";
    }
    $update_query->close();

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
