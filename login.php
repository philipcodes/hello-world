<?php
session_start();
if($_SESSION["user"]) {
?>
<p>But you alread logged in <?php echo $_SESSION["user"]; ?> wtf??<p>
<?php
} else {
  if(isset($_POST['button'])) {
    // check for MySQL user here
  }
}
?>
