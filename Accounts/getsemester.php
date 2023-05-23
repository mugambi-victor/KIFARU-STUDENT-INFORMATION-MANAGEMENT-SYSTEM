<?php
include('../connection.php');
$yr_id = $_POST['yr_id'];
if($yr_id!='')
{
$sem_result =mysqli_query($conn,"select *from semester where yrid=$yr_id ");
$option4 = "<option value=''>Select a semester</option>";
while($row1 = mysqli_fetch_assoc($sem_result)) {
$option4 .= "<option value='".$row1['sem_id']."'>".$row1['name']."</option>";
}
echo $option4;

}
?>