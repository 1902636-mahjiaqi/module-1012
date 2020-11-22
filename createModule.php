<?php
//profID
$ProfID = 1902676;
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "interface/head/head.php" ?>
    <?php include "interface/header/header.php" ?>
    <head>
        <script>
            function CreateMod() {
                var ModCode = document.getElementById("ModCo").value;
                var ModName = document.getElementById("ModNa").value;
                var Title = ModCode + " " + ModName;

                $.ajax({
                    url: "factory/CreateMod.php",
                    type: "POST",
                    //pass the data
                    data: {ProfID: <?php echo $ProfID ?>, Title: Title},
                    //success
                    success: function (data) {
                        alert(data);
                        window.location.href = "profModule.php";
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
                        <h5>Create Module</h5>
                    </div>

                    <!-- content -->
                    <table class="table table-striped">
                        <tr>
                            <th><p>Module Code</p><input id="ModCo" type="text" class="form-control" id="ModCode"></th>
                            <th><p>Module Name</p><input id="ModNa" type="text" class="form-control" id="ModName"></th>
                        </tr>
                    </table>
                    <button class="btn btn-success float-right" onclick="CreateMod()">Create Module</button>
                </div>
            </div>
        </div>
    </body>
</html>