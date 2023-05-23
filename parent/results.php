<?php
include("../connection.php");
session_start();
$sql1=mysqli_query($conn, "select *from student where regno='$_SESSION[p_pass]'");
$res=mysqli_fetch_assoc($sql1);
$s=$res['regno'];
if (!isset($_SESSION['p_pass'])) {
    header("location:parent_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewResults</title>
   
    <style>
       
        
        .results table {
            font-family: arial, sans-serif;
            width: 80%;
            border:0;
        }

        .results td {
            border: 0;
            text-align: left;
            padding: 8px;

        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
       
    </style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>


        <div class="container col-sm">
            <div class="row justify-content-around m-4">
                <div class="col-sm">
                <form action="transcript.php" method="POST">
            <!-- dropdown for session/academic year -->
            

            <div class="row"> 
                <select  name="session" class="form-select" id="session-list" required>
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
        <select name="semester"  class="form-select" id="semester" required>
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
            <input type="text" name="sname" hidden value="<?php echo $r['s_name']; ?>" >
  
     <?php   }
        ?>
  
     <center>   <input type="submit"  class="btn mt-2 btn-primary" name="submit" value="submit"></center>
        </form>
                </div>
            </div>
      
        </div>
    

    <?php
    if(isset($_REQUEST["submit"])){
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
            $grade="";
            if($query!==null){
                if($result['marks']>80&&$result['marks']<=100){
                    $grade="A";
                }
                elseif($result['marks']>65&&$result['marks']<=80){
                    $grade="B";
                }
                elseif($result['marks']>55&&$result['marks']<=65){
                    $grade="C";
                }
                elseif($result['marks']>40&&$result['marks']<=55){
                    $grade="D";
                }
                elseif($result['marks']>0&&$result['marks']<=40){
                    $grade="E";
                }
             ?>
          <center>
          <div class="results">
           <table style="border:0; width:700px;">
                    <tr>
                        <td style="width:50%;"><?php echo $result['subject_name']; ?></td>
                        <td style=" width:50%; "><?php echo $result['marks']; ?></td>
                        <td style=" width:50%; "><?php echo $grade; ?></td>
                    </tr>
                </table>
                
           </div>
           
          </center> 


        <?php }
              
          
              }  }}
    ?>

<br><br><br>
   
    <script src="../jquery.js"></script>
    <script>
	function PrintPage() {
		window.print();
	}
    $('#session-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "../student/get_exams.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#semester").html(result);
            }
        });
    });
    $('.bb').on('click', function(){
    $('#collapseExample').addClass('active');

});
$('.closebtn').on('click', function() {
                            $('#collapseExample').removeClass('active');

                        });
    </script>
</body>
</html>