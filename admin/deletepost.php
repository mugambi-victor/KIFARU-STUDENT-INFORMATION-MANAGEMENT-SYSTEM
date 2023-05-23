<?php
include_once("connection.php");
session_start ();
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
    if(isset($_REQUEST['deleteposts'])){
        $id=$_REQUEST['pid'];
        $delete_post=mysqli_query($conn,"delete from post where id=$id");
        if(!isset($delete_post)){
            die("an error occured while deleting post").mysqli_connect_error();
        }
        else{
            die("success, post deleted successfully").mysqli_connect_error();
        }
    }
    ?>
</body>
</html>