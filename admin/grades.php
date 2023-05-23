<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 
$session_result = mysqli_query($conn, 'select distinct id, sname from academic_year ORDER BY id DESC');
$student_year = "";
$student_classname = "";
$sstudent_name = "";
$option4 = "";
$options1="";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    <title>Grading</title>
   
  
  
    <style>
         .nav a:hover{
            background-color:slateblue;
        }
    </style>
    
</head>

<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>


    <div class="container mt-5 mx-3">
     

        <div class="row ">
            <div class="col-md-6">
                <form action="class_grades.php" method="post">
                    <label for="" class="form-label">Academic Year</label>
                    <select class="form-select" name="academic" id="academic" required>
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
            <div class="col-md-6">
                <label for="term" class="form-label">Academic Term</label>
                <select class="form-select" name="term" id="term-list" required>
                    <option value=''>Select term</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <label for="" class="form-label">Department</label>
                <select class="form-select" name="department" id="department-list" required>
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
                <select class="form-select" name="course_name" id="course-list" required>
                    <option value=''>Select course</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="course_year" class="form-label">Course year</label>
                <select class="form-select" name="course_year" id="year-list" required>
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
        <center><button type="button" name="back" class="btn p-2 btn-danger mt-2 me-1"><a href="admin_dashboard.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i>GoBack</a></button><input type="submit" class="btn col-md-2 mt-2 btn-primary" name="submit" value="Grade Students">
        </center>
        </form>
    </div>


</body>
<script src="jquery.js"></script>
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
$('#course-list').on('change', function() {
    var course_id = this.value;

    $.ajax({
        type: "POST",
        url: "getyears.php",
        data: 'course_id=' + course_id,
        success: function(results) {
            $("#year-list").html(results);
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
        url: "getcourses.php",
        data: 'academic_id=' + academic_id,
        success: function(results) {
            $("#term-list").html(results);
        }
    });
});
</script>

</html>