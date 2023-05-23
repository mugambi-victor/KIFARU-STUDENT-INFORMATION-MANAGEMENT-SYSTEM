<?php
include('../connection.php');
session_start();
$t = $_SESSION["emp_login"];
if (!isset($_SESSION["emp_login"]))

    header("location:t_login.php");
$session_result = mysqli_query($conn, 'select * from academic_year');
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
     <link rel="shortcut icon" href="ol.png" >
    <title>Document</title>
</head>
<body>
    <?php
    $sql = mysqli_query($conn, "select *from final where class_id= $student_classname and student_id=$sstudent_name");
         while ($res=mysqli_fetch_assoc($sql)) { ?>
          <form id="subjectss" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
                                            ?>" method="post">
                <input type="text" hidden value="<?php echo $sstudent_name; ?>" name="student">
                <input type="text" hidden value="<?php echo $student_classname; ?>" name="s_class">
                <input type="number" hidden value="<?php echo $exam; ?>" name="exam">

               <input type="text" hidden value="<?php echo $res['subject_id']; ?>" name="sub_id[]">

                <table style="border:0; width:700px;">
                  <tr>
                       <td style="background-color: whitesmoke; border:0;"> <input type="text" value="<?php echo $res['subject_name']; ?>" name="subname[]" id="subject_name" readonly></td>
              <td style="background-color: whitesmoke; border:0;"> <input type="text" name="marks[]" id="marks" placeholder="Enter Mark Here"></td>
                   </tr>
                </table>
            <?php
        }
            ?>
            <input type="submit" name="submit2" id="sub_btn" value="submit">
            </form>

      
        <?php
        if (isset($_REQUEST["submit2"])) {

            $i = 0;
            $sum = 0;
            foreach ($_POST['marks'] as $textbox) {
                $student = $_POST['student'];
                $s_class = $_POST['s_class'];
                $mark = $textbox;
                $subject = $_POST['sub_id'][$i];
                $exam_id=$_POST['exam'];
               
                $sum = $sum + $textbox;
                $check=mysqli_query($conn,"select * from marks where subject_id=$subject  and student_id=$student and exam=$exam_id");
                $ans=mysqli_fetch_assoc($check);
                if($ans){
                    echo'<script> alert("sorry results for this student have already been added")</script>';
                }
                else{
                    $crud = mysqli_query($conn, "insert into marks values('0',$student,$subject,$exam_id,$mark)");
                    if (!$crud) {
                        echo $mark . $subject;
                        echo $student;
                    }
                    else {
                        echo'<script>alert("data inserted")</script>';
                        # code...
                        $results = mysqli_query($conn, "insert into results values('',$exam_id,$s_class,$student,$sum)");
                        if (!$results) {
                            echo $sum;
                        }
                    }
                    $i++;
                }
               
            }
            
        }
        ?> 
</body>
</html>