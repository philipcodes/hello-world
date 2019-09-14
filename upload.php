<!DOCTYPE html>

<?php
include("link.php");

if(isset($_POST['button'])) {
 
$name = $_FILES['file']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($name);

// Select file type
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Valid file extensions
$extensions_arr = array("jpg","jpeg","png","gif", "mp4", "pdf");

    // Check the extension of the file
    if(in_array($imageFileType,$extensions_arr)) {
 
    // Upload the file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

    if(in_array($imageFileType,$extensions_arr)) {
        
    //  Check the file uploaded
    if (file_exists("uploads/" . $name)) {
        echo $target_file= $name . " exists. Hash: " ;
        
    // Hash the file
    $var = hash_file('sha256', 'uploads/' . $name);
        echo $var;
    
    $check = "SELECT * FROM uploads WHERE hash_file = '".$var."'";
    $result = mysqli_query($link, $check);
    
    // Check if the file has already been uploaded    
    if (mysqli_num_rows($result) == 0){
    $query = "INSERT INTO uploads(name, hash_file) VALUES('".$name."', '".$var."')";
        if (!mysqli_query($link, $query)) {
            echo " Error in adding file to database";
        }
        } else {
            echo " File has already been uploaded.";
            unlink($target_dir . $name);
        }
    }
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
