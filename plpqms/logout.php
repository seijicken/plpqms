<?php
session_start();
require_once("connection.php");
// this is logout page when user click button logout in system page


  date_default_timezone_set("asia/manila");
  $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));

 $email = $_SESSION['admin_user'];
  

mysqli_query($conn,"UPDATE history_log1 SET `logout_time` = '$time'  WHERE `id` = '$email' AND `logout_time` = ''");

$_SESSION = NULL;
$_SESSION = [];
session_unset();
session_destroy();

header("Location: index.php", true, 301);
exit();

?>

