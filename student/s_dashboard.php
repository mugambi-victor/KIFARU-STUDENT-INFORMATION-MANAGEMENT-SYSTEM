<?php
include("../connection.php");
session_start();
$s = $_SESSION["s_login"];

if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}
$getstudent=mysqli_query($conn,"select *from student where regno='$s'");
if(mysqli_num_rows($getstudent)>0){
    $res=mysqli_fetch_assoc($getstudent);
    date_default_timezone_set('Africa/Nairobi');
    $a=time();
    $b=date('d-m-Y');
    $c=date ("h:i:sa", $a);
    
    $insertlog=mysqli_query($conn,"insert into loginout_logs values(0,'$res[regno]','login','$c','$b')");
    if(!isset($insertlog)){
        echo "problem sending logs";
    }
}

 $grade="";

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
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>StudentDashboard</title>
    <style>
       .modtitle{
        margin-top: -0.56%;
       }
       body{
        background-color: whitesmoke;
       }
    </style>
</head>

<body >

   
<?php include('header1.php');?>
    <div class="container-fluid col-sm  d-flex">
        <?php 

  include('sidebar.php');

   ?>

        <div class="container col-sm m-1">

            <div class="row">
                <div class="col-sm-6">
                    <center> <span>
                            <h2>Registered units</h2>
                        </span></center>
                    <?php
                $sql = mysqli_query($conn, "select *from student where regno='$s' ");
                $result = mysqli_fetch_assoc($sql);
                    $a = $result['id'];
                    $b=$result['semester'];
                    $sql2 = mysqli_query($conn, "select distinct unit_id, semester_id, student_id, unit_name from final  where student_id=$a and semester_id=$b");

                    if ($sql2) {
                       
                        $i = 0;
                        foreach ($sql2 as $row) { ?>


                    <ul class="list-group  text-center">
                        <li class="list-group-item text-capitalize"> <?php echo $row['unit_name'] . "<br>"; ?></li>
                    </ul>
                    <br>


                    <?php }
                        $i++;
                    }?>
                </div>
                <div class="col-sm-6">


                    <div class="mx-1 row d-flex text-white text-center p-0 bg-primary">
                        <p class="display-6 text-center modtitle  p-2 " >Fee Summary Info</p>
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
                            <p class=" fs-5 ">Semester Fee: Kshs <?php 
                           
                            echo number_format($result['total']); ?></p>


                        </div>
                        <div class=" col-sm a">
                            <img src="../image/R1.png" class="card-img" alt="...">
                        </div>




                    </div>
                    <div class="row">
                        <div class="col-sm">


                            <p class="text-center display-6 mt-2 lead"> Exam Results</Ri:a>
                            </p>
                            <form action="transcript.php" method="POST">
                                <!-- dropdown for session/academic year -->


                                <div class="row">
                                    <select name="session" title="session" class="form-select" id="session-list" required>
                                        <option value="">Select academic year</option>
                                        <?php
            
            //begin here
                $get_studentdata=mysqli_query($conn,"select *from student where regno='$s'");
                $rest=mysqli_fetch_assoc($get_studentdata);
                $c_course_id=$rest['course_id'];

            $session_result = mysqli_query($conn, "select * from courseyears where course_id=$c_course_id");
           
            if (mysqli_num_rows($session_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($session_result)) {
            ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['yrname']; ?></option>
                                        <?php
                }
            }
            ?>
                                    </select>
                                </div>
                                <div class="row mt-2">
                                    <!-- for selecting class-->
                                    <select name="semester" title="semester" class="form-select" id="semester" required>
                                        <option value=''>Select semester</option>
                                    </select>

                                </div>
                                <!-- <div class="col-sm-4"> -->
                                <!-- for selecting exam -->
                                <!-- <select name="exam"  class="form-select" id="exam" required>
        <option value=''>Select Exam</option>
        </select>
        </div> -->
                                <?php
        $q1=mysqli_query($conn,"select * from student where regno='$s'");
        while($r=mysqli_fetch_assoc($q1)){
            ?>
                                <input type="text" title="sname" name="sname" hidden value="<?php echo $r['s_name']; ?>">

                                <?php   }
        ?>

                                <center> <input type="submit" onclick="myFunction()" title="btn" class="btn  mt-2  btn-primary"
                                        name="submit" value="submit"></center>
                            </form>
                        </div>

                     

                        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

                        <script>
                        function PrintPage() {
                            window.print();
                        }
                        $('#session-list').on('change', function() {
                            var session_id = this.value;
                            $.ajax({
                                type: "POST",
                                url: "get_exams.php",
                                data: 'session_id=' + session_id,
                                success: function(result) {
                                    $("#semester").html(result);
                                }
                            });
                        });

                        $('.bb').on('click', function() {
                            $('#collapseExample').addClass('active');

                        });
                        $('.closebtn').on('click', function() {
                            $('#collapseExample').removeClass('active');

                        });
                        </script>
</body>

</html>