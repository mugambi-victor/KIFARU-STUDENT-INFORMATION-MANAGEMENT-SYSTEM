<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 
$session_result = mysqli_query($conn, 'select distinct id,sname from academic_year ORDER BY id DESC');
$student_year = "";
$student_semester = "";
$sstudent_name = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    <title>ViewGrades</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <style>
         .nav a:hover{
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


  <div class="container m-1 p-2  pt-5">
      <div class="row">
  <div class="col-md">
  <form action="viewgrades1.php" method="post">

<label for="" class="form-label">Academic Year</label>
<select class="form-select"  name="academic" id="academic" required>
<option selected>select Academic Year</option>
<?php
$s_result = mysqli_query($conn, "select* from academic_year");
        if (mysqli_num_rows($s_result) > 0) {
            // output data of each row
            while ($ss = mysqli_fetch_assoc($s_result)) {
                $options1=$options1."<option value= $ss[id] >$ss[sname]</option>";
        
            }
             
        }
       echo $options1;
        ?>
</select>
    </div>
<div class="col-md">
<label for="term" class="form-label">Academic Term</label>
<select class="form-select"  name="term" id="term-list" required>
<option value=''>Select term</option>
</select>
    </div>
    </div>
    <div class="row">
        <div class="col-md">
  <label for="" class="form-label">Department</label>
<select class="form-select"  name="department" id="department-list" required>
<option selected>select department</option>
<?php
$d_result = mysqli_query($conn, "select* from department");
        if (mysqli_num_rows($d_result) > 0) {
            // output data of each row
            while ($r = mysqli_fetch_assoc($d_result)) {
                $options2=$options2."<option value= $r[id] >$r[department_name]</option>";
        
            }
             
        }
       echo $options2;
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
<label for="course_name" class="form-label">Course year</label>
<select class="form-select"  name="course_year" id="yr-list" required>
<option value=''>Select year</option>
</select>
</div>

     <div class="col-md">
     <label for="semester" class="form-label">Semester</label>
        <select class="form-select" name="semester" id="semester-list">
            <option value=''>Select Semester</option>
        </select>
     </div>
     </div>
     <!-- <div class="col">
     <label for="exam" class="form-label">Exam</label>
        <select class="form-select" name="exam" id="exam-list">
            <option value=''>Select exam</option>
        </select>
     </div> -->
  <div class="row mt-3">
  <center> <div class="col-md-6">
  <input type="submit" class="btn btn-primary" name="submit" value="Enter">
  <input type='submit' class='btn ms-2 btn-primary'  value='Print Passlist' name='passlist'></center>
  </div></div></form>
</div>
      </div>
 
        <div class="col table-responsive-lg" style="margin-top:50px;">
             
                   
     
       </div>
  
  </div>
</body>
<script src="jquery.js"></script>
<script>
    $('#yr-list').on('change', function() {
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
                $("#yr-list").html(result);
            }
        });
    });

    $('#department-list').on('change', function() {
        var d_id = this.value;
        $.ajax({
            type: "POST",
            url: "courses.php",
            data: 'd_id=' + d_id,
            success: function(result) {
                $("#course-list").html(result);
            }
        });
    });
    $('#semester-list').on('change', function() {
        var semester_id = this.value;

        $.ajax({
            type: "POST",
            url: "getcourses.php",
            data: 'semester_id=' + semester_id,
            success: function(results) {
                $("#exam-list").html(results);
            }
        });
    });
    $('#academic').on('change', function() {
        var academic_id = this.value;

        $.ajax({
            type: "POST",
            url: "getacademicterm.php",
            data: 'academic_id=' + academic_id,
            success: function(results) {
                $("#term-list").html(results);
            }
        });
    });

</script>

</html>