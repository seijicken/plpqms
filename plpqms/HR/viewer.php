<?php
session_start();
 require_once("connection.php");
include 'sweetAlert.php';

if (isset($_GET['file_id'])) {
    $id = mysqli_real_escape_string($conn,$_GET['file_id']);

    $sql = "SELECT * FROM  upload_files WHERE ID=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../uploads/'.$file['DEPARTMENT'].'/'. $file['NAME'];



 if (file_exists($filepath)) {
header("Content-type: application/pdf");
 header('Content-Disposition: inline; filename=' . basename($filepath));
 header('Content-Transfer-Encoding: binary');
 header('Accept-Ranges: bytes');
 @readfile('../uploads/'.$file['DEPARTMENT'].'/'. $file['NAME']);
}
 else {
        echo "Failed";
    }
   }


?>