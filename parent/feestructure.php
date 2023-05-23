<?php include("../connection.php");
session_start();
$pmail= $_SESSION["p_login"];
$ppass=$_SESSION['p_pass'];
if (!isset($_SESSION["p_login"])) {
    header("location:p_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $getdata=mysqli_query($conn,"select *from student where regno='$ppass'");
    $res=mysqli_fetch_assoc($getdata);
    $sem=$res['semester'];
    $getstructure=mysqli_query($conn,"select *from semester where sem_id=$sem");
    $rest=mysqli_fetch_assoc($getstructure);
    $structure=$rest['fee_structure'];
    ?>
    <embed src="../Accounts/fee_structures/<?php echo $structure ?>" type="application/pdf">

     <!-- Success Alert -->
   
        
</body>
</html>