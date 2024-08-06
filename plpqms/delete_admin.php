<?php
session_start();

 require_once("connection.php");

include 'sweetAlert.php';
$id = mysqli_real_escape_string($conn,$_GET['id']);


mysqli_query($conn,"DELETE FROM admin_login WHERE id='$id'")or die(mysql_error());
echo "<script type='text/javascript'>Swal.fire({
  icon: 'success',
  title: 'Deleted!',
  text:'User Account Has Been Deleted.',
  confirmButtonColor:'#00396D',
   confirmButtonText: 'Okay',
   timer:3000

}).then(function(){
          window.history.back();
          })
         </script>";
?>
