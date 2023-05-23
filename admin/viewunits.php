<?php
include_once("connection.php");
session_start ();
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 
    $options="";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
     <link rel="shortcut icon" href="ol.png" >
    <title>ViewUnits</title>
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

    <div class="container m-1">
        <form action="unitdetails.php" method="post">
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
                    <select class="form-select" name="semester" id="semester-list" required>
                        <option value=''>Select Semester</option>
                    </select>
                </div>
            </div>
            <center><input type="submit" name="submit" class=" btn btn-primary mt-2 form-group"></center>
    </div>

    </form>
   
    </div>

</body>
<script src="jquery.js"></script>
<script>
$('#department-list').on('change', function() {
    var department_id = this.value;

    $.ajax({
        type: "POST",
        url: "viewunitscourses.php",
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
</script>


</html>