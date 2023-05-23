<?php 
include("connection.php");
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
     <link rel="shortcut icon" href="ol.png" >
    <title>Class_Students</title>
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

<?php 
      if(isset($_REQUEST['submit'])){
        // $year=$_REQUEST['course_year'];
        $semester=$_REQUEST['semester'];
        // $exam=$_REQUEST['exam'];
        // $dept=mysqli_real_escape_string($conn,$_POST['department']);
        $course=mysqli_real_escape_string($conn,$_POST['course_name']);
        // $academic=$_REQUEST['academic'];
        $term=$_REQUEST['term'];
        $getexam=mysqli_query($conn,"select *from exam where academic_term=$term and semester_id=$semester");
        if(mysqli_num_rows($getexam)>0){
            $xx=mysqli_fetch_assoc($getexam);
        $exam=$xx['exam_id'];
           
            ?>
            <div class="container ">
  <table  class=" table mt-2 text-center table-bordered table-striped text-capitalize col-sm-12">
                   <tr>
                       <th>Student Name</th><th>Registration Number</th> <th>Exam Name</th><th>actions</th>
                   </tr>
<?php
        $select=mysqli_query($conn, "select distinct regno,student_name,course,semester from marks where exam=$exam and course=$course and semester=$semester");
        $exx=mysqli_query($conn, "select *from exam where exam_id=$exam");
        while($retr=mysqli_fetch_assoc($exx)){
            $examname=$retr['exam_name'];
        }
        $exx=mysqli_query($conn, "select *from semester where sem_id=$semester");
        while($crtr=mysqli_fetch_assoc($exx)){
            $semestername=$crtr['name'];
            $sid=$crtr['sem_id'];
        }

        while($row=mysqli_fetch_assoc($select)){
            $rno=$row['regno'];
            
          ?>
          <tr>
            <td>
                <form method='post' action='results.php'>
                    <label><?php echo $row['student_name'] ?></label>
                </td>
                <td>
                <label><?php echo $row['regno'] ?></label>
                    <input  style="border:0;" name="rno" type="text" hidden readonly value="<?php echo $row['regno'] ?>"> 
                </td>
                    <input  style="border:0;" name="semester" type="text" readonly hidden value="<?php echo $semestername?> ">
                    <td>
                    <label><?php echo $examname; ?></label>
                        <input  style="border:0;" hidden name="exam" value="<?php echo $exam ?>" type='text' readonly ></td>
                        
                        <td><input type="submit" class="btn btn-sm btn-info"  value="View Results" name="profile"><input type="submit" class="btn btn-sm ms-1 btn-info"  value="View All Results" name="results"></td></tr></form>
           <?php }?>
                   

               </table>
           </div>
        </div></div>
        


      <?php }
    else{
        echo("<div class='alert alert-info alert-dismissible fade show'>
        <strong>Sorry!</strong>No exam found for that semester.
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>");
    }  
    }
      elseif(isset($_REQUEST['passlist'])){
        $student_semester = mysqli_real_escape_string($conn,$_POST['semester']);
        // $exam=mysqli_real_escape_string($conn,$_POST['exam']);
        $dept=mysqli_real_escape_string($conn,$_POST['department']);
        $course=mysqli_real_escape_string($conn,$_POST['course_name']);

        $academic=$_REQUEST['academic'];
        $term=$_REQUEST['term'];
        $getexam=mysqli_query($conn,"select *from exam where academic_term=$term and semester_id=$student_semester");
        if(mysqli_num_rows($getexam)>0){
            $xx=mysqli_fetch_assoc($getexam);
        $exam=$xx['exam_id'];
        $ename=$xx['exam_name'];
        $get_deptname=mysqli_query($conn,"select *from department where id=$dept");
        $resdept=mysqli_fetch_assoc($get_deptname);
        $dname=$resdept['department_name'];





        $get_coursename=mysqli_query($conn,"select *from courses where course_id=$course");
        $rescourse=mysqli_fetch_assoc($get_coursename);
        $cname=$rescourse['course_name'];

        $get_semname=mysqli_query($conn,"select *from semester where sem_id=$student_semester");
        $ressem=mysqli_fetch_assoc($get_semname);
        $sname=$ressem['name'];

        $ssr=mysqli_query($conn,"select *from courseyears where course_id=$course");
        $resyr=mysqli_fetch_assoc($ssr);
        $yrname=$resyr['yrname'];

        $sql = mysqli_query($conn, "select * from results where semester_id=$student_semester and exam_id=$exam and comment='pass'");
        $counts=mysqli_num_rows($sql);


        $sql4 = mysqli_query($conn, "select * from results where semester_id=$student_semester and exam_id=$exam and comment='sup'");
        $counts2=mysqli_num_rows($sql4);


        ?>
            <div class="container">
                <div class="row  mt-3">
                    <div class="justify-content-center col-md-12 " style="display:flex;">
                        <img src="image/Kiirua-Technical-Training-Institute.webp" class="d-block" height="120" alt="CoolBrand"/>
                        <p class="lead text-wrap text-dark fw-bold" style="width:6rem; font-family:monospace">KIIRUA TECHNICAL TRAINING INSTITUTE</p>
                        
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12 justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon">School of <?php echo $dname; ?></p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-5 fw-bold  text-center" style="fon"> <?php echo $cname; ?></p>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon"> <?php echo $yrname; ?></p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon"> <?php echo $sname; ?> EXAMINATION RESULTS</p>
                    </div>
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon">PASS</p>
                    </div>
                    </div>  
                    <div class="row mt-5">
                    <div class="col-md justify-content-center">
                    <p class=" fs-6   text-center" style="fon">
                        The following <?php echo $counts; ?> candidates satisfied the school board of examiners during <?php echo $ename; ?> exam of the <?php echo $cname; ?> course and it is therefore recommended that they proceed to the next semester.
                </p>
                    </div>
                    </div> 
            </div>

            <div class="container ">
                <table class="table table-responsive-md table-bordered border-dark me-5">
                    
                    <tr class="text-center ">
                        <th class="text-uppercase">
                            s/no
                        </th>
                        <th class="text-uppercase">
                            reg no
                        </th>
                        <th class="text-uppercase ">
                            name
                        </th>
                       
                    </tr>
                    <?php
                    $i=1;
                    $sql4 = mysqli_query($conn, "select * from results where semester_id=$student_semester and exam_id=$exam and comment='pass'");
                    while($res=mysqli_fetch_assoc($sql4)){
                        ?>
                        <tr class="text-center ">
                            <td class="text-uppercase">
                                <?php 
                                echo $i;
                                $i++
                                ?>
                            </td>
                            <td class="text-uppercase">
                            <?php echo $res['regno'];?>
                            </td>
                            <td class="text-uppercase">
                            <?php echo $res['student_name'];?>
                            </td>
                        </tr>
                        <?php
           
        }?>
        </table> </div>
        <div class="container ">
        <div class="row mt-5">
        <div class="row  mt-3">
                    <div class="justify-content-center col-md-12 " style="display:flex;">
                        <img src="image/Kiirua-Technical-Training-Institute.webp" class="d-block" height="120" alt="CoolBrand"/>
                        <p class="lead text-wrap text-dark fw-bold" style="width:6rem; font-family:monospace">KIIRUA TECHNICAL TRAINING INSTITUTE</p>
                        
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12 justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon">School of <?php echo $dname; ?></p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-5 fw-bold  text-center" style="fon"> <?php echo $cname; ?></p>
                    </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon"> <?php echo $yrname; ?></p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon"> <?php echo $sname; ?> EXAMINATION RESULTS</p>
                    </div>
                    <div class="row">
                    <div class="col-md justify-content-center">
                    <p class="display-6 text-uppercase fs-6 fw-bold  text-center" style="fon">FAIL</p>
                    </div>
                    </div>  
                    <div class="row mt-5">
                    <div class="col-md justify-content-center">
                    <p class=" fs-6   text-center" style="fon">
                        The following <?php echo $counts2; ?> candidates did not <span class="fw-bold">satisfy</span> the school board of examiners during <?php echo $ename; ?> exam of the <?php echo $cname; ?> course and it is therefore recommended that they sit for <span class="fw-bold">supplementary</span> exams in units where they did not meet pass mark.
                </p>
                    </div>
                    </div> 
                   
                    </div> 
                <table class="table table-responsive-md table-bordered border-dark me-5">
                    
                    <tr class="text-center ">
                        <th class="text-uppercase">
                            s/no
                        </th>
                        <th class="text-uppercase">
                            reg no
                        </th>
                        <th class="text-uppercase ">
                            name
                        </th>
                        <th class="text-uppercase ">
                            unitname
                        </th>
                       
                    </tr>
                    <?php
                    $x=1;
                    
                    
                    $sql5 = mysqli_query($conn, "select * from results where semester_id=$student_semester and exam_id=$exam and comment='sup'");
                    while($res5=mysqli_fetch_assoc($sql5)){
                        ?>
                        <tr class="text-center ">
                            <td class="text-uppercase">
                                <?php 
                                echo $x;
                                $x++
                                ?>
                            </td>
                            <td class="text-uppercase">
                            <?php echo $res5['regno'];?>
                            </td>
                            <td class="text-uppercase">
                            <?php echo $res5['student_name'];?>
                            </td>
                            <td class="text-uppercase">
                            <?php
                            $getf=mysqli_query($conn,"select *from marks where regno='$res5[regno]' and exam=$exam and pass='sup'");
                            while($rts=mysqli_fetch_assoc($getf)){
                               $uid=$rts['unit_id'];
                                $getunitname=mysqli_query($conn,"select *from unit where id=$uid");
                                $resrts=mysqli_fetch_assoc($getunitname);
                                echo $resrts['unit_name'].",";
                            }
                            
                            
                            
                            
                            
                            
                            
                          ?>
                            </td>
                        </tr>
                        <?php
           
        }?>
        </table> </div></div>
        <?php
        
        
    }
else{
    echo("<div class='alert alert-info alert-dismissible fade show'>
    <strong>Sorry!</strong>No exam found for that semester.
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
</div>");
}
}
        
      
    ?> 
    </body>
</html>