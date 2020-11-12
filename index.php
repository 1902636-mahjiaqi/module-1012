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
<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php" ?>
  <?php include "interface/header/header.php" ?>

  <body class="bg-dark">
    <form action="_loginProcess.php" method="post">

      <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-xl-3 jumbotron bg-white">
          <div class="form-group">
            <label for="loginUser"><b>Username</b></label>
            <input type="email" class="form-control" placeholder="Enter email address" name="loginUser" required>
          </div>

          <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
          </div>

          <div class="form-group">
          <button type="submit" class="btnSubmit btn btn-danger btn-block">Login</button>
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
        </div>
      </div>
    </form>
  </body>
</html>