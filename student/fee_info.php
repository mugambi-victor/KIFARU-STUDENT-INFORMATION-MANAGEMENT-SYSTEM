<?php
include('../connection.php');
session_start();
$s = $_SESSION["s_login"];
if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
$get_studentdata = mysqli_query($conn, "select *from student where regno='$s'");
$rest = mysqli_fetch_assoc($get_studentdata);



?>
<!DOCTYPE html>
<html lang="en">

<head>
      
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>SIMS | FeeInfo</title>
</head>

<body>
   
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   
    $sql = mysqli_query($conn, "select *from student where regno='$s' ");
    $result = mysqli_fetch_assoc($sql);
        $a = $result['id'];
        $b=$result['semester'];
        ?>
    <div class="container col-sm">
        <div class="row">
            <div class="col-sm">

                <div class="mt-4 ms-1 row d-flex text-white text-center p-0 bg-primary">
                    <p class="display-6 text-center  p-2 " style="margin-top: -0.56%;">Fee Summary Info</p>
                    <div class="col-sm p-2 ">
                    <?php
                        $semester=$result['semester'];
                        $getsemester = mysqli_query($conn, "select *from semester where sem_id =$semester ");
                        $restt = mysqli_fetch_assoc($getsemester);
                        $semname = $restt['name'];
                    $year=$restt['yrid'];
                     $getyr = mysqli_query($conn, "select *from courseyears where id =$year ");
                     $restt = mysqli_fetch_assoc($getyr);
                     $yrname = $restt['yrname'];

                   
                    ?> 
                        <p class="lead text-capitalize">Current Semester: <?php echo $yrname . " " . $semname?></p>
                            <p class="text mt-5 fw-bold display-3"></p>
                            <p class=" fs-5 ">Semester Fee: Kshs <?php echo number_format($result['total']); ?></p>
                            
                        
                        </div>
                    <div class=" col-sm a">
                        <img src="../image/R1.png" class="card-img" alt="...">
                    </div>




                </div>
            </div>
        
            <div class="col-sm">
                <!-- <p>Open a PDF file <a href="../admin/fees/fee_structures/curriculum_vitae1.pdf">example</a>.</p> -->
                <p class="display-4">Fee Payment History</p>
                <div class="row">
                    <div class="col-sm">
                        <form action="" method="post">
                            <label for="" class="form-label">Academic year</label>
                            <select name="session" class="form-select" id="session-list" required>
                                <option value="">Select academic year</option>
                                <?php

                                //begin here
                                
                                $c_course_id = $rest['course_id'];

                                $session_result = mysqli_query($conn, "select * from courseyears where course_id=$c_course_id");

                                if (mysqli_num_rows($session_result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($session_result)) {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['yrname']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="" class="form-label">Semester</label>
                            <select name="semester" class="form-select" id="semester">
                                <option value="">select Semester</option>

                            </select>
                            <center> <input type="submit" value="See History" class="btn mt-2  btn-primary"
                                    name="history" role=""></center>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_REQUEST['history'])) {
                    
                    $semester = $_REQUEST['semester'];

                    $year = $_REQUEST['session'];

                    $getyr = mysqli_query($conn, "select *from courseyears where id =$year ");
                    $restt = mysqli_fetch_assoc($getyr);
                    $yrname = $restt['yrname'];


                    $getsemester = mysqli_query($conn, "select *from semester where sem_id =$semester ");
                    $restt = mysqli_fetch_assoc($getsemester);
                    $semname = $restt['name'];
                    $check = mysqli_query($conn, "select *from payments where regno='$s' and semester =$semester ");
                    if (mysqli_num_rows($check) > 0) {



                        ?>
                        <table class="table table-bordered table-striped text-capitalize caption-top">
                            <caption>List of payments made in
                                <?php echo $yrname . " " . $semname ?> 
                            </caption>
                            <th>
                                s/n
                            </th>
                            <th>
                                Transaction ID
                            </th>
                          
                            <th>
                                amount
                            </th>
                            <?php
                            $x = 1;
                            $sum = 0;
                            $getdata = mysqli_query($conn, "select *from payments where regno='$s' and semester=$semester");
                            while ($res = mysqli_fetch_assoc($getdata)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $x++; ?>
                                    </td>
                                    <td>
                                        <?php echo $res['transaction_id'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sum = $sum + $res['amount_paid'];
                                        echo $res['amount_paid'] ?>
                                    </td>

                                </tr>

                                <?php
                            }

                            ?>
                            <tr>
                                

                            </tr>

                        </table>

                        <?php

                    } else {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Sorry!</strong> No payments yet!! If you have paid but the payment does not reflect here,
                            please contact the Accounts office <a href="">here</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php

                    }
                }
                ?>

            </div>

        </div>
        <button type="button" name="back" class="btn mt-4 p-2 btn-danger"><a href="s_dashboard.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i>GoBack</a></button>
    </div>
    
            </div>
    <script src="../jquery.js"></script>
    <script>
        function PrintPage() {
            window.print();
        }
        $('#session-list').on('change', function () {
            var session_id = this.value;
            $.ajax({
                type: "POST",
                url: "get_exams.php",
                data: 'session_id=' + session_id,
                success: function (result) {
                    $("#semester").html(result);
                }
            });
        });

        $('.bb').on('click', function(){
    $('#collapseExample').addClass('active');
        });

        $('.closebtn').on('click', function(){
    $('#collapseExample').removeClass('active');

});

    </script>
</body>

</html>