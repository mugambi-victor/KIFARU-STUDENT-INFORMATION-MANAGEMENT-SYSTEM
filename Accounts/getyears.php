<?php
include('../connection.php');
$course_id = $_POST['course_id'];
$year_id=$_POST['year_id'];
$session_id = $_POST['session_id'];
if($session_id!='')
{
$class_result =mysqli_query($conn,"select * from semester where yrid=$session_id");
$optionrs = "<option value=''>Select sem</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$optionrs .= "<option value='".$row['sem_id']."'>".$row['name']."</option>";
}
echo $optionrs;

}
elseif($course_id!='')
{
$course_result =mysqli_query($conn,"select distinct id, course_id,yrname from courseyears where course_id=$course_id");
$options = "<option value=''>Select year</option>";
while($row = mysqli_fetch_assoc($course_result)) {
$options .= "<option value='".$row['id']."'>".$row['yrname']."</option>";
}
echo $options;

}
elseif($year_id!=''){
    $se=mysqli_query($conn,"select*from courseyears where id=$year_id");
    $res=mysqli_fetch_assoc($se);
    $ccid=$res['course_id'];
    $y_result =mysqli_query($conn,"select distinct sem_id,name,yrid,course_id from semester where yrid=$year_id and course_id=$ccid");
    $option4 = "<option value=''>Select semester</option>";
    while($row = mysqli_fetch_assoc($y_result)) {
    $option4 .= "<option value='".$row['sem_id']."'>".$row['name']."</option>";
    }
    echo $option4;
}


?>