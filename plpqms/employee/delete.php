<?php

 require_once("connection.php");

$id = mysqli_real_escape_string($conn,$_GET['ID']);


mysqli_query($conn,"DELETE FROM upload_files WHERE ID='$id'")or die(mysql_error());
include 'sweetAlert.php';
				 echo "<script type='text/javascript'>Swal.fire({
				  icon: 'success',
  				title: 'Deleted!',
  				text:'Your data is now deleted',
  				confirmButtonColor:'#00396D',
   				confirmButtonText: 'Okay',
   				timer:2500
				}).then(function(){
				window.location='ceatfolder.php'
				 	})
			</script>";
?>
