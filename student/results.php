<?php
include("../connection.php");
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
    <title>RESULTS</title>

</head>

<body>

<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>
    <div class="container col-sm m-4">
        <div class="row">
            <div class="col-sm">
        <form action="transcript.php" method="POST">
            <!-- dropdown for session/academic year -->


            <div class="col-sm">
                <label for="" class="form-label">Academic year</label>
                <select name="session" class="form-select" id="session-list" required>
                    <option value="">Select academic year</option>
                    <?php

                    //begin here
                    $get_studentdata = mysqli_query($conn, "select *from student where regno='$s'");
                    $rest = mysqli_fetch_assoc($get_studentdata);
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
            </div>
            <div class="col-sm">
                <!-- for selecting class-->
                <label for="" class="form-label">Semester</label>
                <select name="semester" class="form-select" id="semester" required>
                    <option value=''>Select semester</option>
                </select>

            </div>
          
            <?php
            $q1 = mysqli_query($conn, "select * from student where regno='$s'");
            while ($r = mysqli_fetch_assoc($q1)) {
                ?>
                <input type="text" name="sname" hidden value="<?php echo $r['s_name']; ?>">

            <?php }
            ?>

            <center> <input type="submit" class="btn mt-2 btn-primary" name="submit" value="submit">
            </center>
        </form>


        <center><button type="button" name="back" class="btn p-2 mt-2 btn-danger"><a href="s_dashboard.php"
                    class="text-white"><i class="bi-arrow-left-circle-fill"></i>GoBack</a></button></center>
   
    



        <?php
        if (isset($_REQUEST["submit"])) {


            $session = $_REQUEST["session"];
            // $exam=$_REQUEST["exam"];
            $semester = $_REQUEST["semester"];
            $student_name = $_REQUEST["sname"];
            $checckexam = mysqli_query($conn, "select distinct exam from marks where regno='$s' and semester=$semester and yrid=$session");
            if (mysqli_num_rows($checckexam) == 0) {
                echo ("sorry!! your grades for this semester do not exist. contact admin") . mysqli_connect_error();

            } else {
                $finde = mysqli_query($conn, "select distinct exam from marks where regno='$s' and semester=$semester and yrid=$session");
                $re = mysqli_fetch_assoc($finde);
                $exam = $re['exam'];
                echo $exam;


                ?>
                <table class="table table-primary caption-top">
                    <caption>List of Subjects and Scores</caption>
                    <tr>
                        <th>Subject</th>
                        <th>Score</th>
                        <th>Grade</th>
                    </tr>
                    <?php
                    $query = mysqli_query($conn, "select * from marks where exam=$exam and regno='$s'");
                    while ($result = mysqli_fetch_assoc($query)) {



                        $grade = "";
                        if ($query !== null) {
                            if ($result['marks'] > 80 && $result['marks'] <= 100) {
                                $grade = "A";
                            } elseif ($result['marks'] > 65 && $result['marks'] <= 80) {
                                $grade = "B";
                            } elseif ($result['marks'] > 55 && $result['marks'] <= 65) {
                                $grade = "C";
                            } elseif ($result['marks'] > 40 && $result['marks'] <= 55) {
                                $grade = "D";
                            } elseif ($result['marks'] > 0 && $result['marks'] <= 40) {
                                $grade = "E";
                            }
                            ?>
                            <center>
                                <div class="results">

                                    <tr>
                                        <td style="width:50%;">
                                            <?php
                                            $rr = $result['unit_id'];

                                            $qy = mysqli_query($conn, "select *from unit where id=$rr");
                                            while ($row = mysqli_fetch_assoc($qy)) {
                                                echo $row['unit_name'];
                                            } ?>
                                        </td>
                                        <td style=" width:50%; ">
                                            <?php echo $result['marks']; ?>
                                        </td>
                                        <td style=" width:50%; ">
                                            <?php echo $grade; ?>
                                        </td>
                                    </tr>


                                </div>

                            </center>



                        <?php }


                    }
                    $query = mysqli_query($conn, "select * from marks where exam='$exam' and regno='$s'");
                    $sum = 0;
                    $mean = 0;
                    $grade = "";
                    $i = 1;
                    while ($r = mysqli_fetch_assoc($query)) {
                        $n = mysqli_num_rows($query);
                        $m = $r['comment'];
                        $sum = $sum + $r['marks'];

                    }
                    $i++;
                    if ($i > 1) {

                        $mean = $sum / $n;
                    }
                    if ($query !== null) {
                        if ($mean > 80 && $mean <= 100) {
                            $grade = "A";
                        } elseif ($mean > 65 && $mean <= 80) {
                            $grade = "B";
                        } elseif ($mean > 55 && $mean <= 65) {
                            $grade = "C";
                        } elseif ($mean > 40 && $mean <= 55) {
                            $grade = "D";
                        } elseif ($mean > 0 && $mean <= 40) {
                            $grade = "E";
                        }

                        echo "\nAverage Score: <b>" . $mean . "</b><br>GRADE:<b> " . $grade . "</b> <br><br>";


                    }
            }
        }
       
        ?>
                </table>


    
    </div>
    </div>
    
        </div>
            <!-- <div class="form-group purple-border" style="display:hidden">
            <label for="exampleFormControlTextarea4">Teacher's Comment</label>
            <textarea class="form-control " readonly id="exampleFormControlTextarea4" rows="2"></textarea>
        </div>
</div> -->


</body>

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

</html>