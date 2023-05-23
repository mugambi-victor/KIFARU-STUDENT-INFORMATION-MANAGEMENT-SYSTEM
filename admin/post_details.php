<?php include('connection.php');


$post_id= $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vee.css">
    <link rel="stylesheet" href="foots.css">
    <title>Document</title>
</head>
<style>
.main-con{
    margin:4% ;
     
}
.main-con h1{
    margin-left:45%;
}
.main-con p{
  padding:5px;
  text-align: center;
  line-height: 30px;
}
.ppp{
    background-color: red;
}
.pp p {
    width: 100%;
    height: 100px;
    position: relative;
    -webkit-animation-name: example; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 10s; /* Chrome, Safari, Opera */
    -webkit-animation-iteration-count: 3; /* Chrome, Safari, Opera */
    animation-name: example;
    animation-duration: 10s;
    animation-iteration-count: 3;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes example {
    0%   {background-color:red; left:0px; top:0px;}
    25%  {background-color:red; right:200px; top:0px;}
    50%  {background-color:red; left:200px; top:0px;}
    75%  {background-color:red; left:200px; top:0px;}
    100% {background-color:red; left:0px; top:0px;}
}

/* Standard syntax */
@keyframes example {
    0%   {background-color:red; left:0px; top:0px;}
    25%  {background-color:red;right:200px; top:0px;}
    50%  {background-color:red;left:200px;top:0px;}
    75%  {background-color:red; left: 200px;px; top:0px;}
    100% {background-color:red; left:0px;  top:0px;}
}

</style>

<body>
<div class="header">
        <a href="#default" class="logo">Myschool</a>
        <div class="header-right">
            <a class="active" href="admin_login.php">Admin login</a>
            <a href="student/s_login.php">Student Login</a>
            <a href="teacher/t_login.php">Employee Login</a>
        </div>
        </div>
<div class="slider">
    <div class="ppp"><div class="pp"> <p>the quick brown fox jumped over the lazy dog.</p></div></div>
    
   
</div>

        <div class="col-10 main-con">
            <?php
            $sql=mysqli_query($conn, "select *from post where id=$post_id");
            while($res=mysqli_fetch_assoc($sql)){?>
               <h1><?php echo $res['title']; ?></h1>
                <p ><?php echo $res['details']; ?></p>
          <?php  } 
             ?>
        </div>
        <div class="col-12 footerr" style=""><?php include("footer.php") ?></div>

</body>
</html>