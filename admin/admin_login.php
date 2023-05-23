<?php include('../connection.php');
ob_start();
session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    <title>AdminLogin</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 

    <style>
       
       .navbar{
        background:#051094;
       }
       .schoolname{
        width:4rem; 
        font-family:monospace
       }
       body{
       background:whitesmoke;
       }
    </style>
</head>
<body >
<nav class="navbar navbar-expand-md navbar-light " >
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
  
       
    <div class="container" >
    <div class="row justify-content-center">
    <?php

if(isset($_REQUEST['login']))
{
$a =mysqli_real_escape_string($conn,$_REQUEST['email']);
$b = mysqli_real_escape_string($conn,$_REQUEST['pass']);

$res = mysqli_query($conn,"select* from admin where email='$a' and passwords='$b' ");
$result=mysqli_fetch_assoc($res);
if($result)
{

    $getadmin = mysqli_query($conn, "select *from admin where email='$_REQUEST[email]'");
if (mysqli_num_rows($getadmin) > 0) {
    $res = mysqli_fetch_assoc($getadmin);
    date_default_timezone_set('Africa/Nairobi');
    $a = time();

    $b = date('d-m-Y');
    $c = date("h:i:sa", $a);
    
        $insertlog = mysqli_query($conn, "insert into loginout_logs values(0,'$_REQUEST[email]','login','$c','$b')");
        if (!isset($insertlog)) {
            echo "problem sending logs";
        }
    
}
	
	$_SESSION["account_login"]="1";
    $_SESSION["email"]=$result["email"];
	header("location:admin_dashboard");
}
else	
{
    ?>
    <!-- Error Alert -->
    <div class='alert mt-2 alert-danger alert-dismissible fade show'>
        <strong>Error!</strong>Incorrect Password!! Please try again
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>
<?php
   
	
  

}
}
    ?>
        <div class="col-md-6 ">
        <form class="needs-validation form-container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
          <center>  <div class="iccon p-5" ><img src="../images/OIP1.jfif" alt="" width="100" height="80"></div>
        <h2>Admin Login</h2></center>

    <div class="mb-3">
        <label class="form-label" for="inputEmail">Email</label>
        <input type="email" class="form-control p-3" name='email' id="inputEmail" placeholder="Admin Email" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="inputPassword">Password</label>
        <input type="password" class="form-control p-3" name="pass" id="inputPassword" placeholder="Password" required>
    </div>
   <center> <a href="../index" title="back" class="btn  p-2 btn-danger"><i class="bi-arrow-left-circle-fill"></i></a>  <button type="submit" name="login" class="btn btn-primary p-2" >Sign in</button></center>
   <center><a href="" class="link mt-5">Forgot password?</a></center>
</form>
        </div>
   
    </div>
        
</div>

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

</body> 
</html>