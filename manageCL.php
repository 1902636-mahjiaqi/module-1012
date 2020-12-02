<!DOCTYPE html>
<html lang="en">
<?php include "interface/head/head.php" ?>
<?php include "interface/header/header.php" ?>

<?php
session_start();
//for Session profID
$profID = 1902676;
$CompID = 21;
$ModID = $_SESSION['ModID'];
// if (!empty($CompID)) {
//     $CompID = $_SESSION['CompID'];
// }

include "factory/getClassList.php";
?>


<body class="bg-dark">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8 jumbotron bg-white">
                <!-- header -->
                <div class="d-flex justify-content-between pt-3 pb-3">
                    <h5>Manage Class List</h5>
                </div>

                <!-- content -->
                <h4> <?php echo $_SESSION["ModTitle"] ?>
                    <button class="btn btn-info float-right ml-2" data-toggle="modal" data-target="#myModal-fb">Formative Feedback </button>

                    <!-- <input class="btn btn-success float-right" type="file" accept=".xlxs"> -->
                    <div class="upload_btn btn btn-success float-right">Upload Class List</div>
                    <input id="html_btn" class="display-none" type='file' /><br>

                    <!-- <button class=" btn btn-success float-right" data-toggle="modal" data-target="#myModal">Upload Class
                    List</button> -->
                </h4>
<<<<<<< Updated upstream
                <form class="form-inline mr-auto mb-4">
                    <div class="dropdown">

                        <select name="component">.
                            <form action="page2.php" method="post">
                                <?php
                                if ($success) {
                                    echo "<option disabled selected>" . "Select Component..." . "</option>";
                                    for ($i = 0; $i < $subResult->num_rows; $i++) {
                                        $row = $subResult->fetch_assoc();
                                        $thisTitle = $row['Title'];
                                        $thisWeightage = $row['Weightage'];
                                        $thisID = $row['ID'];

                                        echo "<option value=" . $row['Title'] . ">" . $thisTitle . " (" . $thisWeightage . "%)" . "</option>";
                                    }
=======
                <form class="form-inline mr-auto mt-3" method="post">
                    <div class="dropdown">
                        <select class="form-control" name="component" onchange="ChangeComponent(component.value)">
                            <?php
                            echo "<option disabled selected>" . "Select a Component..." . "</option>";
                            if ($success) {
                                // echo "<option disabled selected>" . "Select Component..." . "</option>";
                                for ($i = 0; $i < $subResult->num_rows; $i++) {
                                    $row = $subResult->fetch_assoc();
                                    $thisTitle = $row['Title'];
                                    $thisWeightage = $row['Weightage'];
                                    $thisID = $row['ID'];

                                    echo "<option value=" . $row['CompID'] . ">" . $thisTitle . " (" . $thisWeightage . "%)" . "</option>";
>>>>>>> Stashed changes
                                }
                                echo "<input type='submit'  value='Submit'>";
                                //echo "<button class=\"btn btn-info float-right ml-2\" onclick='EditMod(" . $thisID . ",\"" . $thisTitle . "\")'>Load Component</button>";
                                ?>

                        </select>
                    </div>
<<<<<<< Updated upstream
                    <input class="form-control mr-sm-2 ml-2" type="text" placeholder="Search" aria-label="Search" align="center" />
                    <button class="btn btn-outline-success btn-rounded" type="submit">Search</button>
=======
                    <!-- <input class="form-control mr-sm-2 ml-5" type="text" name="text" id="stringInput" placeholder="Search Student..." aria-label="Search" onkeyup="SearchStudent()" /> -->

                    <!-- <button class="btn btn-outline-success btn-rounded" type="submit">Search</button> -->
>>>>>>> Stashed changes
                </form>

                <!-- <h4> <?php
                        if (!empty($CompID)) {
                            echo $_SESSION["CompTitle"];
                        } ?> </h4> -->
                <table class="table table-striped table-hover" id=" mytable">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectall" onClick="selectAll(this)" />
                                <ul>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Marks</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Generate Class List with Names, Emails, Marks
                        if ($success) {
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                $thisName = $row['Name'];
                                $thisEmail = $row['Email'];
                                echo "<tr>";
                                echo "<td><input type=" . 'checkbox' . " name=" . $row['Name'] . " /></td>";
                                echo "<td>" . $row['Name'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>";
                                if (empty($row['Grade'])) {
                                    echo "-----";
                                } else {
                                    echo $row['Grade'];
                                    echo '<a href="#"><i class="fa fa-pencil text-dark"></i></a>';
                                    echo "</td>";
                                    echo "<td>";
                                    echo '<button class="btn btn-info float-left" data-toggle="modal"';
                                    echo 'data-target="#myModal-sm">Summative Feedback </button>';
                                }


                                echo "</td>";
                            }
                        }
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
                <br>
                <button class="btn btn-danger float-right ml-2">Delete Selected Student Account </button>
                <button class="btn btn-success float-right ml-2" data-toggle="modal" data-target="#myModal">Publish
                    Grades To all students</button>
                <button class="btn btn-info float-right" data-toggle="modal" data-target="#myModal">Send feedback to
                    selected students</button>
            </div>
            <!-- Formative Feedback Form -->
            <div class="modal fade" id="myModal-fb" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Formative Feedback</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="/action_page.php">
                                <textarea id="summative" class="form-control" name="summative" rows="7" style="width: 100%;">
                                </textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Summative Feedback Form -->
            <div class="modal fade" id="myModal-sm" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Summative Feedback</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="/action_page.php">
                                <textarea id="summative" class="form-control" name="summative" rows="7" style="width: 100%;">
                                </textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of content -->
        </div>
    </div>

    <script>
        $('.upload_btn').on("click", function() {
            $('#html_btn').click();
        });

        function ManageClass(id, title) {
            $.ajax({
                url: "factory/SessionIDComp.php",
                type: "POST",
                //pass the data
                data: {
                    CompID: id,
                    CompTitle: title
                },
                //success
                success: function(data) {
                    //updated items
                    location.reload();
                }
            });
        }
    </script>

</body>

</html>