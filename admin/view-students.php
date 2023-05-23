<?php include('../connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

$optionr=""; 
$options=""; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link rel="shortcut icon" href="ol.png" >
    
    <title>ViewStudents</title>
    <style>
        a:hover{
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

    <div class="container m-5" style="margin-top:">
    <form action="" method="post">
    <div class="row">
    <div class="col-md">
                <input type="text" name="searchbox" placeholder="search registration no..." class="form-control" required></div>
                <div class="col m-0">
                <input type="submit" name="search" class="btn btn-primary" value="Search">
                </div>
         
             
            
        </form>
    </div>

    <?php
    if(isset($_REQUEST['search'])){
        $regno=$_REQUEST['searchbox'];

?>
<table  class=" col-sm-12">
                   <tr>
                       <th>Student Name</th><th>Registration Number</th><th>Parent's email</th> <th>Parent's No.</th>
                   </tr>
<?php

        $sql1=mysqli_query($conn, "select * from student where regno='$regno'");
        if(mysqli_num_rows($sql1)>0){
            while($row=mysqli_fetch_assoc($sql1)){
      
                echo "<tr><td><form method='post' action='viewstudentprofile.php'><label class='text-capitalize'>" . $row['s_name'] . "</label></td><td><input class='text-uppercase' style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td>" . $row['email'] . "</td><td>" . $row['pno'] . "</td><td><input type='submit' class='btn btn-info' value='view profile' name='profile'></form></a><a  href='promote.php?id=$row[id]' class='btn btn-primary'>Promotestudent</a></td></tr>  </table>"; 
                }
                
        }
        else{
            echo "<div class='lead mt-2 text-dark'>No records found in the database</div>";
        }
        
            }?>
                    
               

    
<div class="container mt-3">
<div class="row">
    
<form action="" method="post" id="myform">
    <p class="display-6 fw-bold">Search by class</p>
        <div class="row">
    <div class="col-md-6">
    <label for="" class="form-label">Academic year</label>
    <select class="form-select"  name="session" id="session-list" required>
  <option selected>select academic year term</option>
  <?php
  $optionss="";
  $a_result = mysqli_query($conn, "select* from academic_year");
            if (mysqli_num_rows($a_result) > 0) {
                // output data of each row
                while ($r = mysqli_fetch_assoc($a_result)) {
                    $optionss=$optionss."<option value= $r[id] >$r[sname]</option>";
            
                }
                 
            }
           echo $optionss;
            ?>
</select>
  </div>
  <div class="col-md-6">
    <label for="sem_name" class="form-label">Semester</label>
    <select class="form-select"  name="sem_name" id="sem-list" required>
  <option value=''>Select semester</option>
</select>
  </div>
        </div>
        <div class="row">
    <div class="col-md-6">
    <label for="" class="form-label">Department</label>
    <select class="form-select"  name="department" id="department-list" required>
  <option selected>select department</option>
  <?php
  $d_result = mysqli_query($conn, "select* from department");
            if (mysqli_num_rows($d_result) > 0) {
                // output data of each row
                while ($r = mysqli_fetch_assoc($d_result)) {
                    $options=$options."<option value= $r[id] >$r[department_name]</option>";
            
                }
                 
            }
           echo $options;
            ?>
</select>
  </div>
  <div class="col-md-6">
    <label for="course_name" class="form-label">Course</label>
    <select class="form-select"  name="course_name" id="course-list" required>
  <option value=''>Select course</option>
</select>
  </div>
        </div>
        <div class="row">
  <div class="col-md-6">
    <label for="course_year" class="form-label">course year</label>
    <select class="form-select"  name="course_year" id="year-list" required>
  <option value=''>Select year</option>
</select>
  </div>
  <div class="col-md-6">
  <label for="semester" class="form-label">Semester</label>
            <select class="form-select" name="semester" id="semester-list">
                <option value=''>Select Semester</option>
            </select>
         </div>
         </div>

        <div class="col-md-6">
            <input type="submit"  value="submit" name="submit" id="formsubmit" class="btn btn-primary mt-1">
        </div>
  </div>

         
            </form>
</div>
<div class="row">
<div class=" table-responsive-lg">
              
              <?php 
              if(isset($_REQUEST["submit"])){
            ?>
            
            <?php
                  $semester=mysqli_real_escape_string($conn,$_REQUEST["semester"]);
                  $course=mysqli_real_escape_string($conn,$_REQUEST["course_name"]);
                  $acadsem=mysqli_real_escape_string($conn,$_REQUEST["sem_name"]);
                  ?>
                 
                  <table  class=" col-sm-12">
                                     <tr>
                                         <th>Student Name</th><th>Registration Number</th><th>Parent's email</th> <th>Parent's No.</th>
                                     </tr>
                  <?php
                  $sql=mysqli_query($conn,"select * from student where semester=$semester and term=$acadsem");
                  
                  while($row=mysqli_fetch_assoc($sql)){
                
                     echo "<tr><td><form method='post' action='viewstudentprofile.php'><label class='text-capitalize'>" . $row['s_name'] . "</label></td><td><input class='text-uppercase' style='border:0;' name='rno' type='text' readonly value=" . $row['regno'] . "></td><td>" . $row['email'] . "</td><td>" . $row['pno'] . "</td><td><input type='submit' class='btn btn-info' value='view profile' name='profile'></form></a></td></tr>"; }?>
                             
                         </table>
                     </div>
</div>
</div>


    
        </div></div>
      <?php }
    ?>
 
    <script src="../jquery.js"></script>
<script>
    $('#year-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "getclasses.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#semester-list").html(result);
            }
        });
    });
    $('#course-list').on('change', function() {
        var course_id = this.value;
        $.ajax({
            type: "POST",
            url: "getyears.php",
            data: 'course_id=' + course_id,
            success: function(result) {
                $("#year-list").html(result);
            }
        });
    });
    $('#department-list').on('change', function() {
        var department_id = this.value;

        $.ajax({
            type: "POST",
            url: "getcourses.php",
            data: 'department_id=' + department_id,
            success: function(results) {
                $("#course-list").html(results);
            }
        });
    });
    $('#session-list').on('change', function() {
        var academic_id = this.value;

        $.ajax({
            type: "POST",
            url: "getacademicterm.php",
            data: 'academic_id=' + academic_id,
            success: function(results) {
                $("#sem-list").html(results);
            }
        });
    });
   
   
    </script>

</body>
</html>