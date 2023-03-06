<?php

  // Include database connection file

  include_once('config.php');


  if (isset($_POST['email'])) {
    
    $name   = $con->real_escape_string($_POST['name']);
    $mobile = $con->real_escape_string($_POST['mobile']);
    $email  = $con->real_escape_string($_POST['email']);
    
    $studID  = $con->real_escape_string($_POST['studID']);
    $stud_year  = $con->real_escape_string($_POST['stud_year']);
    $stud_course  = $con->real_escape_string($_POST['stud_course']);
    $limit_checker  = $con->real_escape_string($_POST['limit_checker']);
    
   
   
   
    

    $otp    = mt_rand(1111, 9999);

    $query  = "INSERT INTO students (name,email,studID,contactNo,stud_year,stud_course,limit_checker,otp) VALUES ('$name','$email','$studID','$mobile','$stud_year','$stud_course','$limit_checker','$otp')";
    $result = $con->query($query);

    if ($result) {
        echo "yes";
    }else{
        echo "no";
    }   

  }
  
  

?>