<?php
include('../connection.php');

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
    <title>Accounts|Departments</title>
</head>
<body>
<?php

include('header.php');
include('sidebar.php');
?>
<div class="container col-sm">


<?php
$select=mysqli_query($conn,"select *from department");
if(mysqli_num_rows($select)>0){
    ?>
    <table class="table mt-3 text-capitalize table-bordered table-striped caption-top">
        <caption class="text-capitalize">list of Departments</caption>
        <tr>
            <th>
                s/N
            </th>
            <th>
                Department name
            </th>
            <th>
                See courses
            </th>
        </tr>
  
    <?php
    $x=1;
while($result=mysqli_fetch_assoc($select)){
?>
<tr>
    <td>
        <?php echo $x++; ?>
    </td>
    <td>
        <?php echo $result['department_name']; ?>
    </td>
    <td>
      <a href="setfees.php?id=<?php echo $result['id']; ?>" class="btn btn-primary">Courses</a>
    </td>
</tr>



<?php
}}
?> 
 </table>
</div>
</div>
</body>
</html>