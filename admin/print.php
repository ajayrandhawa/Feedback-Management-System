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
    $currdate=getdate(date("U"));
    }
 ?>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Print</title>
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

<style>
@media print {
    .footer,
    #non-printable {
        display: none !important;
    }
    #printable {
        display: block;
    }
}

    </style>

</head>

<body>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h3 class="text-center">FEEDBACK.IO</h3>
    		</div>
            <h4 class="text-center">( Feedback Report )</h4>
    		<div class="row">
    			<div class="col-xs-12">
                   <h4>Class : <?php echo htmlentities($class)?><span class="pull-right">Date : <?php echo "$currdate[month] $currdate[mday] $currdate[year]" ;?></span></h4>
    			</div>
    		</div>
    	</div>
    </div>

<!--- Start Feedback Calculation Card -->
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
        <div class="text-center">----------------------------------------------------------------------------------------------------------</div>
            <div style="padding:5px; text-align:center"><?php echo htmlentities($subject->SubjectName); ?> <b>|</b> 
                <?php echo htmlentities($subject->subjectcode); ?>  <b>|</b> 
                <?php echo htmlentities($subject->teachername); ?>
            </div>
            <?php 

foreach($parameters as $parameter){
    $pm = str_replace(" ", "_",$parameter->ParameterName);
    $sqlresult = "SELECT TRUNCATE(((avg(rating)/5)*100),1) as rate,count(rating) as ct from feedbackdata_theory WHERE SubjectName = :subjectcode AND ParameterName = :parameter AND class= :class";
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
    <div style="border-bottom:1px solid #ededed;">
                <h5><?php echo htmlentities($parameter->ParameterName); ?>
                    <span class="pull-right"><?php echo htmlentities($userData->rate); ?>%</span>
                    <h5>
                    </div>
                        <?php } ?>
                        <?php
                $overallthfinal = substr($overalltheory/$parametercount, 0, 4)
            ?>
            <h4 class="text-right"><b>Overall -> <?php echo htmlentities($overallthfinal); ?>%</b></h4>
 <?php
        }
        
?>

<h4 class="text-center"><b>******************** LAB ********************</b></h4>
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
        <div class="text-center">----------------------------------------------------------------------------------------------------------</div>
            <div style="padding:5px; text-align:center"><?php echo htmlentities($subject->SubjectName); ?> <b>|</b> 
                <?php echo htmlentities($subject->subjectcode); ?>  <b>|</b> 
                <?php echo htmlentities($subject->teachername); ?>
            </div>
            <?php 

foreach($parameters as $parameter){
    $pm = str_replace(" ", "_",$parameter->ParameterName);
    $sqlresult = "SELECT TRUNCATE(((avg(rating)/5)*100),1) as rate,count(rating) as ct from feedbackdata_lab WHERE SubjectName = :subjectcode AND ParameterName = :parameter AND class= :class";
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
    <div style="border-bottom:1px solid #ededed;">
                <h5><?php echo htmlentities($parameter->ParameterName); ?>
                    <span class="pull-right"><?php echo htmlentities($userData->rate); ?>%</span>
                    <h5>
                    </div>
                        <?php } ?>
                        <?php
                $overalllabfinal = substr($overalllab/$parametercountlab, 0, 4)
            ?>
            <h4 class="text-right"><b>Overall -> <?php echo htmlentities($overalllabfinal); ?>%</b></h4>
 <?php
        }
?>




</div>
</body>
<script>
    window.print();
</script>
</html>

<?php } ?>