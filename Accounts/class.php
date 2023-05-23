<?php include('../connection.php'); 
session_start();
$a=$_SESSION['accounts_email'];
if(!isset($a)){
    header('location:accounts_login.php');
   
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>Document</title>
</head>
<body>
    <?php include('header.php'); ?>
    <?php  include('sidebar.php') ?>

  
              
            
                 <div class="container col-md">

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
  <?php 
                 
                 if(isset($_REQUEST["submit"])){
               
                     $semester=mysqli_real_escape_string($conn,$_REQUEST["semester"]);
                     $course=mysqli_real_escape_string($conn,$_REQUEST["course_name"]);
                     $acadsem=mysqli_real_escape_string($conn,$_REQUEST["sem_name"]);
                     ?>
                  <table  class="table table-bordered table-striped caption-top">
                                    <caption class="text-capitalize">list of Students who have not cleared fees yet</caption> <tr class="text-capitalize">
                                        <th>
                                            S/no
                                        </th>
                                         <th>Student Name</th>
                                         <th>Registration Number</th>
                                         <th>Parent's email</th> 
                                         <th>Parent's No.</th>
                                         <th>Semester Fees</th>
                                         <th>actions</th>
                                     </tr>
                  <?php
                  $sql=mysqli_query($conn,"select * from student where semester=$semester and course_id=$course and term=$acadsem and fee_status=1");
                  $x=1;
                  while($row=mysqli_fetch_assoc($sql)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $x++;?>
                        </td>
                        <td>
                            <form method='post' action='viewstudentprofile.php'>
                                <label class='text-capitalize'><?php echo $row['s_name']; ?> </label>
                            </td>
                            <td>
                                <input class='text-uppercase' style='border:0;' name='rno' type='text' readonly value="<?php echo $row['regno'];?> ">
                            </td>
                                
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['pno']?> </td>
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
                                            <input type="text" name="sname" value="<?php echo $row['s_name']; ?>" readonly
                                                class="form-control">

                                            <label for="" class="form-label">Registration Number</label>
                                            <input type="text" name="regno" value="<?php echo $row['regno']; ?>" readonly
                                                class="form-control">
                                                <input type="text" name="sem_name" value="<?php echo $row['term']; ?>" readonly hidden 
                                                class="form-control">

                                            <label for="" class="form-label">Year</label>
                                            <input type="text" value="<?php
                                            $getsemester=mysqli_query($conn,"select *from semester where sem_id='$row[semester]'");
                                            $result=mysqli_fetch_assoc($getsemester);
                                            $getyear=mysqli_query($conn,"select *from courseyears where id='$result[yrid]'");
                                            $result=mysqli_fetch_assoc($getyear);
                                            echo $result['yrname']; ?>" readonly
                                                class="form-control">

                                                <input type="number" hidden  name="courseyear" value="<?php
                                                $getsemester=mysqli_query($conn,"select *from semester where sem_id='$row[semester]'");
                                                $result=mysqli_fetch_assoc($getsemester); echo $result['yrid']; ?>">
                                            <label for="" class="form-label">Semester</label>
                                            <input type="text"  value="<?php
                                            $getsemester=mysqli_query($conn,"select *from semester where sem_id='$row[semester]'");
                                            $result=mysqli_fetch_assoc($getsemester);
                                             echo $result['name']; ?>" readonly
                                                class="form-control">
                                                <input type="text" hidden  name="semester" value="<?php echo $row['semester']; ?>">
                                              
                                                <label for="" class="form-label">Fee Amount</label>
                                            <input type="text" name="total_fee" value="<?php echo $row['total']; ?>" readonly
                                                class="form-control">
                                                <label for="" class="form-label">Paid</label> <br>
                                            <?php
                                            $check = mysqli_query($conn, "select *from payments where regno='$row[regno]' and semester=$semester");
                                            if(mysqli_num_rows($check)>0){
                                            while($rs=mysqli_fetch_assoc($check)){
                                            ?>
                                            <input type="text" name="invoice" value="<?php echo $rs['amount_paid']; ?>" readonly
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

                                            <center> <input type="submit" name="record" class="btn btn-secondary m-3"
                                                    value="save data"></center>
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
                    <?php
                  }
                
                     ?>
                             
                         </table>
                     </div>
</div>
</div>
<?php } ?>
</body>
</html>