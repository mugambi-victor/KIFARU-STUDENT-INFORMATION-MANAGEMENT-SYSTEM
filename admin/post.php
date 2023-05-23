<?php 
include('connection.php');
session_start ();
$t=$_SESSION["email"];
if(!isset($_SESSION["account_login"]))

	header("location:admin_login.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
     <link rel="shortcut icon" href="ol.png" >
    <title>CreatePost</title>
<style>
     a:hover{
            background-color: slateblue;
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
  <?php 
if(isset($_REQUEST["add"]))
	{	
        $title=mysqli_real_escape_string($conn,$_REQUEST["title"]);
        $details=mysqli_real_escape_string($conn,$_REQUEST["details"]);
$target="../image/".basename( $_FILES["uploadfile"]["name"]);

        $filename = $_FILES["uploadfile"]["name"];
        // $tempname = $_FILES["uploadfile"]["tmp_name"];    
            // $folder = "image/".$filename;

            // move_uploaded_file( $_FILES["uploadfile"]["name"][0],$folder."/".$filename);
$postchecker=mysqli_query($conn,"select *from post where title='$title' and details='$details' and img='$filename'");
if(mysqli_num_rows($postchecker)>0){
    echo("<div class='alert alert-info mt-2 alert-dismissible fade show'>
        <strong>Sorry!</strong>Post already created.
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>");
}
else{
    
	mysqli_query($conn,"insert into post values('','$title','$details','$filename','$t')");	
    if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target)){
        echo("<div class='alert mt-2  alert-success alert-dismissible fade show'>
        <strong>Success!</strong>Post uploaded successfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>");;
    }
    }}

?>
    <form method="post" enctype="multipart/form-data">
    <center> <h2>Create Post</h2></center>
<div class="col-md-10 ms-5">
<label for="title" class="form-label">Post Title</label>
<input type="text" name="title"  class="form-control text-capitalize" placeholder="Title goes here..."/>
		<label for="" class="form-label">Post Body</label>
		<textarea name="details" rows="8" columns="10"  class="form-control"placeholder="Type here..."></textarea>
     <label for="uploadfile" class="form-label">Image</label> 
  <input type="file" class="form-control"  name="uploadfile" 
                   value="" />
			<center><input type="submit" class="btn  mt-2 col-md-2 btn-secondary" value="Post" name="add" style="font-size:large;"/></center>
		

</form>
    </div>

</div>
    
</body>
</html>