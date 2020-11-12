<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php" ?>
  <?php include "interface/header/header.php" ?>

  <body class="bg-dark">
    <form action="loginProcess.php" method="post">

      <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-xl-8 jumbotron bg-white">
          <!-- header -->
          <div class="d-flex justify-content-between p-3">
            <h5>Manage Professor Accounts</h5>
            <button type="button" class="btn btn-danger">Create New Account</button>
          </div>

          <!-- search -->
          <div class="d-flex justify-content-end p-3">
            <div class="w-25">
              <input class="form-control" type="text" placeholder="Search" aria-label="Search"></div>
            </div>

          <!-- content table -->
          <div>
            
          </div>
          <table class="table table-borderless table-hover">
            <thead>
              <tr>
                <th scope="col">Account Login</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">1902183@sit.singaporetech.sg</td>
                <td>Foo Qi Kai</td>
                <td>
                  <button type="button" class="btn btn-danger">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>
        </div>
      </div>
    </form>
  </body>
</html>