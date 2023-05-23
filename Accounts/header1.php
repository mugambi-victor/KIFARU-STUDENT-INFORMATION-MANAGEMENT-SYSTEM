 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> 
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- <link href="../bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet" >
<script src="../bootstrap_5.1.3/js/bootstrap.min.js"></script> -->
<style>
    .navbar{
        background:#051094; 
    }
    .schoolname{
        width:4rem;
        font-family:monospace;
    }
</style>
<nav class="navbar navbar-expand-md navbar-light " id="myHeader">
        <div class="container-fluid">
        <img src="../images/rh.jfif" class="pe-2" height="80" alt="CoolBrand"/>
               
               <p class="schoolname text-wrap text-white fw-bold" >KIFARU STUDENT INFORMATION MANAGEMENT SYSTEM</p>
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <p class="text-white lead fs-6 ms-5"><i>Welcome: <?php echo "<span class=''>$a</span>" ?></i> </p>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
                <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="admin_dashboard.php" class="nav-link text-white text-decoration-none">Home</a>
</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="viewprofile.php">Profile</a></li>
                            <li> <a class="dropdown-item"  href="logout">Logout</a></li>
        
                        </ul>
                    </li>
                </ul>
                
            </div>
           
        </div>
       
    </nav>
    
        </div>
   
  
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>