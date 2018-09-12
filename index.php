<?php
session_start();
include('includes/config.php');

$sysbuffer = $_SERVER['REMOTE_ADDR'];

$sqlcheck ="SELECT * FROM appbuffer WHERE buffer=:sysbuffer";
$querycheck= $dbh -> prepare($sqlcheck);
$querycheck-> bindParam(':sysbuffer', $sysbuffer, PDO::PARAM_STR);
$querycheck-> execute();
$resultcheck=$querycheck->fetch(PDO::FETCH_OBJ);
if($querycheck->rowCount() > 0)
{
	if($resultcheck->theory == "1" && $resultcheck->lab == "0")
	{
	 header("location:lab.php");
	}
	elseif($resultcheck->theory == "1" && $resultcheck->lab == "1")
	{
	 header("location:resub.php");
	}
	else{
 	 header("location:resub.php");
	}
}
else{

if(isset($_POST['login']))
{
$fclass=$_POST['fclass'];
$fpin=$_POST['fpin'];
$status='1';
$sql ="SELECT cname,ccode FROM classes WHERE cname=:fclass and ccode=:fpin and status = :status ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':fclass', $fclass, PDO::PARAM_STR);
$query-> bindParam(':fpin', $fpin, PDO::PARAM_STR);
$query-> bindParam(':status', $status, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['fclass'];
echo "<script type='text/javascript'> document.location = 'theory.php'; </script>";
} else{
  echo "<script>alert('Invalid Details or Feedback Link Offline');</script>";
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
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="login-page bk-img">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x">Your Feedback Value Us!</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">

									<label for="" class="text-uppercase text-sm">Class</label>
									<input type="text" placeholder="Eg. IT-6" name="fclass" class="form-control mb" required>
									<label for="" class="text-uppercase text-sm">Access Code</label>
									<input type="password" placeholder="Eg. ABC!@#" name="fpin" class="form-control mb" required>
									<button class="btn btn-primary btn-block" name="login" type="submit">Proceed</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 text-center">© Sachin Virley</div>
			</div>
		</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php } ?>