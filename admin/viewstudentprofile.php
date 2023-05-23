<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["email"]))

	header("location:admin_login.php"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="ol.png" >
    <title>StudentProfile</title>
    
    
    
    <style>
        .gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
}

    </style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   
    if(isset($_REQUEST['profile'])){
            $regno=mysqli_real_escape_string($conn,$_REQUEST["rno"]);
            echo "$regno";
            $query=mysqli_query($conn, "select * from student where regno ='$regno'");
            while($result=mysqli_fetch_assoc($query)){
               
            
    ?>
    
    <div class="container col-md ">
    <section class="vh-100"  style="background-color: #f4f5f7; ">
  
  <div class="row  d-flex justify-content-center align-items-center h-100 ">
    <div class="col col-lg-10 mb-4 mb-lg-0">
      <div class="card mb-9" style="border-radius: .5rem;">
        <div class="row g-3">
          <div class="col-md-4 gradient-custom text-center text-white"
            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
            <?php echo "<img  class='img-fluid my-5' style='width: 150px; padding:0;' src='../student/images/".$result['photo']. " ' >"; ?>
            
            <h5><?php echo $result['s_name']; ?></h5>
            <p><?php echo $result['regno']; ?></p>
            <i class="far fa-edit mb-5"></i>
          </div>
          <div class="col-md-8">
            <div class="card-body p-4">
              <h6>Information</h6>
              <hr class="mt-0 mb-4">
              <div class="row pt-1">
                <div class="col-6 mb-3">
                  <h6>DOB</h6>
                  <p class="text-muted"><?php echo $result['dob']; ?></p>
                </div>
                
                <div class="col-6 mb-3">
                  <h6>year joined</h6>
                  <p class="text-muted"><?php echo $result['year']; ?></p>
                </div>
              </div>
              <div class="row">
                <h5>Course info</h5> <hr>
  <div class="col-md-4">
    <label for="course" class="form-label">Coursename</label>
    
    <?php 
    $cid=$result['course_id'];
    $getcourse=mysqli_query($conn,"select *from courses where course_id =$cid");
    $courseresult=mysqli_fetch_assoc($getcourse);
    $coursename=$courseresult['course_name'];
    ?>
<p class="text-muted"><?php echo $coursename; ?></p>
   
  </div>

 
  <div class="col-md-4">
    <label for="courseyear" class="form-label">Course Year</label>
    
    <?php 
     $sid=$result['semester'];
     $getsem=mysqli_query($conn,"select *from semester where sem_id =$sid");
     $semresult=mysqli_fetch_assoc($getsem);
    $yrid=$semresult['yrid'];
    $getyr=mysqli_query($conn,"select *from courseyears where id =$yrid");
    $yrresult=mysqli_fetch_assoc($getyr);
    $yrname=$yrresult['yrname'];
    ?>
 <p class="text-muted"><?php echo $yrname; ?></p>
    
  </div>

  
  <div class="col-md-4">
    <label for="semester" class="form-label">Semester</label>
    
    <?php 
    $sid=$result['semester'];
    $getsem=mysqli_query($conn,"select *from semester where sem_id =$sid");
    $semresult=mysqli_fetch_assoc($getsem);
    $semname=$semresult['name'];
    ?>
 <p class="text-muted"><?php echo $semname ?></p>
  </div>

  </div>
  <div class="row">
    <h5>Academic Year Info</h5> <hr>
    <div class="col-md-4">
    <label for="course" class="form-label">Academic Year</label>
    <?php 
    $tid=$result['term'];
    $gett=mysqli_query($conn,"select *from academic_term where id =$tid");
    $tresult=mysqli_fetch_assoc($gett);
    $aid=$tresult['sname_id'];
    $getacad=mysqli_query($conn,"select *from academic_year where id =$aid");
    $acadresult=mysqli_fetch_assoc($getacad);
    $acadname=$acadresult['sname'];
    ?>
<p class="text-muted"><?php echo $acadname; ?></p>
    </div>
    <div class="col-md-4">
    <label for="course" class="form-label">Academic Year Term</label>
    <?php 
    $tid=$result['term'];
    $gett=mysqli_query($conn,"select *from academic_term where id =$tid");
    $tresult=mysqli_fetch_assoc($gett);
    $tname=$tresult['term'];
    ?>
<p class="text-muted"><?php echo $tname; ?></p>
    </div>
  </div>
              <h6>Parent/Guardian Information</h6>
              <hr class="mt-0 mb-4">
              <div class="row pt-1">
                <div class="col-6 mb-3">
                  <h6>Parent/Guardian Name</h6>
                  <p class="text-muted"><?php echo $result['parent_name']; ?></p>
                </div>
                <div class="col-6 mb-3">
                  <h6>Parent/Guardian phone</h6>
                  <p class="text-muted"><?php echo $result['pno']; ?></p>
                </div>
                <div class="col-6 mb-3">
                  <h6>Parent's Email</h6>
                  <p class="text-muted"><?php echo $result['email']; ?></p>
                </div>
              </div>
              <div class="d-flex justify-content-start">
                
                <form action="editstudentprofile.php" method="post">
                <input type="text" name="rno" value="<?php echo $result['regno']; ?>" hidden>
                <input type="submit" class="btn btn-primary" name="edit" value="Edit Profile"> 
      
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
</div>
</section>
</div>
<?php }} ?>
</body>
</html>