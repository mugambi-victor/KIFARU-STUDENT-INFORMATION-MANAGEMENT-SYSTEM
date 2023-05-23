<?php
include("../connection.php");
session_start();
$s = $_SESSION["p_pass"];
if (!isset($_SESSION["p_login"])) {
    header("location:p_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transcript</title>
    <link href="../bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet" >
<script src="../bootstrap_5.1.3/js/bootstrap.min.js"></script>
</head>
<body class="bg-white">
               
<?php


    if(isset($_REQUEST["submit"])){
       

        $session=$_REQUEST["session"];
        // $exam=$_REQUEST["exam"];
        $semester=$_REQUEST["semester"];
        $student_name=$_REQUEST["sname"];
        $checckexam=mysqli_query($conn,"select distinct exam from marks where regno='$s' and semester=$semester and yrid=$session");
        if(mysqli_num_rows($checckexam)==0){?>
        <div class="alert container mt-4 alert-primary" role="alert">
        your results for this semester have not been added!! please contact admin. <a href="results.php" class="alert-link">GoBack</a>.
</div>
        <?php
            // echo ("<script>alert('your results for this semester have not been added!! please contact admin')</script>");
       
        }
        else{
            ?>
            <div class="container">
  
  <div class="row mt-3">
              <div class="justify-content-center col-md-12 " style="display:flex;">
                  <img src="../image/Kiirua-Technical-Training-Institute.webp" class="d-block" height="140" alt="CoolBrand"/>
                  <p class="lead text-wrap text-dark fw-bold mt-1" style="width:6rem; font-family:monospace ">KIIRUA TECHNICAL TRAINING INSTITUTE</p>
   </div>
</div>
                  <div class="row">
                      <div class="col-md-12 text-center">
                      <h6>PO BOX 60200</h6>
                      <h6>TEL: 0740843795</p>
                      <h4 class="text-uppercase">office of the registrar- academics</h4>
                      <p class="lead text-capitalize fw-bold">
                          result slip
                      </p>
                      <hr>
                      </div>
                      
</div>
              
   
            <?php
        $finde=mysqli_query($conn, "select distinct exam from marks where regno='$s' and semester=$semester and yrid=$session");
        $re=mysqli_fetch_assoc($finde);
        $exam= $re['exam'];
        $getstudentdata=mysqli_query($conn,"select distinct student_name,regno,course,semester,yrid from marks where regno='$s' and exam=$exam");
        $resst=mysqli_fetch_assoc($getstudentdata);
            $studentname=$resst['student_name'];
            $reg=$resst['regno'];
            $courseid=$resst['course'];
            $yearid=$resst['yrid'];
            $semesters=$resst['semester'];

            $getyear=mysqli_query($conn,"select *from courseyears where id=$yearid");
$reyear=mysqli_fetch_assoc($getyear);
$yrname=$reyear['yrname'];

$getsemester=mysqli_query($conn,"select *from semester where sem_id=$semesters");
$ressem=mysqli_fetch_assoc($getsemester);
$semname=$ressem['name'];

$getcourse=mysqli_query($conn,"select *from courses where course_id=$courseid");
$courser=mysqli_fetch_assoc($getcourse);
$coursename=$courser['course_name'];
        $getexam=mysqli_query($conn,"select*from exam where exam_id=$exam");
        $examrest=mysqli_fetch_assoc($getexam);
        $examname=$examrest['exam_name'];
        ?>
        <div class="container">
            <div class="row">
                <div class="col">
                <p class="text-uppercase"><span class="fw-bold">Student Name:</span> <?php echo $studentname;?></p>
        <p class="text-uppercase"><span class="fw-bold">Reg No: </span><?php echo $reg; ?></p>
        <p class=" text-uppercase"><span class="fw-bold">course: </span><?php echo $coursename; ?> </p>
                </div>
                <div class="col align-content-end">
                
        <p class="text-uppercase"><span class="fw-bold">Year:</span> <?php echo $yrname; ?></p>
        <p class="text-uppercase"><span class="fw-bold">semester:</span> <?php echo $semname;?> </p>
        <p class=" text-uppercase"><span class="fw-bold">Exam:</span> <?php echo $examname; ?></p>
                </div>
            </div>
        </div>
        
       
        <table class="table table-primary caption-top">
    <caption>List of Subjects and Scores</caption>
        <tr><th>Subject</th> <th>Score</th><th>Grade</th></tr>
        <?php
        $query=mysqli_query($conn, "select * from marks where exam=$exam and regno='$s'");
        while($result=mysqli_fetch_assoc($query)) {
       
               
       
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
         
                    <tr>
                        <td class="text-uppercase" style="width:50%;"><?php 
                        $rr=$result['unit_id'];
                        
                        $qy=mysqli_query($conn,"select *from unit where id=$rr");
                        while($row=mysqli_fetch_assoc($qy)){
                            echo $row['unit_name']; 
                        }?></td>
                        <td style=" width:50%; "><?php echo $result['marks']; ?></td>
                        <td style=" width:50%; "><?php echo $grade; ?></td>
                    </tr>
               
                
           </div>
           
          </center> 
          


        <?php }
              
          
        }
         $query=mysqli_query($conn, "select * from marks where exam='$exam' and regno='$s'"); 
        $sum=0;
        $mean=0;
        $grade="";
        $i=1;
        while($r=mysqli_fetch_assoc($query)){
            $n=mysqli_num_rows($query);
            $m=$r['comment'];
        $sum=$sum+$r['marks'];
        
        }$i++;
        if($i>1){
            
            $mean=$sum/$n;
        }
            if($query!==null){
                if($mean>80&&$mean<=100){
                    $grade="A";
                }
                elseif($mean>65&&$mean<=80){
                    $grade="B";
                }
                elseif($mean>55&&$mean<=65){
                    $grade="C";
                }
                elseif($mean>40&&$mean<=55){
                    $grade="D";
                }
                elseif($mean>0&&$mean<=40){
                    $grade="E";
                }
               
             
               
    }
    echo "</table> ";
    
    echo "\nAverage Score: <b>".$mean."</b><br>GRADE:<b> ".$grade."</b> <br><br>"; 
}}?>
 
</div>

</body>
</html>
