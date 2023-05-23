<?php include('../connection.php');
session_start();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:accounts_login.php');
   
} 
$optionr=""; 
$options=""; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>ViewPayments</title>
    <style>
        a:hover{
            background-color: #8432DF;
        }
       
    </style>
</head>
<body>
<?php include("header.php"); 
include('sidebar.php')?>

    <div class="container col-sm m-5">
       
<?php
                 
                 if(isset($_REQUEST['record'])){
                    $regno=$_REQUEST['regno'];
                    $courseyear=$_REQUEST['courseyear'];
                    $semester=$_REQUEST['semester'];
                    $transid=$_REQUEST['transid'];
                    $paid=$_REQUEST['paid'];



                    
                    $check=mysqli_query($conn,"select *from payments where transaction_id='$transid'");
                    if(mysqli_num_rows($check)>0){ 
                        echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                        <strong>Sorry!</strong>A payment with that Transaction Id has already been Recorded.
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>");

                    }else{
                        $insertquery=mysqli_query($conn,"insert into payments values(0,'$regno',$courseyear, $semester, '$transid',$paid)");
                        $getstudent=mysqli_query($conn, "select *from student where regno='$regno'");
                        $rets=mysqli_fetch_assoc($getstudent);
                        $newbalance=$rets['balance']-$paid;
                        if($newbalance<=0){
                            $newbalance=-1*$newbalance;
                            $updatequery=mysqli_query($conn, "update student set balance=$newbalance, fee_status=0, overpaid=$newbalance where regno='$regno'");
                        }
                        elseif($newbalance!=0){
                            $updatequery=mysqli_query($conn, "update student set balance=$newbalance where regno='$regno'");
                        }
                       

                        if(!$insertquery&&!$updatequery){
                            echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                            <strong>Sorry!</strong>A problem occured while sending data
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>");
                        }
                        else{
                            echo ("<div class='alert mt-3 alert-success alert-dismissible fade show'>
                            <strong>Success!</strong>Data sent successfully and student fee updated successfully
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>");
                           
                           
                        }
                    }
                }
                
                 ?>
    <form action="" method="post">
    <div class="row">
    <div class="col-sm">
                <input type="text" name="searchbox" placeholder="search registration no..." class="form-control" required></div>
                <div class="col-sm m-0">
                <input type="submit" name="search" class="btn btn-primary" value="Search">
                </div>
         
             
            
        </form>
    </div>

    <?php
    if(isset($_REQUEST['search'])){
        $regno=$_REQUEST['searchbox'];

?>
<div class="col-sm">
 
<table  class="table mt-3 table-bordered table-striped caption-top">
                                   <tr class="text-capitalize">
                                       
                                         <th>Student Name</th>
                                         <th>Registration Number</th>
                                         <th>TransactionID</th> 
                                         <th>Amount paid</th>
                                         <th>semester</th>
                                         
                                         <th>actions</th>
                                     </tr>
<?php
$getstudent=mysqli_query($conn,"select *from student where regno='$regno'");
if(mysqli_num_rows($getstudent)>0){
$res=mysqli_fetch_assoc($getstudent);
$name=$res['s_name'];
$getpayments=mysqli_query($conn,"select *from payments where regno='$regno'");
while($rts=mysqli_fetch_assoc($getpayments)){
    ?>
    <tr>
        <td><?php echo $name?></td>
        <td><?php echo $regno?></td>
        <td><?php echo $rts['transaction_id']?></td>
        <td><?php echo $rts['amount_paid']?></td>
        <td><?php 
        $getsemester=mysqli_query($conn,"select *from semester where sem_id='$rts[semester]'");
        $sem=mysqli_fetch_assoc($getsemester);
        $semname=$sem['name'];
        $yrid=$sem['yrid'];
        $getyear=mysqli_query($conn,"select *from courseyears where id=$yrid");
        $year=mysqli_fetch_assoc($getyear);
        $yrname=$year['yrname'];
        echo $yrname." ".$semname; ?></td>
      
        <td><a href="#" class="btn btn-sm btn-primary">Print Receipt</a></td>
    </tr>
    <?php
}
?> </table> <?php
    }
    else{
        echo "no record found";
        }
        }?>
                    
               

    
<div class="container col-sm mt-3">
<div class="row">
    
<form action="payments.php" method="post" id="myform">
    <p class="display-6 fw-bold">Search by class</p>
        <div class="row">
    <div class="col-md-6">
    <label for="" class="form-label">Academic year</label>
    <select class="form-select"  aria-label="session" name="session" id="session-list" required>
  <option selected>select academic year</option>
  <?php
  $optionss="";
  $a_result = mysqli_query($conn, "select* from academic_year");
            if (mysqli_num_rows($a_result) > 0) {
                // output data of each row
                while ($r = mysqli_fetch_assoc($a_result)) {
                    $optionss=$optionss."<option value= $r[id] >$r[sname]</option>";
            
                }
                 
            }
           echo $optionss;
            ?>
</select>
  </div>
  <div class="col-md-6">
    <label for="sem_name" class="form-label">Period</label>
    <select class="form-select" aria-label="sem_name"  name="sem_name" id="sem-list" required>
  <option value=''>Select Period</option>
</select>
  </div>
        </div>
        <div class="row">
    <div class="col-md-6">
    <label for="" class="form-label">Department</label>
    <select class="form-select" aria-label="department"  name="department" id="department-list" required>
  <option selected>select department</option>
  <?php
  $d_result = mysqli_query($conn, "select* from department");
            if (mysqli_num_rows($d_result) > 0) {
                // output data of each row
                while ($r = mysqli_fetch_assoc($d_result)) {
                    $options=$options."<option value= $r[id] >$r[department_name]</option>";
            
                }
                 
            }
           echo $options;
            ?>
</select>
  </div>
  <div class="col-md-6">
    <label for="course_name" class="form-label">Course</label>
    <select class="form-select"  aria-label="course_name" name="course_name" id="course-list" required>
  <option value=''>Select course</option>
</select>
  </div>
        </div>
        <div class="row">
  <div class="col-md-6">
    <label for="course_year" class="form-label">course year</label>
    <select class="form-select" aria-label="course_year"  name="course_year" id="year-list" required>
  <option value=''>Select year</option>
</select>
  </div>
  <div class="col-md-6">
  <label for="semester" class="form-label">Semester</label>
            <select class="form-select" aria-label="semester" name="semester" id="semester-list">
                <option value=''>Select Semester</option>
            </select>
         </div>
         </div>

        <div class="col-md-6">
            <input type="submit" value="submit" name="submit" id="formsubmit" class="btn btn-primary mt-1">
        </div>
  </div>

         
            </form>
</div>



    
        </div></div>
      <?php 
    ?>
 
   
<script>
    $('#year-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "getclasses.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#semester-list").html(result);
            }
        });
    });
    $('#course-list').on('change', function() {
        var course_id = this.value;
        $.ajax({
            type: "POST",
            url: "getyears.php",
            data: 'course_id=' + course_id,
            success: function(result) {
                $("#year-list").html(result);
            }
        });
    });
    $('#department-list').on('change', function() {
        var department_id = this.value;

        $.ajax({
            type: "POST",
            url: "getcourses.php",
            data: 'department_id=' + department_id,
            success: function(results) {
                $("#course-list").html(results);
            }
        });
    });
    $('#session-list').on('change', function() {
        var academic_id = this.value;

        $.ajax({
            type: "POST",
            url: "getacademicterm.php",
            data: 'academic_id=' + academic_id,
            success: function(results) {
                $("#sem-list").html(results);
            }
        });
    });
    


   
    </script>

</body>
</html>