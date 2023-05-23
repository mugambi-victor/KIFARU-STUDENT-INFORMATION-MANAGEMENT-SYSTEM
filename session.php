<?php include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="st.css">
    <title>Document</title>
    <style>
        .searchtable{
            margin:150px, 150px;
    
        }
           .form_search{
            margin-top:20px;
        }
        .form_search input{
            padding:10px;
            width:300px;
        }
        
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            
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
    </style>
</head>
<body>
    <div class="searchtable">
    <?php include ('header.php')?>
    <form action="" method="post" class="form_search">
   <input type="text" name="search" placeholder="view classes by academic year e.g 2020/2021"> <button type="submit" name="searchbtn" class="btn-box" style="width:50px; border-radius:0;">Search</button>
    </form>
    <table>
        <tr>
            <th>Class</th>
            <th>Subject</th>
        </tr>

    <?php
    if (isset($_REQUEST['searchbtn'])) {
        $searchname=$_REQUEST['search'];
        $sql2=mysqli_query($conn,"SELECT class_id,class_name, GROUP_CONCAT(subject_name) AS subject_name FROM victor3 where session_name='$searchname'GROUP BY class_id; ");
        foreach ($sql2 as $row) {
            echo '<tr>';
                echo '<td>' . $row['class_name'] . '</td>';
                echo '<td>' . $row['subject_name'] . '</td>';
        
        
            echo '</tr>';
        }
      }
?>
</table>
    </div>
    
</body>
</html>