

<?php
	include('dbconn.php');
	$id=$_GET['id'];
	$result = $db->prepare("UPDATE students SET applied='0' WHERE id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	
header('location:appliedstudents.php');
?>