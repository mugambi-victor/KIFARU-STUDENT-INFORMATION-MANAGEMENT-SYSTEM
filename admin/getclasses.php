<?php
include('connection.php');
$session_id = $_POST['session_id'];
if($session_id!='')
{
$class_result =mysqli_query($conn,"select * from semester where yrid=$session_id");
$optionr = "<option value=''>Select sem</option>";
while($row = mysqli_fetch_assoc($class_result)) {
$optionr .= "<option value='".$row['sem_id']."'>".$row['name']."</option>";
}
echo $optionr;

}


?>