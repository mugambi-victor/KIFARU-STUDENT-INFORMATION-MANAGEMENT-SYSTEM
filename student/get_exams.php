<?php
include('../connection.php');
$session_id = $_POST['session_id'];
// $semester_id=$_POST['semester_id'];
if($session_id!='')
{
$sem_result =mysqli_query($conn,"select *from semester where yrid=$session_id");
$options = "<option value=''>Select semester</option>";
while($row = mysqli_fetch_assoc($sem_result)) {
$options .= "<option value='".$row['sem_id']."'>".$row['name']."</option>";
}
echo $options;

}
elseif($semester_id!='')
{

    $check=mysqli_query($conn, "select * from exam where semester_id=$semester_id");
    if(!$check){
        echo "hi";
    }
    $result=mysqli_fetch_assoc($check);
    $sem_id1=$result['semester_id'];
    echo $result['semester_id'];
$semester_result =mysqli_query($conn,"select *from exam where semester_id=$sem_id1");
$options = "<option value=''>Select exam</option>";
while($row = mysqli_fetch_assoc($semester_result)) {
$options .= "<option value='".$row['exam_id']."'>".$row['exam_name']."</option>";
}
echo $options;

}

?>