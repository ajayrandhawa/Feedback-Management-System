<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
    $class = $_SESSION['alogin'];
    $theory = "1";
    $sysbuffer = $_SERVER['REMOTE_ADDR'];
    $sqlcheck ="SELECT buffer FROM appbuffer WHERE buffer=:sysbuffer AND theory = :theory";
    $querycheck= $dbh -> prepare($sqlcheck);
    $querycheck-> bindParam(':sysbuffer', $sysbuffer, PDO::PARAM_STR);
    $querycheck-> bindParam(':theory', $theory, PDO::PARAM_STR);
    $querycheck-> execute();
    $results=$querycheck->fetchAll(PDO::FETCH_OBJ);
    if($querycheck->rowCount() > 0)
    {
    header("location:lab.php");
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
                        <hr>
                        <div class="clearfix">
                            <h3 class="pull-left text-bold">Class : <?php echo htmlentities($class);?> </h3>
                            <h3 class="pull-right text-bold">Type : Theory </h3>
                        </div>
                        <div class="well row pt-2x pb-3x bk-light">
                        
							<div class="col-md-12">
                            <?php 
                $type = "Theory";
                $sqlpara = "SELECT * from parameters WHERE ParameterType = :type";
                $querypara = $dbh ->prepare($sqlpara);
                $querypara ->bindParam("type",  $type, PDO::PARAM_STR);
                $querypara->execute();
                $resultspara=$querypara->fetchAll(PDO::FETCH_OBJ);
                if($querypara->rowCount() > 0)
                { 
                    $sqlsubject = "SELECT * from subjects WHERE classname = :class AND subjecttype = :stype";
                    $querysubject = $dbh ->prepare($sqlsubject);
                    $querysubject ->bindParam("class",  $class, PDO::PARAM_STR);
                    $querysubject ->bindParam("stype",  $type, PDO::PARAM_STR);
                    $querysubject->execute();
                    $resultssubject=$querysubject->fetchAll(PDO::FETCH_OBJ); 
                ?>

                <form action="process-theory.php" method="post">
                <table class="display table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col" class="bg-primary">Parameters & Subjects</th>
                    <?php 
                    foreach($resultssubject as $result)
                        { ?> 
                        <th class="bg-info text-center"><?php echo htmlentities($result->SubjectName);?>
                        <br>(<?php echo htmlentities($result->subjectcode);?>)
                        <br><?php echo htmlentities($result->teachername);?>
                        </th>
                        
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                <?php 
                foreach($resultspara as $result)
                    { ?>         
                    <tr>
                    <th scope="row" class="bg-info"><?php echo htmlentities($result->ParameterName);?></th>
                    <?php 
                    foreach($resultssubject as $resultsb)
                        { ?> 
                        
                    <td>
                    
                        <select name="<?php echo htmlentities($resultsb->SubjectName.'|'.$result->ParameterName).'|'.$class;?>" required>
                            <option value="">Select</option>
                            <option value="5">Excellent</option>
                            <option value="4">Very Good</option>
                            <option value="3">Good</option>
                            <option value="2">Average</option>
                            <option value="1">Poor</option>
                            <option value="0">Bad</option>
                        </select>
                    </
                    </td>
                    <?php } ?>
                    </tr>
            <?php  }} ?>
                </tbody>
                </table>
                <div class="col-md-2 col-md-offset-5 text-center">
                <button class="btn btn-primary btn-block" name="login" type="submit">Proceed</button>
							</div>
                </form>
		
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-12 text-center">Developed By Sachin Virley</div>
			</div>
		</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php }} ?>