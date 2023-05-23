<?php
//include('db_connect.php');
include('../connection.php');

session_start();
if (!isset($_SESSION["email"])) {
  header("location:admin_login.php");
}

$options = "";
$options1 = "";
$optionr = "";


?>

<?php

// // Connect to first database
// $db1 = new mysqli('localhost', 'root', '', 'ozitekie_srms');

// // Check connection
// if ($db1->connect_error) {
//   die("Connection failed: " . $db1->connect_error);
// }
// $id = isset($_GET['id']) ? $_GET['id'] : '';
// // Retrieve data from form
// $id_no = isset($_POST['rno']) ? $_POST['rno'] : '';
// //$id_no = $_POST['id_no'];
// $name = isset($_POST['s_name']) ? $_POST['s_name'] : '';
// //$name = $_POST['name'];
// $contact = isset($_POST['pno']) ? $_POST['pno'] : '';

// $email = isset($_POST['email']) ? $_POST['email'] : '';
// //$email = $_POST['email'];


// // Insert data into first database
// $sql1 = "INSERT INTO student (id,id_no,name,contact, email) VALUES (NULL, '$id_no','$name','$contact', '$email')";
// if ($db1->query($sql1) === TRUE) {
//   // echo "...";
// } else {
//   echo "Error: " . $sql1 . "<br>" . $db1->error;
// }

// $db1->close();

// ?>
<!DOCTYPE html>
<html lang="en">

<head>
    
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="ol.png" >
  <title>AddStudent</title>



  <style>
    h3:before,
    h3:after {
      content: "";
      flex: 1 1;
      border-bottom: 2px solid;
      margin: auto;
    }

    h3 {
      display: flex;
      flex-direction: row;

    }

    a:hover {
      background-color: #8432DF;

    }

    a:active {
      background-color: #8432DF;
    }
    #myHeader{
      color: blue;
    }
  </style>
</head>

<body>
<?php include('header.php');?>
<div class="container-fluid col-sm  d-flex">
<?php 

  include('sidebar.php');

   ?>
  <div class="container col-md">
    
    <div class="div m-2">
      
    <?php
      if (isset($_REQUEST['submit'])) {
        $course = $_REQUEST['course_name'];
        $department = $_REQUEST['department'];

        $id_no = $_POST['rno'];
        $surname = $_POST['surname'];
        $other_name = $_POST['other_names'];
        $sname=$other_name." ".$surname;
        $contact = $_POST['pno'];
        // $sname = mysqli_real_escape_string($conn, $_REQUEST['s_name']);
        $spass = $_REQUEST['s_pass'];
        $srno = $_REQUEST['rno'];
        $p_name = $_REQUEST['p_name'];
        $gender= $_REQUEST['gender'];
        $pno = $_REQUEST['pno'];
        $email = $_REQUEST['email'];
        $p_pass = $_REQUEST['p_pass'];
        $dob = $_REQUEST['dob'];
        $yoj = $_REQUEST['yoj'];
       
        $term = $_REQUEST['term'];
       
          $yearsemester = $_REQUEST['yearsemester'];
          $getfee = mysqli_query($conn, "select *from semester where course_id=$course and sem_id=$yearsemester");
          if (mysqli_num_rows($getfee) > 0) {


            $res = mysqli_fetch_assoc($getfee);
            $fee = $res['total_fees'];
            $arget = "../student/images/" . basename($_FILES["uploads"]["name"]);
            $filename = $_FILES["uploads"]["name"];
          } else{
            $fee=0;
          }
          
          $check = "SELECT * FROM student WHERE regno='$srno'";
          $rs = mysqli_query($conn, $check);
          if (mysqli_num_rows($rs) > 0) { ?>
            <!-- Error Alert -->
            <div class="alert alert-danger alert-dismissible fade show">
              <strong>Sorry!</strong>That Registration No. has already been taken.
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php
          } else {
            //  $sql = mysqli_query($conn, "insert into studentadm values('0','$sname','$dob','$srno','$spass',$semester,$course,$department, '$year','$p_name','$pno','$email','$p_pass','$filename','$yoj' ,$academic,$term)");
      
            $res = mysqli_query($conn, "insert into student values('0','$sname','$dob','$srno','$gender','$spass',$yearsemester,$course,$department,'$p_name','$pno','$email','$p_pass','$filename','$yoj',$term,$fee,1)");


            //  $res1 = "INSERT INTO student (`id`, `id_no`, `name`, `email`) VALUES (NULL, '$srno','$sname', '$email',CURRENT_TIMESTAMP)";
      

            //$sql = "INSERT INTO tbl_project2 (Name, Description, Cars, Gender) VALUES ('$name', '$desc', '$cars', '$gender' )";
//$sql2 = "INSERT INTO tbl_project2b (Bike, Cycle) VALUES ('$bike', '$cycle' )";
      

            if ($res && move_uploaded_file($_FILES['uploads']['tmp_name'], $arget)) { ?>
              <!-- Success Alert -->
              <div class='alert mt-3 alert-success alert-dismissible fade show'>
                            <strong>Success!</strong>Data sent successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>

              <?php

            } else {
              if (!move_uploaded_file($_FILES['uploads']['tmp_name'], $arget)) {
                echo " not";
              } ?>

              <!-- Error Alert -->
              <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> A problem has occurred while submitting your data.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
              <?php
            }
          }

        }


        ?>

      </div>
   
      <form class="row g-3" enctype="multipart/form-data" method="post">
        <h3>Student details</h3>
        <div class="row mt-2">

          <div class="col-md ">
            <label for="surname" class="form-label">Surname Name</label>
            <input type="text" placeholder="surname" name="surname" class="form-control text-capitalize" id="s_name" required>
          </div>
          <div class="col-md">
            <label for="other_names" class="form-label">Other names</label>
            <input type="text" placeholder="other names" class="form-control text-capitalize" name="other_names" required>
          </div>
          <div class="col-md">
            <label for="rno" class="form-label">Registration Number</label>
            <input type="text" placeholder="Registration Number" class="form-control text-capitalize" name="rno" required>
          </div>
        </div>
        <div class="row mt-2">
       
          <div class="col-md ">
          <label for="gender" class="form-label">Gender</label>
            <select name="gender" id=""class="form-select text-capitalize" required>
              <option value="">Gender</option>
              <option value="m">male</option>
              <option value="f">female</option>
            </select>
          
          
          </div>
          <div class="col-md">
            <label for="dob" class="form-label">DOB</label>
            <input type="text" class="form-control" id="dob" placeholder="date og birth" name="dob" required>
          </div>
          <div class="col-md">
            <label for="uploads" class="form-label">Upload Photo</label>
            <input type="file" class="form-control" id="uploads" name="uploads" required>
          </div>
        </div>
        <h3>Class details</h3>
        <div class="row">
          <div class="col-md-6">
            <label for="" class="form-label">Academic Year</label>
            <select class="form-select text-capitalize" name="academicyear" id="academic" required>
              <option selected>select Academic Year</option>
              <?php
              $s_result = mysqli_query($conn, "select* from academic_year");
              if (mysqli_num_rows($s_result) > 0) {
                // output data of each row
                while ($ss = mysqli_fetch_assoc($s_result)) {
                  $options1 = $options1 . "<option value= $ss[id] >$ss[sname]</option>";

                }

              }
              echo $options1;
              ?>
            </select>
          </div>
          <div class="col-md-6">

            <label for="term" class="form-label">Academic Term</label>
            <select class="form-select  text-capitalize" name="term" id="term-list" required>
              <option value=''>Select term</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="" class="form-label">Department</label>
            <select class="form-select text-capitalize" name="department" id="department-list" required>
              <option selected>select department</option>
              <?php
              $d_result = mysqli_query($conn, "select* from department");
              if (mysqli_num_rows($d_result) > 0) {
                // output data of each row
                while ($r = mysqli_fetch_assoc($d_result)) {
                  $options = $options . "<option value= $r[id] >$r[department_name]</option>";

                }

              }
              echo $options;
              ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="course_name" class="form-label">Course</label>
            <select class="form-select text-capitalize" name="course_name" id="course-list" required>
              <option value=''>Select course</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="year" class="form-label">Year</label>
            <select class="form-select text-capitalize" name="courseyear" id="year-list" required>
              <option value=''>Select year</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="semester" class="form-label">Semester</label>
            <select class="form-select text-capitalize" name="yearsemester" id="semester-list" required>
              <option value=''>Select semester</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="s_pass" class="form-label">Password</label>
            <input type="text" class="form-control" id="s_pass" placeholder="password" name="s_pass" required>
          </div>
          <div class="col-md-6">
            <label for="yoj" class="form-label">YEAR OF JOINING</label>
            <input type="text" class="form-control" id="yoj" placeholder="year of joining eg, 2020" name="yoj" required>
          </div>
         
        </div>
        <div class="row">
          
          
        </div>

        <h3>Parent/Guardian Details</h3>
        <div class="row">
          <div class="col-md-6">
            <label for="s_name" class="form-label">Parent/Guardian Name</label>
            <input type="text" placeholder="parents name" name="p_name" class="form-control text-capitalize" id="p_name" required>
          </div>
          <div class="col-md-6">
            <label for="pno" class="form-label">Phone Number</label>
            <input type="text" placeholder="Phone Number" class="form-control " name="pno" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" placeholder="Email" name="email" class="form-control" id="email" required>
          </div>
          <div class="col-md-6">
            <label for="p_pass" class="form-label">password</label>
            <input type="text" placeholder="Password" class="form-control " name="p_pass" required>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-12 mt-2 ">
            <button type="submit" style="width:150px;" class="btn btn-primary" name="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <script src="jquery.js"></script>
  <script>
    $('#department-list').on('change', function () {
      var department_id = this.value;

      $.ajax({
        type: "POST",
        url: "getcourses.php",
        data: 'department_id=' + department_id,
        success: function (results) {
          $("#course-list").html(results);
        }
      });
    });

    $('#course-list').on('change', function () {
      var course_id = this.value;
      $.ajax({
        type: "POST",
        url: "getyear.php",
        data: 'course_id=' + course_id,
        success: function (results) {
          $("#year-list").html(results);
        }
      });
    });

    $('#year-list').on('change', function () {
      var year_id = this.value;
      $.ajax({
        type: "POST",
        url: "getyear.php",
        data: 'year_id=' + year_id,
        success: function (results) {
          $("#semester-list").html(results);
        }
      });
    });

    $('#academic').on('change', function () {
      var academic_id = this.value;
      $.ajax({
        type: "POST",
        url: "getacademicterm.php",
        data: 'academic_id=' + academic_id,
        success: function (results) {
          $("#term-list").html(results);
        }
      });
    });

  </script>
  <script>
    window.onscroll = function () { myFunction() };

    var header = document.getElementById("side");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
  </script>
</body>

</html>