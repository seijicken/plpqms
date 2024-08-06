<?php

    session_start();

    require_once("connection.php");
    include 'sweetAlert.php';

    if (isset($_GET['file_id'])) {
        $id = mysqli_real_escape_string($conn,$_GET['file_id']);
        $sql2 = "UPDATE upload_files SET file_status = 'Approved' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql2);
        if($result){
            echo "<script type='text/javascript'>Swal.fire({
                icon: 'success',
                title: 'Approved',
                text:'Your Document Has Been Approved',
                confirmButtonColor:'#00396D',
                 confirmButtonText: 'Okay',
                 timer:3000
              
              }).then(function(){
                       window.history.back();
                        })
                       </script>";
        }

    } else {
        echo "Failed";
    }
?>