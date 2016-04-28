<?php
  session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_destroy();
    header("Refresh: 0");
  }
?>

<html>
  <head>
    <title>Home</title>
    <meta name="author" content="Daniel Shaw"> 
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <h1>Home</h1>
    <hr />
    <?php
    
    if(isset($_SESSION["username"])) {
      echo "You are logged in as " . $_SESSION["username"] . "<br />";
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="submit" value="Logout" />
    </form>
    <?php
    } else {
      echo "Must be logged in!<br />";
    }
    ?>
  </body>
</html>