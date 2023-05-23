<?php
include('connection.php');
$academic_id = $_POST['academic_id'];

$ed=mysqli_query($conn,"select distinct department_id from exam where session_id=$academic_id");
$options2 = "<option value=''>Select department</option>";
while($res_id=mysqli_fetch_assoc($ed)){
$did=$res_id['department_id'];
$d_result = mysqli_query($conn, "select* from department where id=$did");

        if (mysqli_num_rows($d_result) > 0) {
            // output data of each row
            while ($r = mysqli_fetch_assoc($d_result)) {
                $options2=$options2."<option value= $r[id] >$r[department_name]</option>";
        
            }
             
        }}
       echo $options2;
        ?>