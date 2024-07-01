<?php
  header("Location: http://localhost/home_furnishing_store/index.php");
  session_start();
  //remove all session variables
  session_unset();
 
  //destroy
  session_destroy();
?>