<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php" ?>
  <?php include "interface/header/header.php" ?>

  <body class="bg-dark">
      <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-xl-8 jumbotron bg-white">
          <!-- header -->
          <div class="d-flex justify-content-between pt-3 pb-3">
            <h5>Create Module</h5>
          </div>
          
          <!-- content -->
        <table class="table table-striped">
            <tr>
                <th><p>Module Code</p><input type="text" class="form-control" id="ModCode"></th>
                <th><p>Module Name</p><input type="text" class="form-control" id="ModName"></th>
            </tr>
        </table>
        
        <button class="btn btn-danger float-right" onclick="window.location.href='?.php'">Create</button>
          </div>
        </div>
        </div>
      </div>

          </div>
        </div>
      </div>
  </body>
</html>