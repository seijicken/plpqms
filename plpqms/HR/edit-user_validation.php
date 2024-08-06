<?php
session_start();
 require_once("connection.php");


 if(isset($_POST['edit2'])){
         $user_name = mysqli_real_escape_string($conn,$_POST['name']);
         $email_address = mysqli_real_escape_string($conn,$_POST['email_address']);
         $user_password = mysqli_real_escape_string($conn,$_POST['user_password']);
         $user_status = mysqli_real_escape_string($conn,$_POST['status']);
		 $sign = mysqli_real_escape_string($conn,$_POST['sign']);

	// $pass=sha1($password);
	// 	$salt="a1Bz20ydqelm8m1wql";
	// 	$password=$salt.$pass;

      $q_checkadmin = $conn->query("SELECT * FROM `login_user` WHERE `email_address` = '$email_address'") or die(mysqli_error());
		$v_checkadmin = $q_checkadmin->num_rows;
		if($v_checkadmin == 1){
			echo '
				<script type = "text/javascript">
					alert("Email Address already taken");
					window.location = "view_user.php";
				</script>
			';
		}else{
			$conn->query("UPDATE `login_user` SET `name` = '$user_name', `email_address` = '$email_address', `user_password` = '$user_password', `user_status` = '$user_status', `sign` = '$sign'  WHERE `id` = '$_REQUEST[id]'") or die(mysqli_error());
			 echo '
			 	<script type = "text/javascript">
			 		alert("Successfully Edited");
			 		window.location = "view_user.php";
			 	</script>
			 ';
		}
	}	

	?>