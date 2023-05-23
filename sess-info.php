<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .emp_form {
            width: 80%;
            margin: 2% auto;
            height: max-content;



        }

        .emp_form input {
            font-family: Georgia, "Times New Roman", Times, serif;
            background: rgba(255, 255, 255, .1);
            border: none;
            border-radius: 4px;
            font-size: 15px;
            margin: 0;
            outline: 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            background-color: #e8eeef;
            color: #8a97a0;
            -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.03) inset;
            margin-bottom: 30px;
        }

        .form-style-4 {
            width: 80%;
            margin: 2% auto;
            display: flex;


        }

        .sect1 {
            width: 40%;
            margin-right: 100px;
        }

        .sect2 {
            width: 40%;

        }
    </style>
</head>
<body>
    <div class="emp_form">
        <?php
        
        if(isset($_REQUEST['submit'])){
            $class_id=$_REQUEST['class_id'];
            $sname=$_REQUEST['subname'];
            $scode=$_REQUEST['subcode'];
            $sql=mysqli_query($conn, "insert into subject values('$sname','$class_id','$scode')");
            if ($sql) {
                echo "Data inserted successfully";
            } else {
                echo "error inserting data to the database";
            }
        }
        ?>
        <label for="class_id">Class Id</label>
        <input type="number" name="class_id" placeholder="Class_id">
        <label for="subname">subject Name</label>
        <input type="text" name="subname" placeholder="subject Name">
        <label for="subcode">subject code</label>
        <input type="text" name="subcode" placeholder="subject code">
        <button type="submit" name="submit">submit</button>
    </div>

</body>

</html>