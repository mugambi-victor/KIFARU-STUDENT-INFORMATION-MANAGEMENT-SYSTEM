<?php include ('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet/css" href="vee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Document</title>
    <style>
    .tablee {
        width: 80%;
        margin: 2% auto;
        height: max-content;


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

    .subPopup {
        position: relative;
        text-align: center;
        width: 100%;
    }

    .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
    }

    .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
    }

    .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
    }

    .formContainer .cancel {
        background-color: #cc0000;
    }

    .formContainer .btn:hover,
    .openButton:hover {
        opacity: 1;
    }

    .openBtn {
        display: flex;
        justify-content: left;
    }

    .openButton {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 5px 10px;
        cursor: pointer;

    }

    .formContainer input[type=text],
    .formContainer input[type=number] {
        width: 80%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
    }

    .formContainer input[type=text]:focus,
    .formContainer input[type=number]:focus {
        background-color: #ddd;
        outline: none;
    }

    /*class popup*/
    .classPopup {
        position: relative;
        text-align: center;
        width: 100%;
    }

    .cformPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
    }

    .cformContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
    }

    .cformContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
    }

    .cformContainer .cancel {
        background-color: #cc0000;
    }

    .cformContainer .btn:hover,
    .openButton:hover {
        opacity: 1;
    }

    .cformContainer input[type=text],
    .cformContainer input[type=number] {
        width: 80%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
    }

    .cformContainer input[type=text]:focus,
    .cformContainer input[type=number]:focus {
        background-color: #ddd;
        outline: none;
    }



    .tablee table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 80%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;

    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .dropbtn {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: inherit;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: grey;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: grey;
    }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/mylogo.png" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin_dashboard.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav> 
   

    <?php

    if (isset($_REQUEST['create_class'])) {
         $classname = $_REQUEST['cname'];
       $a_year=$_REQUEST['academic_year'];
       $sql1=mysqli_query($conn, "select *from class where session_id=$a_year");
       $check=mysqli_num_rows($sql1);
       if($check<4){
         
        $res = mysqli_query($conn, "insert into class values('0','$classname' ,'$a_year')");
        if ($res) {
            echo "Data inserted successfully";
        } else {
            echo "error inserting data to the database";
        }
       }
       else{
        echo'<script> alert("sorry you can only have 4 classes in a Year"); </script>';
       }
      
    }

    ?>
    <?php
    if (isset($_REQUEST['submit'])) {
        $subname = $_REQUEST['subname'];
        $class = $_REQUEST['class'];
        $subcode = $_REQUEST['subcode'];
        $sql=mysqli_query($conn, "select *from subjects where class_id=$class and subject_name='$subname'");
       $check=mysqli_num_rows($sql);
            if($check>0){
               echo "subject already added";
            }else{
                $res1 = mysqli_query($conn, "insert into subject values('0','$subname','$class','$subcode' )");
                  if($res1){
                      echo"data inserted successfully";
                  }else{
                      echo"sorry";
                  }
                }
    }
         
        
    
    ?>

    <div class="tablee">
        <table id="all_classes">
            <tr>
                <th>
                    <div class="openBtn">
                        <button class="openButton" type="button" onclick="openForm()"><strong>Add
                                Class</strong></button>
                    </div>
                </th>

                <th>
                    <div class="openBtn">
                        <button class="openButton" type="button" onclick="openForm1()"><strong>Add
                                subject</strong></button>
                    </div>
                </th>
            </tr>

            <tr>
                <th style="color: blue; background-color:white;">Class</th>
                <th style="color: blue;  background-color:white;">subjects</th>

            </tr><?php
            $sql2=mysqli_query($conn,"SELECT class_id,class_name, GROUP_CONCAT(subject_name) AS subject_name FROM class_subjects GROUP BY class_id; ");
            foreach ($sql2 as $row) {
                echo '<tr>';
                    echo '<td>' . $row['class_name'] . '</td>';
                    echo '<td>' . $row['subject_name'] . '</td>';
            
            
                echo '</tr>';
            }
            
?>

        </table>
    </div>
    <!-- form for creating class !-->
    <div class="subPopup">
        <div class="formPopup" id="popupForm">
            <form action="" method="post" class="formContainer">
                <label for="cname">Class Name</label>
                <input type="text" name="cname" placeholder="Class Name" required> <br>
                <label for="academic_year">Session </label> <br> <br>
                <?php
                $options1 = "";
                $selectQ= mysqli_query($conn, "SELECT *FROM academic_year");
                while ($row3 = mysqli_fetch_array($selectQ)) {
                    $options1 = $options1. "<option value=$row3[id]>$row3[sname]</option>";
                }?>
                <select name="academic_year" id="academic_year">
                    <?php echo $options1; ?>
                </select> <br> <br>
                <button type="submit" class="btn-box" name="create_class">submit</button>
                <button type="button" class="btn-box" onclick="closeForm()">Close</button>
            </form>
        </div>
    </div>

    <!-- form for creating subject !-->
    <div class="classPopup">
        <div class="cformPopup" id="cForm">
            <form action="" class="cformContainer">
                <label for="class_id">Class Name</label> <br> <br>
                <?php
                $options = "";
                $selectQuery = mysqli_query($conn, "SELECT *FROM class");
                while ($row2 = mysqli_fetch_array($selectQuery)) {
                    $options = $options . "<option value=$row2[class_id]>$row2[class_name]</option>";
                }?>
                <select name="class" id="class">
                    <?php echo $options; ?>
                </select> <br> <br>
                <label for="subname">subject Name</label>
                <input type="text" name="subname" placeholder="subject Name">
                <label for="subcode">subject code</label>
                <input type="text" name="subcode" placeholder="subject code">
                <button type="submit" class="btn-box" name="submit">submit</button>
                <button type="button" class="btn-box" onclick="closeForm1()">Close</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }

    function openForm1() {
        document.getElementById("cForm").style.display = "block";
    }

    function closeForm1() {
        document.getElementById("cForm").style.display = "none";
    }

    function myfuncc() {
        document.getElementById("all_classes").style.display = "none";
    }
    </script>
</body>

</html>