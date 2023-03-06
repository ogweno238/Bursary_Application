<?php

  // Start session   
  session_start();

  // Include database connection file

  include_once('config.php');

  // Send OTP to email Form post
  if (isset($_POST['otp'])) {
     	
   	$postOtp = $_POST['otp'];
   	$email  = $_SESSION['EMAIL'];
   	
   	$ret=mysqli_query($con,"SELECT * FROM students WHERE otp = '$postOtp' AND email = '$email'");
$num=mysqli_fetch_array($ret);
if($num>0)
{

       	$con->query("UPDATE students SET otp = '' WHERE email = '$email'");
       	$_SESSION['IS_LOGIN'] = $email; 
       	$_SESSION['eid']=$num['studID'];
        $_SESSION['bid']=$num['limit_checker'];
        $_SESSION['login']=$_POST['studID'];
       	echo "yes";         
   	}else{
       	echo "no";
   	} 
                 
  }

?>
