<?php
include('../connection.php');
session_start();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:accounts_login.php');
   
} 
$_GET['name'];
$id = $_GET['name'];

$getid=mysqli_query($conn,"select *from courses where course_name='$id'");
$rest=mysqli_fetch_assoc($getid);
$idd=$rest['course_id'];
$option4 = "";
$options = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>Accounts|SetFee</title>
<style>
a.btn{
    width:40%}

</style>

</head>

<body>
    <?php
    include('header.php');

    ?>
    
    
    <?php include('sidebar.php');?>
 <div class="container ms-1  col-md">
 <?php
    if(isset($_REQUEST['set'])){
        
        $sem=$_REQUEST['sem'];
        $total=$_REQUEST['total'];
        $target="fee_structures/".basename( $_FILES["fee_structure"]["name"]);
        $filename = $_FILES["fee_structure"]["name"];
        $check=mysqli_query($conn,"select *from semester where sem_id=$sem");
        $res=mysqli_fetch_assoc($check);
        $amount=$res['total_fees'];

        if($amount==0){
        $updatequery=mysqli_query($conn, "update semester set total_fees=$total, fee_structure='$filename' where sem_id=$sem");
       //updating student fees
        $newfee=mysqli_query($conn,"select *from student where semester=$sem");
        if(mysqli_num_rows($newfee)>0){
        $rest=mysqli_fetch_assoc($newfee);
        $newfees=$total+$rest['total'];
        if($newfees>0){
            $fee_status=1;
        }else{
            $fee_status=0;
        }

        $updatestudent=mysqli_query($conn, "update student set total=$newfees, fee_status=$fee_status where  semester=$sem");
        if(move_uploaded_file($_FILES["fee_structure"]["tmp_name"],$target)&&$updatequery&&$updatestudent) {?>
       <?php
            echo("<div class=' mt-3 alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Data sent successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>");
        }
    
    
        else{
            echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
            <strong>Sorry!</strong>An error occured while sending data
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>");
        }}
        elseif(mysqli_num_rows($newfee)<1){
            if(move_uploaded_file($_FILES["fee_structure"]["tmp_name"],$target)&&$updatequery) {?>
                <?php
                     echo("<div class=' mt-3 alert alert-success alert-dismissible fade show'>
                     <strong>Success!</strong>Data sent successfully!
                     <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                 </div>");
                 }
             
             
                 else{
                     echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
                     <strong>Sorry!</strong>An error occured while sending data
                     <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                 </div>");
                 }
        }
    }
    else{
        echo ("<div class='mt-3 alert alert-warning alert-dismissible fade show'>
            <strong>Sorry!</strong>Fee has already been set unless you update it.
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>");
    }

    }
    elseif(isset($_REQUEST['update'])){
        $year=$_REQUEST['year'];
        $sem=$_REQUEST['sem'];
        $total=$_REQUEST['total'];
        $target="fee_structures/".basename( $_FILES["fee_structure"]["name"]);
        $filename = $_FILES["fee_structure"]["name"];
      
        
        
        $updatequery=mysqli_query($conn, "update semester set total_fees=$total, fee_structure='$filename' where  sem_id=$sem");
        $checkstudent=mysqli_query($conn,"select *from student where semester=$sem");
        $sum=0;
        while($x=mysqli_fetch_assoc($checkstudent)){
            $reg=$x['regno'];
            $getpayments=mysqli_query($conn,"select *from payments where semester=$sem and regno='$reg'");
            while($y=mysqli_fetch_assoc($getpayments)){
                $sum=$sum+$y['amount_paid'];
            }
            echo $sum;
            $amount=$total-$sum;
            if($amount>0){

                $update_st=mysqli_query($conn, "update student set total=$amount, fee_status=1 where semester=$sem");
            }else{
                $update_st=mysqli_query($conn, "update student set total=$amount, fee_status=0 where semester=$sem");
            }

        }
        // $updatestudent=mysqli_query($conn, "update student set total=$total where semester=$sem");
        if($updatequery&&$update_st&&move_uploaded_file($_FILES["fee_structure"]["tmp_name"],$target)) {?>
       <?php
            echo("<div class=' mt-3 alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Data sent successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>");
        }
        else{
            echo ("<div class='alert mt-3 alert-warning alert-dismissible fade show'>
            <strong>Sorry!</strong>An error occured while sending data
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>");
        }
    }
    
    
    ?>

        <div class="row mt-3 justify-content-center">
         
            <div class="col-md">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="year" class="form-label">Select Year</label>
                <select name="year" aria-label="year" class="form-select" id="yearlist">
                    <option value="">select Course Year</option>
                    <?php
                    $getyears = mysqli_query($conn, "select *from courseyears where course_id=$idd");
                    while ($res = mysqli_fetch_assoc($getyears)) {
                        $option4="";
                        $options4 = $options4 . "<option value= $res[id] >$res[yrname]</option>";

                    }
                    echo $options4;
                    ?>
                </select>

                <label for="sem" class="form-label">semester</label>
                <select class="form-select" aria-label="sem" name="sem" id="sem-list">
                    <option value="">select semester</option>
                </select>
                <label for="fee_structure" class="form-label">Fees structure</label>
                <input type="file" aria-label="fee_structure" name="fee_structure" required class="form-control">
                <label for="total" class="form-label" >Total fees</label>
                <input type="number" name="total" placeholder="enter a number" class="form-control" required>

                <center> <input type="submit" name="set" class="btn btn-danger m-3" value="save data"><input type="submit" name="update" class="btn btn-secondary m-3" value="update data"></center>
           
                </form> </div>
                <div class="col-md">
            <table class="table table-bordered">
                <tr>
                    <th>
                        S/n
                    </th>
                    <th>
                        YR Name
                    </th>
                    <th>
                        Semester
                    </th>
                    <th>
                        Fee
                    </th>
                </tr>
                <?php 
                $getd=mysqli_query($conn,"select *from semester where course_id=$idd");
                $x=1;
                while($response=mysqli_fetch_assoc($getd)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $x++;?>
                        </td>
                        <td>
                            <?php
                            $getyrname=mysqli_query($conn,"select *from courseyears where id='$response[yrid]'");
                            $r=mysqli_fetch_assoc($getyrname);
                            echo $r['yrname'];?>
                        </td>
                        <td>
                            <?php 
                             $getyrname=mysqli_query($conn,"select *from courseyears where id='$response[yrid]'");
                             $r=mysqli_fetch_assoc($getyrname);
                             echo $response['name']?>
                        </td>
                        <td>
                            <?php echo $response['total_fees']?>
                        </td>
                    </tr>


                    <?php
                }
                ?>

            </table>
            
           </div>

           

        </div>
        <a href="select_department.php" class="btn btn-primary "  role="button"><i class="bi-arrow-bar-left"></i>BacktoDepartments</a>
    </div>
    <script src="../jquery.js"></script>
    <script>
        $('#yearlist').on('change', function () {
            var yr_id = this.value;

            $.ajax({
                type: "POST",
                url: "getsemester.php",
                data: 'yr_id=' + yr_id,
                success: function (results) {
                    $("#sem-list").html(results);
                }
            });
        });
    </script>
</body>

</html>