<?php
// Display Modules
//for Session profID
$profID = 1902676;

include "factory/moduleProcesses.php";
?>

<html lang="en">
    <head>
        <title> Professor Module </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">
        <!-- BootStrap include: this will include all needed files for BootStrap 4.3.1 -->
        <?php include "css/BootStp.php" ?>
        <script>//script to get Data from DB using Ajax
            function CreatePopup(){
                //add popup code for Create Module
            }
            function DeletePopup(){
                //add popup code for Delete Module
            }
            
            function DeleteModule(id) {
                //$.ajax({
                //    url: "factory/moduleProcesses.php", //the page containing php script
                //    type: "POST", //request type
                //    data: {modID:id},
                //    success: function (result) {
                //        alert(result);
                //    }
                //});
                alert(id);
            }
        </script>
    </head>
    <body>
        <div id="Top_Row">
            <h1>Manage Modules</h1>
            <button onlick='CreatePopup()'>Create Module</button>
        </div>

        <div class="container-fluid" id="GenerateModule">
            <?php
          //Codes to auto generate all modules from that prof
            if ($success) {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    echo "<div id='Row" . $i . "'><p>" . $row['Title'] . "</p>";
                    echo "<button href=''>Manage Class</button>
                        <button href=''>Edit Module</button>
                        <button onclick='DeletePopup()')>Delete Module</button>";
                    echo "</div>";
                }
            } else {
                //No items in table
                echo "No modules currently owned";
            }
            ?>

        </div>
    </body>

</html>

