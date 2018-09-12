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
$sub=$_GET['sub'];
$subject = str_replace(" ", "_",$sub);
$type=$_GET['type'];

$sqldel = "DELETE FROM subjects WHERE id=:delid";
$querydel = $dbh->prepare($sqldel);
$querydel-> bindParam(':delid',$delid, PDO::PARAM_STR);
$querydel -> execute();
unset($sqldel);

if($type == "Theory"){
$sqlth = "DELETE FROM feedbackdata_theory WHERE SubjectName=:subject";
$queryth = $dbh->prepare($sqlth);
$queryth-> bindParam(':subject',$subject, PDO::PARAM_STR);
$queryth -> execute();
unset($sqlth);
}

if($type == "LAB"){
$sqllb = "DELETE FROM feedbackdata_lab WHERE SubjectName=:subject";
$querylb = $dbh->prepare($sqllb);
$querylb-> bindParam(':subject',$subject, PDO::PARAM_STR);
$querylb -> execute();
unset($sqllb);
}

$msg="Deleted Sucessfully";
}

if(isset($_POST['submit']))
{
$classname=$_POST['cname'];
$sname=$_POST['sname'];
$scode=$_POST['scode'];
$tname=$_POST['tname'];
$stype=$_POST['stype'];
$sql="INSERT INTO subjects(subjecttype, subjectname, subjectcode, teachername, classname) VALUES(:stype, :sname,:scode,:tname,:cname)";
$query = $dbh->prepare($sql);
$query->bindParam(':stype',$stype,PDO::PARAM_STR);
$query->bindParam(':sname',$sname,PDO::PARAM_STR);
$query->bindParam(':scode',$scode,PDO::PARAM_STR);
$query->bindParam(':tname',$tname,PDO::PARAM_STR);
$query->bindParam(':cname',$classname,PDO::PARAM_STR);
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
	
	<title>Add Subjects</title>

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
									<div class="panel-heading"><h4>ADD SUBJECT</h4></div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-2 control-label">Class Name</label>
												<div class="col-sm-2">
                                                <select name="cname" class="form-control" required>
                                                <option value="">Select</option>
                                                <?php $sql = "SELECT * from classes";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {				?>	
                                                    <option value="<?php echo htmlentities($result->cname);?>"><?php echo htmlentities($result->cname);?></option>
                                                    <?php }} ?>
                                                </select>
												</div>

												<label class="col-sm-2 control-label">Subject Type</label>
												<div class="col-sm-2">
												<select name="stype" class="form-control" required>
                                                <option value="">Select</option>
                                                    <option value="Theory">Theory</option>
                                                    <option value="LAB">LAB</option>
                                                </select>
												</div>

												<label class="col-sm-2 control-label">Subject Code</label>
												<div class="col-sm-2">
													<input type="text" class="form-control" name="scode" required>
												</div>

											</div>
                                            <div class="form-group">

											 <label class="col-sm-2 control-label">Subject Name</label>
												<div class="col-sm-3">
													<input type="text" class="form-control" name="sname" required>
												</div>

                                                <label class="col-sm-2 control-label">Teacher Name</label>
												<div class="col-sm-3">
													<input type="text" class="form-control" name="tname" required>
												</div>

												<div class="col-sm-2">
													<button class="btn btn-primary btn-block" name="submit" type="submit">ADD</button>
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
							<div class="panel-heading">Subjects Info</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th>Class</th>
                                                <th>Subject Name</th>
                                                <th>Subject Code</th>
												<th>Type</th>
                                                <th>Teacher Name</th>
											<th>Action</th>	
										</tr>
									</thead>
									
									<tbody>

<?php $sql = "SELECT * from subjects";
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
											<td><?php echo htmlentities($result->classname);?></td>
                                            <td><?php echo htmlentities($result->SubjectName);?></td>	
                                            <td><?php echo htmlentities($result->subjectcode);?></td>
											<td><?php echo htmlentities($result->subjecttype);?></td>
                                            <td><?php echo htmlentities($result->teachername);?></td>										
<td>
<a href="subjects.php?del=<?php echo $result->id;?>&type=<?php echo $result->subjecttype;?>&sub=<?php echo $result->SubjectName;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close" style="color:red"></i></a></td>
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