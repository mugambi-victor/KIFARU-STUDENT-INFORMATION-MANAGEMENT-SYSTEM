<?php include('../connection.php');
header('Content-type: text/html; charset=utf-8');
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


    <link rel="shortcut icon" href="../admin/ol.png">
    <title>ViewInvoices</title>
    <style>
    a:hover {
        background-color: #8432DF;
    }
    </style>
</head>

<body>
    <?php include("header.php"); 
include('sidebar.php')?>

    <div class="container col-sm m-2">

        <?php
                 
                 if(isset($_REQUEST['record'])){
                    $regno=$_REQUEST['regno'];
                    $term=$_REQUEST['sem_name'];
                  
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
                        $insertquery=mysqli_query($conn,"insert into payments values(0,'$regno',$term, $semester, '$transid',$paid)");
                        $getstudent=mysqli_query($conn, "select *from student where regno='$regno'");
                        $rets=mysqli_fetch_assoc($getstudent);
                        $newtotal=$rets['total']-$paid;
                        // if($newbalance<0){
                        //     $overpaid=-1*$newbalance;
                        //     $updatequery=mysqli_query($conn, "update student set balance= 0, overpaid=$overpaid, fee_status=0 where regno='$regno'");
                        // }
                        // elseif($newbalance==0){
                        //     $updatequery=mysqli_query($conn, "update student set balance= 0,overpaid=0, fee_status=0 where regno='$regno'");
                        // }
                        // elseif($newbalance>0){
                        //     $updatequery=mysqli_query($conn, "update student set balance=$newbalance where regno='$regno'");
                        // }
                       

                        // if(!$insertquery&&!$updatequery){
                        //     echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                        //     <strong>Sorry!</strong>A problem occured while sending data
                        //     <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        // </div>");
                        // }
                        // else{
                        //     echo ("<div class='alert mt-3 alert-success alert-dismissible fade show'>
                        //     <strong>Success!</strong>Data sent successfully and student fee updated successfully
                        //     <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        // </div>");
                           
                           
                        // }
                        if($newtotal<=0){
                            $updatequery=mysqli_query($conn,"update student set total=$newtotal, fee_status=0 where regno='$regno'");
                            if(!$updatequery){
                                echo "sorry";
                            }
                            else{
                                echo "success";
                            }
                        }
                        else{
                            $updatequery=mysqli_query($conn,"update student set total=$newtotal where regno='$regno'");
                            if(!$updatequery){
                                echo "sorry";
                            }
                            else{
                                echo "success";
                            }
                        }
                       
                    }
                }
                 ?>
        <div class="row">
           
            <div class="col-md">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm">
                            <label for="searchbox" class="form-label lead fw-bold mt-5">Search By Registration
                                No</label>
                            <input type="text" name="searchbox" placeholder="registration no..."
                                class="p-2 form-control" required>
                        </div>

                        <input type="submit" name="search" class="btn btn-sm mt-3 btn-primary" value="Search">




                </form>
            </div>

            <?php
            if(isset($_REQUEST['search'])){

           
            $regno=$_REQUEST['searchbox'];

            ?>
            <div class="col-md">

                <table class="table mt-3 ms-1 table-sm table-bordered table-striped caption-top">
                    <tr class="text-capitalize">

                        <th>Student Name</th>
                        <th>Reg Number</th>
                       
                        <th>Fees due</th>
                        <th>actions</th>
                    </tr>
                    <?php

            $sql1=mysqli_query($conn, "select * from student where regno='$regno' and fee_status=1");
            if(mysqli_num_rows($sql1)>0){
            while($row=mysqli_fetch_assoc($sql1)){
      
                ?>
                    <tr>

                        <td>
                            <form method='post' action='viewstudentprofile.php'>
                                <label class='text-capitalize'><?php echo $row['s_name']; ?> </label>
                        </td>
                        <td>
                            <input class='text-uppercase' style='border:0;' name='rno' type='text' readonly
                                value="<?php echo $row['regno'];?> ">
                        </td>


                      
                        <td>
                            <?php echo $row['total']?>
                        </td>
                        <td>

                            </form>
                            <a href="#myModal<?php echo $row['id'] ?>" class="btn btn-sm btn-primary"
                                data-bs-toggle="modal">Record Payment</a>

                            <!-- Modal HTML -->
                            <div id="myModal<?php echo $row['id'] ?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <?php echo $row['total']; ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <label for="" class="form-label">Student Name</label>
                                                <input type="text" name="sname" value="<?php echo $row['s_name']; ?>"
                                                    readonly class="form-control">

                                                <label for="" class="form-label">Registration Number</label>
                                                <input type="text" name="regno" value="<?php echo $row['regno']; ?>"
                                                    readonly class="form-control">
                                                <input type="text" name="sem_name" value="<?php echo $row['term']; ?>"
                                                    readonly hidden class="form-control">

                                                <label for="" class="form-label">Year</label>
                                                <input type="text" value="<?php
                                            $getsemester=mysqli_query($conn,"select *from semester where sem_id='$row[semester]'");
                                            $result=mysqli_fetch_assoc($getsemester);
                                            $getyear=mysqli_query($conn,"select *from courseyears where id='$result[yrid]'");
                                            $result=mysqli_fetch_assoc($getyear);
                                            echo $result['yrname']; ?>" readonly class="form-control">

                                                <input type="number" hidden name="courseyear" value="<?php
                                                $getsemester=mysqli_query($conn,"select *from semester where sem_id='$row[semester]'");
                                                $result=mysqli_fetch_assoc($getsemester); echo $result['yrid']; ?>">
                                                <label for="" class="form-label">Semester</label>
                                                <input type="text" value="<?php
                                            $getsemester=mysqli_query($conn,"select *from semester where sem_id='$row[semester]'");
                                            $result=mysqli_fetch_assoc($getsemester);
                                             echo $result['name']; ?>" readonly class="form-control">
                                                <input type="text" hidden name="semester"
                                                    value="<?php echo $row['semester']; ?>">

                                                <label for="" class="form-label">Fee Amount</label>
                                                <input type="text" name="total_fee" value="<?php echo $row['total']; ?>"
                                                    readonly class="form-control">
                                                <label for="" class="form-label">Paid</label> <br>
                                                <?php
                                            $check = mysqli_query($conn, "select *from payments where regno='$row[regno]' and semester='$row[semester]'");
                                            if(mysqli_num_rows($check)>0){
                                            while($rs=mysqli_fetch_assoc($check)){
                                            ?>
                                                <input type="text" name="invoice"
                                                    value="<?php echo $rs['amount_paid']; ?>" readonly
                                                    class="form-control ">
                                                <?php } } else{

?>
                                                <input type="text" name="invoice" value="<?php echo 0; ?>" readonly
                                                    class="form-control ">
                                                <?php

                                            }?>

                                                <label for="" class="form-label">Transaction Id</label>
                                                <input type="text" name="transid" class="form-control" required>


                                                <label for="" class="form-label">Enter Total Amount paid</label>
                                                <input type="number" name="paid" class="form-control" required>

                                                <center> <input type="submit" name="record"
                                                        class="btn btn-secondary m-3" value="save data"></center>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn  btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                </table>
                <?php  }
                ?>
            </div><?php
                
        }
        else{
            echo "<div class='lead mt-2 text-dark'>No records found in the database</div>";
        }
        
    }?>



        </div>
        <div class="col-md">

<p class="fw-bold p-0 mt-5 fs-4 lead">Search by class</p>

<div class="row">
    <div class="col-md-6">
        <form action="class.php" method="post">
            <label for="session" class="form-label">Academic year</label>
            <select class="form-select" aria-label="session" name="session" id="session-list" required>
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
        <label for="sem_name" class="form-label">term</label>
        <select class="form-select" aria-label="sem_name" name="sem_name" id="sem-list" required>
            <option value=''>Select term</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="department" class="form-label">Department</label>
        <select class="form-select" aria-label="department" name="department" id="department-list"
            required>
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
        <select class="form-select" aria-label="course_name" name="course_name" id="course-list"
            required>
            <option value=''>Select course</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="course_year" class="form-label">course year</label>
        <select class="form-select" aria-label="course_year" name="course_year" id="year-list" required>
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

<div class="col-md">
    <center><input type="submit" value="GO" name="submit" id="formsubmit" class="btn btn-primary mt-3"></center>
</div>
</div>


</form>

    </div>








    <?php 
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
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

    function func() {
        document.getElementById('myAccordion').style.display = "none";

    }
    </script>

</body>

</html>