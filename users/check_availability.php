<?php 
require_once("includes/config.php");
if(!empty($_POST["studID"])) {
	$studID= $_POST["studID"];
	
		$result =mysqli_query($con,"SELECT studID FROM students WHERE studID='$studID'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> studID already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> studID available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
