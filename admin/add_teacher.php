<?php include('connection.php');

session_start();
if (!isset($_SESSION["email"]))

    header("location:admin_login.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="vee.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        .emp_form {
            width: 80%;
            margin: 2% auto;
          
            height: max-content;
            border-radius: 20px;
        }

        .emp_form input {
            width: 100%;
            padding: 20px 5px;
            margin: 5px 0;
            border: 0;
            border-bottom: 1px solid #999;
            outline: none;
            background: transparent;
            
        }

        .emp_form form {
            width: 80%;
            margin: 2% auto;
            top: 80px;
           
        }
        .mb-3{
            padding-left:20px;
            padding-right:20px;
        }
        button{
            margin-bottom:30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="#default" class="logo">Myschool</a>
        <div class="header-right">
            <a class="active" href="admin_dashboard.php">Home</a>
            <div class="subnav">
                <button class="subnavbtn">Profile <i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                    <a href="#link1">View Profile</a>
                    <a href="#link2">Logout</a>

                </div>
            </div>

        </div>
    </div>
        <?php
        if (isset($_REQUEST['t_login'])) {
            $uname = $_REQUEST['t_name'];
            $uemail = $_REQUEST['t_email'];
            $upass = $_REQUEST['t_pass'];
            $check= "SELECT * FROM teacher WHERE email='$uemail'";
            $rs = mysqli_query($conn, $check);
            if (mysqli_num_rows($rs) > 0) {
                echo "Sorry... email already taken"; 	}
                 else {
                $res = mysqli_query($conn, "insert into teacher values('0','$uname','$uemail','$upass' )");
                if($res){
                    echo"Data inserted successfully";
                }
                else{
                    echo"error inserting data to the database";
                }
            }
           
          
        } ?>
    
    <div class="container" style="border:0; margin-top:40px;">
        <form class="needs-validation" style=" margin:auto;  width:40%; border:1px solid;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
          <center> 
        <h2>Register a Teacher </h2><hr></center>
        <div class="mb-3">
        <label class="form-label" for="t_name">Teacher's Name</label>
        <input type="text" class="form-control" name='t_name' id="t_name" placeholder="Teacher's name..." required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="t_email">Email</label>
        <input type="email" class="form-control" name='t_email' id="t_email" placeholder="Teacher's Email" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="t_pass">Password</label>
        <input type="password" class="form-control" name="t_pass" id="t_pass" placeholder="Password" required>
    </div>
   <center> <button type="submit" name="t_login" class="btn btn-primary">Submit</button></center>
</form></div>
</body>

</html>