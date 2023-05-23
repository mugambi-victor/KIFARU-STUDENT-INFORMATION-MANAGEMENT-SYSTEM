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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
     <link rel="shortcut icon" href="ol.png" >
    <title>DeleteCourse</title>
</head>
<body>
<?php include('header.php') ?>
    <?php
    if(isset($_REQUEST['deletecourses'])){
        $id=$_REQUEST['cid'];
        $name=$_REQUEST['cname'];
       
      
        $delete=mysqli_query($conn,"delete from courses where course_id=$id ");
        if(!isset($delete)){
            die("an error occured while deleting course").mysqli_connect_error();
        }
        else{
            date_default_timezone_set('Africa/Nairobi');
    $a=time();
   
    $b=date('d-m-Y');
    $c=date ("h:i:sa", $a);
            $sendlog=mysqli_query($conn, "insert into operation_logs values(0,'$s','delete','$name','course','$c','$b')");
            if(isset($sendlog)){
                ?>
        <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert"><strong>Success,</strong> logs sent successfully
        <a href="viewcourses.php" class="ms-5">Go back</a>
            <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
        </div><?php
            

            }
            
            ?>
        <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert"><strong>Success,</strong> course deleted successfully
        <a href="viewcourses.php" class="ms-5">Go back</a>
            <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
        </div><?php
            
        }
    }
    ?>
</body>
</html>