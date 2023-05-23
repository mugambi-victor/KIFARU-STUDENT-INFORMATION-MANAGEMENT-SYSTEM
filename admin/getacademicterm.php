<?php
include('../connection.php');
$a_id = $_POST['academic_id'];
if($a_id!='')
{
$academic_result =mysqli_query($conn,"select *from academic_term where sname_id=$a_id");
$options = "<option value=''>Select term</option>";
while($row = mysqli_fetch_assoc($academic_result)) {
$options .= "<option value='".$row['id']."'>".$row['term']."</option>";
}
echo $options;

}


?>