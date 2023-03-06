<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($con,"SELECT * FROM students WHERE email='".$_POST['email']."' and studID='".($_POST['studID'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="emp-changepassword.php";//
$_SESSION['IS_LOGIN']=$_POST['email'];
$_SESSION['eid']=$num['studID'];
$_SESSION['bid']=$num['limit_checker'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(uid,studentId,userip,status) values('".$_SESSION['eid']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['login']=$_POST['studentId'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog(studentId,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$errormsg="Invalid studentId or password";
$extra="login.php";

}
}



if(isset($_POST['change']))
{
   $studentId=$_POST['studentId'];
    $contactNo=$_POST['contactNo'];
    $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM studentinfo WHERE studentId='$studentId' and contactNo='$contactNo'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($con,"update studentinfo set password='$password' WHERE studentId='$studentId' and contactNo='$contactNo' ");
$msg="password Changed Successfully";

}
else
{
$errormsg="Invalid studentId id or password";
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>BURSARY MANAGEMENT SYSTEM FOR SOUTH MUGIRANGO CONSTITUENCY</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<script type="text/javascript">
function valid()
{
 if(document.forgot.password.value!= document.forgot.confirmpassword.value)
{
alert("password and Confirm password Field do not match  !!");
document.forgot.confirmpassword.focus();
return false;
}
return true;
}
</script>
  </head>

  <body>

      

	  <div id="login-page">
	  	<div class="container">
	  		<h3 align="center" style="color:#fff"><a href="../index.php" style="color:#fff">BURSARY MANAGEMENT SYSTEM FOR SOUTH MUGIRANGO CONSTITUENCY
</a></h3>
	<hr />
		      <form class="form-login" name="login" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="email" placeholder="email"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="studID" required placeholder="password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot password?</a>
		
		                </span>
						<span class="pull-left">
		                    <a href="../admin/"> Admin Login</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		           </form>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="registration.php">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		           <form class="form-login" name="forgot" method="post">
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your details below to reset your password.</p>
<input type="studentId" name="studentId" placeholder="studentId" autocomplete="off" class="form-control" required><br >
<input type="text" name="contactNo" placeholder="contactNo" autocomplete="off" class="form-control" required><br>
 <input type="password" class="form-control" placeholder="Original password" id="password" name="password"  required ><br />
<input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm password" id="confirmpassword" name="confirmpassword" required >

		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		          </form>
		
		      	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
