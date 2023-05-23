<?php include('connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

$options = "";
$optionr = "";
$optionrr = "";
$option3 = "";
$option4 = "";
$option = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
 <link rel="shortcut icon" href="ol.png" >
    <title>CreateCourses</title>
    <style>
        .form-label {
            font-weight: bold;
        }

        a:hover {
            background: slateblue;
        }

        
    </style>

</head>

<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

    
  <div class="container mt-5 m-1" >
                <div class="row">
                    
        <?php
            if (isset($_REQUEST['create_units'])) {
                $unitname = $_REQUEST['unitname'];
                $unitcode = $_REQUEST['unitcode'];
                $course = $_REQUEST['course_name'];
                $semester1 = $_REQUEST['semester'];
                $checker4 = mysqli_query($conn, "select * from unit where unit_name='$unitname' and semester_id=$semester1 and course_id=$course");
                if (mysqli_num_rows($checker4) >= 1) {


                    die("<div class='alert alert-warning'>
            <strong>Sorry!</strong> Unit already exists!!
          </div>") . mysqli_connect_error();
                } else {
                    $insertunit = mysqli_query($conn, "insert into unit values(0, '$unitname',$course,'$unitcode',$semester1,'1')");
                    if ($insertunit) {
                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Course unit created successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
            <?php
                       
                    } else {
                        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> A problem occurred while inserting unit to the database. Please contact admin
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
            <?php
                     
                    }
                }
            }
            ?>
            
       
               
                <?php
    if (isset($_REQUEST['create_course'])) {
        $dept = $_REQUEST['department'];
        $course = $_REQUEST['coursename'];
        $years = $_REQUEST['years'];

        $sqlcheck = mysqli_query($conn, "select *from courses where department=$dept and course_name='$course'");
        if (mysqli_num_rows($sqlcheck) > 0) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Course already exists!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
            <?php
           
        } else {
            $sqlinsert = mysqli_query($conn, "insert into courses values(0,'$course',$dept,$years,'1')");
            if ($sqlinsert) {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong> Course created successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
                <?php
                
                for ($i = 1; $i <= $years; $i++) {
                    $slector = mysqli_query($conn, "select*from courses where course_name='$course'");
                    $re = mysqli_fetch_assoc($slector);
                    $cid = $re['course_id'];
                    $s = "year " . $i;
                    $sqlinsert1 = mysqli_query($conn, "insert into courseyears values(0,'$s',$cid)");


                }
                $slector = mysqli_query($conn, "select*from courses where course_name='$course'");
                $re = mysqli_fetch_assoc($slector);
                $cid = $re['course_id'];
                $selector2 = mysqli_query($conn, "select *from courseyears where course_id=$cid");
                while ($ree = mysqli_fetch_assoc($selector2)) {
                    $c = $ree['id'];
                    $ccid = $ree['course_id'];



                    //    foreach($cid2 as $c) {
    
                    $sem1 = "semester 1";
                    $sem2 = "semester 2";
                  
                    $sem1insert = mysqli_query($conn, "insert into semester values(0,'$sem1',$ccid,$c,0,'')");
                    $sem2insert = mysqli_query($conn, "insert into semester values(0,'$sem2',$ccid,$c,0,'')");

                    //    }
                }
                if ($sqlinsert1 && $sem1insert && $sem2insert) {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!!</strong> course years and semesters created successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
                    <?php
                

                } else {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Sorry!</strong> an errorr occurred while creating years and semesters. Please contact admin
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
                    <?php
                   
                }
            }

        }

    }

    ?>
                    <div class="col-md">
                        <!-- form for creating Course-->
                        <form class="needs-validation border p-3 border-3" action="
                    <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <center>
                                <h2>Create Course</h2>
                            </center>

                            <div class="col-md">
                                <label for="" class="form-label">Department</label>
                                <select class="form-select text-capitalize" name="department" id="department-list" required>
                                    <option value=''>select department</option>
                                    <?php
                            $d_result = mysqli_query($conn, "select* from department");
                            if (mysqli_num_rows($d_result) > 0) {
                                // output data of each row
                                while ($r = mysqli_fetch_assoc($d_result)) {
                                    $options = $options . "<option value= $r[id] >$r[department_name]</option>";

                                }

                            }
                            echo $options;
                            ?>
                                </select>
                            </div>
                            <div class="col-md">
                                <label for="coursename" class="form-label">Course name</label>
                                <input type="text" class="form-control text-capitalize" name="coursename" placeholder="course name...">
                            </div>
                            <div class="col-md">
                                <label for="coursename" class="form-label">Course Duration</label>
                                <input type="number" class="form-control" name="years" placeholder="course duration..."
                                    required>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control" name="yr1" value="year one" hidden>
                                <input type="text" class="form-control" name="yr2" value="year two" hidden>
                            </div>

                            <div class="col-md justify-content-center">
                                <center><button type="submit" name="create_course"
                                        class="btn btn-primary  mt-1">Submit</button>
                                    <button name="viewcourse" class="btn btn-primary  mt-1"> <a
                                            class="text-white text-decoration-none" href="viewcourses.php">
                                            ViewCourses</a> </button>
                                </center>
                            </div>

                        </form>
                    </div>
                       



                    <!-- form for creating Unit -->
                    <div class="col-md">
                        <form class="needs-validation border p-3 border-3"
                            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <center>
                                <h2>Create Unit</h2>
                            </center>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-label">Department</label>
                                    <select class="form-select text-capitalize" name="department" id="department" required>
                                        <option selected>select department</option>
                                        <?php
                                $d_result = mysqli_query($conn, "select* from department");
                                if (mysqli_num_rows($d_result) > 0) {
                                    // output data of each row
                                    while ($r = mysqli_fetch_assoc($d_result)) {
                                        $optionrr = $optionrr . "<option value= $r[id] >$r[department_name]</option>";

                                    }

                                }
                                echo $optionrr;
                                ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="course_name" class="form-label">Course</label>
                                    <select class="form-select text-capitalize" name="course_name" id="course-list" required>
                                        <option value=''>Select course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="year" class="form-label">Year</label>
                                    <select class="form-select" name="year" id="year-list" required>
                                        <option value=''>Select year</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="sem" class="form-label">Semester</label>
                                    <select class="form-select text-capitalize" name="semester" id="semester-list" required>
                                        <option value=''>Select semester</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="unitname">unit Name</label>
                                    <input type="text" name="unitname" class="form-control text-capitalize" placeholder="unit Name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="unitcode">Unit Code</label>
                                    <input type="text" name="unitcode" class="form-control text-capitalize" placeholder="unit Code"
                                        required>
                                </div>
                            </div>

                            <?php

                    ?>
                            <center> <input type="submit" name="create_units" class="btn btn-primary mt-2"
                                    value="Submit">
                            </center>
                    </div>
                            </div>
                    </form>

                </div>
            </div></div>
      


    <script src="jquery.js"></script>
    <script>
        $('#session-list').on('change', function () {
            var session_id = this.value;
            $.ajax({
                type: "POST",
                url: "get_classes.php",
                data: 'session_id=' + session_id,
                success: function (result) {
                    $("#semester-list").html(result);
                }
            });
        });

        $('#department').on('change', function () {
            var department_id = this.value;

            $.ajax({
                type: "POST",
                url: "getcourses.php",
                data: 'department_id=' + department_id,
                success: function (results) {
                    $("#course-list").html(results);
                }
            });
        });
        $('#departments').on('change', function () {
            var department_id = this.value;

            $.ajax({
                type: "POST",
                url: "getcourses.php",
                data: 'department_id=' + department_id,
                success: function (results) {
                    $("#courses").html(results);
                }
            });
        });
        $('#d-list').on('change', function () {
            var d_id = this.value;

            $.ajax({
                type: "POST",
                url: "courses.php",
                data: 'd_id=' + d_id,
                success: function (results) {
                    $("#c-list").html(results);
                }
            });
        });

        $('#course-list').on('change', function () {
            var course_id = this.value;

            $.ajax({
                type: "POST",
                url: "getyear.php",
                data: 'course_id=' + course_id,
                success: function (results) {
                    $("#year-list").html(results);
                }
            });
        });
        $('#year-list').on('change', function () {
            var year_id = this.value;

            $.ajax({
                type: "POST",
                url: "getyear.php",
                data: 'year_id=' + year_id,
                success: function (results) {
                    $("#semester-list").html(results);
                }
            });
        });
    </script>

</body>

</html>