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
      global $conn;
      return $conn->query($query);
    }

    function add_user($name, $email, $password, $salt) {
      global $conn;
      //Prepared statement (ps)
      $ps = $conn->prepare("INSERT INTO users (name, email, password, salt) VALUES (?, ?, ?, ?)");
      if($ps == false) {
        return false;
      }
      $ps->bind_param("ssss", $name, $email, $password, $salt);
      $ps->execute();
      $ps->close();
    }

    function username_exists($name) {
      global $conn;
      $ps = $conn->prepare("SELECT * FROM users WHERE name = ?");
      if($ps == false) {
        //To be safe, return false in case the user DOES exist
        return false; 
      }
      $ps->bind_param("s", $name);
      $ps->execute();
      $ps->bind_result($id, $uname, $email, $password, $salt);
      $count = 0;
      while($ps->fetch()) {
        $count++;
      }
      $ps->close();
      if($count > 0) {
        return true;
      } else {
        return false;
      }
    }

    function email_exists($email) {
      global $conn;
      $ps = $conn->prepare("SELECT * FROM users WHERE email = ?");
      if($ps == false) {
        return false; 
      }
      $ps->bind_param("s", $email);
      $ps->execute();
      $ps->bind_result($id, $uname, $uemail, $password, $salt);
      $count = 0;
      while($ps->fetch()) {
        $count++;
      }
      $ps->close();
      if($count > 0) {
        return true;
      } else {
        return false;
      }
    }

    function get_user($id) {
      global $conn;
      $ps = $conn->prepare("SELECT name, email, password, salt FROM users WHERE id = ?");
      if($ps == false) {
        return false;
      }
      $ps->bind_param("s", $id);
      $ps->execute();
      $ps->bind_result($uname, $uemail, $upassword, $salt);
      $ps->fetch();
      $ps->close();
      return array("name" => $uname, "email" => $uemail, "password" => $upassword, "salt" => $salt);
    }
  }
?>
