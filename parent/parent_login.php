<?php include('../connection.php');
ob_start();
session_start();?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <script >
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParentLogin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> 
     <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <style>
        .emp_form {
            width: 500px;
            margin: 2% auto;
            border-style: groove;
            height: max-content;
            border-radius: 20px;
        }

        .emp_form input {
            width: 100%;
            padding: 20px 5px;
            margin: 5px 0;
            border: 0;
            border-bottom: 1px solid #999;
            border-radius:5px;
            outline: none;
            background: transparent;
        }

        .form-style-4 {
            width: 80%;
            margin: 50px;

        }
    </style>
</head>
<body>
  
<nav class="navbar navbar-expand-md navbar-light " style="background:#051094;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="../image/Kiirua-Technical-Training-Institute.webp" height="80" alt="CoolBrand"/>
               
            </a><p class=" text-wrap text-white fw-bold" style="width:4rem; font-family:monospace">KIIRUA TECHNICAL TRAINING INSTITUTE</p> 
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
        <form class="needs-validation" style=" margin:auto;  " action="" method="post">
          <center>  <div class="iccon" style="padding:10px;"><img src="../images/Business-people-TEC-homepage_0.png" alt="" width="100" height="90"></div>
        <h2>Parent Login</h2></center>

    <div class="mb-3">
        <label class="form-label" for="inputEmail">Email</label>
        <input type="email" class="form-control p-3" name='email' id="inputEmail" placeholder="Email..." required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="inputPassword">Password</label>
        <input type="password" class="form-control p-3" name="pass" id="inputPassword" placeholder="Password" required>
    </div>
   <center> <button type="button" name="back" class="btn p-2 btn-danger"><a href="../index.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i></a></button> <button type="submit" name="login" class="btn btn-primary" style="margin:20px;">Sign in</button></center>
</form></div>
    <?php

if(isset($_REQUEST['login']))
{
$a = $_REQUEST['email'];
$b = $_REQUEST['pass'];

$res = mysqli_query($conn,"select* from student where email='$a'and p_password='$b'");
$result=mysqli_fetch_array($res);
if($result)
{
	$_SESSION["p_login"]="$a";
    $_SESSION["p_pass"]=$b;
	header("Location:parent_dashboard");
}
else	
{?>
  <!-- Error Alert -->
  <div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> Incorrect Email or Password!!!! Please try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php
	
  

}
}
    ?>
    
 

</body>
</html>