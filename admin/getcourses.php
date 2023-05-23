<?php
include('connection.php');

$department_id = $_POST['department_id'];
$semester_id = $_POST['semester_id'];
$a_id = $_POST['academic_id'];
if($department_id!='')
{
$course_result =mysqli_query($conn,"select distinct course_id, course_name from courses where department=$department_id and status=1");
$option3 = "<option value=''>Select a course</option>";
while($row = mysqli_fetch_assoc($course_result)) {
$option3 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
}
echo $option3;

}
elseif($semester_id!='')
{
$sem_result =mysqli_query($conn,"select * from exam where semester_id=$semester_id ");
$option4 = "<option value=''>Select an exam</option>";
while($row1 = mysqli_fetch_assoc($sem_result)) {
$option4 .= "<option value='".$row1['exam_id']."'>".$row1['exam_name']."</option>";
}
echo $option4;

}
elseif($a_id!='')
{
$academic_result =mysqli_query($conn,"select *from academic_term where sname_id=$a_id");
$options = "<option value=''>Select term</option>";
while($row = mysqli_fetch_assoc($academic_result)) {
$options .= "<option value='".$row['id']."'>".$row['term']."</option>";
}
echo $options;

}

?>