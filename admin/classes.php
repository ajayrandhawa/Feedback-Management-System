<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['del']))
{
$delid=intval($_GET['del']);
$class=$_GET['class'];

$sqldel = "DELETE FROM classes WHERE id=:delid";
$querydel = $dbh->prepare($sqldel);
$querydel-> bindParam(':delid',$delid, PDO::PARAM_STR);
$querydel -> execute();
unset($sqldel);

$sqlsub = "DELETE FROM subjects WHERE classname=:class";
$querysub = $dbh->prepare($sqlsub);
$querysub-> bindParam(':class',$class, PDO::PARAM_STR);
$querysub -> execute();
unset($sqlsub);

$sqlth = "DELETE FROM feedbackdata_theory WHERE class=:class";
$queryth = $dbh->prepare($sqlth);
$queryth-> bindParam(':class',$class, PDO::PARAM_STR);
$queryth -> execute();
unset($sqlth);

$sqllb = "DELETE FROM feedbackdata_lab WHERE class=:class";
$querylb = $dbh->prepare($sqllb);
$querylb-> bindParam(':class',$class, PDO::PARAM_STR);
$querylb -> execute();
unset($sqllb);

$sqlre = "DELETE FROM feedbackdata_review WHERE class=:class";
$queryre = $dbh->prepare($sqlre);
$queryre-> bindParam(':class',$class, PDO::PARAM_STR);
$queryre -> execute();
unset($sqlre);

$msg="Deleted Sucessfully";
}

if(isset($_REQUEST['online']))
	{
	$aeid=intval($_GET['online']);
	$memstatus=0;
	$sql = "UPDATE classes SET status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}

if(isset($_REQUEST['offline']))
	{
	$aeid=intval($_GET['offline']);
	$memstatus=1;
	$sql = "UPDATE classes SET status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}

if(isset($_POST['submit']))
{
$classname=$_POST['cname'];
$classcode=$_POST['ccode'];
$sql="INSERT INTO classes(cname,ccode) VALUES(:cname,:ccode)";
$query = $dbh->prepare($sql);
$query->bindParam(':cname',$classname,PDO::PARAM_STR);
$query->bindParam(':ccode',$classcode,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Added Sucessfully";
}
else 
{
$error="Something went wrong. Please try again";
}
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
	
	<title>Classes</title>

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
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading"><h4>ADD CLASS</h4></div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-2 control-label">Class Name</label>
												<div class="col-sm-3">
													<input type="text" class="form-control" name="cname" required>
												</div>
                                                <label class="col-sm-2 control-label">Access Code</label>
												<div class="col-sm-3">
													<input type="text" class="form-control" name="ccode" required>
												</div>
                                                <div class="col-sm-2">
													<button class="btn btn-primary" name="submit" type="submit">ADD</button>
												</div>
											</div>
										</form>

									</div>
								</div>
							</div>

                            
							
						</div>
						
					

					</div>
				</div>
				<div class="panel panel-default">
							<div class="panel-heading">Classes List</div>
							<div class="panel-body">
								<table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th>Class</th>
                                                <th>Access Code</th>
											<th>Status</th>	
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody>

<?php $sql = "SELECT * from  classes";
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
                                            <td><?php echo htmlentities($result->ccode);?></td>
											<td>
                                            
                                            <?php if($result->status == 1)
                                                    {?>
                                                    <a href="classes.php?online=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to offline the Feedback')"><i class="fa fa-circle" style="color:green"></i> Online </a> 
                                                    <?php } else {?>
                                                    <a href="classes.php?offline=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to online the Feedback')"> <i class="fa fa-circle" style="color:red"></i> Offline</a>
                                                    <?php } ?>
</td>
<td>
<a href="classes.php?del=<?php echo $result->id;?>&class=<?php echo $result->cname;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close" style="color:red"></i></a></td>

										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
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