<?php 
error_reporting(0); 
     require_once("connection.php");


 $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);

 

 $r = mysqli_query($conn,"SELECT * FROM admin_login where id = '$id'") or die (mysqli_error($con));

 $row = mysqli_fetch_array($r);
 
 $username=$row['name'];
 $id=$row['admin_user'];
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
    <title>PLP | QMS CEAT Folder</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <link rel="stylesheet" type="text/css" href="medias/css/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    
<script src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="medias/css/dataTable.css" />
    <link rel="stylesheet" type="text/css" href="medias/css/bulma.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="medias/css/datatables.min.css" />

    <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
    <!-- end table-->
    <script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    var table = $('#dtable').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
         responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details History for #'+data[0]+' - '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'ui table'
                } )
            }
        },
         "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
    } );
} );
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

      body{
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

        #loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('../assets/img/rtuflipInside.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }
    </style>

<script type="text/javascript">
window.onload = () => {
   $('#modal_upload').modal('show');
}

function btnclose() {
window.location="requested.php";
}

</script>




<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

 <script src="sidebars.js"></script>

<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>

<script type="text/javascript" src="js/popper.min.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/mdb.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/r-2.3.0/rr-1.2.8/datatables.min.js"></script>






<!-- Button trigger modal-->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSocial">Launch
  modal</button>

<!--Modal: modalSocial-->
<div class="modal fade" id="modalSocial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header light-blue darken-3 white-text">
        <h4 class="title"><i class="fas fa-users"></i> Spreed the word!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>

      <!--Body-->
      <div class="modal-body mb-0 text-center">


        <!--Facebook-->
        <a type="button" class="btn-floating btn-fb"><i class="fab fa-facebook-f"></i></a>
        <!--Twitter-->
        <a type="button" class="btn-floating btn-tw"><i class="fab fa-twitter"></i></a>
        <!--Google +-->
        <a type="button" class="btn-floating btn-gplus"><i class="fab fa-google-plus-g"></i></a>
        <!--Linkedin-->
        <a type="button" class="btn-floating btn-li"><i class="fab fa-linkedin-in"></i></a>
        <!--Instagram-->
        <a type="button" class="btn-floating btn-ins"><i class="fab fa-instagram"></i></a>
        <!--Pinterest-->
        <a type="button" class="btn-floating btn-pin"><i class="fab fa-pinterest"></i></a>
        <!--Youtube-->
        <a type="button" class="btn-floating btn-yt"><i class="fab fa-youtube"></i></a>
        <!--Dribbble-->
        <a type="button" class="btn-floating btn-dribbble"><i class="fab fa-dribbble"></i></a>
        <!--Vkontakte-->
        <a type="button" class="btn-floating btn-vk"><i class="fab fa-vk"></i></a>
        <!--Stack Overflow-->
        <a type="button" class="btn-floating btn-so"><i class="fab fa-stack-overflow"></i></a>
        <!--Slack-->
        <a type="button" class="btn-floating btn-slack"><i class="fab fa-slack-hash"></i></a>
        <!--Github-->
        <a type="button" class="btn-floating btn-git"><i class="fab fa-github"></i></a>
        <!--Comments-->
        <a type="button" class="btn-floating btn-comm"><i class="fas fa-comments"></i></a>
        <!--Email-->
        <a type="button" class="btn-floating btn-email"><i class="fas fa-envelope"></i></a>

      </div>

    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: modalSocial-->

   </body>
   </html>