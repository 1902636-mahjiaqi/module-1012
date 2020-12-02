<!DOCTYPE html>
<?php 
include "factory/usersClass.php";
include_once "factory/usersInterface.php"; 
?>
<html lang="en">
    <?php include "interface/head/head.php" ?>
    <?php include "interface/header/header.php" ?>

    <?php
    // Professor default page
    //for Session profID
    // session_start();
    
    $profID = $_SESSION['sessionToken']->getUser();

    include "factory/moduleProcesses.php";
    ?>

    <script>
        //script to get Data from DB using Ajax
        function CreatePopup() {
            //add popup code for Create Module
        }
        function DeleteMod(id, title) {
            if (confirm("Are you sure you want to Delete: " + title + id)) {
                //If they click "ok" it will run delete code
                $.ajax({
                    url: "factory/DeleteMod.php",
                    type: "POST",
                    //pass the data
                    data: {ModID: id},
                    //success
                    success: function (data) {
                        //updated items
                        location.reload();
                    }
                });
            } else {
                //If they click Cancel it will run code here
            }
        }

        function EditMod(id, title) {
            $.ajax({
                url: "factory/SessionIDMod.php",
                type: "POST",
                //pass the data
                data: {ModID: id, ModTitle: title},
                //success
                success: function (data) {
                    //updated items
                    window.location.href = "editModule.php";
                }
            });
        }

        function ManageClass(id, title) {
            $.ajax({
                url: "factory/SessionIDMod.php",
                type: "POST",
                //pass the data
                data: {ModID: id, ModTitle: title},
                //success
                success: function (data) {
                    //updated items
                    window.location.href = "manageCL.php";
                }
            });
        }
    </script>

    <body class="bg-dark">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 jumbotron bg-white">
                    <!-- header -->
                    <div class="d-flex justify-content-between pt-3 pb-3">
                        <h5>Create Module</h5>
                    </div>

                    <!-- content -->
                    <div id="Top_Row">
                        <h2>Manage Modules
                            <button class="btn btn-success float-right" padding onclick="window.location.href = 'createModule.php'">Create Module</button>
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
                                echo "<td><button class=\"btn btn-danger float-right ml-2\" onclick='DeleteMod(" . $thisID . ",\"" . $thisTitle . "\")'>Delete Module</button>
                         <button class=\"btn btn-info float-right ml-2\" onclick='EditMod(" . $thisID . ",\"".$thisTitle."\")'>Edit Module</button>
                         <button class=\"btn btn btn-warning float-right ml-2\" onclick='ManageClass(" . $thisID . ",\"".$thisTitle."\")'>Manage Class</button></td>";
                                echo "</div></tr>";
                            }
                        } else {
                            //No items in table
                            echo "No modules currently owned";
                        }
                        ?>
                    </table>

                </div>
            </div>
        </div>
    </body>
</html>