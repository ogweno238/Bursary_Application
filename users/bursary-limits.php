<?php
session_start();
error_reporting(0);
include('bursary.includes/config.php');
if(strlen($_SESSION['IS_LOGIN'])==0)
    {   
header('location:index.php');
}
else{

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Student | Bursary History</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="bursary.assests/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="bursary.assests/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="bursary.assests/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
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
                        <div class="page-title">Bursary Limits</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Bursary application limits</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bursary Type</th>
											<th>Parent's Occupation</th>
                                             <th>Amount</th>
                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
									
<?php 
$bid=$_SESSION['bid'];
$sql = "SELECT bursary_limits.occupation,tbl_bursary.amount,tbl_bursary.offered_by from bursary_limits join tbl_bursary on bursary_limits.limit_checker=tbl_bursary.limit_checker where tbl_bursary.applied!=1 and bursary_limits.limit_checker=:bid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->offered_by);?></td>
											<td><?php echo htmlentities($result->occupation);?></td>
											<td><?php echo htmlentities($result->amount);?></td>
                                                                                 
          
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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
        <script src="bursary.assests/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="bursary.assests/js/alpha.min.js"></script>
        <script src="bursary.assests/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>