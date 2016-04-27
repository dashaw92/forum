<?php
  class MySql {
    private $conn = false;

    function connect($server, $user, $pass, $name) {
      global $conn;
      if($conn != false) {
        $conn->close();
      }
      $conn = new mysqli($server, $user, $pass, $name);
      if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    }
     
    function close() {
      global $conn;
      if($conn == false) return;
      $conn->close();
      $conn = false;
    }

    function query($query) {
      return $conn->query($query);
    } 
  }
?>
