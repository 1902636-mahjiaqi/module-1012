<!DOCTYPE html>

<?php

  session_start();
  if (isset($_SESSION['sessionToken'])) {
    if($_SESSION['sessionToken'] -> getTypeOfUser() == "2") {
      header("Location:dashboard.php");
    }
    else if ($_SESSION['sessionToken'] -> getTypeOfUser() == "1") {
      header("Location:profDashboard.php");
    }
    else if ($_SESSION['sessionToken'] -> getTypeOfUser() == "0") {
      header("Location:adminDashboard.php");
    }
  }

  else {
    unset($_SESSION["sessionToken"]);
    session_destroy();
  }

?>

<html lang="en">
  <head>
    <title> Learning Board </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <!-- BootStrap include: this will include all needed files for BootStrap 4.3.1 -->
    <?php include "css/BootStp.php" ?>
    <!-- Below is the old css that does not use BootStrap -->
    <!--<link rel="stylesheet" type="text/css" href="css/login.css">-->
  </head>
  <body>

    <form action="loginProcess.php" method="post">

      <div class="container">
        <div>
          <label for="loginUser"><b>Username</b></label>
          <input type="email" placeholder="Enter email address" name="loginUser" required>
        </div>

        <div>
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
        </div>

        <div>
        <button type="submit">Login</button>
        </div>
        
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>

        <?php
          if(isset($_SESSION["errorMsg"])) {
            echo "<h3>" . $_SESSION['errorMsg'] . "</h3>";
          }
        ?>

      </div>

    </form>
  </body>

</html>
