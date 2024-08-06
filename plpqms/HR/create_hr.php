<?php
error_log("Executing create_hr.php");
require_once ("connection.php");
include 'sweetAlert.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user_name = mysqli_real_escape_string($conn, $_POST['name']);
  $email_address = mysqli_real_escape_string($conn, $_POST['hr_user']);
  $password = mysqli_real_escape_string($conn, $_POST['hr_password']);
  $user_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
  $user_status = mysqli_real_escape_string($conn, $_POST['user_status']);

  $q_checkadmin = $conn->query("SELECT * FROM `hr_user` WHERE `hr_email` = '$email_address'");
  if ($q_checkadmin->num_rows > 0) {
    echo "<script type='text/javascript'>Swal.fire({
            icon: 'error',
            title: 'Error Creating Account!',
            text:'The Inputted User Email Account is Already Registered!',
            confirmButtonColor:'#00396D',
            confirmButtonText: 'Okay',
            timer:3000
        }).then(function(){
            window.history.back();
        })</script>";
  } else {
    $query = $conn->query("INSERT INTO newlycreatedhr(email, status) VALUES ('$email_address', 'HR')");
    if (!$query) {
      exit("Error: " . $conn->error);
    }

    // Handle 7 signatures insertion
    $baseDir = 'signatures/HR/legit/';

    if (!empty($_POST['name'])) {
      $userName = $_POST['name'];
      $trainingDir = $baseDir . 'training/' . $userName . '/';
      $validationDir = $baseDir . 'validation/' . $userName . '/';
      $testingDir = $baseDir . 'testing/' . $userName . '/';

      if (!file_exists($trainingDir)) {
        mkdir($trainingDir, 0666, true);
      }
      if (!file_exists($validationDir)) {
        mkdir($validationDir, 0666, true);
      }
      if (!file_exists($testingDir)) {
        mkdir($testingDir, 0666, true);
      }

      $fileCount = count($_FILES['signatureFiles']['name']);

      if ($fileCount != 7) {
        die('Please upload exactly 7 signature images.');
      }

      for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $_FILES['signatureFiles']['name'][$i];
        $fileTmpName = $_FILES['signatureFiles']['tmp_name'][$i];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileType, ['jpg', 'jpeg', 'png'])) {
          die('Only JPG, JPEG, and PNG files are allowed.');
        }

        $destinationTraining = $trainingDir . basename($fileName);
        $destinationValidation = $validationDir . basename($fileName);
        $destinationTesting = $testingDir . basename($fileName);

        if (!move_uploaded_file($fileTmpName, $destinationTraining)) {
          die('Error uploading file to training directory.');
        }

        if ($i < 5) {
          if (!copy($destinationTraining, $destinationValidation)) {
            die('Error copying file to validation directory.');
          }

          if (!copy($destinationTraining, $destinationTesting)) {
            die('Error copying file to testing directory.');
          }
        }
        // Store file paths for database insertion
        $filePaths[] = $destinationTraining;
      }

      // Database insertion for signature data
      $userId = ""; // Replace this with the actual user ID from your existing user table
      $role = "HR"; // Assuming this is the role for HR users, change it accordingly if needed

      // Fetch hr_email from the form submission
      $hr_email = $email_address;

      // Database insertion for signature data
      $stmt = $conn->prepare("INSERT INTO signature_data (hr_email, role, signature_1, signature_2, signature_3, signature_4, signature_5, signature_6, signature_7, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
      $stmt->bind_param("sssssssss", $hr_email, $role, $signature1, $signature2, $signature3, $signature4, $signature5, $signature6, $signature7);

      // Set the values for each signature column
      // These values should be obtained from the form submission or file uploads
      $signature1 = $trainingDir . basename($_FILES['signatureFiles']['name'][0]);
      $signature2 = $trainingDir . basename($_FILES['signatureFiles']['name'][1]);
      $signature3 = $trainingDir . basename($_FILES['signatureFiles']['name'][2]);
      $signature4 = $trainingDir . basename($_FILES['signatureFiles']['name'][3]);
      $signature5 = $trainingDir . basename($_FILES['signatureFiles']['name'][4]);
      $signature6 = $trainingDir . basename($_FILES['signatureFiles']['name'][5]);
      $signature7 = $trainingDir . basename($_FILES['signatureFiles']['name'][6]);

      // Execute the SQL statement
      if (!$stmt->execute()) {
        die("Error inserting signature data: " . $stmt->error);
      }

      $stmt->close();
    }

    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'carl.gorobao2525@gmail.com';
      $mail->Password = 'rymosuskklyfmddb';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      //Recipients
      $mail->setFrom('cergorobao@rtu.edu.ph', 'PLP | QMS Newly Created Account');
      $mail->addAddress($email_address);
      $mail->addReplyTo('no-reply@cergorobaortu.edu.ph', 'No Reply');

      $url = "https://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/index.php";
      //Content
      $mail->isHTML(true);
      $mail->Subject = 'Your Login Credentials at PLP | QMS';
      $mail->Body = "<h1>Your Account is Created in PLP | QMS</h1>
            <h3>Hi $user_name,</h3>
            Your Email Account is Successfully Registered at PLP | QMS.<br>
            <h3>The Login Credentials of Your Account:</h3>
            <b>Email: </b>$email_address<br>
            <b>Password: </b>$password<br>
            <b>Status: </b>HR<br><br>
            Access Link Via:<br>
            <a href='$url'>$url</a><br><br>
            Please Change Your Default Password When you First Login<br>
            If you need help, please contact the site administration.<br><br>   
            <b>- PLP | QMS Team</b>";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();

      // Database insertion for HR user
      $conn->query("INSERT INTO `hr_user` VALUES('0','$user_name', '$email_address', '$user_password', '$user_status')")
        or die(mysqli_error($conn));

      // Execute Python script to get validation accuracy
      // Rename the $python_path according to your python 3.11 interpreter
      $python_path = "C:/Users/sktui/AppData/Local/Microsoft/WindowsApps/PythonSoftwareFoundation.Python.3.11_qbz5n2kfra8p0/python.exe";
      $script_path = "../HR/practice/py.py";
      $output = shell_exec("$python_path $script_path 2>&1");

      // Define the default message
      $message = "HR Account is Successfully Created, The Login Credentials are Sent to the Inputted Email.";

      if ($output !== null && preg_match('/Final validation accuracy:\s*([\d.]+)%/', $output, $matches)) {
        // If accuracy is retrieved from the output
        $accuracy_value = number_format((float) $matches[1], 2, '.', '');
        $accuracy_message = "The validation accuracy is: <strong>$accuracy_value%</strong>";
        $message .= "<br>$accuracy_message";
      } else {
        // If accuracy cannot be retrieved
        $message .= "<br>Unable to retrieve validation accuracy.";
      }

      // Display Swal.fire with the message
      echo "<script type='text/javascript'>Swal.fire({
            icon: 'success',
            title: 'Successfully Created!',
            html: '$message',
            confirmButtonColor:'#00396D',
            confirmButtonText: 'Okay',
            timer:3000
        }).then(function(){
            window.history.back();
        })</script>";
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
?>