<?php
  session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
    header("Refresh: 0");
  }

  include("./views/home-view.php");
?>

