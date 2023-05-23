<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
include("../connection.php");
session_start();
$pmail= $_SESSION["p_login"];
$ppass=$_SESSION['p_pass'];
if (!isset($_SESSION["p_login"])) {
    header("location:p_login.php");
}
$getdata=mysqli_query($conn,"select *from student where regno='$ppass'");
$resp=mysqli_fetch_assoc($getdata);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script >
        window.history.forward();
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
   
        
    
</head>

<body style="background-color: whitesmoke;"><?php include('header1.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

   <div class="container col-sm">
    <div class="row">
    <div class="col-sm">
    <div class="mt-4 mx-2 row d-flex text-white text-center p-0 bg-primary" >
    <p class="display-6 text-center  p-2 " style="margin-top: -0.56%;">Fee Summary Info</p>
                        <div class="col-sm p-2 ">
                        <?php
 $sql = mysqli_query($conn, "select *from student where regno='$ppass' ");
 $result = mysqli_fetch_assoc($sql);

                        $semester=$result['semester'];
                        $getsemester = mysqli_query($conn, "select *from semester where sem_id =$semester ");
                        $restt = mysqli_fetch_assoc($getsemester);
                        $semname = $restt['name'];
                    $year=$restt['yrid'];
                     $getyr = mysqli_query($conn, "select *from courseyears where id =$year ");
                     $restt = mysqli_fetch_assoc($getyr);
                     $yrname = $restt['yrname'];

                   
                    ?> <p class="text-capitalize lead "><i> Regno: <?php echo $ppass;?> </i></p>
                     <p class="text-capitalize lead"><i>Name: <?php echo $resp['s_name'];?></i> </p>
                        <p class="lead text-capitalize">Current Semester: <?php echo $yrname . " " . $semname?></p>
                            <p class="text mt-5 fw-bold display-3"></p>
                            <p class=" fs-5 lead">Semester Fee: Kshs <?php 
                           
                            echo number_format($result['total']); ?></p>
                            

                        </div>
                        <div class=" col-sm a">
                            <img src="../image/R1.png" class="card-img" alt="...">
                        </div>




                    </div>
    </div>
    <div class=" col-md-5 me-0">
      <form method="POST" action="mailto: victormugambi001@gmail.com"
          enctype="multipart/form-data">
            <p class="display-5 lead ">Contact us today</p>
            <label for="" class="form-label">Email Address</label>
            <input type="email" class="form-control p-2" >
            <label for="" class="form-label text-capitalize">phone no</label>
            <input type="number" class="form-control p-2" >
            <label for="" class="form-label text-capitalize">message</label>
            <textarea name="msg" id="" cols="30" rows="5" class="form-control p-3"></textarea>

          <center>  <input type="submit" value="send" name="send" class="btn btn-primary p-2 mt-2"></center>
        </form>
    </div>
    </div>
    
   </div>
   <script src="../jquery.js"></script>
<script>
    





    $('.bb').on('click', function(){
    $('#collapseExample').addClass('active');

});
$('.closebtn').on('click', function() {
                            $('#collapseExample').removeClass('active');

                        });

    </script>
  
</body>

</html>