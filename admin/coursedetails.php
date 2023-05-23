<?php
include_once("connection.php");
session_start();
if (!isset($_SESSION["email"]))

    header("location:admin_login.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link rel="shortcut icon" href="ol.png" >
    <title>CourseDetails</title>
    <style>
        a:hover{
            background-color: slateblue;
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
            <?php
if (isset($_REQUEST['submit'])) {
    $dept = $_REQUEST['dept'];
    $getdepts = mysqli_query($conn, "select *from department where id=$dept");

    $restt = mysqli_fetch_assoc($getdepts);
    $deptname = $restt['department_name'];
    $getdata = mysqli_query($conn, "select* from courses where department=$dept");
    if (mysqli_num_rows($getdata) > 0) {
?>
<div class="table">
            <table class="table mt-3 table-bordered table-striped  caption-top">
                <caption>List of Courses in the <span class="text-capitalize">
                        <?php echo $deptname; ?>
                    </span></caption>
                <tr>
                    <th>
                        <p>
                            S/N
                        </p>
                    </th>
                   
                    <th style="width:50%;">
                        <p class="text-capitalize ">course name</p>
                    </th>
                    <th>
                        <p class="text-capitalize">
                            course Duration(years)
                        </p>
                    </th>

                    <th>
                        <p class=" text-capitalize text-wrap">
                            current
                            status
                        </p>
                    </th>
                    <th>
                        <p class="text-capitalize text-wrap">
                            activate/deactivate course
                        </p>
                    </th>
                    <th>
                        <p class="text-capitalize">
                            Delete
                        </p>
                    </th>

                </tr>
                <?php

        $x = 1;
        while ($result = mysqli_fetch_assoc($getdata)) {
            ?>
                <form action="" method="post">


                    <tr>
                        <td>
                            <?php echo $x++; ?>
                        </td>
                        
                        <td class="text-capitalize">
                            <?php echo $result['course_name']; ?>
                        </td>
                        <td class="text-capitalize text-center">
                            <?php echo $result['duration']; ?>
                        </td>

                        <td class="text-capitalize">
                            <?php
            $status = $result['status'];
            if ($status == 1) {
                        ?>
                            <?php
                echo "<div class='form-check' ><input type='radio' class='form-check-input ' checked name='status' disabled> <label class='form-check-label' for='status'>Active</label></div>";

            } else {
                echo "<input type='radio' class='form-check-input bg-danger' checked name='status' disabled ><label class='form-check-label ' for='status'>Inactive</label>";
            }
                        ?>
                        </td>
                        <td style="display:flex;">
                            <?php
            if ($status == 1) { ?>
                            <form action="" method="post">


                                <input type="text" name="cid" value="<?php echo $result['course_id'] ?>" hidden>
                                <div class="div">
                                    <input type="submit" class="btn btn-outline-primary mt-1 text-capitalize"
                                        name="submit2" value="deactivate">
                                </div>

                            </form>
                            <?php

            } else {
                        ?>
                            <form action="" method="post">

                                <input type="text" name="cid" value="<?php echo $result['course_id'] ?>" hidden>
                                <div>
                                    <input type="submit" name="submit3" class="btn btn-outline-primary ms-3"
                                        value="activate">
                                </div>

                            </form>
                            <?php
            }

                        ?>
                        </td>
                        <td>
                            <form action="deletecourse.php" method="post">
                                <input type="text" value="<?php echo $result['course_id'] ?>" name="cid" hidden>
                                <input type="text" name="cname" value="<?php echo $result['course_name'] ?>" hidden>
                                <input type="submit" name="deletecourses" value="delete Course"
                                    class="btn text-capitalize btn-danger">
                            </form>
                        </td>
                    </tr>
                </form>
                <?php

        }
            ?>
            </table>
    </div>
            <?php
    } else {
        ?>
            <div class="alert alert-info mt-4 alert-dismissible fade show" role="alert"><strong>Sorry,</strong> No
                courses here
                <a href="classs.php" class="ms-5">click here to add some</a>
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button></a>
            </div>
            <?php
    }

} elseif (isset($_REQUEST['delete_course'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Warning!</strong> are You
                sure
                you want to deactivate this course? it wont appear in this department anymore <a
                    href="deactivatecourse.php" class="alert-link">Yes Deactivate</a><br> <a href="viewcourses.php"
                    class="alert-link">cancel</a>.
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button></a>
            </div>
            <?php
    $courseid = $_REQUEST['courseid'];
    echo $courseid;

}
if (isset($_REQUEST['submit2'])) {

    $cid = $_REQUEST['cid'];

    $update = mysqli_query($conn, "update courses set status=0 where course_id=$cid");


    if (isset($update)) {
        $getdepartment = mysqli_query($conn, "select *from courses where course_id=$cid");
        $did = mysqli_fetch_assoc($getdepartment);
        $ddid = $did['department'];
        $resdept = mysqli_query($conn, "select *from department where id=$ddid");
        $getdata = mysqli_query($conn, "select* from courses where department=$ddid");
        ?>
            <div class="alert mt-3 alert-success alert-dismissible fade show" role="alert"><strong>success!</strong>
                Course
                Status updated successfully
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button></a>
            </div>
            <?php
        if (mysqli_num_rows($resdept) > 0) {
            $department = mysqli_fetch_assoc($resdept);
            $deptname = $department['department_name'];
       ?>
            <table class="table mt-3 table-bordered table-striped table-responsive-md caption-top">
                <caption>List of Courses in the <span class="text-capitalize">
                        <?php echo $deptname; ?>
                    </span></caption>
                <tr>
                    <th>
                        <p>
                            S/N
                        </p>
                    </th>
                   
                    <th style="width:50%;">
                        <p class="text-capitalize ">course name</p>
                    </th>
                    <th>
                        <p class="text-capitalize">
                            course Duration(years)
                        </p>
                    </th>

                    <th>
                        <p class=" text-capitalize text-wrap">
                            current
                            status
                        </p>
                    </th>
                    <th>
                        <p class="text-capitalize text-wrap">
                            activate/deactivate course
                        </p>
                    </th>
                    <th>
                        <p class="text-capitalize">
                            Delete
                        </p>
                    </th>

                </tr>
                <?php

            $x = 1;
            while ($department = mysqli_fetch_assoc($getdata)) {
            ?>
                <form action="" method="post">


                    <tr>
                        <td>
                            <?php echo $x++; ?>
                        </td>
                       
                        <td class="text-capitalize">
                            <?php echo $department['course_name']; ?>
                        </td>
                        <td class="text-capitalize text-center">
                            <?php echo $department['duration']; ?>
                        </td>

                        <td class="text-capitalize">
                            <?php
                $status = $department['status'];
                if ($status == 1) {
                        ?>
                            <?php
                    echo "<div class='form-check' ><input type='radio' class='form-check-input ' checked name='status' disabled> <label class='form-check-label' for='status'>Active</label></div>";

                } else {
                    echo "<input type='radio' class='form-check-input bg-danger' checked name='status' disabled ><label class='form-check-label ' for='status'>Inactive</label>";
                }
                        ?>
                        </td>
                        <td style="display:flex;">
                            <?php
                if ($status == 1) { ?>
                            <form action="" method="post">


                                <input type="text" name="cid" value="<?php echo $department['course_id'] ?>" hidden>
                                <div class="div">
                                    <input type="submit" class="btn btn-outline-primary mt-1 text-capitalize"
                                        name="submit2" value="deactivate">
                                </div>

                            </form>
                            <?php

                } else {
                        ?>
                            <form action="" method="post">

                                <input type="text" name="cid" value="<?php echo $department['course_id'] ?>" hidden>
                                <div>
                                    <input type="submit" name="submit3" class="btn btn-outline-primary ms-3"
                                        value="activate">
                                </div>

                            </form>
                            <?php
                }

                        ?>
                        </td>
                        <td>
                            <form action="deletecourse.php" method="post">
                                <input type="text" value="<?php echo $department['course_id'] ?>" name="cid" hidden>
                                <input type="text" name="cname" value="<?php echo $department['course_name'] ?>" hidden>
                                <input type="submit" name="deletecourses" value="delete Course"
                                    class="btn text-capitalize btn-danger">
                            </form>
                        </td>
                    </tr>
                </form>
                <?php

            }
            ?>
            </table>




            <?php

        }
    } else { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!</strong> an error
                occurred when updating course status
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button></a>
            </div>
            <?php }
} elseif (isset($_REQUEST['submit3'])) {

    $cid = $_REQUEST['cid'];
    $update = mysqli_query($conn, "update courses set status=1 where course_id=$cid");
    if (isset($update)) {
        $getdepartment = mysqli_query($conn, "select *from courses where course_id=$cid");
        $did = mysqli_fetch_assoc($getdepartment);
        $ddid = $did['department'];
        $resdept = mysqli_query($conn, "select *from department where id=$ddid");
        $getdata = mysqli_query($conn, "select* from courses where department=$ddid");
        ?>
            <div class="alert mt-3 alert-success alert-dismissible fade show" role="alert"><strong>success!</strong>
                Course
                Status updated successfully
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button></a>
            </div>
            <?php
        if (mysqli_num_rows($resdept) > 0) {
            $department = mysqli_fetch_assoc($resdept);
            $deptname = $department['department_name'];
           ?>
            <table class="table mt-3 table-bordered table-striped table-responsive-md caption-top">
                <caption>List of Courses in the <span class="text-capitalize">
                        <?php echo $deptname; ?>
                    </span></caption>
                <tr>
                    <th>
                        <p>
                            S/N
                        </p>
                    </th>
                   
                    <th style="width:50%;">
                        <p class="text-capitalize ">course name</p>
                    </th>
                    <th>
                        <p class="text-capitalize">
                            course Duration(years)
                        </p>
                    </th>

                    <th>
                        <p class=" text-capitalize text-wrap">
                            current
                            status
                        </p>
                    </th>
                    <th>
                        <p class="text-capitalize text-wrap">
                            activate/deactivate course
                        </p>
                    </th>
                    <th>
                        <p class="text-capitalize">
                            Delete
                        </p>
                    </th>

                </tr>
                <?php

            $x = 1;
            while ($department = mysqli_fetch_assoc($getdata)) {
                ?>
                <form action="" method="post">


                    <tr>
                        <td>
                            <?php echo $x++; ?>
                        </td>
                      
                        <td class="text-capitalize">
                            <?php echo $department['course_name']; ?>
                        </td>
                        <td class="text-capitalize text-center">
                            <?php echo $department['duration']; ?>
                        </td>

                        <td class="text-capitalize">
                            <?php
                $status = $department['status'];
                if ($status == 1) {
                            ?>
                            <?php
                    echo "<div class='form-check' ><input type='radio' class='form-check-input ' checked name='status' disabled> <label class='form-check-label' for='status'>Active</label></div>";

                } else {
                    echo "<input type='radio' class='form-check-input bg-danger' checked name='status' disabled ><label class='form-check-label ' for='status'>Inactive</label>";
                }
                            ?>
                        </td>
                        <td style="display:flex;">
                            <?php
                if ($status == 1) { ?>
                            <form action="" method="post">


                                <input type="text" name="cid" value="<?php echo $department['course_id'] ?>" hidden>
                                <div class="div">
                                    <input type="submit" class="btn btn-outline-primary mt-1 text-capitalize"
                                        name="submit2" value="deactivate">
                                </div>

                            </form>
                            <?php

                } else {
                            ?>
                            <form action="" method="post">

                                <input type="text" name="cid" value="<?php echo $department['course_id'] ?>" hidden>
                                <div>
                                    <input type="submit" name="submit3" class="btn btn-outline-primary ms-3"
                                        value="activate">
                                </div>

                            </form>
                            <?php
                }

                            ?>
                        </td>
                        <td>
                            <form action="deletecourse.php" method="post">
                                <input type="text" value="<?php echo $department['course_id'] ?>" name="cid" hidden>
                                <input type="text" name="cname" value="<?php echo $department['course_name'] ?>" hidden>
                                <input type="submit" name="deletecourses" value="delete Course"
                                    class="btn text-capitalize btn-danger">
                            </form>
                        </td>
                    </tr>
                </form>
                <?php

            }
                ?>
            </table>




            <?php

        }
    } else { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!</strong> an error
                occurred when updating course status
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button></a>
            </div>
            <?php }
}

            ?>
        </div>
</body>

</html>