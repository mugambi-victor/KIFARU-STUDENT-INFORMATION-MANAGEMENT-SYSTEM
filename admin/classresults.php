<?php
include('connection.php');
session_start ();
if(!isset($_SESSION["account_login"]))

	header("location:admin_login.php"); 
$session_result = mysqli_query($conn, 'select * from academic_year ORDER BY id DESC');

$student_year = "";
$student_classname = "";
$sstudent_name = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="vee.css">
    <link rel="stylesheet" type="text/css" href="foots.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/new.png" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="s_dashboard.php"><i class='far fa-times-circle' style='font-size:48px;color:inherit'></i></a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav> 
    <div class="container">
        
        <div class="col-sm-6 ">
        <form action="" method="post">
            <select  class="form-select" name="session" id="session-list">
            <option value="">Select academic year</option>
            <?php
            if (mysqli_num_rows($session_result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($session_result)) {
            ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['sname']; ?></option>
            <?php
                }
            }
            ?>
        </select>
  
  <div class="col">
  <select class="form-select" name="classs" id="class-list">
            <option value=''>Select class</option>
        </select>
  </div>
  <div class="col">
      
  <select class="form-select  form-select-sm" name="exam" id="exam-list">
            <option value=''>Select Exam</option>
        </select>
  </div>
  
  <center><input type="submit" class="btn btn-primary" name="submit" value="Enter"></center>
  </form>
        </div>
    
    </div>
    
        <?php
        if(isset($_REQUEST['submit'])){
            $session=$_REQUEST['session'];
            $class=$_REQUEST['classs'];
            $exam=$_REQUEST['exam'];
            $sql=mysqli_query($conn,"select *from finalmarks where exam_id='$exam'");
            while($result=mysqli_fetch_assoc($sql)){
            $mark=$result["marks"];
            $name=$result['s_name'];
            $subject=$result['subject_name'];
            }?>
<table>
            <tr>
                <th>
                    student name
                </th>
                
                    <?php
                    $query=mysqli_query($conn,"select *from subject where class='$class'");
                    while($res=mysqli_fetch_assoc($query)){

                    $s=$res['subject_name'];
                    ?>
                <th><?php echo $res['subject_name'] ?></th>
                
            </tr>
            <tr>
                <td><?php echo $name; ?></td>
                <?php
                    $query=mysqli_query($conn,"select * from finalmarks where subject_name='$s'");
                    if ($query) {
                       
                        $i = 0;
                        foreach ($query as $row) { ?>
                            

                              <td><?php echo $row['subject_name'] . "<br>"; ?></td>
                                
                                 
        

                <?php }
                        $i++;
                    }?>
                    <?php
                    while($res=mysqli_fetch_assoc($query)){

                    
                    ?>
                <td><?php echo $res['marks']; ?></td>
                <?php }} ?>
            </tr>
<?php
            
            
        }
        ?>
</body>
<script src="jquery.js"></script>
<script>
    $('#session-list').on('change', function() {
        var session_id = this.value;
        $.ajax({
            type: "POST",
            url: "get_classes.php",
            data: 'session_id=' + session_id,
            success: function(result) {
                $("#class-list").html(result);
            }
        });
    });
    $('#class-list').on('change', function() {
        var class_id = this.value;
        $.ajax({
            type: "POST",
            url: "get_classes.php",
            data: 'class_id=' + class_id,
            success: function(result) {
                $("#exam-list").html(result);
            }
        });
    });

   

    //     function submitAdd(){
    // document.frmAddAssessment.btnSubmit.value=”Add”;
    // document.frmAddAssessment.submit();
    // }

    // var k = "The respective values are :";
    //     function Geeks() {
    //         var input = document.getElementsByName('marks[]');

    //         for (var i = 0; i < input.length; i++) {
    //             var a = input[i];
    //             k = k + "marks[" + i + "].value= "
    //                                + a.value ;
    //         }

    //     document.getElementById("par").innerHTML = k;
    //     document.getElementById("po").innerHTML = "Output";
    // }

    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
</script>
</html>