<?php
include('connection.php');
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
    <title>CreateDepartment</title>
    <style>
        a:hover{
            background-color: slateblue;
        }
        
    </style>
</head>
<body>
<?php 

include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

    <div class="container mt-5 m-1" style="border:0;">
        <div class="row">
        <?php
if(isset($_REQUEST['year'])){
    $yr=$_REQUEST['yname'];
    $t1=$_REQUEST['t1'];
    $t2=$_REQUEST['t2'];
    $t4=$_REQUEST['t4'];

    $acadchecker=mysqli_query($conn,"select *from academic_year where sname='$yr'");
    if(mysqli_num_rows($acadchecker)>0){
        echo("<div class='alert alert-warning  alert-dismissible fade show'>
            <strong>Sorry!!</strong> Academic year already created
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>  ") .mysqli_connect_error(); 
    }else{
        $acad=mysqli_query($conn,"insert into academic_year values(0,'$yr')");
        if($acad){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Academic year created successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
            <?php
         
            $acadc=mysqli_query($conn,"select *from academic_year where sname='$yr'");
            $xx=mysqli_fetch_assoc($acadc);
            $xid=$xx['id'];
            $insertterm=mysqli_query($conn,"insert into academic_term values(0,'$t1',$xid)");
            $insertterm2=mysqli_query($conn,"insert into academic_term values(0,'$t2',$xid)");
            $insertterm3=mysqli_query($conn,"insert into academic_term values(0,'$t4',$xid)");
            if($insertterm&&$insertterm2&&$insertterm3){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!!</strong> Academic terms  created successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
                <?php
                
            }
            else{
                ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error!!</strong>problem creating academic year terms.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
            <?php
               
            }
        }
        else{
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry!!</strong>a problem occured when creating academic year
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
            <?php
          
        }
    }
    


}
if(isset($_REQUEST['department'])){
    $dpt=$_REQUEST['departmentname'];
    $checkdept=mysqli_query($conn,"select *from department where department_name='$dpt'");
    if(mysqli_num_rows($checkdept)>0){
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Sorry!!</strong> That department already exists!
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

        <?php
       
    }
    else{
        $deptinsert=mysqli_query($conn, "insert into department values(0,'$dpt')");
        if($deptinsert){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> Department created successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

            <?php
           
        }
        else{
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sorry!!</strong> An error occurred when inserting department
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

            <?php
           
        }
    }
}

?>
            <div class="col-md">
                <!-- creating academic year -->
                <form class="border p-3 border-3" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    
      
                    <h3>Create Academic Year</h3>
                    </center>

                    <div class="mb-3">
                        <label for="academic_year" class="form-label">Academic Year </label> <br>
                        <input type="text" name="yname" class="form-control text-capitalize" placeholder="Year Name eg '2020/2021' "
                            required>
                    </div>
                    <div class="hidden" hidden>
                        <div class="mb-3">
                            <label for="t1">Term 1</label> <br>
                            <input type="text" name="t1" class="form-control" value="January-March" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="t2">Term 2</label> <br>
                            <input type="text" name="t2" class="form-control text-capitalize" value="April-August" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="t4">Term 3</label> <br>
                            <input type="text" name="t4" class="form-control text-capitalize" value="September-December" readonly>
                        </div>
                    </div>

                    <center> <button type="submit" name="year" class="btn btn-primary">Submit</button></center>


                </form>
            </div>
            <div class="col-md">

                <form action="" class="border p-3 border-3 ">
                    <h3 class="text-capitalize">create department</h3>
                    <div class="div">
                        <label for="" class="form-label">Department Name</label>
                        <input type="text" placeholder="enter department name" name="departmentname" class="form-control text-capitalize">
                    </div>
                    <input type="submit"  class="btn mt-3 btn-primary" name="department">
                    <!-- <center><button type="submit" name="department" class="btn mt-3 btn-primary" >create
                            department</button></center> -->
                </form>
            </div>
        </div>
       
        <!-- end of academic year section -->
</body>
</html>