<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
    if(isset($_GET['class']))
    {
    $class=$_GET['class'];
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
	
	<title>View Feedback</title>

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
	height:4px;
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
							<div class="panel-heading clearfix"><h4 class="pull-left">Class : <?php echo htmlentities($class); ?></h4><h4 class="pull-right">Theory</h4></div>
							<div class="panel-body">

<!--- Start Feedback Calculation Card -->

<div class="row">
<?php
		$type = "Theory";
        $sqlsubject = "SELECT * FROM subjects WHERE classname = :class AND subjecttype = :stype";
		$stmtsubject = $dbh->prepare($sqlsubject);
		$stmtsubject ->bindParam("class",  $class, PDO::PARAM_STR);
		$stmtsubject ->bindParam("stype",  $type, PDO::PARAM_STR);
        $stmtsubject->execute();
        $mainCount=$stmtsubject->rowCount();
        $subjects = $stmtsubject->fetchAll(PDO::FETCH_OBJ);

        foreach($subjects as $subject){
        $sqlpara = "select * from parameters WHERE ParameterType = :ptype";
		$stmtpara = $dbh->prepare($sqlpara);
		$stmtpara ->bindParam("ptype",  $type, PDO::PARAM_STR);
        $stmtpara->execute();
        $mainCount=$stmtpara->rowCount();
        $parameters = $stmtpara->fetchAll(PDO::FETCH_OBJ);
        $subjectname = str_replace(" ", "_",$subject->SubjectName);
        $overalltheory = 0;
        $parametercount = 0;
        ?>

	<div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo htmlentities($subject->SubjectName); ?>
                <span class="pull-right"><?php echo htmlentities($subject->subjectcode); ?></span>
            </div>

            <div class="panel-body">
            <?php 

foreach($parameters as $parameter){
    $pm = str_replace(" ", "_",$parameter->ParameterName);
    $sqlresult = "SELECT TRUNCATE(((avg(rating)/5)*100),1) as rate from feedbackdata_theory WHERE SubjectName = :subjectcode AND ParameterName = :parameter AND class= :class";
    $stmtresult  = $dbh->prepare($sqlresult);
    $stmtresult ->bindParam("subjectcode", $subjectname, PDO::PARAM_STR);
    $stmtresult ->bindParam("parameter",  $pm, PDO::PARAM_STR);
	$stmtresult ->bindParam("class",  $class, PDO::PARAM_STR);
    $stmtresult ->execute();
    $mainCount=$stmtresult ->rowCount();
    $userData = $stmtresult ->fetch(PDO::FETCH_OBJ);

    $overalltheory += $userData->rate;
    $parametercount = $parametercount + 1;
    ?>

                <h5><?php echo htmlentities($parameter->ParameterName); ?>
                    <span class="pull-right"><?php echo htmlentities($userData->rate); ?>%</span>
                    <h5>
                        <div class="progress">
                        <?php
                            if(intval($userData->rate) >= 75){
                                $sts = "success";
                            }
                            if(intval($userData->rate) >= 41 && intval($userData->rate) <= 74){
                                $sts = "warning";
                            }
                            if(intval($userData->rate) <= 40){
                                $sts = "danger";
                            }
                        ?>
                            <div class="progress-bar progress-bar-<?php echo htmlentities($sts); ?>" role="progressbar" aria-valuenow="<?php echo htmlentities($userData->rate); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo htmlentities($userData->rate); ?>%">
                            </div>
						</div>
                        <?php } ?>
            </div>
            <?php
                $overallthfinal = substr($overalltheory/$parametercount, 0, 4)
            ?>
            <div class="panel-footer">Teacher : <?php echo htmlentities($subject->teachername); ?>
            <span class="pull-right"><b><?php echo htmlentities($overallthfinal); ?>%</b></span>
            </div>
        </div>
	</div>

 <?php
        }
?>

</div>

<!--- End Feedback Calculation Card -->
							</div>




<!--- LAB Part -->

							<div class="panel-heading text-right"><h4>LAB</h4></div>
							<div class="panel-body">

<!--- Start Feedback Calculation Card -->

<div class="row">
<?php
		$type = "LAB";
        $sqlsubject = "SELECT * FROM subjects WHERE classname = :class AND subjecttype = :stype";
		$stmtsubject = $dbh->prepare($sqlsubject);
		$stmtsubject ->bindParam("class",  $class, PDO::PARAM_STR);
		$stmtsubject ->bindParam("stype",  $type, PDO::PARAM_STR);
        $stmtsubject->execute();
        $mainCount=$stmtsubject->rowCount();
        $subjects = $stmtsubject->fetchAll(PDO::FETCH_OBJ);

        foreach($subjects as $subject){
        $sqlpara = "select * from parameters WHERE ParameterType = :ptype";
		$stmtpara = $dbh->prepare($sqlpara);
		$stmtpara ->bindParam("ptype",  $type, PDO::PARAM_STR);
        $stmtpara->execute();
        $mainCount=$stmtpara->rowCount();
        $parameters = $stmtpara->fetchAll(PDO::FETCH_OBJ);
        $subjectname = str_replace(" ", "_",$subject->SubjectName);  
        $overalllab = 0;
        $parametercountlab = 0;     
        ?>

	<div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo htmlentities($subject->SubjectName); ?>
                <span class="pull-right"><?php echo htmlentities($subject->subjectcode); ?></span>
            </div>

            <div class="panel-body">
            <?php 

foreach($parameters as $parameter){
    $pm = str_replace(" ", "_",$parameter->ParameterName);
    $sqlresult = "SELECT TRUNCATE(((avg(rating)/5)*100),1) as rate from feedbackdata_lab WHERE SubjectName = :subjectcode AND ParameterName = :parameter AND class= :class";
    $stmtresult  = $dbh->prepare($sqlresult);
    $stmtresult ->bindParam("subjectcode", $subjectname, PDO::PARAM_STR);
    $stmtresult ->bindParam("parameter",  $pm, PDO::PARAM_STR);
	$stmtresult ->bindParam("class",  $class, PDO::PARAM_STR);
    $stmtresult ->execute();
    $mainCount=$stmtresult ->rowCount();
    $userData = $stmtresult ->fetch(PDO::FETCH_OBJ);
    $overalllab += $userData->rate;
    $parametercountlab = $parametercountlab + 1;
    ?>

                <h5><?php echo htmlentities($parameter->ParameterName); ?>
                    <span class="pull-right"><?php echo htmlentities($userData->rate); ?>%</span>
                    <h5>
                        <div class="progress">
                        <?php
                            if(intval($userData->rate) >= 75){
                                $sts = "success";
                            }
                            if(intval($userData->rate) >= 41 && intval($userData->rate) <= 74){
                                $sts = "warning";
                            }
                            if(intval($userData->rate) <= 40){
                                $sts = "danger";
                            }
                        ?>
                            <div class="progress-bar progress-bar-<?php echo htmlentities($sts); ?>" role="progressbar" aria-valuenow="<?php echo htmlentities($userData->rate); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo htmlentities($userData->rate); ?>%">
                            </div>
						</div>
                        <?php } ?>
            </div>
            <?php
                $overalllabfinal = substr($overalllab/$parametercountlab, 0, 4)
            ?>
            <div class="panel-footer">Teacher : <?php echo htmlentities($subject->teachername); ?>
            <span class="pull-right"><b><?php echo htmlentities($overalllabfinal); ?>%</b></span>
            </div>
        </div>
	</div>

 <?php
        }
?>

</div>

<!--- End Feedback Calculation Card -->
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
</body>
</html>
<?php } ?>
