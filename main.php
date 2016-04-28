<?php
  define("RUNNING", true);

  $mysql = false;

  require_once("./mysql.php");
  
  $mysql = new MySql();
  $mysql->connect("localhost", "php", "password123", "forum");
  $mysql->query("CREATE TABLE IF NOT EXISTS users (id int AUTO_INCREMENT, name varchar(30), email varchar(254), password varchar(512), salt varchar(12), PRIMARY KEY (id))");

?>
