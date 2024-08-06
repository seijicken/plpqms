<?php
require_once("connection.php");

include 'sweetAlert.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['reg'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['admin_user']);
    $password = mysqli_real_escape_string($conn, $_POST['admin_password']);
    $user_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT, array('cost' => 12));
    $user_status = mysqli_real_escape_string($conn, $_POST['user_status']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    

    $q_checkadmin = $conn->query("SELECT * FROM `admin_login` WHERE `admin_user` = '$user_email'") or die(mysqli_error($conn));
    $v_checkadmin = $q_checkadmin->num_rows;

    if ($v_checkadmin == 1) {
        echo "<script type='text/javascript'>Swal.fire({
          icon: 'error',
          title: 'Error Creating Account!!',
          text:'The Inputted Admin Email Account is Already Registered!!',
          confirmButtonColor:'#00396D',
          confirmButtonText: 'Okay',
          timer:3000
        }).then(function(){
              window.history.back();
          })
         </script>";
    } else {
        $status = 'Admin';
        $query = mysqli_query($conn, "INSERT INTO newlycreatedadmin(email, status) VALUES ('$user_email' ,'$status')");
        // if (!$query) {
        //     exit("Error");
        // }

        // Move the uploaded image to the "signatures" folder
        $uploadDirectory = "signatures/"; // Change this to the directory where you want to store the uploaded images

        // Check if a file is uploaded
        if (isset($_FILES['admin_sign']) && $_FILES['admin_sign']['error'] == UPLOAD_ERR_OK) {
            $tempName = $_FILES['admin_sign']['tmp_name'];
            $fileName = $_FILES['admin_sign']['name'];

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($tempName, $uploadDirectory . $fileName)) {
                $sign = $uploadDirectory . $fileName;
            } else {
                // Handle the case where the file couldn't be moved
                $sign = ""; // Or provide a default value
            }
        } else {
            // Handle the case where no file is uploaded or an error occurred
            $sign = ""; // Or provide a default value   
        }

        $mail = new PHPMailer(true);
        try {
            // Server settings
            // ... (Your existing mailer settings)

            // Your existing mail sending code

            // Database insertion with the $sign variable
            $conn->query("INSERT INTO `admin_login` VALUES('0','$user_name', '$user_email', '$user_password', '$user_status', '$designation')") or die(mysqli_error($conn));

            echo "<script type='text/javascript'>Swal.fire({
                icon: 'success',
                title: 'Successfully Created!!',
                text:'Admin Account is Successfully Created, The Login Credentials is Sent to the Inputted Email.',
                confirmButtonColor:'#00396D',
                confirmButtonText: 'Okay',
                timer:3000
            }).then(function(){
                  window.history.back();
            })
         </script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
