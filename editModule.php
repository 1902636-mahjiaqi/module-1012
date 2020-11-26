<!DOCTYPE html>
<html lang="en">
    <?php include "interface/head/head.php" ?>
    <?php include "interface/header/header.php" ?>

    <?php
    session_start();
    //for Session profID
    $profID = 1902676;
    $ModID = $_SESSION['ModID'];
    $totalWeight = 0;

    include "factory/editModulePro.php";
    ?>
    <!-- style for modal --> 
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        //used for DeleteAllSub
        var MainCompID1;
        //script to get Data from DB using Ajax
        function UpWeight(id, weightage) {
            //alert(id);
            //alert(weightage);
            //check to make sure total Weightage is not more than 100
            var TotalWeight = document.getElementById("TtlWt").innerHTML;
            var newInp = parseInt(document.getElementById("WT" + id).value);
            var newWeight = (TotalWeight - weightage) + newInp;
            if (newWeight > 100) {
                //error out
                alert("Total Weightage for module is above 100% (Current the total is " + newWeight + "%) Please ensure the total weightage is lesser than 100%");
                //reset weightage?
                document.getElementById("WT" + id).value = weightage;
                document.getElementById("Status" + id).innerHTML = "Reverted";
            } else {
                //POST to update weight into DB
                $.ajax({
                    url: "factory/UpdateWeight.php",
                    type: "POST",
                    //pass the data
                    data: {CompID: id, NewWei: newInp},
                    //success
                    success: function (data) {
                        //updated items
                        //Update onclick
                        document.getElementById("Uppy" + id).setAttribute( "onClick", "UpWeight("+ id +","+ newInp +")" );
                        document.getElementById("Status" + id).innerHTML = "Updated";
                        document.getElementById("TtlWt").innerHTML = newWeight;
                    }
                });


            }
        }
        function DeleteComp(id, type, title) {
            if (type === 0 || type === 2) {
                //confirm delete components without subcomponents or subcomponenets
                if (confirm("Are you sure your want to Delete: " + title)) {
                    $.ajax({
                        url: "factory/DeleteComp.php",
                        type: "POST",
                        //pass the data
                        data: {CompID: id},
                        //success
                        success: function (data) {
                            //updated items
                            //alert(data);
                            location.reload();
                        }
                    });
                } else {
                    //if cancel what happens?
                }
            }
            //if it is a componenets with sub componenets
            else {
                //use for DeleteAllSub()
                MainCompID1 = id;
                //populate popup modal main module
                document.getElementById("CompName").innerHTML = title;

                //get all subComponenets to display
                $.ajax({
                    url: "factory/getSubComp.php",
                    type: "POST",
                    //pass the data
                    data: {CompID: id},
                    //success
                    success: function (data) {
                        //updated items
                        //alert(data);
                        document.getElementById("SubCompNames").innerHTML = data;
                        //Popup Modal to display all componenets which will be deleted
                        modal.style.display = "block";
                    }
                });


            }

        }
        
        function DeleteAllSub(){
            //alert(MainCompID1);
            $.ajax({
                    url: "factory/DeleteSubComp.php",
                    type: "POST",
                    //pass the data
                    data: {CompID: MainCompID1},
                    //success
                    success: function (data) {
                        location.reload();
                    }
                });
        }
        
        function CreateSub(id, title, weightage) {
            //session for Components
            $.ajax({
                    url: "factory/SessionIDComp.php",
                    type: "POST",
                    //pass the data
                    data: {CompID: id, CompTitle: title, Weightage: weightage},
                    //success
                    success: function (data) {
                        window.location.href = "createSubComp.php"
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
                        <h5>Edit Modules</h5>
                    </div>

                    <!-- content -->
                    <div id="Top_Row">
                        <h2> <?php echo $_SESSION["ModTitle"] ?>
                            <button class="btn btn-success float-right" padding onclick="window.location.href = 'createComponent.php'">Add Components</button>
                        </h2>
                    </div>
                    <br>
                    <table class="table" id="DisplayModules">
                        <?php
                        //Codes to auto generate all modules from that prof
                        if ($success) {
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                //echo implode(" ",$row);
                                $CompTitle = $row['Title'];
                                $thisID = $row['CompID'];
                                $SubComType = $row['subComponentStatus'];
                                //If it is a Component without subcomponent
                                if ($SubComType == 0) {
                                    //title
                                    $totalWeight = $totalWeight + $row['Weightage'];
                                    echo "<tr>";
                                    echo "<div id='Row" . $i . "'><td><p>" . $row['Title'] . "</p></td>";
                                    echo "<td><input id='WT" . $row['CompID'] . "' type='number' min=0 max=100 value=" . $row['Weightage'] . "><p id='Status" . $row['CompID'] . "'></p></td>";
                                    echo '<td><button class="btn btn-danger float-right" onclick="DeleteComp(' . $row['CompID'] . ', ' . $row['subComponentStatus'] . ', \'' . $row['Title'] . '\')">Delete Component</button>';
                                    echo '<button id="Uppy'.$row['CompID'].'" class="btn btn-info float-right ml-2" onclick="UpWeight(' . $row['CompID'] . ', ' . $row['Weightage'] . ')">Update Weightage</button>';
                                    echo '<button class="btn btn-success float-right ml-2" onclick="CreateSub(' . $row['CompID'] . ',\''.$row['Title'].'\', '. $row['Weightage'] .')">Add SubComponenet</button></td>';
                                    echo "</tr>";
                                }
                                //If it is a component with subcomponents
                                elseif ($SubComType == 1) {
                                    echo "<tr><div id='Row" . $i . "'>";
                                    echo "<td><p>" . $row['Title'] . "</p></td>";
                                    echo "<td></td>";
                                    echo '<td><button class="btn btn-danger float-right" onclick="DeleteComp(' . $row['CompID'] . ', ' . $row['subComponentStatus'] . ', \'' . $row['Title'] . '\')">Delete Component</button>';
                                    echo '<button class="btn btn-success float-right ml-2" onclick="CreateSub(' . $row['CompID'] . ',\''.$row['Title'].'\',0 )">Add SubComponenet</button></td>';
                                    echo "</div></tr>";
                                    //reset $subResults so it searches from the start
                                    mysqli_data_seek($subResult, 0);
                                    //used to populate subcompoenents
                                    for ($s = 0; $s < $subResult->num_rows; $s++) {
                                        $subRow = $subResult->fetch_assoc();
                                        if ($subRow['MainCompID'] == $row['CompID']) {
                                            $totalWeight = $totalWeight + $subRow['Weightage'];
                                            echo "<tr><div id='SubRow" . $i . "'>";
                                            //Echo SubComp
                                            echo "<td><p>&nbsp&nbsp&nbsp&nbsp" . $subRow['Title'] . "</p></td>";
                                            //Echo Subcomp weightage
                                            echo "<td><input id='WT" . $subRow['CompID'] . "' type='number' min=0 max=100 value=" . $subRow['Weightage'] . "><p id='Status" . $subRow['CompID'] . "'></p></td>";
                                            //buttons
                                            echo '<td><button class="btn btn-danger float-right" onclick="DeleteComp(' . $subRow['CompID'] . ', ' . $subRow['subComponentStatus'] . ', \'' . $subRow['Title'] . '\')">Delete Subcomponent</button>';
                                            echo '<button id="Uppy'.$row['CompID'].'" class="btn btn-info float-right ml-2" onclick="UpWeight(' . $subRow['CompID'] . ', ' . $subRow['Weightage'] . ')">Update Weightage</button></td>';
                                            echo "</div></tr>";
                                        }
                                    }
                                }
                            }
                            // current total weightage
                            echo "<tr>";
                            echo "<td><p>Total Weightage</p></td>";
                            echo "<td><p id='TtlWt'>" . $totalWeight . "<p></td>";
                            echo "</tr>";
                        } else {
                            //No items in table
                            echo "No Components for this Module";
                        }
                        ?>
                    </table>

                    <!--<button class="btn btn-danger float-right" onclick="window.location.href = '?.php'">Update Weightage</button>-->
                </div>
            </div>
        </div>

        <!-- The Modal for multiple delete -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>ALERT Deleting the following component "<a id="CompName"> </a>" will also delete the following SubComponents: </p>
                <br>
                <p id="SubCompNames"></p>
                <button onclick="DeleteAllSub()">Confirm Delete</button>
                <button id="CancelAllDel">Cancel</button>
            </div>

        </div>
    </body>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        //Get button tp close Modal
        var btn = document.getElementById("CancelAllDel");

        // When the user clicks the cancel button it will close 
        btn.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    </script>
</html>