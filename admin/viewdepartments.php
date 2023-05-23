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
    
     <link rel="shortcut icon" href="ol.png" >
    <title>ViewDepartments</title>
    <style>
        a:hover{
            background-color: #8432DF;
        }
    </style>
</head>
<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>

    <div class="container mt-4 m-1">
        <?php
        $getdepartments=mysqli_query($conn,"select *from department");
        if(mysqli_num_rows($getdepartments)<1){
echo "sorry, there are no departments yet";
        }else{?>
        <table class="table table-bordered table-striped caption-top" >
            <caption>List of Departments</caption>
            <tr class="text-capitalize">
                <th>
                   S/N 
                </th>
                <th>
                    Department Name
                </th>
                <th>
                    No. of Courses
                </th>
            </tr>

            <?php
            $x=1;
            while($rest=mysqli_fetch_assoc($getdepartments)){
                $department_name=$rest['department_name'];
                $id=$rest['id'];
                ?>
                <tr>
                    <td>
                        <?php echo $x++; ?>
                    </td>
                    <td>
                        <?php echo $department_name; ?>
                    </td>
                    <td>
                        <?php 
                        $getcourses=mysqli_query($conn, "select*from courses where department=$id");
                        $y=mysqli_num_rows($getcourses);
                        
                        echo $y; ?>
                    </td>
                </tr>
                
                
                <?php
            }
            ?>

        </table>


        <?php
        }
        ?>
    </div>
    <script src="jquery.js"></script>
</body>
</html>