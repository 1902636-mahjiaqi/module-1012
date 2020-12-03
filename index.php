<?php
  include "factory/usersClass.php";
  include_once "factory/usersInterface.php";

  session_start();  

  if (isset($_SESSION['sessionToken']) && isset($_SESSION['status'])) {
    if ($_SESSION['status'] - time() < 1800) {
      $_SESSION['status'] = time();
      if($_SESSION['sessionToken']->getUserType() == "2") {
        header("Location:studDashboard.php");
      }
      else if ($_SESSION['sessionToken']->getUserType() == "1") {
        header("Location:professorDashboard.php");
      }
      else if ($_SESSION['sessionToken']->getUserType() == "0") {
        header("Location:adminDashboard.php");
      }
    }
    
  }

?>
<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php"; ?>
  <?php include "interface/header/header.php"; ?>

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
            if (isset($_SESSION["errorMsg"])) {
              echo "<div class='alert alert-danger'>" . $_SESSION['errorMsg'] . "</div>";
            }
          ?>
        </div>
        </div>
      </div>
    </form>
  </body>
</html>