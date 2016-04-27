<?php
  $mysql = false;

  require_once("./mysql.php");
  
  $mysql = new MySql();
  $mysql->connect("localhost", "php", "password123", "forum");
?>
