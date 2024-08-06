<?php
session_start();
require_once("connection.php");
include 'sweetAlert.php';


     require_once("connection.php");


 $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);

 

 $r = mysqli_query($conn,"SELECT * FROM hr_user where id = '$id'") or die (mysqli_error($con));

 $row = mysqli_fetch_array($r);
 
 $username=$row['name'];
 $id=$row['hr_email'];
  // $fname=$row['fname'];
  // $lname=$row['lname'];




$id = mysqli_real_escape_string($conn,$_GET['ID']);
$q = mysqli_query($conn,"SELECT * FROM `upload_files` WHERE id = '$id'") or die (mysqli_error($conn));
$rs1 = mysqli_fetch_array($q);
               $fname1=$rs1['NAME'];
               $dept = $rs1['DEPARTMENT'];


               
$filePath = "../uploads/" . $dept . "/" . $fname1;

// Check if the file exists and is readable
if (file_exists($filePath) && is_readable($filePath)) {
    // Attempt to close the file if it's open
    fclose(fopen($filePath, "a"));

    // Now, attempt to delete the file
    if (unlink($filePath)) {
        // File deletion successful
        echo "File deleted successfully.";
    } else {
        // File deletion failed
        echo "Error deleting the file.";
    }
} else {
    // File does not exist or is not readable
  
}




mysqli_query($conn,"DELETE FROM upload_files WHERE ID='$id'")or die(mysql_error());
mysqli_query($conn,"DELETE FROM download_log WHERE ID='$id'")or die(mysql_error());
mysqli_query($conn,"DELETE FROM upload_log WHERE ID='$id'")or die(mysql_error());
			echo "<script type='text/javascript'>Swal.fire({
  icon: 'success',
  title: 'Deleted!',
  text:'Your File Has Been Deleted.',
  confirmButtonColor:'#00396D',
   confirmButtonText: 'Okay',
   timer:3000

}).then(function(){
          window.history.back();
          })
         </script>";
        

?>
