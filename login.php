<?php
  include("./main.php");

  function clean_input($in) {
    return htmlspecialchars(stripslashes(trim($in)));
  }
?>
<html>
  <head>
    <title>Login</title>
    <meta name="author" content="Daniel Shaw">
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <h1>Login</h1>
    <hr />
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <p>Username: <input type="text" name="username" required /><sup class="error">*</sup></p>
      <p>Password: <input type="password" name="password" required /><sup class="error">*</sup></p>
      <p><input type="submit" value="Login" /></p>
    </form>
    <?php
      if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = clean_input($_POST['username']);
        $password = clean_input($_POST['password']);
        if(empty($username) || !ctype_alnum($username) || strlen($username) < 3) {
          echo "<span class=\"error\">Username invalid.</span><br />";
          exit;
        }
        if(empty($password)) {
          echo "<span class=\"error\">Password cannot be empty.</span><br />";
          exit;
        }
        if($mysql->username_exists($username)) {
          if($mysql->validate_user($username, $password)) {
            echo "Successful login for $username<br />";
            session_start();
            $_SESSION['username'] = $username;
            header("Location: home.php");
          } else {
            echo "<span class=\"error\">Failed to login.</span><br />";
          }
        } else {
          echo "<span class=\"error\">Failed to login.</span><br />";
        }
      }
    ?>
  </body>
</html>
