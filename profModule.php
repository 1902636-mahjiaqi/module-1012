<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php" ?>
  <?php include "interface/header/header.php" ?>

<?php
    // Professor default page
    //for Session profID
    $profID = 1902676;

    include "factory/moduleProcesses.php";
?>

<script>
  //script to get Data from DB using Ajax
    function CreatePopup(){
        //add popup code for Create Module
    }
    function DeleteMod(id, title){
        if (confirm("Are you sure you want to Delete: " + title + id)){
            //If they click "ok" it will run the codes here
        }
        else{
            //If they click Cancel it will run code here
        }
    }
</script>

  <body class="bg-dark">
      <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-xl-8 jumbotron bg-white">
          <!-- header -->
          <div class="d-flex justify-content-between p-3">
            <h5>Create Module</h5>
          </div>
          
          <!-- content -->
          <div id="Top_Row">
            <h2>Manage Modules
            <button class="btn btn-danger float-right" padding onclick="window.location.href='createModule.php'">Create Module</button>
            </h2>
        </div>
        <br>
        <table class="table" id="DisplayModules">
            <?php
          //Codes to auto generate all modules from that prof
            if ($success) {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $thisTitle = $row['Title'];
                    $thisID = $row['ModID'];
                    echo "<tr>";
                    echo "<div id='Row" . $i . "'><td><p>" . $row['Title'] . "</p></td>";
                    echo "<td><button class=\"btn btn-danger float-right ml-2\" onclick='DeleteMod(".$thisID.",\"".$thisTitle."\")'>Delete Module</button>
                         <button class=\"btn btn-info float-right ml-2\" href=''>Edit Module</button>
                         <button class=\"btn btn btn-warning float-right ml-2\" onclick=\"window.location.href='createModule.php'\">Manage Class</button></td>";
                    echo "</div></tr>";
                }
            } else {
                //No items in table
                echo "No modules currently owned";
            }
            ?>
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