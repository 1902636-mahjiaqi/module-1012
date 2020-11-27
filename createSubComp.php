<?php
include "factory/usersClass.php";
include_once "factory/usersInterface.php"; 

//ProfID
session_start();
$ProfID = $_SESSION['sessionToken']->getUser();

$ModID = $_SESSION["ModID"];
$MainCompID = $_SESSION['CompID'];
if (isset($IgnoreWeight)){
    $IgnoreWeight = $_SESSION['IgnoreWeightage'];
}
else {
    $IgnoreWeight = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
    <?php include "interface/head/head.php" ?>
    <?php include "interface/header/header.php" ?>
    <head>
        <script>
            function CreateSubComp() {
                var CompName = document.getElementById("SubCompNa").value;
                var CompWeight = document.getElementById("SubCompWei").value;
                //post to get total Weightage
                $.ajax({
                    url: "factory/getTotalWeight.php",
                    type: "POST",
                    //pass the data
                    data: {ModID: <?php echo $ModID ?>, CompID: <?php echo $MainCompID ?>},
                    //success
                    success: function (data) {
                        TotalW = (parseInt(data) + parseInt(CompWeight)) - <?php echo $IgnoreWeight ?>;
                        //alert(parseInt(data));
                        if (TotalW <= 100) {
                            //run insert code
                            $.ajax({
                                url: "factory/CreateSubComp.php",
                                type: "POST",
                                //pass the data
                                data: {ModID: <?php echo $ModID ?>, CompName: CompName, Weightage: CompWeight, Type: 2, CompID: <?php echo $MainCompID ?>},
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
                            document.getElementById("SubCompWei").value = avail;
                        }

                    }
                });

            }

            function CreateAnotherSubComp() {
                var CompName = document.getElementById("SubCompNa").value;
                var CompWeight = document.getElementById("SubCompWei").value;
                $.ajax({
                    url: "factory/getTotalWeight.php",
                    type: "POST",
                    //pass the data
                    data: {ModID: <?php echo $ModID ?>},
                    //success
                    success: function (data) {
                        TotalW = (parseInt(data) + parseInt(CompWeight)) - <?php echo $IgnoreWeight ?>;
                        //alert(parseInt(data));
                        if (TotalW <= 100) {
                            //run insert code
                            $.ajax({
                                url: "factory/CreateSubComp.php",
                                type: "POST",
                                //pass the data
                                data: {ModID: <?php echo $ModID ?>, CompName: CompName, Weightage: CompWeight, Type: 2, CompID: <?php echo $MainCompID ?>},
                                //success
                                success: function (data) {
                                    //insert completed
                                    alert(data);
                                    window.location.href = "createSubComp.php";
                                }
                            });
                        } else {
                            //run error code
                            var avail = 100 - parseInt(data);
                            var message = "Total Weightage is over 100% (" + data + "%) Max percenntage available is " + avail;
                            alert(message);
                            //set weightage to max available points
                            document.getElementById("SubCompWei").value = avail;
                        }

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
                        <h5>Add SubComponent to: <a id="MainCompName"><?php echo $_SESSION['CompTitle'] ?></a></h5>
                    </div>

                    <!-- content -->
                    <table class="table table-striped">
                        <tr>
                            <th><p>SubComponent Name</p><input id="SubCompNa" type="text" class="form-control" id="ModCode"></th>
                            <th><p>SubComponent Weightage</p><input id="SubCompWei" type="number" min="0" max="100" class="form-control" id="ModName"></th>
                        </tr>
                    </table>
                    <button class="btn btn-success float-right" onclick="CreateSubComp()">Create SubComponent</button>
                    <button class="btn btn-warning float-right" onclick="CreateAnotherSubComp()">Create SubComponent and add another SubComponent</button>
                </div>
            </div>
        </div>
    </body>
</html>