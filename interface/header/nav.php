<!-- <?php session_start(); ?>
 -->
<!-- insert here is isset session login show nav bar content, else hide nav bar content -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php"><?php include "./interface/head/title.php" ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <nav class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">
              <!-- <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
               -->
              <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <nav class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <nav class="dropdown-divider"></nav>
                      <a class="dropdown-item" href="#">Something else here</a>
                  </nav>
              </li> -->
          </ul>
          <?php if (isset($_SESSION['sessionToken'])) {
              
              
              $UType = "";
              $UName = $_SESSION['AcName'];
              if($_SESSION['AcType'] == 0){
                  $UType = "Admin: ";
              }
              else if ($_SESSION['AcType'] == 1){
                  $UType = "Prof: ";
              }
              else {
                  $UType = "Stud: ";
              }
              
            echo "<ul class='navbar-nav navbar-right'>";
            echo "<li><p class='nav-link'>Hello, ".$UType.$UName."</p></li>";
            echo "<li class='nav-item active'>";
            echo "<a class='nav-link' href='_logout.php'>Logout</a>";
            echo "</li>";
            echo "</ul>";
          } ?>
      </nav>
  </nav>