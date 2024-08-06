<?php 
$conn = mysqli_connect("localhost", "root", "", "file_management");

if(!$conn){
	die("Connection error: " . mysqli_connect_error());	
}

$query = "SELECT * FROM resetpasswords";

  date_default_timezone_set("asia/manila");
   $expired = date("M-d-Y h:i A",strtotime("0 HOURS"));


// execute query 
$result = mysqli_query($conn, $query) or die ("Error in query: $query. ".mysqli_error()); 
$rowYr = mysqli_fetch_assoc($result); 

if (mysqli_num_rows($result) > 0) { 
	mysqli_query($conn, "DELETE FROM resetpasswords WHERE timeOut <= '$expired'");
	}
?>