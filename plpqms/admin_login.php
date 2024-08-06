<?php
session_start();
error_reporting(0);
require_once("connection.php");
if(!isset($_POST["adminlog"])){
     header("location:index.php");
}

date_default_timezone_set("asia/manila");
$currentYear = date("Y",strtotime("+0 HOURS"));

$query = "SELECT * FROM yearvalidation";

// execute query 
$result = mysqli_query($conn, $query) or die ("Error in query: $query. ".mysqli_error()); 
$rowYr = mysqli_fetch_assoc($result); 
$yr = $rowYr['YEAR'];

// see if any rows were returned 
if (mysqli_num_rows($result) > 0) { 

	// //download_log
	// mysqli_query($conn, "DELETE FROM download_log WHERE YEAR <> $currentYear;");

	// //upload_log
	// mysqli_query($conn, "DELETE FROM upload_log WHERE YEAR <> $currentYear;");

	// //yearvalidation
	// mysqli_query($conn, "DELETE FROM yearvalidation WHERE YEAR <> $currentYear;");

	if ($currentYear != $yr){

	//Admin, Employee Logged Sessions
	mysqli_query($conn, "TRUNCATE TABLE history_log;");
	mysqli_query($conn, "TRUNCATE TABLE history_log1;");	
		
	} else {

	$updateYear = "UPDATE yearvalidation SET YEAR=$currentYear";
	mysqli_query($conn, $updateYear);

	}
} 

if (mysqli_num_rows($result) == 0) { 

	$insertYr = "INSERT INTO yearvalidation (YEAR) VALUES ('$currentYear');";
	mysqli_query($conn, $insertYr);
}

if(isset($_POST["adminlog"])){


  date_default_timezone_set("asia/manila");
  $date = date("M-d-Y h:i A",strtotime("+0 HOURS"));

 $username = mysqli_real_escape_string($conn, $_POST["admin_user"]);  
 $password = mysqli_real_escape_string($conn, $_POST["admin_password"]);

 $_SESSION["password"] = $password;


$query=mysqli_query($conn,"SELECT * FROM admin_login WHERE admin_user = '$username'")or die(mysqli_error($conn));
		$row=mysqli_fetch_array($query);
           $id=$row['id'];
            $admin=$row['admin_user'];
           $_SESSION["admin_user"] = $row["admin_user"];
           $status = $row["admin_status"];
	

    
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
}).then(function(){
				 	window.location='index.php'
				 	})
				 </script>";
			  } 
			  else
			  {
			  	if(password_verify($password, $row["admin_password"]))  
                     {
				  $_SESSION['admin_user']=$id;	

          $resetpass = mysqli_query($conn,"SELECT * FROM newlycreatedadmin WHERE email ='$username' AND status ='$status'")or die(mysqli_error($conn));
          $resetrow=mysqli_fetch_array($resetpass);
          $newEmail = $resetrow['email'];

          $resetcounter=mysqli_num_rows($resetpass);

          if($resetcounter ==1){
            $_SESSION["admin_user"] = $row["admin_user"];
            $_SESSION["admin_status"] = $row["admin_status"];

             include 'sweetAlert.php';
                   echo "<script type='text/javascript'>Swal.fire({
  icon: 'warning',
  title: 'First Login!',
  text:'Please Change Your Default Password First and Login Again.',
  confirmButtonColor:'#00396D',
   confirmButtonText: 'Okay',
}).then(function(){
          window.location='resetdefaultpass.php'
          })
         </script>";

          }

          else{

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
                       mysqli_query($conn,"INSERT INTO history_log1(id,admin_user,action,ip,host,login_time) VALUES('$id','$admin','$remarks','$ip','$host','$date')")or die(mysqli_error($conn));
    
                 
					   header("Location: home.php", true, 301);
					   exit();
           }
					   
			  }

			  else{
			      include 'sweetAlert.php';
				 echo "<script type='text/javascript'>Swal.fire({
	icon: 'error',
  title: 'Login Error!',
  text:'Invalid Email Address or Password,Please try again!',
  confirmButtonColor:'#00396D',
   confirmButtonText: 'Okay',

}).then(function(){
				 	window.location='index.php'
				 	})
				 </script>";
			}
	    }
   }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/PLP.png">
    <title>PLP | QMS Login Page</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/headers/">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="custom.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      
      }

    </style>

    
    <!-- Custom styles for this template -->
    <link href="headers.css" rel="stylesheet">
  </head>
  <body>
<main>

<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-5 border-warning" style="background-color: green;">
      <a href="/" class="d-flex align-items-center ms-5 mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img class="bi me-2" src="../assets/img/PLP.png" width="60" height="57"></img>
        <span class="fs-4 ms-2 fw-bold text-light" style="font-family: arial;">PAMANTASAN NG LUNGSOD NG PASIG DOCUMENT MANAGEMENT SYSTEM</span>
      </a>
    </header>
</main>


<div class="row w-100">
<div id="carouselExampleIndicators" class="col-6 carousel slide" data-bs-ride="true" style="margin-top:-171px;">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner" style="z-index: -1; " id="item">
    <div class="carousel-item active">
      <img src="../assets/img/plp1.jpg" class="vh-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../assets/img/plp2.jpg" class="vh-100" alt="...">
    </div>
      <div class="carousel-item">
        <img src="../assets/img/plp.jpg" class="vh-100" alt="...">
      </div>
    </div>
  </div>

  <div class="col-lg-4 mb-auto mt-auto ms-auto bg-light border-top border-bottom rounded-4 border-5 me-auto d-flex justify-content-center">
  <div class="container login-sec">
    <img src="../assets/img/PLPLOGO1.png" class="img-fluid mt-3" title="e-PLP" alt="e-PLP"><hr class="mb-3">


    <!--FORM-->
    <form id="form"class="login-form mt-4" action="admin_login.php" method="POST">

    <div id="emailDiv" class="form-floating mb-2 mt-2" style="display: block;">
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="admin_user" required >
      <label for="email" id="emailph" textContent="">Enter Email</label>
    </div>

    <div id="pwdDiv" class="form-floating mt-3 mb-3" style="display: block;">
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="admin_password" required>
      <label for="pwd" id="passwordph" textContent="">Enter Password</label>
      <a href="forgotPass.php" class="mt-2" id="forgotpass" style="display:block">  Forgot Admin Password?</a>
    </div>

      
    <div class="form-floating mb-4">
        <button type="button" onclick="goback()" id="submitbtn1" class="float-start btn mb-3 col-6 text-dark btn-floating rounded-3 font-weight-bold" style="background:#E0A100; font-weight:bold; display: inline-block; " textContent=""><i class="fa fa-arrow-left"></i> Go Back</button>
        <button type="reset" id="resetbtn" class="float-end btn col-5 mb-3 text-dark btn-floating rounded-3 font-weight-bold" style="background:#E0A100; font-weight:bold; display: inline-block;" textContent=""><i class="fa fa-refresh"></i>   Reset</button>

        <button type="submit" id="submitbtn" class="mt-0 btn col-12 text-dark btn-floating rounded-3 font-weight-bold" style="background:#E0A100; font-weight:bold; display: block;" textContent="">Admin Login &#8680;</button>
      </div>
      
  </form>

  </div>
</div>
</div>
    <div class="footertop" style="background:green; margin-top: -0px; z-index: -1; height: 53px;">
    <footer class="border-top border-5 border-warning">
      <p class="text-light my-3 d-flex justify-content-center" style="font-size:13px; font-family: arial"> COPYRIGHT PAMANTASAN NG LUNGSOD NG PASIG ALL RIGHTS RESERVED &copy; 2023</p>
    </footer>
  </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
