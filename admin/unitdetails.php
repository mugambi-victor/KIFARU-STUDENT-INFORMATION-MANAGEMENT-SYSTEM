<?php
include_once("connection.php");
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
    <title>UnitDetails</title>
    <style>
        a:hover{
            background-color: #8432df;
        }
    </style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

<div class="container m-2" >




<?php
   if(isset($_REQUEST['submit'])){
    $dept=$_REQUEST['department'];
    $getdeptname=mysqli_query($conn,"select *from department where id=$dept");
    if(mysqli_num_rows($getdeptname)>0){
        $rest0=mysqli_fetch_assoc($getdeptname);
        $deptname=$rest0['department_name'];
    }
    else{
        echo "a problem occurred while getting department";
    }

    $course=$_REQUEST['course_name'];
$getcoursename=mysqli_query($conn,"select *from courses where course_id=$course");
if(mysqli_num_rows($getcoursename)>0){
    $rest=mysqli_fetch_assoc($getcoursename);
    $cname=$rest['course_name'];
}
else{
    echo "a problem occurred while getting course";
}

    $year=$_REQUEST['course_year'];

    $getyrname=mysqli_query($conn,"select *from courseyears where id=$year");
    if(mysqli_num_rows($getyrname)>0){
        $rest1=mysqli_fetch_assoc($getyrname);
        $yrname=$rest1['yrname'];
    }
    else{
        echo "a problem occurred while getting year";
    }

    $semester=$_REQUEST['semester'];
    $getsemname=mysqli_query($conn,"select *from semester where sem_id=$semester");
    if(mysqli_num_rows($getsemname)>0){
        $rest2=mysqli_fetch_assoc($getsemname);
        $semname=$rest2['name'];
    }
    else{
        echo "a problem occurred while getting year";
    }

$selectt=mysqli_query($conn,"select * from unit where semester_id=$semester");
if(mysqli_num_rows($selectt)>0){

    ?>
<div class="container mt-3">
    <table class="table table-bordered mt-2 table-striped caption-top">
        <caption ><span class="text-capitalize"><?php echo $deptname ?></span><br> List of Units in: <br><span class="text-capitalize"><?php echo $cname; ?> <br> <?php echo $yrname ?><br> <?php echo $semname ?></span></caption>
        <tr>
            <th>
                <p class="text-uppercase">
                    s/n
                </p>
            </th>
           
            <th>
                <p class="text-capitalize">unit name</p>
            </th>
            <th>
                <p class="text-capitalize">
                    Unit code
                </p>
            </th>
            <th>
                <p class="text-capitalize">
                    current status
                </p>
            </th>
            <th>
                <p class="text-capitalize">
                    activate/deactivate
                </p>
            </th>



            <th>
                <p class="text-capitalize">
                    Delete
                </p>
            </th>

        </tr>
        <?php

           $x=1;
            while($result=mysqli_fetch_assoc($selectt)){
                $id=$result['id'];
                ?>
        <tr>
            <td>
                <?php echo $x++; ?>
            </td>
            
            <td>
                <?php echo $result['unit_name']; ?>
            </td>
            <td>
                <?php echo $result['unit_code']; ?>
            </td>
            <td>
                <?php 
            $status=$result['status'];
            
             if($status==1){?>
                <div class='form-check'>
                    <input type='radio' class='form-check-input' checked disabled> <label class='form-check-label'
                        for='status'>Active</label>
                </div>

                <?php }
              else{
                echo "<input type='radio' class='form-check-input bg-danger' checked disabled ><label class='form-check-label ' for='status'>Inactive</label>";
              }?>
            </td>
            <td>
                <?php 
                    if($status==1){?>
                <form action="deactivateunit.php" method="post">
                  
                    <input type="text" name="uid" value="<?php echo $result['id'] ?>" hidden>
                    
                    <input type="submit" class="btn text-capitalize btn-outline-primary ms-1" name="submit2" value="deactivate">
                </form>
                <?php  
                        
                            }else{
                                ?>
                <form action="deactivateunit.php" method="post">
                    
                    <input type="text" name="uid" value="<?php echo $result['id'] ?>" hidden>

                    <input type="submit" name="submit3" class="btn btn-outline-primary text-capitalize ms-3" value="activate">
                </form>
                <?php  
                            }
                            
                ?>
            </td>
            
            <td>
            <form action="deleteunit.php" method="post">
                        <input type="text" value="<?php echo $result['id'] ?>" name="uid" hidden >
                        <input type="text" name="uname" value="<?php echo $result['unit_name'] ?>" hidden>
                            <input type="submit" name="deleteunits" value="delete unit" class="btn text-capitalize btn-danger"> 
                            </form>      
            </td>
           
        </tr>
        <?php
            
        }}
        else{
            ?>
            <div class="alert alert-info mt-4 alert-dismissible fade show" role="alert"><strong>Sorry,</strong> No units here 
            <a href="classs.php" class="ms-5">click here to add some</a>
                <a href="viewcourses.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></a>
            </div><?php
        }
        }
       
             
            ?>
            
    </table>
    
   
</div>
<script src="jquery.js"></script>
</body>
</html>