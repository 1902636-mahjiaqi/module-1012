<?php

include "factory/usersClass.php";
include_once "factory/usersInterface.php";
include_once "_dbconn.php";

session_start();

if (!isset($_SESSION['sessionToken'])) {
  unset($_SESSION["sessionToken"]);
  $_SESSION = array();
  session_destroy();
  header('Location:index.php');
}

if (isset($_SESSSION['status']) && $_SESSION['status'] - time() < 1800) {
  $_SESSION['status'] = time();
}

?>

<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php"; ?>
  <?php include "interface/header/header.php"; ?>
  <script>
   function ajax(accID){
     $.ajax({
          type: 'POST',
          url: '_deleteAccount.php',
          data: {ID: accID},
          success: function(){
              window.location.replace("adminDashboard.php");
          }
        })
   }
  </script>
  <body class="bg-dark">
      <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-xl-8 jumbotron bg-white">
          <!-- header -->
          <div class="d-flex justify-content-between pt-3 pb-3">
            <h5>Manage Professor Accounts</h5>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#newAccount">Create New Account</button>
          </div>

          <!-- search -->
          <div class="d-flex justify-content-end">
            <div class="w-25">
              <input class="form-control" type="text" placeholder="Search" aria-label="Search"></div>
            </div>

          <!-- content table -->
          <table class="table table-borderless table-hover">
            <thead>
              <tr>
                <th scope="col">Account Login</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
              </tr>
            </thead>
          
            <tbody>
              <?php
              $sql = "SELECT * FROM accounts where AccType != 0";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td scope='row'>" . $row['AccID'] . "</td>";
                  echo "<td>" . $row['Name'] . "</td>";
                  echo "<td>";
                  echo "<form method='post' action='_deleteAccount.php>";
                  echo "<button type'button'id='button' class='btn btn-danger' onclick='ajax(" . $row['AccID'] . ")'> Delete </button>";
                  echo "</form>";
                  echo "</tr>";
                }
              }
              ?>

<!--               <tr>
                <td scope="row">1902183@sit.singaporetech.sg</td>
                <td>Foo Qi Kai</td>
                <td>
                  <button type="button" class="btn btn-danger">Delete</button>
                </td>
              </tr> -->
            </tbody>
          </table>
          </div>
        </div>
        </div>
      </div>

      <!-- new account modal -->
      <div class="modal fade" id="newAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create New Account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
              <!-- insert form here -->
              <form action="#" method="post">
                  <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input type="email" class="form-control" placeholder="Enter email address" name="name" required>
                  </div>

                  <div class="form-group">
                    <label for="email"><b>Email Address</b></label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="email" required>
                  </div>

                  <div class="form-group">
                    <label for="password"><b>Password</b></label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                  </div>
        
                  <div class="form-group">
                    <label for="cfmPassword"><b>Confirm Password</b></label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="cfmPassword" required>
                  </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger">Save changes</button>
            </div>
            </div>
            <!-- end of modal -->

          </div>
        </div>
      </div>
  </body>
</html>