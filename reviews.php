<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

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
					<div class="col-md-12">
						<h1 class="text-center text-bold mt-2x">Amritsar College of Engineering & Technology</h1>
					</div>
				</div>
                <hr>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h2 class="text-center text-bold mt-2x">Your Views/Suggestions/Complaints</h2>
					</div>
				</div>
                <div class="row">
					<div class="col-md-12">
                    <form method="post" class="form-horizontal" action="process-reviews.php">
                                                                <div class="form-group">
                                                                    <div class="col-sm-6 col-md-offset-3">
                                                                        <textarea class="form-control" name="fmsg" cols="30" rows="5" placeholder="Give Some Reviews" required></textarea>
                                                                    </div>
                                                                    </div>
                                                            
					</div>
				</div>
                <div class="row">
					<div class="col-md-12 text-center">
                    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
					</div>
				</div>   
                </form>
			</div>
		</div>
		<br>
		<br>
		<br>
		<div class="col-md-12 text-center">Developed By Sachin Virley</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php  
    }
?>