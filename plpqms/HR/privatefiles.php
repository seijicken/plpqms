<?php
require_once("../session_expiry.php");
if (!isset($_SESSION["hr_email"])) {
  header("location:index.php");
} else {
  $uname = $_SESSION['hr_email'];
}
?>

<?php

require_once ("connection.php");


$id = mysqli_real_escape_string($conn, $_SESSION['hr_email']);



$r = mysqli_query($conn, "SELECT * FROM hr_user where id = '$id'") or die(mysqli_error($con));

$row = mysqli_fetch_array($r);

$username = $row['name'];
$id = $row['hr_email'];
// $fname=$row['fname'];
// $lname=$row['lname'];

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
  <title>PLP | QMS Approved Files</title>



  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" type="text/css" href="medias/css/sweetalert2.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <script type="text/javascript"
    src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/r-2.3.0/rr-1.2.8/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="medias/css/dataTable.css" />
  <link rel="stylesheet" type="text/css" href="medias/css/bulma.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bulma.min.css" />
  <link rel="stylesheet" type="text/css" href="medias/css/datatables.min.css" />

  <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
  <!-- end table-->
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
      var table = $('#dtable').DataTable({
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return 'Details History for #' + data[0] + ' - ' + data[1];
              }
            }),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
              tableClass: 'ui table'
            })
          }
        },
        "aLengthMenu": [
          [5, 10, 15, 25, 50, 100, -1],
          [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 10
      });
    });
  </script>





  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link href="custom.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    body {
      margin: 0;
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
      background: url('../assets/img/rtuflipInside.gif') 50% 50% no-repeat rgb(249, 249, 249);
      opacity: 1;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="sidebars.css" rel="stylesheet">
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
    <symbol id="collection" viewBox="0 0 16 16">
      <path
        d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z" />
    </symbol>
    <symbol id="calendar3" viewBox="0 0 16 16">
      <path
        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
      <path
        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
    </symbol>
    <symbol id="chat-quote-fill" viewBox="0 0 16 16">
      <path
        d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z" />
    </symbol>
    <symbol id="cpu-fill" viewBox="0 0 16 16">
      <path d="M6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
      <path
        d="M5.5.5a.5.5 0 0 0-1 0V2A2.5 2.5 0 0 0 2 4.5H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2A2.5 2.5 0 0 0 4.5 14v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14a2.5 2.5 0 0 0 2.5-2.5h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14A2.5 2.5 0 0 0 11.5 2V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5zm1 4.5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3A1.5 1.5 0 0 1 6.5 5z" />
    </symbol>
    <symbol id="gear-fill" viewBox="0 0 16 16">
      <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path
          d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
      </svg>
    </symbol>
    <symbol id="speedometer" viewBox="0 0 16 16">
      <path
        d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
      <path fill-rule="evenodd"
        d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
    </symbol>
    <symbol id="toggles2" viewBox="0 0 16 16">
      <path d="M9.465 10H12a2 2 0 1 1 0 4H9.465c.34-.588.535-1.271.535-2 0-.729-.195-1.412-.535-2z" />
      <path
        d="M6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm.535-10a3.975 3.975 0 0 1-.409-1H4a1 1 0 0 1 0-2h2.126c.091-.355.23-.69.41-1H4a2 2 0 1 0 0 4h2.535z" />
      <path d="M14 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0z" />
    </symbol>
    <symbol id="tools" viewBox="0 0 16 16">
      <path
        d="M1 0L0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z" />
    </symbol>
    <symbol id="chevron-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd"
        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
    </symbol>
    <symbol id="geo-fill" viewBox="0 0 16 16">
      <path fill-rule="evenodd"
        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z" />
    </symbol>
    <symbol id="folder" viewBox="0 0 16 16"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
        viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M928 444H820V330.4c0-17.7-14.3-32-32-32H473L355.7 186.2a8.15 8.15 0 0 0-5.5-2.2H96c-17.7 0-32 14.3-32 32v592c0 17.7 14.3 32 32 32h698c13 0 24.8-7.9 29.7-20l134-332c1.5-3.8 2.3-7.9 2.3-12 0-17.7-14.3-32-32-32zm-180 0H238c-13 0-24.8 7.9-29.7 20L136 643.2V256h188.5l119.6 114.4H748V444z">
        </path>
      </svg></symbol>
    <symbol id="folder" viewBox="0 0 16 16"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
        viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M928 444H820V330.4c0-17.7-14.3-32-32-32H473L355.7 186.2a8.15 8.15 0 0 0-5.5-2.2H96c-17.7 0-32 14.3-32 32v592c0 17.7 14.3 32 32 32h698c13 0 24.8-7.9 29.7-20l134-332c1.5-3.8 2.3-7.9 2.3-12 0-17.7-14.3-32-32-32zm-180 0H238c-13 0-24.8 7.9-29.7 20L136 643.2V256h188.5l119.6 114.4H748V444z">
        </path>
      </svg></symbol>
    <symbol id="addrescard"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="1.9em"
        xmlns="http://www.w3.org/2000/svg"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path
          d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm96-96c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zm128-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
      </svg></symbol>
    <symbol id="userclock"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em"
        xmlns="http://www.w3.org/2000/svg"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
        <path
          d="M496 224c-79.6 0-144 64.4-144 144s64.4 144 144 144 144-64.4 144-144-64.4-144-144-144zm64 150.3c0 5.3-4.4 9.7-9.7 9.7h-60.6c-5.3 0-9.7-4.4-9.7-9.7v-76.6c0-5.3 4.4-9.7 9.7-9.7h12.6c5.3 0 9.7 4.4 9.7 9.7V352h38.3c5.3 0 9.7 4.4 9.7 9.7v12.6zM320 368c0-27.8 6.7-54.1 18.2-77.5-8-1.5-16.2-2.5-24.6-2.5h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h347.1c-45.3-31.9-75.1-84.5-75.1-144zm-96-112c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128z" />
      </svg></symbol>
    <symbol id="building"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M48 0C21.5 0 0 21.5 0 48V464c0 26.5 21.5 48 48 48h96V432c0-26.5 21.5-48 48-48s48 21.5 48 48v80h96c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48H48zM64 240c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V240zm112-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V240c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V240zM80 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V112zM272 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16z" />
      </svg></symbol>
    <symbol id="user"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em"
        xmlns="http://www.w3.org/2000/svg"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path
          d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
      </svg></symbol>
    <symbol id="history"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65V152c0-13.3-10.7-24-24-24z" />
      </svg></symbol>
    <symbol id="userPlus"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em"
        xmlns="http://www.w3.org/2000/svg"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path
          d="M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
      </svg></symbol>
    <symbol id="users"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M144 160c-44.2 0-80-35.8-80-80S99.8 0 144 0s80 35.8 80 80s-35.8 80-80 80zm368 0c-44.2 0-80-35.8-80-80s35.8-80 80-80s80 35.8 80 80s-35.8 80-80 80zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM416 224c0 53-43 96-96 96s-96-43-96-96s43-96 96-96s96 43 96 96zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
      </svg></symbol>
    <symbol id="email"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
      </svg></symbol>
    <symbol id="lock"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
      </svg>
    </symbol>
    <symbol id="notif"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z" />
      </svg></symbol>
    <symbol id="question"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V250.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H222.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM288 352c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32z" />
      </svg></symbol>
    <symbol id="key"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z" />
      </svg></symbol>
    <symbol id="add"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM160 240c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v48h48c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H224v48c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V352H112c-8.8 0-16-7.2-16-16V304c0-8.8 7.2-16 16-16h48V240z" />
      </svg></symbol>
    <symbol id="signout"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
        height="2em" width="2em" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96C43 32 0 75 0 128V384c0 53 43 96 96 96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H96c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32h64zM504.5 273.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H192c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32H320v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
      </svg></symbol>
  </svg>


  <div class="row d-md-block w-100 ms-0">
    <div class="d-flex flex-column flex-shrink-0 p-3 pt-4 float-start" style="background-color: green;" id="sidebar">
      <a href="home.php" class="logo-wrapper">
        <img class="img-fluid mt-0" src="../assets/img/PLPLOGO2.png" width="250px" height="250px"></img>
      </a>
      <hr class="text-warning" style="background-color: orange;">
      <ul class="nav nav-pills flex-column mb-auto px-1" id="itemSidebar">
        <li class="nav-item">
          <a href="home.php" class="nav-link text-white" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#home" />
            </svg>
            Home
          </a>
        </li>
        <li>
          <a href="dashboard.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#speedometer2" />
            </svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white dropdown-toggle" style="background-color: rgba(202, 202, 202, .65);"
            data-bs-toggle="dropdown" aria-expanded="false">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#user" />
            </svg>
            <span>HR Files</span>
          </a>
          <ul class="dropdown-menu fw-normal border-top border-bottom border-3 border-warning ms-3"
            style="background-color: green;">
            <li>
              <a href="add_file.php" class="nav-link dropdown-item text-white">
                <i class="fa-solid fa-file-arrow-up pe-0 me-2" style="color: #ffffff;"></i>
                - Upload Files
              </a>
            </li>
            <li>
              <a href="ownfiles.php" class="nav-link dropdown-item text-white">
                <i class="fa-solid fa-file-circle-question pe-0 me-2" style="color: #ffffff;"></i>
                - In Progress Files
              </a>
            </li>
            <li>
              <a href="privatefiles.php" class="nav-link dropdown-item text-white"
                style="background-color: rgba(202, 202, 202, .65);">
                <i class="fa-solid fa-file-circle-check pe-0 me-2" style="color: #ffffff;"></i>
                - Approved Files
              </a>
            </li>
          </ul>
        </li>
        <!-- <li>
        <a href="addfile.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
          Add Document
        </a>
      </li> -->
        <li>
          <a href="pastFiles.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#folder" />
            </svg>
            Manage All Files
          </a>
        </li>
        <!-- <li>
        <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#modalRegisterForm">
          <svg class="bi pe-none me-2" width="20" height="16"><use xlink:href="#users"/></svg>Add Employee Account
        </a>
      </li> -->
        <li>
          <a href="add_offices.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#building" />
            </svg>
            Department Offices
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#addrescard" />
            </svg>
            View Account
          </a>
          <ul class="dropdown-menu fw-normal border-top border-bottom border-3 border-warning ms-3"
            style="background-color: green;">
            <li>
              <a href="view_acc.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#folder" />
                </svg>
                - Admins Accounts
              </a>
            </li>
            <li>
              <a href="view_user.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#folder" />
                </svg>
                - HR Accounts
              </a>
            </li>
            <li>
              <a href="view_user.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#folder" />
                </svg>
                - Faculty Account
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <svg class="bi pe-none me-1" width="20" height="16">
              <use xlink:href="#userclock" />
            </svg>
            View Login History
          </a>
          <ul class="dropdown-menu fw-normal border-top border-bottom border-3 border-warning ms-3"
            style="background-color: green;">
            <li>
              <a href="admin_log.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#history" />
                </svg>
                - Admin Login History
              </a>
            </li>
            <li>
              <a href="user_log.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#history" />
                </svg>
                - HR Login History
              </a>
            </li>
            <li>
              <a href="user_log.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#history" />
                </svg>
                - Faculty Login History
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="settings.php" class="nav-link text-white">
            <i class="fa-solid fa-gear pe-0 me-2" style="color: #ffffff;"></i>
            Settings
          </a>
        </li>
      </ul>
      <div class="dropdown" id="namePosition">
        <hr class="text-warning">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../../assets/img/user.png" alt="" width="35" height="35" class="bg-light rounded-circle me-2">
          <div>
            <strong>Logged in as:</strong><br>
            <span style="color: #AFAFAF;"><?php echo ucwords(htmlentities($username)); ?></span>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text- shadow" id="logout">
          <li>
            <a class="dropdown-item" href="#" onclick="confirmSignOut()">
              Sign out
              <svg class="bi pe-none me-2" width="20" height="20">
                <use xlink:href="#signout" />
              </svg>
            </a>
          </li>
        </ul>
      </div>
      <script>
        function confirmSignOut() {
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              cancelButton: 'btn btn-danger',
              confirmButton: 'btn btn-primary ms-2'
            },
            buttonsStyling: false
          });

          swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You will be signed out.",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No, cancel!',
            confirmButtonText: 'Yes, sign me out!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              // If confirmed, navigate to the logout script
              window.location.href = 'logout.php';
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              // If canceled, show a message (optional)
              swalWithBootstrapButtons.fire(
                'Cancelled!',
                'You are not signed out.',
                'error'
              );
            }
          });
        }
      </script>
      </li>
      </ul>
    </div>
  </div>
  </div>
  <div class="col-md-12 headertop ms-0" style=" background-color: green; z-index: -1;" id="headerCustom">
    <header class="ms-0 w-100 py-4 mb-6 border-bottom border-5 border-warning" style="height: 80px; z-index: -1">
      <div class="dropstart float-end">
        <li class="dropdown" style="list-style: none;">
          <span class="text-light px-3">Welcome HR!!</span>
          <a href="#" class="dropdown-toggle text-light text-decoration-none" id="notiftoggle" data-bs-toggle="dropdown"
            aria-expanded="false"><span class="badge rounded-pill bg-danger count"
              style="border-radius:10px;"></span><svg class="me-4" width="20" height="18">
              <use xlink:href="#notif" />
            </svg>
          </a>
          <ul class="dropdown-menu border-top border-start border-end border-dark border-bottom border-4 rounded-3"
            id="dropnotif"
            style="text-decoration: none; background-color: #E0A100; color:black; width: 350px; height: 400px; overflow-x:hidden; overflow-y: auto; ">
          </ul>

          <!-- Dropdown menu links -->
        </li>
      </div>
    </header>
  </div>

  <div class="collapse" id="navbarToggleExternalContent" style="background-color: green;">
    <div class="dark p-4">



      <a href="/" class="logo-wrapper">
        <img class="img-fluid mt-0" src="../assets/img/PLPLOGO2.png" width="250px" height="250px"></img>
      </a>
      <hr class="text-warning" style="background-color: orange;">
      <ul class="nav nav-pills flex-column mb-auto px-1" id="itemSidebar">
        <li class="nav-item">
          <a href="home.php" class="nav-link text-white" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#home" />
            </svg>
            Home
          </a>
        </li>
        <li>
          <a href="dashboard.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#speedometer2" />
            </svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white dropdown-toggle" style="background-color: rgba(202, 202, 202, .65);"
            data-bs-toggle="dropdown" aria-expanded="false">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#user" />
            </svg>
            <span>HR Files</span>
          </a>
          <ul class="dropdown-menu fw-normal border-top border-bottom border-3 border-warning ms-3"
            style="background-color: green;">
            <li>
              <a href="add_file.php" class="nav-link dropdown-item text-white">
                <i class="fa-solid fa-file-arrow-up pe-0 me-2" style="color: #ffffff;"></i>
                - Upload Files
              </a>
            </li>
            <li>
              <a href="ownfiles.php" class="nav-link dropdown-item text-white">
                <i class="fa-solid fa-file-circle-question pe-0 me-2" style="color: #ffffff;"></i>
                - In Progress Files
              </a>
            </li>
            <li>
              <a href="privatefiles.php" class="nav-link dropdown-item text-white"
                style="background-color: rgba(202, 202, 202, .65);">
                <i class="fa-solid fa-file-circle-check pe-0 me-2" style="color: #ffffff;"></i>
                - Approved Files
              </a>
            </li>
          </ul>
        </li>
        <!-- <li>
        <a href="addfile.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
          Add Document
        </a>
      </li> -->
        <li>
          <a href="pastFiles.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#folder" />
            </svg>
            Manage All Files
          </a>
        </li>
        <!-- <li>
        <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#modalRegisterForm">
          <svg class="bi pe-none me-2" width="20" height="16"><use xlink:href="#users"/></svg>Add Employee Account
        </a>
      </li> -->
        <li>
          <a href="add_offices.php" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#building" />
            </svg>
            Department Offices
          </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <svg class="bi pe-none me-2" width="16" height="16">
              <use xlink:href="#addrescard" />
            </svg>
            View Account
          </a>
          <ul class="dropdown-menu fw-normal border-top border-bottom border-3 border-warning ms-3"
            style="background-color: green;">
            <li>
              <a href="view_acc.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#folder" />
                </svg>
                - Admins Accounts
              </a>
            </li>
            <li>
              <a href="view_user.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#folder" />
                </svg>
                - HR Accounts
              </a>
            </li>
            <li>
              <a href="view_user.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#folder" />
                </svg>
                - Faculty Account
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <svg class="bi pe-none me-1" width="20" height="16">
              <use xlink:href="#userclock" />
            </svg>
            View Login History
          </a>
          <ul class="dropdown-menu fw-normal border-top border-bottom border-3 border-warning ms-3"
            style="background-color: green;">
            <li>
              <a href="admin_log.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#history" />
                </svg>
                - Admin Login History
              </a>
            </li>
            <li>
              <a href="user_log.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#history" />
                </svg>
                - HR Login History
              </a>
            </li>
            <li>
              <a href="user_log.php" class="nav-link dropdown-item text-white">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#history" />
                </svg>
                - Faculty Login History
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <div class="dropdown" id="namePosition">
        <hr class="text-warning">
        <a href="#" class="d-flex align-items-centered text-white text-decoration-none dropdown-toggle"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../assets/img/user.png" alt="" width="35" height="35" class="bg-light rounded-circle me-2 mt-1">
          <strong>Logged in as:<br><?php echo ucwords(htmlentities($username)); ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" id="logout">
          <li><a class="dropdown-item" href="#" onclick="confirmSignOut()">Sign out <svg class="bi pe-none me-2"
                width="16" height="16">
                <use xlink:href="#signout" />
              </svg></a>

            <script>
              function confirmSignOut() {
                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    cancelButton: 'btn btn-danger',
                    confirmButton: 'btn btn-primary ms-2'
                  },
                  buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                  title: 'Are you sure?',
                  text: "You will be signed out.",
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonText: 'No, cancel!',
                  confirmButtonText: 'Yes, sign me out!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.isConfirmed) {
                    // If confirmed, navigate to the logout script
                    window.location.href = 'logout.php';
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    // If canceled, show a message (optional)
                    swalWithBootstrapButtons.fire(
                      'Cancelled!',
                      'You are not signed out.',
                      'error'
                    );
                  }
                });
              }
            </script>
          </li>
        </ul>
      </div>
    </div>


  </div>
  <div class="pt-3 ms-0 w-100 mb-6 border-bottom border-5 border-warning" id="customMenu"
    style="background-color: green; height: 80px; ">
    <div class="container-fluid">
      <button class="mt-1 ms-2 btn btn-warning text-dark" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <svg class="" width="20" height="20">
          <use xlink:href="#gear-fill" />
        </svg>
        MENU
      </button>

      <div class="mt-2 dropstart float-end">
        <li class="dropdown" style="list-style: none;">
          <span class="text-light px-3">Welcome, Admin</span>
          <a href="#" class="dropdown-toggle text-light text-decoration-none" id="notiftoggle1"
            data-bs-toggle="dropdown" aria-expanded="false"><span class="badge rounded-pill bg-danger count1"
              style="border-radius:10px;"></span><svg class="me-4" width="20" height="18">
              <use xlink:href="#notif" />
            </svg>
          </a>
          <ul class="dropdown-menu border-top border-start border-end border-dark border-bottom border-4 rounded-3"
            id="dropnotif1"
            style="text-decoration: none; background-color: #E0A100; color:black; width: 350px; height: 400px; overflow-x:hidden; overflow-y: auto; ">
          </ul>

          <!-- Dropdown menu links -->
        </li>
      </div>
    </div>
    </nav>

  </div>
  </div>

  <div class="content">
    <div class="row ms-0 w-100" style="position: relative;">
      <div class="col-md-12 headertop ms-0 rounded-4 ">
        <div class="container-fluid mt-5 rounded-4">

          <!-- Heading -->
          <div class="card mb-4 wow fadeIn rounded-4">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between shadow bg-light rounded-4">

              <h4 class="mb-2 mb-sm-0 pt-1 fw-bold rounded-4">
                <a style="text-decoration: none; color:green; ">
                  <span style="color: #E0A100;">APPROVED FILES</span>
              </h4>
              <!-- 

          <form class="d-flex justify-content-center">
       
            <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
            <button class="btn btn-primary btn-sm my-0 p" type="submit">
              <i class="fas fa-search"></i>
            </button>

          </form> -->

            </div>

          </div>
        </div>
        <!--Grid column-->
        <!--Grid column-->
      </div>
      <div class="col-md-12">
        <div class="container-fluid">
          <div class="table-responsive">
            <table id="dtable" class="table table-striped w-100">


              <thead>
                <th class="all">ID</th>
                <th class="all">Filename</th>
                <th class="all">Uploaded by</th>
                <th class="desktop">Department</th>
                <th class="all">Approved by</th>
                <th class="all">Date/Time</th>
                <th class="none">FileSize</th>
                <th class="none">Downloads</th>
                <th class="desktop">Action</th>

              </thead>
              <tbody>
                <?php

                require_once ("connection.php");


                $query = "SELECT * FROM upload_files WHERE (EMAIL ='$id' AND ARCHIVE ='0' AND file_status = 'Approved') group by ID DESC";
                $result = mysqli_query($conn, $query);
                while ($file = mysqli_fetch_array($result)) {
                  $id = $file['id'];
                  $controlid = $file['controlNumber'];
                  $name = $file['NAME'];
                  $department = $file['DEPARTMENT'];
                  $size = $file['SIZE'];
                  $description = $file['DESCRIPTION'];
                  $sentby = $file['SENTBY'];
                  $time = $file['TIMERS'];
                  $download = $file['DOWNLOAD'];

                  ?>

                  <tr>
                    <td class="fw-bold"><?php echo $controlid; ?></td>
                    <td width="20%"><?php echo $name; ?></td>
                    <td><?php echo $sentby; ?></td>
                    <td><?php echo $department; ?></td>
                    <td><?php echo $sentby; ?></td>
                    <td><?php echo $time; ?></td>
                    <td><?php echo floor($size / 1000) . ' KB'; ?></td>
                    <td><?php echo $download; ?></td>


                    <td>
                    <a href='view_updatedDocument.php?controlNumber=<?php echo $controlid; ?>' onclick="viewDocument(event)" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>
                      <script>
                        function viewDocument(event) {
                          event.preventDefault();
                          var urlToRedirect = event.currentTarget.getAttribute('href');
                          window.open(urlToRedirect, '_blank');
                        }
                      </script>

                      <a href="share.php?id=<?php echo $id; ?>" class="btn btn-sm btn-outline-success"><i
                          class="fa fa-share"></i></a>

                      <a href='downloads.php?file_id=<?php echo $id; ?>' onclick="downloadYes(event)"
                        class="btn btn-sm btn-outline-primary"><i class="fa fa-download"></i>
                        <script>
                          function downloadYes(evs) {
                            document.querySelector("body").style.overflow = 'hidden';
                            evs.preventDefault();
                            var urlToRedirect = evs.currentTarget.getAttribute('href');
                            window.location.href = urlToRedirect;
                            Swal.fire({
                              icon: 'success',
                              title: 'Downloading!!',
                              text: 'Your Requested File is Now Downloading.',
                              showConfirmButton: false,
                              timer: 7000
                            }).then(function () { })
                            document.querySelector("body").style.overflow = 'visible';
                          }
                        </script>

                      </a>
                      <a href="archive.php?ID=<?php echo $id; ?>" class="btn btn-sm btn-outline-danger"
                        onclick="yesNO(event)"><i class="fa fa-archive"></i>
                        <script>
                          function yesNO(ev) {
                            document.querySelector("body").style.overflow = 'hidden';
                            ev.preventDefault();
                            var urlToRedirect = ev.currentTarget.getAttribute('href');
                            const swalWithBootstrapButtons = Swal.mixin({
                              customClass: {
                                cancelButton: 'btn btn-danger',
                                confirmButton: 'btn btn-primary ms-2'
                              },
                              buttonsStyling: false
                            })

                            swalWithBootstrapButtons.fire({
                              title: 'Are you sure?',
                              text: "You won't be able to revert this!",
                              icon: 'warning',
                              showCancelButton: true,
                              cancelButtonText: 'No, cancel!',
                              confirmButtonText: 'Yes, Archive it!',
                              reverseButtons: true
                            }).then((result) => {
                              if (result.isConfirmed) {
                                window.location.href = urlToRedirect;
                              } else if (
                                /* Read more about handling dismissals below */
                                result.dismiss === Swal.DismissReason.cancel
                              ) {
                                swalWithBootstrapButtons.fire(
                                  'Cancelled!',
                                  'Your File is Safe and Didnt Delete.',
                                  'error'
                                )
                                document.querySelector("body").style.overflow = 'visible';
                              }
                            })
                          }
                        </script>
                      </a>
                    </td>

                  </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>


        <!--/.Card-->



        <!--Grid column-->

        <!--Grid column-->
        <!--Card-->
        <!--Grid column-->

      </div>
    </div>
    <div class="footerstyleAccount">
      <div class="col-md-12 headertop ms-0 position-relative bottom-0 start-0">
        <footer class="ms-0 w-100 py-3 mb-5 border-top border-5 border-warning mt-4" style="background-color: green;"
          id="footerSize">
          <center>
            <p class="text-light my-0" id="footerText"> COPYRIGHT PAMANTASAN NG LUNSGOD NG PASIG ALL RIGHT RESERVED
              &copy; 2023</p>
          </center>
        </footer>
      </div>
    </div>
  </div>

  </div>




  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="sidebars.js"></script>



  <script type="text/javascript" src="js/popper.min.js"></script>

  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/mdb.min.js"></script>



  <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">

    <form action="create_admin.php" method="POST" id="form">
      <div class="modal-dialog modal-dialog-centered rounded-5" role="document">
        <div class="modal-content bg-light rounded-5">
          <div class="modal-header text-center rounded-5">
            <h4 class="modal-title w-100 rounded-4" style="color: green;"> ADD EMPLOYEE ACCOUNT</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
          </div>
          <div class="modal-body rounded-4">
            <div class="md-form mb-0">
              <center>
                <img src="../assets/img/userplus.gif" height="250" width="250">
              </center>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-4" id="name" placeholder="Enter email" name="name">
              <label for="email"><svg class="" width="20" height="20">
                  <use xlink:href="#user" />
                </svg> Enter Name</label>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-4" id="email" placeholder="Enter email" name="admin_user">
              <label for="email"><svg class="" width="20" height="20">
                  <use xlink:href="#email" />
                </svg> Enter Email</label>
            </div>

            <div class="form-floating mb-3">
              <input type="password" class="form-control rounded-4" id="pass" placeholder="Enter password"
                name="admin_password" required>
              <label for="email"><svg class="" width="20" height="20">
                  <use xlink:href="#lock" />
                </svg> Enter Password</label>
            </div>


            <div class="row">
              <div class="col md-6 form-floating mb-3">
                <select class="form-select rounded-4" aria-label="Default select example" required name="user_status"
                  onchange="userType(this.value);">
                  <option selected value="Admin"> Admin</option>
                  <option value="User"> User</option>
                </select>
                <label class="ms-2 mb-1"><svg class="" width="20" height="20">
                    <use xlink:href="#users" />
                  </svg> Admin or Employee</label>
              </div>

              <div class=" col md-6 form-floating mb-3">
                <select class="form-select rounded-4" name="designation" aria-label="Default select example"
                  id="lastname" required>
                  <option selected value="">Choose Designation</option>
                  <?php
                  require_once ("connection.php");

                  $query = "SELECT OFFICES FROM department_office";
                  $result = mysqli_query($conn, $query);
                  while ($file = mysqli_fetch_assoc($result)) {

                    $offices = $file['OFFICES'];

                    ?>
                    <option value="<?php echo $offices; ?>"><?php echo $offices; ?> Office</option> <?php } ?>

                </select>

                <label class="ms-2 mb-1"><svg class="" width="20" height="20">
                    <use xlink:href="#building" />
                  </svg> Designation Office</label>
              </div>

            </div>


            <div class="modal-footer d-flex justify-content-center" id="reg">
              <button class="btn btn-warning fw-bold rounded-4" name="reg">CREATE ADMIN ACCOUNT </button>
            </div>

            <div class="modal-footer d-flex justify-content-center" id="reguser"
              style="visibility: hidden; position: absolute;">
              <button class="btn btn-warning fw-bold rounded-4" name="reguser">CREATE EMPLOYEE ACCOUNT </button>
            </div>

          </div>
        </div>
    </form>

    <script type="text/javascript">
      $(document).ready(function () {

        function load_unseen_notification(view = '') {
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              view: view
            },
            dataType: "json",
            success: function (data) {
              $('#dropnotif').html(data.notification);
              if (data.unseen_notification > 0) {
                $('.count').html(data.unseen_notification);
              }
            }
          });
        }

        load_unseen_notification();


        $(document).on('click', '#notiftoggle', function () {
          $('.count').html('');
          load_unseen_notification('yes');
        });

        setInterval(function () {
          load_unseen_notification();;
        }, 5000);

      });
    </script>

    <script type="text/javascript">
      $(document).ready(function () {

        function load_unseen_notification(view = '') {
          $.ajax({
            url: "fetch1.php",
            method: "POST",
            data: {
              view: view
            },
            dataType: "json",
            success: function (data) {
              $('#dropnotif1').html(data.notification);
              if (data.unseen_notification > 0) {
                $('.count1').html(data.unseen_notification);
              }
            }
          });
        }

        load_unseen_notification();


        $(document).on('click', '#notiftoggle1', function () {
          $('.count1').html('');
          load_unseen_notification('yes');
        });

        setInterval(function () {
          load_unseen_notification();;
        }, 5000);

      });
    </script>




    <script>
      function userType(value) {

        let val = value;


        if (val === "User") {

          document.getElementById("reguser").style.visibility = "visible";
          document.getElementById("reguser").style.position = null;
          document.getElementById("reg").style.visibility = "hidden";
          document.getElementById("reg").style.position = "absolute";

          document.getElementById("email").name = "email_address";
          document.getElementById("pass").name = "user_password";

          document.getElementById("form").action = "create_user.php";
        } else {

          document.getElementById("reg").style.visibility = "visible";
          document.getElementById("reg").style.position = null;
          document.getElementById("reguser").style.visibility = "hidden";
          document.getElementById("reguser").style.position = "absolute";

          document.getElementById("email").name = "admin_user";
          document.getElementById("pass").name = "admin_password";
          document.getElementById("sign").name = "admin_sign";

          document.getElementById("form").action = "create_admin.php";
        }

      }
    </script>

    <script type="text/javascript">
      $(window).on('load', function () {
        //you remove this timeout
        setTimeout(function () {
          $('#loader').fadeOut('slow');
        }, 300);
        //remove the timeout
        //$('#loader').fadeOut('slow'); 
      });
    </script>
</body>


</html>