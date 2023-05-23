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
     <script>
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link rel="shortcut icon" href="ol.png" >
    <title>AddMarks</title>
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

    <div class="container col-md  ">
        <div class="col-md">
            <?php

            if (isset($_POST["submit"])) {
                $rno = mysqli_real_escape_string($conn, $_POST['rno']);
                $sstudent_name = mysqli_real_escape_string($conn, $_POST['student']);
                $student_semester = mysqli_real_escape_string($conn, $_POST['semester']);
                $exam = mysqli_real_escape_string($conn, $_POST['exam']);
                $sname = mysqli_real_escape_string($conn, $_POST['s_name']);
                $course = mysqli_real_escape_string($conn, $_POST['course']);

                $getyear = mysqli_query($conn, "select *from semester where sem_id=$student_semester");
                $ress = mysqli_fetch_assoc($getyear);
                $year = $ress['yrid'];

                // yrname
                $getyearr=mysqli_query($conn,"select *from courseyears where id='$ress[yrid]'");
                $ye=mysqli_fetch_assoc($getyearr);
                $yrname=$ye['yrname'];
                //semestername
                $getsem=mysqli_query($conn,"select *from semester where sem_id=$student_semester");
                $sem=mysqli_fetch_assoc($getsem);
                $semname=$sem['name'];
                $sql = mysqli_query($conn, "select distinct unit_id,semester_id,student_id,unit_name from final where semester_id='$student_semester' and student_id='$sstudent_name'");

                ?>
                 <table class="table mt-3 table-bordered table-striped text-capitalize caption-top">
                    <caption class="text-capitalize">Name: <?php echo $sname; ?><br>Year: <?php echo $yrname; ?><br>semester: <?php echo $semname; ?></caption>
                    <tr>
                    <th>Unit Name</th>
                    <th>
                        Marks
                    </th>
                    </tr>
                
                    <div class="students">
                        
                            <?php
                while ($res = mysqli_fetch_assoc($sql)) { ?>
                           
                                <tr>

                                <form id="subjectss" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                        ?>" method="post">
                            <input type="text" hidden value="<?php echo $sstudent_name; ?>" name="student">
                            <input type="text" hidden value="<?php echo $rno; ?>" name="rno">
                            <input type="text" hidden value="<?php echo $student_semester; ?>" name="semester">
                            <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
                            <input type="text" hidden value="<?php echo $sname; ?>" name="sname">
                            <input type="text" hidden value="<?php echo $course; ?>" name="course">
                            <input type="text" hidden value="<?php echo $year; ?>" name="session">
                            <input type="text" hidden value="<?php echo $res['unit_id']; ?>" name="unit_id[]">
                                    <td> <input type="text" class="form-control text-capitalize text-center"
                                            value="<?php echo $res['unit_name']; ?>" name="unitname[]" id="unit_name" readonly>
                                    </td>





                                    <td> <input type="number" class="form-control mark" name="marks[]" id="marks"
                                            placeholder="Enter Mark Here" required>
                                    </td>
                                </tr>
                            
                            <?php
                }

                ?>
</table>
                </div>
                <textarea class="form-control " name="comment" placeholder="enter comment here" row="4"></textarea> <br>
                <center>
                    <button type="button" name="back" class="btn p-2 btn-danger"><a href="grades.php" class="text-white"><i
                                class="bi-arrow-left-circle-fill"></i>GoBack</a></button>
                    <input type="submit" name="submit2" id="sub_btn" class="btn btn-primary" value="submit">
                </center>
                </form>
            </div>
            <?php
            }
            ?>


        <?php
        if (isset($_REQUEST["submit2"])) {

            $student = mysqli_real_escape_string($conn, $_POST['student']);
            $reg = mysqli_real_escape_string($conn, $_POST['rno']);
            $semester = mysqli_real_escape_string($conn, $_POST['semester']);
            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $student = mysqli_real_escape_string($conn, $_POST['student']);
            $reg = mysqli_real_escape_string($conn, $_POST['rno']);
            $semester = mysqli_real_escape_string($conn, $_POST['semester']);
            $course = mysqli_real_escape_string($conn, $_POST['course']);


            $exam_id = mysqli_real_escape_string($conn, $_POST['exam']);
            $sname2 = mysqli_real_escape_string($conn, $_POST['sname']);
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);

            $session = mysqli_real_escape_string($conn, $_POST['session']);



            $semester = mysqli_real_escape_string($conn, $_POST['semester']);
            $getunit = mysqli_query($conn, "select *from unit where semester_id=$semester");
            $unitcount = mysqli_num_rows($getunit);

            $i = 0;
            $sum = 0;
            $pp = "pass";
            foreach ($_POST['marks'] as $t) {

                if ($t < 50) {
                    $pp = "sup";

                }


            }



            foreach ($_POST['marks'] as $textbox) {
                if ($textbox > 50) {
                    $cmt = "pass";

                } else {
                    $cmt = "sup";
                }
                $student = mysqli_real_escape_string($conn, $_POST['student']);
                $reg = mysqli_real_escape_string($conn, $_POST['rno']);
                $semester = mysqli_real_escape_string($conn, $_POST['semester']);
                $course = mysqli_real_escape_string($conn, $_POST['course']);
                $mark = $textbox;
                echo $mark;
                echo $comment;
                $unit = $_POST['unit_id'][$i];
                $sum = $sum + $textbox;

                echo $unit;
                $check = mysqli_query($conn, "select *from marks where unit_id=$unit and course=$course and student_id=$student and exam=$exam_id");
               
                if (mysqli_num_rows($check) > 0) {
                    $ans = mysqli_fetch_assoc($check);
                    die("<div class='alert alert-danger'>
                <strong>sorry!!</strong>marks for this student have already been added.
              </div>");
                } else {
                    $crud = mysqli_query($conn, "insert into marks values('0','$sname2','$reg',$student,$unit,$course,$semester,$session, $exam_id,$mark,'$comment','$cmt')");
                    if (!$crud) {
                        echo $mark . $unit;
                        echo $student;
                        echo ("<div class='alert alert-danger alert-dismissible fade show'>
    <strong>Error!!</strong> an error occurred when submitting marks to the database.
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div>");
                    } else {


                        echo ("<div class='alert alert-success alert-dismissible fade show'>
    <strong>Success!</strong> Data sent successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div>");
                    }
                    $i++;

                }

            }
            # code...
        
            $resultss = mysqli_query($conn, "insert into results values('0','$sname2','$reg',$exam_id,$semester,$student,$sum,'$pp')");
            if (!$resultss) {
                echo ("an error occured while inserting data to the database") . mysqli_connect_error();
            }

            if ($i > 0) {

                $mean = $sum / $i;
            }
        }
        ?>
    </div>
    </div>
</body>

</html>