<?php
include_once "factory/usersClass.php";
include_once "factory/usersInterface.php";
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><?php include "./interface/head/title.php" ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <nav class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">
           <?php

            if (!isset($_SESSION['sessionToken'])) { 
                echo '<a class="navbar-brand" href="index.php"><?php include "./interface/head/title.php" ?></a>';
            }
            else {
                if ($_SESSION['sessionToken']->getUserType() == "2") {
                echo '<a class="navbar-brand" href="studDashboard.php"><?php include "./interface/head/title.php" ?></a>';
                }
                else if ($_SESSION['sessionToken']->getUserType() == "0") {
                echo '<a class="navbar-brand" href="adminDashboard.php"><?php include "./interface/head/title.php" ?></a>';
                }
                else {
                echo '<a class="navbar-brand" href="index.php"><?php include "./interface/head/title.php" ?></a>';
                }
            }
            ?>
          </ul>
          <?php if (isset($_SESSION['sessionToken'])) {
            echo "<ul class='navbar-nav navbar-right'>";
            echo "<li class='nav-item active'>";
                    echo "<a class='nav-link' href='_logout.php'>Logout</a>";
                echo "</li>";
            echo "</ul>";
          } ?>
      </nav>
  </nav>