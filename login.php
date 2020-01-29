<?php
session_start();
include("link.php");
if($_SESSION["user"]) {
?>
<p>But you alread logged in <?php echo $_SESSION["user"]; ?> wtf??<p>
<?php

} else {
  if(isset($_POST['button'])) {
    // check for MySQL user here
    $username = $_POST['username'];
    $query = "SELECT password FROM Users WHERE username = '".$username."' ";
    $passwordHash = mysqli_query($link, $query);
    if(password_verify ($_POST['password'], $passwordHash) ) {
       $_SESSION["user"] = $username;
    }
  }
}
?>
