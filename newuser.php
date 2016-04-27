<?php
  include("./main.php");
  $name = $email = $password = "";
  $err = false;

  function validate_var($var) {
    global $err;
    if(isset($var) && $err == true) {
      return htmlspecialchars($var);
    } else {
      return "";
    }
  }

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = false;
    $name = clean_input($_POST["user"]);
    $email = clean_input($_POST["email"]);
    $password = clean_input($_POST["password"]);
    if(empty($name)) {
      echo "Username is required.<br />";
      $err = true;
    }
    if(empty($email)) {
      echo "E-mail is required.<br />";
      $err = true;
    }
    if(empty($password)) {
      echo "Password is required.<br />";
      $err = true;
    }
    if($err == false) {
      //submit INSERT after checking if username or email is taken
    }
  }

  function clean_input($in) {
    return htmlspecialchars(stripslashes(trim($in)));
  }
?>
<html>
  <head>
    <title>Register</title>
    <meta name="author" content="Daniel Shaw">
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <h1>Register a new user</h1>
    <hr />
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <p>Username: <input type="text" name="user" value="<?php echo validate_var($_POST["user"]); ?>"/></p> 
      <p>E-mail: <input type="text" name="email" value="<?php echo validate_var($_POST["email"]); ?>"/></p> 
      <p>Password: <input type="password" name="password" value="<?php echo validate_var($_POST["password"]); ?>"/></p>
      <p><input type="submit" value="Register" /></p>
    </form>
  </body>
</html>
