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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>UnitDetails</title>
</head>
<body>
<?php
if(isset($_REQUEST['submit2'])){
   
   $uid=$_REQUEST['uid'];
    $update=mysqli_query($conn,"update unit set status=0 where id=$uid");
    if(isset($update)){?>
    <div class="alert mt-3 alert-success alert-dismissible fade show" role="alert"><strong>success!</strong> Unit
        Status updated successfully
        <a href="viewunits.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
    </div> <?php


}
else{?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!</strong> an error
        occurred when updating Unit status
        <a href="viewunits.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
    </div> <?php }
    
}
    elseif(isset($_REQUEST['submit3'])){
       
       $uid=$_REQUEST['uid'];
        $update=mysqli_query($conn,"update unit set status=1 where id=$uid");
        if(isset($update)){?>
       
    <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>success!</strong> unit
        Status updated successfully
        <a href="viewunits.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
    </div> <?php }else{?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!</strong> an error
        occurred when updating unit status
        <a href="viewunits.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
    </div><?php }
        }
        ?>
        </body>
    </html>