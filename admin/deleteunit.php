<?php
include_once("connection.php");
session_start ();
$s=$_SESSION["email"];
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 
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
    if(isset($_REQUEST['deleteunits'])){
        $id=$_REQUEST['uid'];
        $name=$_REQUEST['uname'];
        echo $id;
      
        $delete_unit=mysqli_query($conn,"delete from unit where id=$id ");
        if(!isset($delete_unit)){
            die("an error occured while deleting unit").mysqli_connect_error();
        }
        else{
            date_default_timezone_set('Africa/Nairobi');
    $a=time();
    echo $name;
    $b=date('d-m-Y');
    $c=date ("h:i:sa", $a);
            $sendlog=mysqli_query($conn, "insert into operation_logs values(0,'$s','delete','$name','unit','$c','$b')");
            if(isset($sendlog)){
                echo "logs sent successfully";
            }

            die("success, unit deleted successfully").mysqli_connect_error();
        }
    }
    ?>
</body>
</html>