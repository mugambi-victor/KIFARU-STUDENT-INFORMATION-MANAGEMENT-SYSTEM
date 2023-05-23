<?php 
include('connection.php');

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
     <link rel="shortcut icon" href="ol.png" >
    <title>CreateAdmin</title>
    <style>
    a:hover{
            background-color: slateblue;
        }
</style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>



    <div class="container col-md">
    <?php
    if(isset($_REQUEST['create'])){
        $name=mysqli_real_escape_string($conn,$_REQUEST['name']);
        $email=mysqli_real_escape_string($conn,$_REQUEST['email']);
        $pass=mysqli_real_escape_string($conn,$_REQUEST['pass']);
        $type=mysqli_real_escape_string($conn,$_REQUEST['type']);
        $check=mysqli_query($conn,"select *from admin where email='$email'");
        if(mysqli_num_rows($check)>0){
            echo("<div class='mt-3 alert alert-info alert-dismissible fade show'>
            <strong>Sorry!</strong>that email already exists.
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>");
        }
        else{
            $insertq=mysqli_query($conn,"insert into admin values('$name','$email','$pass',$type)");
            if(!$insertq){
                echo("<div class='mt-3 alert alert-info alert-dismissible fade show'>
            <strong>Sorry!</strong>a problem occurred when sending data to the database.
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>");
    }
            else{
                echo("<div class='mt-3 alert alert-success alert-dismissible fade show'>
                <strong>Success!!</strong>New admin user has been added successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>");
            }
    
        }
    
    }
    ?>
        <div class="row mt-5 justify-content-center">
            <div class="col-10">
                <form action="" method="post">
                   <div>
                   <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control text-capitalize" name="name" placeholder="Enter name...">
                   </div>
                   <div>
                   <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control " name="email" placeholder="Enter email...">
                   </div>
                   <div>
                   <label for="type" class="form-label">User Type</label>
                    <select name="type" class="form-select" id="">
                        <option value="0">Admin</option>
                        <option value="1">Accountant</option>
                    </select>
                   </div>
                   <div>
                   <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="password">
                   </div>
                   <div>
                    <input type="submit" name="create" class="btn mt-2 btn-primary" value="submit">
                   </div>
                </form>
            </div>
        </div>
    </div>
    <script src="jquery.js"></script>
</body>
</html>