<?php include("../connection.php");
session_start();
$s = $_SESSION["s_login"];
if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>RegisterUnits</title>
  
    <style>
        .units-content {
            margin: 50px 300px;
            background-color: whitesmoke;
        }

        .units-content form {
            padding: 50px;
            margin: 50px 50px;
            font-size: larger;
            text-decoration: none;

        }

        .units-content h2 {
            color: blueviolet;
        }

        .units-content input {
            padding: 20px;
            margin: 0 5px 0 30px;
            text-align: center;
            
        }

        button {
            padding: 10px;
            font-size: large;
        }
        .nav a:hover{
          background-color:#8432DF;
          
        }
        .nav a:active{
          background-color: #8432DF;
        }
    </style>
</head>

<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

    <div class="container col-sm ">
      
       <?php


if (isset($_REQUEST['submit'])&&!empty($_POST['units'])) {
  
    $i = 0;
    if( count ($_POST['units'])!=0){
    foreach ($_POST['units'] as $textbox) {

        $data = mysqli_query($conn, "select *from student where regno='$s'");
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $student_id=$row['id'];
                $unitname = $textbox;
                
                
                $check= "SELECT distinct id,unit_id,semester_id,student_id FROM unitandstudent WHERE unit_id=$textbox and student_id=$student_id";
                $rs = mysqli_query($conn, $check);
                if (mysqli_num_rows($rs) > 0) {
                   die( '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> You have already registered units for the semester.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'
                );
            
   
              
                }
                    else{
                        $sql1 = mysqli_query($conn, "insert into unitandstudent values('0',$unitname,$row[semester], $row[id])");
                        if ($sql1) {
                            // <!-- Success Alert -->
              echo( '
            <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have successfully registered units for the semester.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'
                );
                      
                        }
                        $i++;
                    }
              
            }
        }
    }
}}
?>



            <form method="post" action=" " class="ms-5 mt-3 me-1">
           <?php $sql1 = mysqli_query($conn, "select *from student where regno='$s'");
           $ress=mysqli_fetch_assoc($sql1);
           
           $semester=$ress['semester'];
           
           $sql3 = mysqli_query($conn, "select *from semester where sem_id=$semester");
           $res3=mysqli_fetch_assoc($sql3);
           $courseyear=$res3['yrid'];
           $sql2 = mysqli_query($conn, "select *from courseyears where id=$courseyear");
           $res2=mysqli_fetch_assoc($sql2);
           $courseyearname=$res2['yrname'];


           $semestername=$res3['name'];
           ?>
                        <h2>Select subjects for <?php echo $courseyearname." " .$semestername; ?> </h2>
        <?php
        $sql = mysqli_query($conn, "select distinct id,regno,semester,course_id from student where regno='$s'");
        
        if ($sql) {
            while ($res = mysqli_fetch_assoc($sql)) {
                $c= $res['semester'];
                $b=$res['course_id'];
                $sql2 = mysqli_query($conn, "select *from unit where semester_id=$c and course_id=$b");
                if ($sql2) { ?>
                   
                        <?php 
                        while ($data = mysqli_fetch_assoc($sql2)) {
                           
                            echo "<input type='checkbox' name='units[]' value='" . $data['id'] . "'>"." ". $data['unit_name'] . "<br/>";
                           
                        } ?>
                        <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
                    </form>
        <?php }
            }
           
        }
        else{  ?>
            <!-- Error Alert -->
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> .
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php
         } ?>
         <center><button type="button" name="back" class="btn mt-4 p-2 btn-danger"><a href="s_dashboard.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i>GoBack</a></button></center>  
         </div>
    
</div>
<script src="../jquery.js"></script>
<script>
    $('.bb').on('click', function(){
    $('#collapseExample').addClass('active');

});
$('.closebtn').on('click', function(){
    $('#collapseExample').removeClass('active');

});

</script>
       
      
</body>

</html>