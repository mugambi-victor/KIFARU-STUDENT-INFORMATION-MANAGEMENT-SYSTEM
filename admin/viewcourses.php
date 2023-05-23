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
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
     <link rel="shortcut icon" href="ol.png" >
    <title>ViewCourses</title>
    <style>
        a:hover{
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
        <!-- <div class="container col-5  vh-50" style="margin-top:15%;">
            <form action="coursedetails.php" method="post">
                <div class="row">
                    <div class="col-md">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" name="department" id="department-list" required>
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
                    <input type="submit" name="submit" class="btn mt-2 btn-primary">
                </div>
            </form>

        </div> -->
        <table class="table mt-3 table-bordered text-capitalize table-striped">
            <tr>
                <th>
                    S/n
                </th>
                <th>
                    Department Name
                </th>
                <th>
                    No of Courses
                </th>
                <th>
                    View Courses
                </th>
            </tr>
        
        <?php
        $getdepartments=mysqli_query($conn,"select *from department");
        $x=1;
        while($res=mysqli_fetch_assoc($getdepartments)){
            ?>
            <tr>
                <td>
                    <?php echo $x++;?>
                </td>
                <td>
                    <?php echo $res['department_name'];?>
                </td>
                <td>
                    <?php
                      $getcourses=mysqli_query($conn, "select*from courses where department='$res[id]'");
                      $y=mysqli_num_rows($getcourses);
                    echo $y;?>
                </td>
                <td>
                    <form action="coursedetails.php" method="post">
                        <input type="text" value="<?php echo $res['id']; ?>" name="dept" hidden >
                        <input type="submit" name="submit" class="btn btn-primary">
                    </form>
                    <!-- <a href="coursedetails.php?id=<?php 
                    
                    echo $res['id']; ?>"  role="button" class="btn btn-primary">View Courses</a> -->
                </td>
            </tr>
            <?php
        }
        ?>
      </table>
    </div>
</body>

</html>