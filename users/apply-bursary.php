<?php
session_start();
error_reporting(0);
include('bursary.includes/config.php');
if(strlen($_SESSION['IS_LOGIN'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$studID=$_SESSION['eid'];
$bursary_id=$_POST['bursary_id'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$description=$_POST['description'];  

$application_status=$_POST['application_status'];  
$applied=$_POST['applied'];  

if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }
		   
		   

$sql="update students set applied=:applied where studID=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':applied',$applied,PDO::PARAM_STR);
$query->bindParam(':eid',$studID,PDO::PARAM_STR);
$query->execute();

$sql="update tbl_bursary set applied=:applied where bursary_id=:bursary_id";
$query = $dbh->prepare($sql);
$query->bindParam(':applied',$applied,PDO::PARAM_STR);
$query->bindParam(':bursary_id',$bursary_id,PDO::PARAM_STR);
$query->execute();

$sql="INSERT INTO bursary_application(bursary_id,studID,fromdate,todate,description,application_status) VALUES(:bursary_id,:studID,:fromdate,:todate,:description,:application_status)";
$query = $dbh->prepare($sql);
$query->bindParam(':bursary_id',$bursary_id,PDO::PARAM_STR);
$query->bindParam(':studID',$studID,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':application_status',$application_status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Bursary applied successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Student | Bursary Leave</title>
        
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
                        <div class="page-title">Apply for Bursary</div>
                    </div>
                    <div class="col s12 m12 l8">
                        <div class="card">
                            <div class="card-content">
							
                                <span class="card-title">
                                        Apply for Bursary</span>
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>


 <div class="input-field col  s12">
<select  name="bursary_id" autocomplete="off">
<option value="">Select bursary type...</option>
<?php 
$bid=$_SESSION['bid'];
$sql = "SELECT tbl_bursary.bursary_id,tbl_bursary.amount,tbl_bursary.offered_by from bursary_limits join tbl_bursary on bursary_limits.limit_checker=tbl_bursary.limit_checker where tbl_bursary.applied!=1 and bursary_limits.limit_checker=:bid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->bursary_id);?>"><?php echo htmlentities($result->offered_by);?> - (Ksh <?php echo htmlentities($result->amount);?>)</option>
<?php }} ?>
</select>
</div>


<div class="input-field col m6 s12">
<label for="fromdate">From  Date</label><br>
<input placeholder="" id="mask1" name="fromdate" class="masked"  min ='<?php echo date('Y-m-d');?>' type="date" data-inputmask="'alias': 'date'" required>
</div>
<div class="input-field col m6 s12">
<label for="todate">To Date</label><br>
<input placeholder="" id="mask1" name="todate" class="masked"  min='<?php echo date('Y-m-d');?>' type="date" data-inputmask="'alias': 'date'" required>

<input placeholder="" name="application_status" value="1" class="masked" type="hidden" >
<input name="applied" value="1" type="hidden">

</div>
<div class="input-field col m12 s12">
<label for="birthdate">Description</label>    

<textarea id="textarea1" name="description" class="materialize-textarea" length="500" required></textarea>
</div>
</div>


				<?php 
$eid=$_SESSION['eid'];
$sql = "SELECT applied from students where studID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 

 <?php 
if($result->applied==0){
                                             ?>
											 <button type="submit" name = "apply" <?php echo $applied == 1 ? 'disabled' : '';?> id="apply" class="waves-effect waves-light btn indigo m-b-xs">Apply</button> 
											 
                                                 <?php } if($result->applied==1)  { ?>
												 
                                                <span style="color: red">Bursary is being proccesed</span>
                                                 <?php }if($result->applied==3)  { ?>
												 
 <span style="color: blue">sorry you are blocked by admin</span>
<?php }}} ?>
 
 
                                                  

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
          <script src="bursary.assests/js/pages/form-input-mask.js"></script>
                <script src="bursary.assests/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>
</html>
<?php } ?> 