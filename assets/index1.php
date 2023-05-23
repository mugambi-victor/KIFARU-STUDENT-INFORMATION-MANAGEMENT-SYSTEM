<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Navbar Right Align | Carey Development</title>
    <style>
        .two{
            width:20%;
        }
.two .nav-item{
    margin-left:100px;
   
}
.two .nav-item a:hover{
    color:brown;
}
.contentss{
    margin;auto;
}
.col{
    float:left;
    margin-top:20px;
}
.col:hover{
    color:red;
    opacity:0.5;
}
.the-list{
  margin-top:20px;
}
.the-list .list-group-item:hover{
  background-color:#4c0121;
  
color:white;
}
a{
  text-decoration:none;
  
}
.list-group-item{
  border:0;
  border-bottom:1px solid;
}
    </style>
        

</head>

<body >
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="images/mylogo.png" height="80"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Sports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Academics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="news.php">News and Announcemnts</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="admin_login.php">Admin Portal</a></li>
                            <li> <a class="dropdown-item"  href="teacher/t_login.php">Teacher's Portal</a></li>
                            <li><a class="dropdown-item" href="student/s_login.php">Student Portal</a></li>
                            <li><a class="dropdown-item" href="parent/parent_login.php">Parent Portal</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" height="100">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/o-HIGH-SCHOOL-BUILDING-facebook.jpg" class="d-block w-100" h-50 alt="..." height="400">
      <div class="carousel-caption d-none d-md-block">
        <h3>Join Us Today</h3>
    
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/library-books.jpg" class="d-block w-100" alt="..." height="400">
      <div class="carousel-caption d-none d-md-block">
        <h5>Our Library</h5>
        <p>Knowledge is a power, get to explore our enormous collection of books on all walks of life and topics</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/00d45529-4682-4401-864e-fc46b68b2741.jpg" class="d-block w-100" alt="..." height="400">
      <div class="carousel-caption d-none d-md-block">
        <h5>Sports</h5>
        <p>Get to Join our sports clubs. Discover your co-curricular Talents.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




    <div class="container" style="display:flex;">
    <div class="row">
    <div class="mt-4 p-5 bg-info text-white rounded">
  <center><h1>MySchool </h1></center>
  <p>
The Kenya High School had its beginnings in 1910 when a co-educational school called the Nairobi European School began in buildings designed for police Barracks. In 1931 the boys were separated from the girls. In 1935, the school was renamed The European Girls Secondary School and had its first Headmistress, Miss Kerby appointed. The buildings consisted partly of temporary wooden huts located on the compound of the present Nairobi Primary school, with whom the secondary school shared the present buildings. Staff housing was scattered in the vicinity of Protectorate Hill. In 1939, the school was renamed The Kenya High School. </p>
</div>
  <div class="col"> 
     <a href="#" style="text-decoration:none;">  <div class="card img-fluid" style="width:350px;">
      <center><div class="card-header"><h6>ABOUT US</h6></div></center>
    <img class="card-img-top" src="images/R1.jpg" alt="Card image" style="width:100%">
    <div class="card-img-overlay">
      <h4 class="card-title"></h4><br><br>
    
      </div>
   <center>   <p class="card-text" style="font-weight:bold;">LEARN MORE ABOUT US<i class="fa fa-angle-double-right" style="font-size:20px"></i></p></center>
    </div></a></div>
  <div class="col">  
  <a href="news.php" style="text-decoration:none;">  <div class="card img-fluid" style="width:350px;">
      <center><div class="card-header"> <h6>NEWS AND ANNOUNCEMENTS</h6></div></center>
    <img class="card-img-top" src="images/markus-winkler-k_Am9hKISLM-unsplash.jpg" alt="Card image" style="width:100%">
    <div class="card-img-overlay">
      <h4 class="card-title"></h4><br><br>
    
      </div>
   <center>   <p class="card-text" style="font-weight:bold;">SEE UPCOMING ACTIVITIES AND EVENTS<i class="fa fa-angle-double-right" style="font-size:20px"></i></p></center>
    </div></a></div>
    <div class="the-list col-sm" style=""><ul class="list-group text-center ">
  <li class="list-group-item"><a href=""><h6>CLUBS AND SOCIETIES</h6></a> </li>
  <li class="list-group-item"><a href=""><h6>JOB VACANCIES</h6></a> </li>
  <li class="list-group-item"> <a href=""> <h6>ALUMNI</h6></a>  </li>
</ul></div>
</div>
</div>


  <footer class="bg-primary text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-facebook left"></i> Facebook</a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-twitter left"></i> Twitter</a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-google-plus left"></i> Google +</a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fa fa-instagram left"></i> Instagram</a>

    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright:
    <a class="text-white" href="https://mdbootstrap.com/">Gambino solutions</a>
  </div>
  <!-- Copyright -->
</footer>

  



</body>
</html>