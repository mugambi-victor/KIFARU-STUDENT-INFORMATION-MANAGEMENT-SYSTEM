<?php include('../connection.php');
session_start();
$a = $_SESSION['accounts_email'];
if (!isset($a)) {
    header('location:accounts_login.php');

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <title>AccountsDashboard</title>
    <style>
.container{
    background-color: whitesmoke;
}
    </style>
</head>

<body>

    <?php

    include('header1.php');

    include('sidebar.php');
    ?>
    <div class="container col-sm " >
        <div class="row">

            <div class="ms-1  col-sm">

                <p class="display-6"><i class="bi-house-fill"></i>AccountsDashboard</p>
                <div class="row mt-4">
                    <div class="col-md col-sm students">
                        <?php
                        $query = mysqli_query($conn, "select *from student");
                        $result = mysqli_num_rows($query);

                        ?>
                        <div class="m-1 row d-flex text-center p-0 bg-secondary">
                            <div class="col-sm p">
                                <p class="text fw-bold display-3">
                                    <?php echo $result; ?>
                                </p>
                                <p>Students</p>

                            </div>
                            <div class=" col-sm a">
                                <img src="../image/student-icon1.jpg" class="card-img" alt="...">
                            </div>




                        </div>
                    </div>

                    <div class="col-sm col-md studen1">

                        <?php
                        $query1 = mysqli_query($conn, "select *from department");
                        $result1 = mysqli_num_rows($query1);

                        ?>
                        <div class=" m-1 row d-flex text-center p-0 bg-primary">
                            <div class="col-sm col-md p">
                                <p class="text fw-bold display-3">
                                    <?php echo $result1; ?>
                                </p>
                                <p>Departments</p>

                            </div>
                            <div class=" col-sm col-md a">
                                <img src="../image/department.png" class="card-img" alt="...">
                            </div>




                        </div>
                    </div>
                    <div class="col-sm col-md ">
                        <?php
                        $query = mysqli_query($conn, "select *from courses");
                        $result = mysqli_num_rows($query);

                        ?>



                        <div class="m-1 row d-flex text-center p-0 bg-secondary">
                            <div class="col-sm p">
                                <p class="text fw-bold display-3">
                                    <?php echo $result; ?>
                                </p>
                                <p>Courses</p>

                            </div>
                            <div class=" col-sm a">
                                <img src="../image/course.png" class="card-img pt-3" alt="...">
                            </div>




                        </div>

                    </div>




                </div>

            </div>
        </div>

    <?php 
    //invoices
    $getstudents=mysqli_query($conn,"select max(term) as t from student");
    $sum=0;
    while( $m=mysqli_fetch_assoc($getstudents)){
        $mterm1= $m['t'];
        if($mterm1>0){
        $getstudents4=mysqli_query($conn,"select * from student where term=$mterm1");
       while($m4=mysqli_fetch_assoc($getstudents4)){
      $sum=$sum+$m4['total'];
       }

      
    }
   
    //payments

    $getstudents2=mysqli_query($conn,"select max(term) as c from payments");
    $sum1=0;
    
    while( $m2=mysqli_fetch_assoc($getstudents2)){
        $mterm2= $m2['c'];
        if($mterm2>0){
        $getstudents3=mysqli_query($conn,"select * from payments where term=$mterm2");
       
        
        while($m3=mysqli_fetch_assoc($getstudents3)){
      $sum1=$sum1+$m3['amount_paid'];
        }}
    
    
   //etting term name and academic year name
    $getterm=mysqli_query($conn,"select *from academic_term where id=$mterm1");
    $x=mysqli_fetch_assoc($getterm);
   $currentterm= $x['term'];
    $yr=$x['sname_id'];
    $getyr=mysqli_query($conn,"select *from academic_year where id=$yr");
    $y=mysqli_fetch_assoc($getyr);
    $currentyr= $y['sname'];
    ?>
</p>
<div class="row">
    <div class="col-md-6">
    <canvas id="myChart" style="width:100%;"></canvas>

<script>
    var xValues = ["Invoices", "Payments"];
    var yValues = ['<?php echo $sum ?>', '<?php echo $sum1 ?>', 5000];
    var barColors = ["red", "green", "blue"];

    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "Invoices vs Payments summary for <?php echo $currentyr ?> ( <?php echo $currentterm ?>  )"
            }
        }
    });
</script>
<?php }} ?>
    </div>
</div>

    </div>
  

    </div>

</body>

</html>