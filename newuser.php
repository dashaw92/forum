<?php
  include("./main.php");

  $name = $email = $password = "";
  $err = false;

  function validate_var($var) {
    global $err; //Check if form is already been submitted as valid. Do not want fields to stay
                 //populated after submission.
    if(isset($_POST[$var]) && $err == true) {
      return htmlspecialchars($_POST[$var]);
    } else {
      return "";
    }
  }

  function create_password($original) {
    $first = md5(uniqid(rand(), true));
    $salt = substr($first, 0, 12);
    return array("pw" => hash("sha512", $original . $salt), "salt" => $salt);
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
      <p>Username: <input type="text" name="user" value="<?php echo validate_var("user"); ?>"/> <sup title="Required field" class="error">*</sup></p> 
      <p>E-mail: <input type="text" name="email" value="<?php echo validate_var("email"); ?>"/> <sup title="Required field" class="error">*</sup></p> 
      <p>Password: <input type="password" name="password" value="<?php echo validate_var("password"); ?>"/> <sup title="Required field" class="error">*</sup></p>
      <p><input type="submit" value="Register" /></p>
    </form>
    <p><i>Fields marked with "<span class="error">*</span>" are required.</i></p>
    <?php
      
      //Moved down to make status message appear at bottom instead of at the top.
      if($_SERVER["REQUEST_METHOD"] == "POST") {
        $err = false;
        $name = clean_input($_POST["user"]);
        $email = clean_input($_POST["email"]);
        $password = clean_input($_POST["password"]);
        if(empty($name) || !ctype_alnum($name) || strlen($name) < 3) {
          $err = true;
        }
        if(empty($email)) {
          $err = true;
        }
        if(empty($password)) {
          $err = true;
        }
        if($err == false) {
          if(!$mysql->username_exists($name) && !$mysql->email_exists($email)) {
            $res = create_password($password);
            $mysql->add_user($name, $email, $res["pw"], $res["salt"]);
            echo "Registered user $name.<br />";
          } else {
            echo "A user already exists with those credentials.<br />";
          }
        }
      }

      if($err == true) {
        echo "<span class=\"error\">One or more fields are missing or the name field contains errors.<br />Names may only consist of letters and numbers and must be at least 3 characters long.<br /></span>";
      }
    ?>
  </body>
</html>
