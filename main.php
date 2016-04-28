<?php
  define("RUNNING", true);

  $mysql = false;

  require_once("./mysql.php");
  require_once("./config.php");
  
  $config = new Config("./config/config.ini");

  if($config == false) {
    echo "The config file could not be read. Please create: /config/config.ini<br />";
    exit;
  }

  $mysql = new MySql();
  $mysql->connect($config->read_field("mysql", "host"), $config->read_field("mysql", "user"), $config->read_field("mysql", "pass"), $config->read_field("mysql", "name"), $config->read_field("mysql", "port"));
  $mysql->query("CREATE TABLE IF NOT EXISTS users (id int AUTO_INCREMENT, name varchar(30), email varchar(254), password varchar(512), salt varchar(12), PRIMARY KEY (id))");


?>
