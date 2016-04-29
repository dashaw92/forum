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
      echo "You are logged in as " . $_SESSION["username"] . ".";
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="submit" value="Logout" />
    </form>
    <?php
    } else {
      echo "Must be logged in!";
      ?>
      <a href="login.php">Login</a>
      <?php
    }
    ?>
  </body>
</html>
