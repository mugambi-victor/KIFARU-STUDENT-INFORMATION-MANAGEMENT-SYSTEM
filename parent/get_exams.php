<?php
include('../connection.php');
$session_id = $_POST['session_id'];
$exam_id=$_POST['exam_id'];
if($session_id!='')
{
$class_result =mysqli_query($conn,"select *from exam where year='$session_id'");
$options = "<option value=''>Select class</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$options .= "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
}
echo $options;

}
elseif($exam_id!='')
{
    $check=mysqli_query($conn, "select * from exam where exam_id='$exam_id'");
    if(!$check){
        echo "hi";
    }
    $result=mysqli_fetch_assoc($check);
    $class_id1=$result['class'];
    echo $result['class'];
$class_result =mysqli_query($conn,"select *from class where class_id='$class_id1'");
$options = "<option value=''>Select class</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$options .= "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
}
echo $options;

}

?>