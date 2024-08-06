<?php
require_once("connection.php");

// Get the inputted password
$password = $_POST['password'];
echo $username = $_POST['username'];

// Get the hashed password from the database
$r = mysqli_query($conn,"SELECT * FROM admin_login where name = '$username'") or die (mysqli_error($con));
$row = mysqli_fetch_array($r);
$pass = $row['admin_password'];

// Compare the inputted password with the hashed password
if(password_verify($password, $pass)){
    echo "1";
}else{
    echo "0";
}

?>


