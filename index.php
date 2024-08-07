<?php
session_start();

require_once ("plpqms/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <link rel="icon" type="image/x-icon" href="assets/img/PLP.png">
  <link rel="icon" type="image/x-icon" href="assets/img/PLP.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <title>PLP | QMS Login Page</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/headers/">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
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

    #loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('assets/img/rtufliplogo.gif') 50% 50% no-repeat rgb(249, 249, 249);
      opacity: 1;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="headers.css" rel="stylesheet">
</head>

<body>
  <!-- <div id="loader"></div> -->
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="bootstrap" viewBox="0 0 118 94">
      <title>Bootstrap</title>
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z">
      </path>
    </symbol>
    <symbol id="home" viewBox="0 0 16 16">
      <path
        d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
    </symbol>
    <symbol id="speedometer2" viewBox="0 0 16 16">
      <path
        d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z" />
      <path fill-rule="evenodd"
        d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z" />
    </symbol>
    <symbol id="table" viewBox="0 0 16 16">
      <path
        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
      <path fill-rule="evenodd"
        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
    </symbol>
    <symbol id="grid" viewBox="0 0 16 16">
      <path
        d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
    </symbol>
  </svg>
  <main>

    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-5 border-warning"
      style="background-color: green;">
      <a href="/" class="d-flex align-items-center ms-5 mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img class="bi me-2" src="assets/img/PLP.png" width="60" height="57"></img>
        <span class="fs-4 ms-2 fw-bold text-light" style="font-family: arial;">PAMANTASAN NG LUNGOD NG PASIG DOCUMENT
          MANAGEMENT SYSTEM</span>
      </a>
    </header>
  </main>


  <div class="row w-100">
    <div id="carouselExampleIndicators" class="col-6 carousel slide" data-bs-ride="true" style="margin-top:-171px;">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner" style="z-index: -1; " id="item">
        <div class="carousel-item active">
          <img src="assets/img/plp1.jpg" class="vh-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/img/plp2.jpg" class="vh-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/img/plp.jpg" class="vh-100" alt="...">
        </div>
      </div>
    </div>

    <div
      class="col-lg-4 mb-auto mt-auto ms-auto bg-light border-top border-bottom rounded-4 border-5 me-auto d-flex justify-content-center">
      <div class="container login-sec">
        <img src="assets/img/PLPLOGO1.png" class="img-fluid mt-3" title="e-PLP" alt="e-PLP">
        <hr class="mb-3">


        <!--FORM-->
        <form id="form" class="login-form mt-4" action="adminlogin.php" method="POST">

          <div class=" text-center form-floating mb-2">

            <button type="button" onclick="chooseLogin_employee()" id="loginEmploy"
              class=" btn col-5 text-dark btn-floating rounded-3 font-weight-bold"
              style="background:#E0A100; font-weight:bold;">Personnel <i class="fa fa-sign-in"
                aria-hidden="true"></i></button>

            <button type="button" onclick="chooseLogin_admin()" id="loginAdmin"
              class=" btn col-5 text-dark btn-floating rounded-3 font-weight-bold"
              style="background:#E0A100; font-weight:bold;">Admin <i class="fa fa-sign-in"
                aria-hidden="true"></i></button> <br>
            <br>
            <button type="button" onclick="chooseLogin_HR()" id="loginHR"
              class=" btn col-10 text-dark btn-floating rounded-3 font-weight-bold"
              style="background:#E0A100; font-weight:bold;"> Human Resource (HR) <i class="fa fa-sign-in"
                aria-hidden="true"></i></button>
          </div>


          <div id="emailDiv" class="form-floating mb-2 mt-2" style="display: none; position: absolute;">
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="admin_user" required>
            <label for="email" id="emailph" textContent="">Enter Email</label>
          </div>

          <div id="pwdDiv" class="form-floating mt-3 mb-3" style="display: none; position: absolute;">
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="admin_password"
              required>
            <label for="pwd" id="passwordph" textContent="">Enter Password</label>
            <a href="plpqms/forgotPass.php" class="mt-2" id="forgotpass" style="display:none" textContent=""> Forgot
              Password?</a>
          </div>

          <div class="form-floating mb-4">
            <button type="button" onclick="goback()" id="submitbtn1"
              class="float-start btn mb-3 col-6 text-dark btn-floating rounded-3 font-weight-bold"
              style="background:#9B9B9B; font-weight:bold; display: none; " textContent=""><i
                class="fa fa-arrow-left"></i> Go Back</button>
            <button type="reset" id="resetbtn"
              class="float-end btn col-5 mb-3 text-dark btn-floating rounded-3 font-weight-bold"
              style="background:#E0A100; font-weight:bold; display: none;" textContent=""><i class="fa fa-refresh"></i>
              Reset</button>
            <button type="submit" id="submitbtn"
              class="mt-0 btn col-12 text-dark btn-floating rounded-3 font-weight-bold"
              style="background:#E0A100; font-weight:bold; display:none" textContent=""></button>
          </div>

        </form>

      </div>
    </div>
  </div>
  <div class="footertop position-relative top-100 start-0"
    style="background:green; margin-top: -0px; z-index: -1; height: 53px;">
    <footer class="border-top border-5 border-warning">
      <p class="text-light my-3 d-flex justify-content-center" style="font-size:13px; font-family: arial"> COPYRIGHT
        PAMANTASAN NG LUNGSOD NG PASIG ALL RIGHTS RESERVED &copy; 2023</p>
    </footer>
  </div>

  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    $(window).on('load', function () {
      //you remove this timeout
      setTimeout(function () {
        $('#loader').fadeOut('slow');
      }, 1500);
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
    });
  </script>
  <script>

    function chooseLogin_employee() {


      document.getElementById("submitbtn").style.display = "block";
      document.getElementById("forgotpass").style.display = "block";


      document.getElementById("submitbtn1").style.display = "inline-block";
      document.getElementById("resetbtn").style.display = "inline-block";

      document.getElementById("submitbtn1").style.position = null;

      document.getElementById("loginEmploy").style.display = "none";
      document.getElementById("loginAdmin").style.display = "none";
      document.getElementById("loginHR").style.display = "none";


      document.getElementById("submitbtn").name = "logIn";
      const element = document.getElementById("submitbtn");
      element.innerHTML = "Personnel Login &#10149;";

      document.getElementById("emailph").textContent = "Personnel Email";
      document.getElementById("passwordph").textContent = "Personnel Password ";
      document.getElementById("forgotpass").textContent = "Forgot Personnel Password?";
      forgotpass.href = "plpqms/forgotPassPersonnel.php"; // Employee forgot password link

      document.getElementById("email").name = "email_address";
      document.getElementById("pwd").name = "user_password";
      document.getElementById("form").action = "plpqms/employee/login.php";

      document.getElementById("emailDiv").style.display = "block";
      document.getElementById("emailDiv").style.position = null;
      document.getElementById("pwdDiv").style.display = "block";
      document.getElementById("pwdDiv").style.position = null;

    }

    function chooseLogin_HR() {


      document.getElementById("submitbtn").style.display = "block";
      document.getElementById("forgotpass").style.display = "block";

      document.getElementById("submitbtn1").style.display = "inline-block";
      document.getElementById("submitbtn1").style.position = null;
      document.getElementById("resetbtn").style.display = "inline-block";

      document.getElementById("emailph").textContent = "HR Email";
      document.getElementById("passwordph").textContent = "HR Password";
      document.getElementById("forgotpass").textContent = "Forgot HR Password?";
      forgotpass.href = "plpqms/forgotPassHR.php"; // Employee forgot password link


      document.getElementById("submitbtn").name = "hrlog";
      document.getElementById("submitbtn").textContent = "hr_Login";
      const element = document.getElementById("submitbtn");
      element.innerHTML = "HR Login &#10149;";

      document.getElementById("loginEmploy").style.display = "none";
      document.getElementById("loginAdmin").style.display = "none";
      document.getElementById("loginHR").style.display = "none";

      document.getElementById("email").name = "hr_email";
      document.getElementById("pwd").name = "hr_password";
      document.getElementById("form").action = "plpqms/HR/login.php";

      document.getElementById("emailDiv").style.display = "block";
      document.getElementById("emailDiv").style.position = null;
      document.getElementById("pwdDiv").style.display = "block";
      document.getElementById("pwdDiv").style.position = null;


    }

    function goback() {

      document.getElementById("submitbtn").style.display = "none";
      document.getElementById("forgotpass").style.display = "none";
      document.getElementById("forgotpass").textContent = "Forgot Admin Password?";


      document.getElementById("submitbtn1").style.display = "none";

      document.getElementById("submitbtn1").style.position = null;

      document.getElementById("resetbtn").style.display = "none";

      document.getElementById("loginEmploy").style.display = "inline-block";
      document.getElementById("loginAdmin").style.display = "inline-block";
      document.getElementById("loginHR").style.display = "inline-block";


      document.getElementById("emailDiv").style.display = "none";
      document.getElementById("emailDiv").style.position = null;
      document.getElementById("pwdDiv").style.display = "none";
      document.getElementById("pwdDiv").style.position = null;
    }

    function chooseLogin_admin() {


      document.getElementById("submitbtn").style.display = "block";
      document.getElementById("forgotpass").style.display = "block";

      document.getElementById("submitbtn1").style.display = "inline-block";
      document.getElementById("submitbtn1").style.position = null;
      document.getElementById("resetbtn").style.display = "inline-block";

      document.getElementById("emailph").textContent = "Admin Email";
      document.getElementById("passwordph").textContent = "Admin Password";


      document.getElementById("submitbtn").name = "adminlog";
      document.getElementById("submitbtn").textContent = "Admin Login";
      const element = document.getElementById("submitbtn");
      element.innerHTML = "Admin Login &#10149;";

      document.getElementById("loginEmploy").style.display = "none";
      document.getElementById("loginAdmin").style.display = "none";
      document.getElementById("loginHR").style.display = "none";

      document.getElementById("email").name = "admin_user";
      document.getElementById("pwd").name = "admin_password";
      document.getElementById("form").action = "plpqms/admin_login.php";

      document.getElementById("emailDiv").style.display = "block";
      document.getElementById("emailDiv").style.position = null;
      document.getElementById("pwdDiv").style.display = "block";
      document.getElementById("pwdDiv").style.position = null;
    }
  </script>

</body>

</html>