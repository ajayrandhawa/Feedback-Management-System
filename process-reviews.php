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
        if(isset($_POST['submit']))
        {
        $fmsg=$_POST['fmsg'];
        $sql="INSERT INTO feedbackdata_review(class,msg) VALUES(:class,:msg)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':class',$class,PDO::PARAM_STR);
        $query->bindParam(':msg',$fmsg,PDO::PARAM_STR);
        $query->execute();
        }

    $buffer = $_SERVER['REMOTE_ADDR'];
    $reviews = "1";
    $sqlfp="UPDATE appbuffer set review = (:review) WHERE buffer = :buffer";
    $queryfp = $dbh->prepare($sqlfp);
    $queryfp->bindParam(':buffer',$buffer,PDO::PARAM_STR);
    $queryfp->bindParam(':review',$reviews,PDO::PARAM_STR);
    $queryfp->execute();
?>
</table>
</body>
</html>

<?php  

header("location:done.php");
unset($_SESSION['alogin']);
session_destroy();

}
?>