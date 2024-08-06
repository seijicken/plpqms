<?php 
session_start();
 require_once("connection.php");
include 'sweetAlert.php';


if (isset($_GET['file_id'])) {
    $id = mysqli_real_escape_string($conn,$_GET['file_id']);

    // fetch file to download from database
    $sql = "SELECT * FROM  upload_files WHERE ID=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../uploads/'.$file['DEPARTMENT'].'/'. $file['NAME'];

    
    if (file_exists($filepath)) {
                
        $updateQuery = "UPDATE upload_files SET ARCHIVE='0' WHERE ID=$id";
        mysqli_query($conn, $updateQuery);

        echo "<script type='text/javascript'>Swal.fire({
  icon: 'success',
  title: 'Restoring',
  text:'Your Requested File is Now Unarchiving.',
  confirmButtonColor:'#00396D',
   confirmButtonText: 'Okay',
   timer:3000

}).then(function(){
          window.location='archiveFiles1.php'
          })
         </script>";

        exit;
        
    } else {
        echo "Failed";
    }

}



?>
