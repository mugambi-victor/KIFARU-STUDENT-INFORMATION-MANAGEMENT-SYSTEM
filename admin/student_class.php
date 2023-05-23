<?php
include('connection.php');
$session_id=$_POST['session_id'];
echo $session_id;
if($session_id!='')
{
$exam_result =mysqli_query($conn,"select *from class where session_id='$session_id'");
$options = "<option value=''>Select class</option>";
while($row = mysqli_fetch_assoc($exam_result)) {
$options .= "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
}
echo $options;

}



?>