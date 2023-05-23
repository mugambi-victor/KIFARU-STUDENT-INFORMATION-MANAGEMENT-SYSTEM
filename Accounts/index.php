<?php include('../connection.php');
session_start();
$a = $_SESSION['accounts_email'];
if (!isset($a)) {
    header('location:accounts_login.php');

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>AccountsDashboard</title>
</head>

<body>

    <?php

    include('header.php');

    include('sidebar.php');
    ?>
    <div class="container col-sm " style="background-color: whitesmoke;">
        <div class="row">

            <div class="ms-1  col-md">

                <p class="display-6"><i class="bi-house-fill"></i>AccountsDashboard</p>
                <div class="row mt-4">
                    <div class="col-md students">
                        <?php
                        $query = mysqli_query($conn, "select *from student");
                        $result = mysqli_num_rows($query);

                        ?>
                        <div class="m-1 row d-flex text-center p-0 bg-secondary">
                            <div class="col p">
                                <p class="text fw-bold display-3">
                                    <?php echo $result; ?>
                                </p>
                                <p>Students</p>

                            </div>
                            <div class=" col a">
                                <img src="../image/student-icon1.jpg" class="card-img" alt="...">
                            </div>




                        </div>
                    </div>

                    <div class="col-md studen1">

                        <?php
                        $query1 = mysqli_query($conn, "select *from department");
                        $result1 = mysqli_num_rows($query1);

                        ?>
                        <div class=" m-1 row d-flex text-center p-0 bg-primary">
                            <div class="col p">
                                <p class="text fw-bold display-3">
                                    <?php echo $result1; ?>
                                </p>
                                <p>Departments</p>

                            </div>
                            <div class=" col a">
                                <img src="../image/department.png" class="card-img" alt="...">
                            </div>




                        </div>
                    </div>
                    <div class="col-md ">
                        <?php
                        $query = mysqli_query($conn, "select *from courses");
                        $result = mysqli_num_rows($query);

                        ?>



                        <div class="m-1 row d-flex text-center p-0 bg-secondary">
                            <div class="col p">
                                <p class="text fw-bold display-3">
                                    <?php echo $result; ?>
                                </p>
                                <p>Courses</p>

                            </div>
                            <div class=" col a">
                                <img src="../image/course.png" class="card-img pt-3" alt="...">
                            </div>




                        </div>

                    </div>




                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ">
        </script>
    <script src="jquery.js"></script>

    </div>

</body>

</html>