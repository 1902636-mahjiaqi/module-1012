<?php
// Proffessors default page
//for Session profID
$profID = 1902676;

include "factory/moduleProcesses.php";
?>

<html lang="en">
    <head>
        <title> Professor Manage Module </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">
        <!-- BootStrap include: this will include all needed files for BootStrap 4.3.1 -->
        <?php include "interface/head/head.php" ?>
        <script>//script to get Data from DB using Ajax
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
    </head>
    <body>
        <div id="Top_Row">
            <h2>Manage Modules
            <button class="btn btn-Danger float-right" padding onclick="window.location.href='createModule.php'">Create Module</button>
            </h2>
        </div>
        <br>
        <table class="table table-striped" id="DisplayModules">
            <?php
          //Codes to auto generate all modules from that prof
            if ($success) {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $thisTitle = $row['Title'];
                    $thisID = $row['ModID'];
                    echo "<tr>";
                    echo "<div id='Row" . $i . "'><td><p>" . $row['Title'] . "</p></td>";
                    echo "<td><button class=\"btn btn-Danger float-right\" onclick='DeleteMod(".$thisID.",\"".$thisTitle."\")'>Delete Module</button>
                         <button class=\"btn btn-info float-right\" href=''>Edit Module</button>
                         <button class=\"btn btn btn-warning float-right\" onclick=\"window.location.href='createModule.php'\">Manage Class</button></td>";
                    echo "</div></tr>";
                }
            } else {
                //No items in table
                echo "No modules currently owned";
            }
            ?>
        </table>
    </body>

</html>

