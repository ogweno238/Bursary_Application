<?php
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
	$fullname=$_POST['fullname'];
	$studID=$_POST['studID'];
	$nationalID=md5($_POST['nationalID']);
	$contactno=$_POST['contactno'];
	
	$stud_year=$_POST['stud_year'];
	$stud_course=$_POST['stud_course'];
	$limit_checker=$_POST['limit_checker'];
	$status=1;
	$query=mysqli_query($con,"insert into students(fullName,studID,nationalID,contactNo,stud_year,stud_course,limit_checker,status) values('$fullname','$studID','$nationalID','$contactno','$stud_year','$stud_course','$limit_checker','$status')");
	$msg="Registration successfull. Now You can login !";
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

    <title>SOUTH MUGIRANGO BURSARY MS</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'studID='+$("#studID").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
  </head>

  <body>
	  <div id="login-page">
	  	<div class="container">
	<h3 align="center" style="color:#fff"><a href="../index.php" style="color:#fff">SOUTH MUGIRANGO BURSARY MANAGEMENT SYSTEM</a></h3>
	<hr />
		      <form class="form-login" id="submitForm">
		        <h2 class="form-login-heading">User Registration</h2>
		        <p style="padding-left: 1%; color: green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?>


		        </p>
		        <div class="login-wrap">
		         <input type="text" class="form-control" placeholder="Full Name" name="name" required="required" autofocus>
		            <br>
		            <input type="studID" class="form-control" placeholder="studID" id="studID" onBlur="userAvailability()" name="studID" required="required">
		             <span id="user-availability-status1" style="font-size:12px;"></span>
		            <br>
		            <input type="text" class="form-control" placeholder="email" required="required" name="email"><br >
		             <input type="text" class="form-control" maxlength="10" name="mobile" placeholder="Contact" required="required" autofocus>
		            <br>
					<select name="stud_year" required id="stud_year" class="form-control" maxlength="10" >
                                            <option value="" selected disabled>--Choose Year--</option>
                                            <option value="Year 1">Year 1</option>
                                            <option value="Year 2">Year 2</option>
											<option value="Year 3">Year 3</option>
											<option value="Year 4">Year 4</option>
                                        </select>
		            <br>
                                          <input type="text" class="form-control"  name="stud_course" placeholder="student course" required="required" autofocus>
		            <br>
					 <select class="form-control" maxlength="10"  name="limit_checker" required="required"  autocomplete="off">
					 <option value="" selected disabled>--parent occupation--</option>

<?php $sql=mysqli_query($con,"select limit_checker,occupation from bursary_limits ");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($rw['limit_checker']);?>"><?php echo htmlentities($rw['occupation']);?></option>
<?php
}
?>
</select>
		            <br>
		            
		            <button class="btn btn-theme btn-block"  type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Register</button>
		            <hr>
		            
		            <div class="registration">
		                Already Registered<br/>
		                <a class="" href="index.php">
		                   Sign in
		                </a>
		            </div>
		
		        </div>
		
		      
		
		      </form>	  	
	  	
	  	</div>
	  </div>
	  <script type="text/javascript">
  $(document).ready(function(){
    $("#submitForm").on("submit", function(e){
      e.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        url  : "signup.php",
        type : "POST",
        cache:false,
        data : formData,
        success:function(result){
          if (result == "yes") {
            alert("Registration sucessfully Please login");
            window.location ='login.php';          
          }else{
            alert("Registration failed try again!");
          }          
        }
      });  
    });    
  });
</script>

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
