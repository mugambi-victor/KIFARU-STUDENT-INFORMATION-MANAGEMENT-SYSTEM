<?php
include('../connection.php');
$session_id = $_POST['session_id'];
$semester_id=$_POST['semester_id'];
$student_id = $_POST['student_id'];
if($session_id!='')
{
$exam_result =mysqli_query($conn,"select * from semester where session_id=$session_id");
$options = "<option value=''>Select semester</option>";
while($row = mysqli_fetch_assoc($exam_result)) {
$options .= "<option value='".$row['sem_id']."'>".$row['name']."</option>";
}
echo $options;

}
elseif($semester_id!='')
{
    $check=mysqli_query($conn, "select distinct exam_id, exam_name, year, semester from  exam where semester=$semester_id");
    if(!$check){
        echo "hi";
    }
    $result=mysqli_fetch_assoc($check);
    $class_id1=$result['semester'];
    echo $result['semester'];
$sem_result =mysqli_query($conn,"select distinct exam_id, exam_name, year, semester from exam where semester=$class_id1");
$options = "<option value=''>Select exam</option>";
while($row = mysqli_fetch_assoc($sem_result)) {
$options .= "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
}
echo $options;

}



?>