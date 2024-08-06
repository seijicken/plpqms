<?php 
session_start();
require_once("connection.php");
include 'sweetAlert.php';

if (isset($_GET['file_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['file_id']);

    // Fetch file to download from database
    $sql = "SELECT * FROM upload_files WHERE ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


            $updateQuery = "UPDATE upload_files SET ARCHIVE='0' WHERE ID=?";
            $stmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);

            echo "<script type='text/javascript'>",
                "Swal.fire({",
                "icon: 'success',",
                "title: 'Restoring',",
                "text:'Your Requested File is Now Unarchiving.',",
                "confirmButtonColor:'#00396D',",
                "confirmButtonText: 'Okay',",
                "timer:3000",
                "}).then(function(){",
                "window.location='ArhieveFile.php'",
                "})",
                "</script>";
            exit;
       
    } else {
        echo "File not found in database.";
    }

?>
