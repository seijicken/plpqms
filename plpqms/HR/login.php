<?php

require_once("connection.php");

session_start();

if(isset($_POST["hrlog"])){


  date_default_timezone_set("asia/manila");
  $date = date("M-d-Y h:i A",strtotime("+0 HOURS"));

 $username = mysqli_real_escape_string($conn, $_POST["hr_email"]);  
 $password = mysqli_real_escape_string($conn, $_POST["hr_password"]);

 		
	
$query=mysqli_query($conn,"SELECT * FROM hr_user WHERE hr_email = '$username'")or die(mysqli_error($conn));
			$row=mysqli_fetch_array($query);
          	

    
           $counter=mysqli_num_rows($query);
            
		  	if ($counter == 0) 
			  {	
				include 'sweetAlert.php';
				 echo "<script type='text/javascript'>Swal.fire({
				icon: 'error',
  				title: 'Login Error!',
  				text:'Invalid Email Address or Password,Please try again!',
  				confirmButtonColor:'#00396D',
   				confirmButtonText: 'Okay',
   				timer:2500
				}).then(function(){
				window.location='../../index.php'
				 	})
			</script>";
			  } 
			  else
			  {
			  	if(password_verify($password, $row["hr_password"]))
                     {
					  $id=$row['id'];
          			  $hr=$row['hr_email'];
          				 $_SESSION["hr_email"] = $row["hr_email"];
				        $_SESSION['hr_email']=$id;	

				         if (!empty($_SERVER["HTTP_CLIENT_IP"]))
							{
							 $ip = $_SERVER["HTTP_CLIENT_IP"];
							}
							elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
							{
							 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
							}
							else
							{
							 $ip = $_SERVER["REMOTE_ADDR"];
							}

							$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);


			
                       $remarks="Has LoggedIn the system at";  
                       mysqli_query($conn,"INSERT INTO hr_log(id,hr_user,action,ip,host,login_time) VALUES('$id','$hr','$remarks','$ip','$host','$date')")or die(mysqli_error($conn));
    
                 
					   header("Location: home.php", true, 301);
					   exit();
						}
						else{
							include 'sweetAlert.php';
				 		echo "<script type='text/javascript'>Swal.fire({
						icon: 'error',
  						title: 'Login Error!',
  						text:'Invalid Email Address or Password,Please try again!',
  						confirmButtonColor:'#00396D',
   						confirmButtonText: 'Okay',
   						timer:2500
						}).then(function(){
						window.location='../../index.php'
				 		})
						</script>";
						}
					   
			  }
	    }

?>