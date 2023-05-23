<?php include('connection.php');
session_start();
$a=$_SESSION["email"];
if (!isset($_SESSION["email"])) {

    header("location:admin_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="shortcut icon" href="ol.png" >

    <title>CreateExams</title>
    <style>
        .nav a:hover {
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

    <!-- form for creating exam !-->
    <div class="container col-md m-1 align-items-center">

        <?php
        if (isset($_POST['exam'])) {
            $ename = mysqli_real_escape_string($conn, $_REQUEST['ename']);
            $semester = mysqli_real_escape_string($conn, $_REQUEST['semester']);
            $department = mysqli_real_escape_string($conn, $_REQUEST['department']);
            $courseid = mysqli_real_escape_string($conn, $_REQUEST['course_name']);
            $yearid = mysqli_real_escape_string($conn, $_REQUEST['course_year']);
            $academic = mysqli_real_escape_string($conn, $_REQUEST['academic']);
            $academic_term = mysqli_real_escape_string($conn, $_REQUEST['term']);
            $checker = mysqli_query($conn, "select *from exam where semester_id=$semester and course_id=$courseid and academic_term=$academic_term");
            if (mysqli_num_rows($checker) > 0) {
                echo "exam already created";
            } else {
                $res1 = mysqli_query($conn, "insert into exam values('0','$ename',$department,$courseid,$yearid,$semester,$academic,$academic_term )");
                if ($res1) { ?>
                    <!-- Success Alert -->
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>Success!</strong> Data sent successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php } else { ?>
                    <!-- Error Alert -->
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> A problem has occurred while submitting your data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php
                }
            }

        }


        ?>
        <div class="row mt-5 justify-content-center">
            <div class="col-sm-8 ">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                ?>">
                    <h2>Create Exam</h2>
                    <div class="row">
                        <div class="col-md">
                            <label for="ename" class="form-label">Exam Name</label><br>
                            <input type="text" name="ename" class="form-control" placeholder="exam name " required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label for="" class="form-label">Academic Year</label>
                            <select class="form-select" name="academic" id="academic" required>
                                <option selected>select Academic Year</option>
                                <?php
                                $s_result = mysqli_query($conn, "select* from academic_year");
                                if (mysqli_num_rows($s_result) > 0) {
                                    // output data of each row
                                    while ($ss = mysqli_fetch_assoc($s_result)) {
                                        $options1 = $options1 . "<option value= $ss[id] >$ss[sname]</option>";

                                    }

                                }
                                echo $options1;
                                ?>
                            </select>
                        </div>
                        <div class="col-md">
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
                                            $options = $options . "<option value= $r[id] >$r[department_name]</option>";

                                        }

                                    }
                                    echo $options;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md">
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

                            <div class="col-md-6">
                                <label for="course_year" class="form-label">Semester</label>
                                <select class="form-select" name="semester" id="semester-list">
                                    <option value=''>Select Semester</option>
                                </select>
                            </div>
                        </div>

                        <center><button type="button" name="back" class="btn p-2 btn-danger"><a
                                    href="admin_dashboard.php" class="text-white"><i
                                        class="bi-arrow-left-circle-fill"></i>GoBack</a></button> <button type="submit"
                                class="btn col-2 btn-outline-primary" name="exam" style="margin:5px;">submit</button>
                        </center>

                </form>
            </div>

        </div>


    </div>


</body>
<script src="jquery.js"></script>
<script>
    $('#year-list').on('change', function () {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "getclasses.php",
            data: 'session_id=' + session_id,
            success: function (result) {
                $("#semester-list").html(result);
            }
        });
    });
    $('#course-list').on('change', function () {
        var course_id = this.value;
        $.ajax({
            type: "POST",
            url: "getyears.php",
            data: 'course_id=' + course_id,
            success: function (result) {
                $("#year-list").html(result);
            }
        });
    });
    $('#department-list').on('change', function () {
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
    $('#academic').on('change', function () {
        var academic_id = this.value;

        $.ajax({
            type: "POST",
            url: "getacademicterm.php",
            data: 'academic_id=' + academic_id,
            success: function (results) {
                $("#term-list").html(results);
            }
        });
    });
</script>

</html>