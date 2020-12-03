<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php" ?>
  <?php include "interface/header/header.php" ?>
    

  <body class="bg-dark">
      <div class="container-fluid">
        <!-- student nav bar here -->
        <?php include "interface/header/stud_nav.php" ?>

        <div class="row justify-content-center">
        <div class="col-xl-8 jumbotron bg-white">
          <!-- header -->
          <div class="d-flex justify-content-between p-3">
            <h5>Student Student Formative Feedback</h5>
          </div>
          <!-- content -->
          <div class="p-3">
            <!-- insert module here -->
            
            <!-- insert loop of quiz here -->
            <table class="table table-borderless table-hover">
            <thead>
              <tr>
                <!-- insert component name here -->
                <th>Module</th>
                <th>Feedback</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "factory/getSumFeed.php";
                $PrGrade = "";
                foreach ($result as $a){
                    echo "<tr>";
                    echo "<td>".$a['Title']."</td>";
                    echo "<td>".$a['Comments']."</td>";
                    echo "</tr>";
                }
                
              ?>
            </tbody>
            </table>
          </div>
          </div>
        </div>
        </div>
      </div>

      <!-- new account modal -->
      <div class="modal fade" id="viewFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Feedback</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
              <!-- insert content here -->
              <div class="d-flex justify-content-between">
                <div class="formative">

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><h6>Formative Feedback</h6></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" cols="25" readonly></textarea>
                    </div>

                </div>
                <div class="summative">
                
                    <div class="form-group">
                        <label for="exampleFormControlTextarea2"><h6>Summative Feedback</h6></label>
                        <textarea class="form-control" id="exampleFormControlTextarea2" rows="10" cols="25" readonly></textarea>
                    </div>

                </div>
              </div>
              
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </div>
            <!-- end of modal -->

          </div>
        </div>
      </div>
  </body>
</html>