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
?>
<html>
<body>
<table>
<?php

    foreach ($_POST as $key => $value) {
        $str = explode("|",$key);
        $Subject=$str[0];
        $Parameter=$str[1];
        $class=$str[2];
        $Rate=$value;
        $sql="INSERT INTO feedbackdata_lab(class,SubjectName,ParameterName,Rating) VALUES (:class,:subject,:parameter,:rate)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':class',$class,PDO::PARAM_STR);
        $query->bindParam(':subject',$Subject,PDO::PARAM_STR);
        $query->bindParam(':parameter',$Parameter,PDO::PARAM_STR);
        $query->bindParam(':rate',$Rate,PDO::PARAM_INT);
        $query->execute();  
    }

    $buffer = $_SERVER['REMOTE_ADDR'];
    $lab = "1";
    $sqlfp="UPDATE appbuffer set lab = (:lab) WHERE buffer = :buffer";
    $queryfp = $dbh->prepare($sqlfp);
    $queryfp->bindParam(':buffer',$buffer,PDO::PARAM_STR);
    $queryfp->bindParam(':lab',$lab,PDO::PARAM_STR);
    $queryfp->execute();
?>
</table>
</body>
</html>

<?php  

header("location:reviews.php");

}
?>