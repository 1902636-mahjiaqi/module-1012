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
            <h5>Student Feedback/Result</h5>
          </div>
          <!-- content -->
          <div class="p-3">
            <!-- insert module here -->
            <button type="button" class="btn btn-primary" onclick="window.location.href='studSumFeed.php'">View Formative Feedback</button>
            <!-- insert loop of quiz here -->
            <table class="table table-borderless table-hover">
            <thead>
              <tr>
                <!-- insert component name here -->
                <th>Module</th>
                <th>Component</th>
                <th>Grade</th>
                <th>Feedback</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "factory/getFeedback.php";
                $PrGrade = "";
                foreach ($result as $a){
                    if($a['Grade'] >= 86){
                        $PrGrade = "A+";
                    }
                    else if($a['Grade'] >= 83 && $a['Grade'] < 85){
                        $PrGrade = "A";
                    }
                    else if($a['Grade'] >= 80 && $a['Grade'] < 82){
                        $PrGrade = "A-";
                    }
                    else if($a['Grade'] >= 77 && $a['Grade'] < 79){
                        $PrGrade = "B+";
                    }
                    else if($a['Grade'] >= 74 && $a['Grade'] < 76){
                        $PrGrade = "B";
                    }
                    else if($a['Grade'] >= 70 && $a['Grade'] < 73){
                        $PrGrade = "B-";
                    }
                    else if($a['Grade'] >= 66 && $a['Grade'] < 69){
                        $PrGrade = "C+";
                    }
                    else if($a['Grade'] >= 63 && $a['Grade'] < 65){
                        $PrGrade = "C";
                    }
                    else if($a['Grade'] >= 60 && $a['Grade'] < 62){
                        $PrGrade = "C-";
                    }
                    else if($a['Grade'] >= 53 && $a['Grade'] < 59){
                        $PrGrade = "D+";
                    }
                    else if($a['Grade'] >= 50 && $a['Grade'] < 52){
                        $PrGrade = "D";
                    }
                    else{
                        $PrGrade = "F";
                    }
                    
                    echo "<tr>";
                    echo "<td>".$a['MTitle']."</td>";
                    echo "<td>".$a['CTitle']."</td>";
                    echo "<td>".$PrGrade."</td>";
                    echo '<td><button id="BtnUpdate99" onclick="myFunction(\''.$a['Comments'].'\')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewFeedback" >View Feedback</button></td>';
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
                <div class="summative">
                
                    <div class="form-group">
                        <label for="exampleFormControlTextarea2"><h6>Summative Feedback</h6></label>
                        <textarea class="form-control" id="exampleFormControlTextarea2" rows="10" cols="25" readonly></textarea>
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
      <script>
          function myFunction(Num){
              //alert(Num);
              document.getElementById("exampleFormControlTextarea2").innerHTML = Num;
          }
      </script>
  </body>
</html>