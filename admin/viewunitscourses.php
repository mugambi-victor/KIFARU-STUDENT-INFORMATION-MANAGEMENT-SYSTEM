<?php
include('connection.php');

$department_id = $_POST['department_id'];
if($department_id!='')
{
$course_result =mysqli_query($conn,"select distinct course_id, course_name from courses where department=$department_id ");
$option3 = "<option value=''>Select a course</option>";
while($row = mysqli_fetch_assoc($course_result)) {
$option3 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
}
echo $option3;

}