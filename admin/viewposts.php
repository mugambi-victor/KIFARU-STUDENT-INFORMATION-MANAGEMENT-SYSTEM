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
    <title>ViewPosts</title>
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

    <div class="container m-2">
        <div class="container">
            <table class="table table-bordered table-striped text-capitalize">
                <tr>
                    <th>
                        <p>s/n</p>
                    </th>
                    <th>
                        <p>Post title</p>
                    </th>
                    <th>
                        <p>
                           details
                        </p>
                    </th>
                    <th>
                        <p>
                           image
                        </p>
                    </th>
                    <th>
                        <p>
                           view
                        </p>
                    </th>
                    <th>
                        <p>
                           Delete
                        </p>
                    </th>

                </tr>
                
                <?php
                $getdata=mysqli_query($conn, "select* from post");
                $x=1;
                while($result=mysqli_fetch_assoc($getdata)){
                    ?>
                    <tr>
                        <td>
                            <?php  echo $x++; ?>
                        </td>
                        <td>
                          
                            
                            <?php echo $result['title']; ?>
                        </td>
                        <td>
                        <?php echo $result['details']; ?> 
                        </td>
                        <td>
                        <?php echo "<img  class='img-fluid ' style='width: 250px; padding:0;' src='../image/".$result['img']. " ' >"; ?>
                        </td>
                        <td>
                            <a href="postdetails.php">post details</a>
                        </td>
                        <td>
                        <form action="deletepost.php" method="post">
                        <input type="number" value="<?php echo $result['id']; ?>" name="pid" hidden>
                            <input type="submit" name="deleteposts" value="delete post" class="btn btn-danger"> 
                      
                        </td>
                    </tr>
                    </form>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>