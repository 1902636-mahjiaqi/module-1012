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
    <title>Learning Board</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <!-- BootStrap include: this will include all needed files for BootStrap 4.3.1 -->
    <?php include "src/css/style.php" ?>
  </head>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">System & Grading System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <nav class="collapse navbar-collapse" id="navbarSupportedContent">
           <!-- <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <nav class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <nav class="dropdown-divider"></nav>
                      <a class="dropdown-item" href="#">Something else here</a>
                  </nav>
              </li>
              <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
              </li>
          </ul> -->
      </nav>
  </nav>
  </header>
  <body class="bg-dark">
    <form action="loginProcess.php" method="post">

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
