<?php
include("../connection.php");
session_start ();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:account_login.php');
   
} 

$getadmin = mysqli_query($conn, "select *from admin where email='$a'");
if (mysqli_num_rows($getadmin) > 0) {
    $res = mysqli_fetch_assoc($getadmin);
    date_default_timezone_set('Africa/Nairobi');
    $a = time();

    $b = date('d-m-Y');
    $c = date("h:i:sa", $a);
    
        $insertlog = mysqli_query($conn, "insert into loginout_logs values(0,'$res[email]','logout','$c','$b')");
        if (!isset($insertlog)) {
            echo "problem sending logs";
        }
    

}
session_destroy();
header("location:accounts_login");
?>