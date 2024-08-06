<?php
session_start();

if(!isset($_SESSION["admin_user"])){
  header("location:index.php");
  
}else {
  
  $uname = $_SESSION['admin_user'];

}
?>

<?php 

     require_once("connection.php");


 $id = mysqli_real_escape_string($conn,$_SESSION['admin_user']);


 $r = mysqli_query($conn,"SELECT * FROM admin_login where id = '$id'") or die (mysqli_error($con));

 $row = mysqli_fetch_array($r);
 $username=$row['name'];
 $id=$row['admin_user'];
  // $fname=$row['fname'];
  // $lname=$row['lname'];



//fetch.php;
if(isset($_POST["view"])){

require_once("connection.php");
	$validate="SELECT EMAIL FROM notifcation_table";
	$result=mysqli_query($conn,$validate);

	while($file=mysqli_fetch_array($result)){
		$email = $file['EMAIL'];
	}

	$requestvalidate = 'Requested '.$id;

	if(($_POST["view"] != '')&& ($id!=$email)) {
		mysqli_query($conn,"UPDATE `notifcation_table` set SEEN_STATUS='1' where SEEN_STATUS='0' AND EMAIL !='$id' AND (SENDTO = 'All' OR SENDTO ='$id' OR SENDTO = '$requestvalidate')");
	}


	$query=mysqli_query($conn,"SELECT * from `notifcation_table` WHERE EMAIL!='$id' AND (SENDTO='$id' OR  SENDTO='All' OR SENDTO='$requestvalidate')  order by id desc limit 20");
	$output = '';

 
	if(mysqli_num_rows($query) > 0){
	while($row = mysqli_fetch_array($query)){
	$link = $row['LINK'];
	$output .= '
	<a href ="'.$link.'.php" class="text-decoration-none text-dark">
	<li class="px-3 p-2 rounded-3 hoverColor">
	<link href="custom.css" rel="stylesheet">

	
	
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
         <symbol id="clock"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="2em" width="2em" xmlns="http://www.w3.org/2000/svg"><path d="M256 512C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256s-114.6 256-256 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg></symbol>
       
</svg>
        
		<strong class="">'."- ".$row['EMAIL'].'</strong>
		'." ".$row['ACTION'].'
		<strong>'.$row['FILENAME'].'</strong><br>
		<strong class="mt-5">'.$row['controlNumber'].'</strong><br>
		<strong class="fw-bold float-end" style="font-size:13px;"><svg class="" width="16" height="16"><use xlink:href="#clock"/></svg>'. get_time_ago(strtotime($row['TIMERS']) ).'</strong>
		<br>
	</li>
	<hr class="fw-bold text-dark" style="background-color: white;">
	</a>
	';
	}
	}

	else{
	$output .= '<li class="px-3 p-2"><a href="#" class="text-decoration-none text-dark fw-bold">No Notification Found</a>
	<hr class="fw-bold text-dark" style="background-color: white;"></li>';
	}
	
	$query1=mysqli_query($conn,"SELECT * from `notifcation_table` where EMAIL!='$id' AND SEEN_STATUS='0' AND (SENDTO='$id' OR  SENDTO='All' OR SENDTO='$requestvalidate')");
	$count = mysqli_num_rows($query1);
	$data = array(
		'notification'   => $output,
		'unseen_notification' => $count
	);
	echo json_encode($data);


	
}



 function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
?>