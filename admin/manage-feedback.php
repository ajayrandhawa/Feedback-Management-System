<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['clear']))
{
$delid=$_REQUEST['clear'];
$sqldelth = "DELETE FROM feedbackdata_theory WHERE class=:delid";
$querydelth = $dbh->prepare($sqldelth);
$querydelth-> bindParam(':delid',$delid, PDO::PARAM_STR);
$querydelth -> execute();
unset($sqldelth);
$sqldellb = "DELETE FROM feedbackdata_lab WHERE class=:delid";
$querydellb = $dbh->prepare($sqldellb);
$querydellb-> bindParam(':delid',$delid, PDO::PARAM_STR);
$querydellb -> execute();
unset($sqldellb);
$sqldelre = "DELETE FROM feedbackdata_review WHERE class=:delid";
$querydelre = $dbh->prepare($sqldelre);
$querydelre-> bindParam(':delid',$delid, PDO::PARAM_STR);
$querydelre -> execute();
unset($sqldelre);
$msg="Feedback Data Clear Sucessfully";
}

 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Manage Feedback</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

.progress{
	height:5	px;
	margin-bottom:0px;
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading"><h4>MANAGE FEEDBACK</h4></div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										       <th>#</th>
												<th>Classes</th>
												<th>View</th>
												<th>Clear Data</th>
										</tr>
									</thead>
								<tbody>

<?php $sql = "SELECT * from classes";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->cname);?></td>
											<td><a href="view-feedback.php?class=<?php echo htmlentities($result->cname);?>" ><i class="fa fa-eye"></i> Feedback</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="view-messages.php?class=<?php echo htmlentities($result->cname);?>" ><i class="fa fa-envelope"></i> Reviews</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="print.php?class=<?php echo htmlentities($result->cname);?>" ><i class="fa fa-print"></i> Print</a></td>
											<td><a href="manage-feedback.php?clear=<?php echo htmlentities($result->cname);?>" style="color:red" onclick="return confirm('Do you want to Clear Feedback Data');"><i class="fa fa-trash"></i> Clear</a></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
</body>
</html>
<?php } ?>
