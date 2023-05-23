<?php include('../connection.php');

session_start();
 ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>SIMS | AccountsLogin</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--  
<link href="../bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet" >
<script src="../bootstrap_5.1.3/js/bootstrap.min.js"></script> -->
    <style>
       .navbar{
        background:#051094;
       }
       .schoolname{
        width:4rem; 
        font-family:monospace
       }
    </style>
</head>
<body>
  
<nav class="navbar navbar-expand-md navbar-light " style="background:#051094;">
        <div class="container-fluid">
        <img src="../images/rh.jfif" class="pe-2" height="80" alt="CoolBrand"/>
               
               <p class="schoolname text-wrap text-white fw-bold" >KIFARU STUDENT INFORMATION MANAGEMENT SYSTEM</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a> -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="profile.php">Profile</a></li>
                            <li> <a class="dropdown-item"  href="logout.php">Logout</a></li>
        
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container" style="border:0; margin-top:40px;">
         <?php

if(isset($_REQUEST['login']))
{
$a = mysqli_real_escape_string($conn,$_REQUEST['rno']);
$b =  mysqli_real_escape_string($conn,$_REQUEST['pass']);

$res = mysqli_query($conn,"select* from student where regno='$a'and password='$b'");
$result=mysqli_fetch_array($res);
if($result)
{
	$_SESSION["s_login"]=$a;
	header("location:s_dashboard");
}
else	
{?>
  <!-- Error Alert -->
  <div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> Incorrect Registration no. or Password!!!! Please try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php
	
  

}
}
    ?>
  
       <form class="needs-validation" style="  " action="" method="post">
          <center>  <div class="iccon" style="padding:10px;"><img src="../images/R2.jfif" alt="" width="100" height="80"></div>
        <h2>Student Login</h2></center>
<div class="row  justify-content-center">
    <div class="mb-3 col-sm col-md-8 ">
        <label class="form-label " for="inputEmail">Registration Number</label>
        <input type="text" class="form-control p-3" name='rno' id="inputEmail" placeholder="Registration Number" required>
    </div>
    </div>
    <div class="row  justify-content-center">
    <div class="mb-3 col-sm col-md-8">
        <label class="form-label" for="inputPassword">Password</label>
        <input type="password" class="form-control p-3" name="pass" id="inputPassword" placeholder="Password" required>
    </div>
</div>
   <center><button type="button" name="back" class="btn p-2 btn-danger"><a href="../index.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i></a></button> <button type="submit" name="login" class="btn p-2 btn-primary">Sign in</button></center>
</form>
</div>
   

</body>
</html>