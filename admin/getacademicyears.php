<?php
include('connection.php');
$d_id = $_POST['d_id'];
if($d_id!='')
{
$course_result =mysqli_query($conn,"select distinct course_id, course_name from courses where department=$d_id");
$options = "<option value=''>Select course</option>";
while($row = mysqli_fetch_assoc($course_result)) {
$options .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
}
echo $options;

}


?>