<?php
include('../connection.php');
session_start();
$s = $_SESSION["s_login"];
if (!isset($_SESSION["s_login"])) {
    header("location:s_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../admin/ol.png" >
    <title>ExamCard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</head>

<body>
<?php
$getdata = mysqli_query($conn, "select *from student where regno='$s'");
$res = mysqli_fetch_assoc($getdata);
$sem=$res['semester'];
$getsem=mysqli_query($conn, "select *from semester where sem_id=$sem");
$rs=mysqli_fetch_assoc($getsem);
$total=$rs['total_fees'];

$getpayments=mysqli_query($conn,"select *from payments where regno ='$s' and semester=$sem");
$sum=0;
while($p=mysqli_fetch_assoc($getpayments)){
$sum=$sum+$p['amount_paid'];
}



$waver=0.9*$total;
if($sum>=$waver||$res['total']<=0)
{



$id = $res['id'];
$getunits = mysqli_query($conn, "select *from unitandstudent where student_id=$id and semester_id='$res[semester]'");

?>

    <div class="container col-sm shadow-lg p-3 mb-5 bg-body rounded" style="margin-top:5%;">
        <div class="row d-flex">
            <div class="col-sm mt-5">
                <div class="row">
                    <div class="col-sm">
                        <p class="lead text-capitalize fw-bold"> Name: <?php echo $res['s_name']; ?></p>
                        <p class="lead text-capitalize fw-bold">Registration Number: <?php echo $res['regno']; ?></p>
                        <p class="lead text-capitalize fw-bold"> Year: <?php
                         $sem=$res['semester'];
                         $getsem=mysqli_query($conn,"select *from semester where sem_id=$sem");
                         $resp=mysqli_fetch_assoc($getsem);
                        $yr=$resp['yrid'];
                        $getyr=mysqli_query($conn,"select *from courseyears where id=$yr");
                        $resp=mysqli_fetch_assoc($getyr);
                        echo $resp['yrname'];
                         ?></p>
                    </div>
             
                <div class="col-sm justify-content-center">
                    <p class="lead text-capitalize fw-bold">Semester: <?php
                        $sem=$res['semester'];
                        $getsem=mysqli_query($conn,"select *from semester where sem_id=$sem");
                        $resp=mysqli_fetch_assoc($getsem);
                        echo $resp['name'];
                         ?></p>
                    <p class="lead text-capitalize fw-bold">Exam: <?php
                     $course=$res['course_id'];
                     $term=$res['term'];
                        $getexam=mysqli_query($conn,"select *from exam where course_id=$course and semester_id=$sem and academic_term=$term");
                        $resp=mysqli_fetch_assoc($getexam);
                        echo $resp['exam_name'];
                         ?></p>
                </div> 
              </div>


                <table class="table table-striped table-bordered text-capitalize caption-top">
                    <caption>Units</caption>
                    <tr>
                        <th>
                            s/n
                        </th>
                        <th>
                            unit
                        </th>
                        <th>
                            unit code
                        </th>
                        <th>
                            sign
                        </th>
                    </tr>
                    <?php
                    $x = 1;
                    while ($rest = mysqli_fetch_assoc($getunits)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $x++; ?>
                            </td>
                            <td>
                                <?php 
                                    $uid = $rest['unit_id'];

                                $getunit = mysqli_query($conn, "select *from unit where id=$uid");
                                $res1 = mysqli_fetch_assoc($getunit);
                                echo $res1['unit_name']; ?>
                            </td>
                            <td>
                                <?php
                                $getunit = mysqli_query($conn, "select *from unit where id=$uid");
                                $res1 = mysqli_fetch_assoc($getunit);
                                echo $res1['unit_code']; ?>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
<a href="" onclick="f()" id="bytn" class="btn btn-primary">Download</a>
            </div>
  <center><button type="button" id="back" name="back" class="btn mt-4 p-2 btn-danger"><a href="s_dashboard.php" class="text-white"><i class="bi-arrow-left-circle-fill"></i>GoBack</a></button></center>  
      
    
                <?php }
                else{
                    
                   ?>
                   <div class="container">
                    <div class="row">
                    <div col-sm class="alert alert-warning alert-dismissible fade show" role="alert">
                   <strong>Sorry!</strong> You have to pay at least 90% of your fees.
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 
                    </div>
                    <a href="s_dashboard.php" class="btn btn-danger m-5">Goback</a>
                 </div>
                 <?php
                }
              ?>
              </div>
    <script src="../jquery.js"></script>
    <script>
        function f(){
           
            document.querySelector('#bytn').style.display='none';
            
            document.querySelector('#back').style.display='none';
            window.print();
        }
    </script>
</body>

</html>