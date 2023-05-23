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
    <title>Class_Students</title>
    <style>
     
         input{
             border:0;
             background-color:inherit;
         }
         .nav a:hover{
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

   
    <div class="container col-md">
    <?php
if (isset($_POST["submit"])) {
   
            $student_semester = mysqli_real_escape_string($conn,$_POST['semester']);
         
            // $exam=mysqli_real_escape_string($conn,$_POST['exam']);
            $dept=mysqli_real_escape_string($conn,$_POST['department']);
            
            $course=mysqli_real_escape_string($conn,$_POST['course_name']);
           
            $term=mysqli_real_escape_string($conn,$_POST['term']);

            $getexam=mysqli_query($conn,"select *from exam where semester_id=$student_semester and academic_term=$term ");
           if(mysqli_num_rows( $getexam)<1){
            echo "<div class='alert alert-danger'>
            <strong>Sorry!!</strong> exam does not exist!
          </div>";
           }else{
            $xx=mysqli_fetch_assoc($getexam);
            $exam=$xx['exam_id'];
            
                $sql = mysqli_query($conn, "select * from student where semester='$student_semester'and course_id=$course and term=$term");
                if(mysqli_num_rows($sql)<1){
                    die("<div class='alert alert-warning'>
                    <strong>Sorry!!</strong>no students in this semester
                  </div>");
                }
                else{

                ?>
                <table class="table mt-3 table-bordered table-striped text-capitalize ">
                    <th>name</th>
                    <th>
                        Registration No.
                    </th>
                    <th>
                        action
                    </th>
                <?php
                while($res=mysqli_fetch_assoc($sql)){?>
                <div class="row">
                <div class="col-md">
                <form action="addmarks.php" method="post">
                <input type="text" hidden value="<?php echo $res['id']; ?>" name="student">
                <input type="text" hidden value="<?php echo $res['semester']; ?>" name="semester">
                <input type="text" hidden value="<?php echo $res['course_id']; ?>" name="course">
                <input type="text" hidden value="<?php echo $exam; ?>" name="exam">
               
                    <tr>
              
                        <td>
                            <input type="text" class="text-uppercase" name="s_name" readonly value="<?php echo $res['s_name']; ?>">
                        </td>
                         <td>
                            <input type="text"  class="text-uppercase" name="rno" readonly value="<?php echo $res['regno']; ?>"></td>
                         
                         <td><input style="margin-top:0;"  type="submit" class="btn text-capitalize btn-primary" name="submit" value="add marks"> </form></td>
                    </tr>
                

           
           <?php }
        ?> 
        </table>
               
                </div>
                </div>
        <div class="container">
                <center>
                <button type="button" name="back" class="btn p-2 btn-danger"><a href="grades.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i>GoBack</a></button>
                </center>
            </div>
        <?php   
        }}}

           elseif(isset($_REQUEST['passlist'])){
            $student_semester = mysqli_real_escape_string($conn,$_POST['semester']);
            $exam=mysqli_real_escape_string($conn,$_POST['exam']);
            $dept=mysqli_real_escape_string($conn,$_POST['department']);
            $course=mysqli_real_escape_string($conn,$_POST['course_name']);
            $sql = mysqli_query($conn, "select * from results where semester_id=$student_semester and exam_id=$exam and comment='pass'");
            while($res=mysqli_fetch_assoc($sql)){
                echo $res['student_name'];
            }
            

            }
          ?>
            </div>
</body>
</html>