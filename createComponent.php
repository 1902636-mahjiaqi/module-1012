<?php
//profID
session_start();
$ProfID = 1902676;
$ModID = $_SESSION["ModID"];
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "interface/head/head.php" ?>
    <?php include "interface/header/header.php" ?>
    <head>
        <script>
            function CreateComp() {
                var CompName = document.getElementById("CompNa").value;
                var CompWeight = document.getElementById("CompWei").value;
                $.ajax({
                    url: "factory/getTotalWeight.php",
                    type: "POST",
                    //pass the data
                    data: {ModID: <?php echo $ModID ?>},
                    //success
                    success: function (data) {
                        TotalW = parseInt(data) + parseInt(CompWeight);
                        //alert(parseInt(data));
                        if (TotalW <= 100) {
                            //run insert code
                            $.ajax({
                                url: "factory/CreateComp.php",
                                type: "POST",
                                //pass the data
                                data: {ModID: <?php echo $ModID ?>, CompName: CompName, Weightage: CompWeight, Type: 0},
                                //success
                                success: function (data) {
                                    //insert completed
                                    alert(data);
                                    window.location.href = "editModule.php";
                                }
                            });
                        } else {
                            //run error code
                            var avail = 100 - parseInt(data);
                            var message = "Total Weightage is over 100% (" + data + "%) Max percenntage available is " + avail;
                            alert(message);
                            //set weightage to max available points
                            document.getElementById("CompWei").value = avail;
                        }

                    }
                });
            }

            function CreateCompAndSub() {
                var CompName = document.getElementById("CompNa").value;
                var CompWeight = document.getElementById("CompWei").value;
                //create Component with no weightage
                $.ajax({
                    url: "factory/CreateComp.php",
                    type: "POST",
                    //pass the data
                    data: {ModID: <?php echo $ModID ?>, CompName: CompName, Weightage: 0, Type: 1},
                    //success
                    success: function (data) {
                        //insert completed
                        alert(data);
                        window.location.href = "createSubComp.php";
                    }
                });
            }
        </script>
    </head>
    <body class="bg-dark">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 jumbotron bg-white">
                    <!-- header -->
                    <div class="d-flex justify-content-between pt-3 pb-3">
                        <h5>Add Component</h5>
                    </div>

                    <!-- content -->
                    <table class="table table-striped">
                        <tr>
                            <th><p>Component Name</p><input id="CompNa" type="text" class="form-control" id="ModCode"></th>
                            <th><p>Component Weightage</p><input id="CompWei" type="number" min="0" max="100" class="form-control" id="ModName"></th>
                        </tr>
                    </table>
                    <button class="btn btn-success float-right ml-2" onclick="CreateComp()">Create Component</button>
                    <button class="btn btn-warning float-right ml-2" onclick="CreateCompAndSub()">Create and add SubComponent</button>
                </div>
            </div>
        </div>
    </body>
</html>