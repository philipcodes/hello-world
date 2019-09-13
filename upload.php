<!DOCTYPE html>

<?php
include("config.php");

if(isset($_POST['button'])){
 
  $name = $_FILES['file']['name'];
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($name);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if(in_array($imageFileType,$extensions_arr) ){
 
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

    //  Check the file uploaded
    if (file_exists("uploads/" . $name)){
         echo $target_file= $name . " exists. Hash: " ;
        
    // Hash the file
    $var = hash_file('sha256', 'uploads/' . $name);
    echo $var;
        
    $query = "INSERT INTO uploads(name, hash_file) VALUES('".$name."', '".$var."')";
    mysqli_query($con,$query);

    } 
      
  }
 
}
    
?>

<html>

<head>
    <title>My Upload Site</title>
</head>

<body>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="button" value="Upload">
    </form>

</body>

</html>
