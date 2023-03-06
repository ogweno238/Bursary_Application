<?php
session_start();
error_reporting(0);
include('bursary.includes/config.php');
if(strlen($_SESSION['IS_LOGIN'])==0)
    {   
header('location:index.php');
}
else{
$eid=$_SESSION['eid'];
if(isset($_POST['update']))
{

$name=$_POST['name'];
$contactNo=$_POST['contactNo'];   
$stud_year=$_POST['stud_year']; 
$stud_course=$_POST['stud_course']; 

$sql="update students set name=:name,contactNo=:contactNo,stud_year=:stud_year,stud_course=:stud_course where studID=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':contactNo',$contactNo,PDO::PARAM_STR);
$query->bindParam(':stud_year',$stud_year,PDO::PARAM_STR);
$query->bindParam(':stud_course',$stud_course,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$msg="Info updated Successfully";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Student | Info</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="bursary.assests/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="bursary.assests/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="bursary.assests/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="bursary.assests/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>





    </head>
    <body>
  <?php include('bursary.includes/header.php');?>
            
       <?php include('bursary.includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Student Info</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
							
                                <span class="card-title">Update Info</span>
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
										
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
<?php 
$eid=$_SESSION['eid'];
$sql = "SELECT * from  students where studID=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
 <div class="input-field col  s12">
<label for="empcode">Student ID</label>
<input  name="studID" id="empcode" value="<?php echo htmlentities($result->studID);?>" type="text" autocomplete="off" readonly required>
<span id="empid-availability" style="font-size:12px;"></span> 
</div>


<div class="input-field col m6 s12">
<label for="firstName">First name</label>
<input id="firstName" name="name" value="<?php echo htmlentities($result->name);?>"  type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Year </label>
<input id="lastName" name="stud_year" value="<?php echo htmlentities($result->stud_year);?>" type="text" autocomplete="off" required>
</div>

</div>
</div>
                                                    
<div class="col m6">
<div class="row">
<div class="input-field col m6 s12">
<label for="address">Course</label>
<input id="lastName" name="stud_course" value="<?php echo htmlentities($result->stud_course);?>" type="text" autocomplete="off" required>
</div>
<label for="birthdate">Date Registered <label>
<div class="input-field col m6 s12">

<input name="date" autocomplete="off" readonly  class="datepicker" value="<?php echo htmlentities($result->regDate);?>" >
</div>

                                                    

<div class="input-field col m6 s12">
<label for="lastName">University </label>
<input id="lastName" name="stud_uni" autocomplete="off" readonly  value="KCA" type="text" autocomplete="off" required>
</div>

<div class="input-field col m6 s12">
<label for="address">Mobile number</label>
<input id="address" name="contactNo" type="text"  value="<?php echo htmlentities($result->contactNo);?>" autocomplete="off" required>
</div>
                                                          
<?php }}?>
                                                        
<div class="input-field col s12">
<button type="submit" name="update"  id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

</div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="bursary.assests/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="bursary.assests/plugins/materialize/js/materialize.min.js"></script>
        <script src="bursary.assests/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="bursary.assests/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="bursary.assests/js/alpha.min.js"></script>
        <script src="bursary.assests/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 