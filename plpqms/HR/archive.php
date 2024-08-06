<?php
session_start();
 require_once("connection.php");
include 'sweetAlert.php';

$id = mysqli_real_escape_string($conn,$_GET['ID']);


mysqli_query($conn,"UPDATE upload_files SET ARCHIVE = '1' WHERE ID='$id'") or die(mysql_error());
	echo "<script type='text/javascript'>Swal.fire({
  icon: 'success',
  title: 'Archived',
  text:'Your Document Has Been Archived',
  confirmButtonColor:'#00396D',
   confirmButtonText: 'Okay',
   timer:3000

}).then(function(){
         window.history.back();
          })
         </script>";
?>
