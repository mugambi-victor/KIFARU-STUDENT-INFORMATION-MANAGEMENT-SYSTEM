<?php 
include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
  
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <style>
        .m {
    background: url("images/board.png") ;
    background-repeat: no-repeat;
    background-size: cover;
    position:fixed;
    width:100%;
    
}
.container{
    padding-top: 8em;
}

    </style>
</head>

<body  style="background-color: whitesmoke;">
<!-- <nav class="navbar navbar-expand-md navbar-light " style="background:#8432DF;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="image/Kiirua-Technical-Training-Institute.webp" height="80" alt="CoolBrand"/>
               
            </a><p class=" text-wrap text-white fw-bold" style="width:4rem; font-family:monospace">KIIRUA TECHNICAL TRAINING INSTITUTE</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto">
                    
        
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->
    
    <div class="text-center col-sm m-0 m" > 
       <h1 class="display-3 text-primary fw-bold p-5" >NEWS AND ANNOUNCEMENTS</h1> 
       <p class="lead pb-4"></p>
       <p><a href="#" class="btn btn-primary btn-lg" role="button"></a></p>
    </div>

    

<div class="container">
    <div class="row">
        <div class="col-sm-12 mt-2">
            
                <div class="container" >
          
                <?php 
                $sql=mysqli_query($conn,"select *from post order by id desc");
        
                while($r_res=mysqli_fetch_assoc($sql))
                {
                   if($r_res['id']%2==0){

                    echo'<div class="col-sm-12 mt-2  content container" >';
                    echo'<div class="row">';
                echo'<div class="col-sm images" >';
                    
                     echo "<img class='img-fluid' style='height:28em;' src=' image/".$r_res['img']. " ' >"; 
                   echo'  </div>';
                    echo '<div class="col-sm details">';
                    echo'<center><h2 class="text-capitalize" style="color:blue;">'.substr($r_res['title'],0,100).'</h2><hr style="color:blue;"></center><br>';
                         echo'<p class="text-justify-center">'.substr($r_res['details'],0,100).'</p><br>';
                         
                         $getadmin=mysqli_query($conn,"select *from admin where email='$r_res[created_by]'");
                         $res=mysqli_fetch_assoc($getadmin);
                         if($res['user_type']==0){
                            $user="School Admin";
                         }
                         else{
                            $user="School Accountant";
                         }
                         ?>
                         <i>created by: <?php echo $r_res['created_by']."-".$user;
                         ?></i>
                       <center>  <a href="post_details.php?id=<?php echo $r_res['id']; ?>"  class="btn btn-danger text-center">Read more</a><br><br></center>
                         <?php
                        echo'</div>';
                        echo'</div>';
                        echo'</div>';
                 } 
                 if($r_res['id']%2==1){
                    echo'<div class="col-sm-12 mt-2 content container" >';
                    echo'<div class="row">';
                   echo '<div class="col-sm details">';
                   echo'<center><h2 class="text-capitalize" style="color:blue;">'.substr($r_res['title'],0,100).'</h2><hr style="color:blue;"></center><br>';

                        echo'<p class="text-justify-center">'.substr($r_res['details'],0,100).'</p>';
                        $getadmin=mysqli_query($conn,"select *from admin where email='$r_res[created_by]'");
                         $res=mysqli_fetch_assoc($getadmin);
                         if($res['user_type']==0){
                            $user="School Admin";
                         }
                         else{
                            $user="Accountant";
                         }
                        ?>
                        <i>created by: <?php echo $r_res['created_by']."-".$user;?></i>
<center>  <a href="post_details.php?id=<?php echo $r_res['id']; ?>"  class="btn btn-danger text-center">Read more</a><br><br></center>
  <?php
                       echo'</div>';
                       
                       echo'<div class="col-sm images" >';
                       echo "<img class='img-fluid'  style='height:28em;'   src=' image/".$r_res['img']. " ' >"; 
                     echo'  </div>';
                     echo'</div>';
                     echo'</div>';
       
                 }} ?>

               </div>
       
 

       
    </div>
</div>




</body>

</html>