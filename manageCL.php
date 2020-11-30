<!DOCTYPE html>
<html lang="en">
<?php include "interface/head/head.php" ?>
<?php include "interface/header/header.php" ?>

<?php
//session_start();
//for Session profID
$profID = 1902676;

//$_SESSION['CompID'] = 60;
$CompID = $_SESSION['CompID'];
//$_SESSION['ModID'] = 1;
// $ModID = 1;
$ModID = $_SESSION['ModID'];
//$_SESSION["ModTitle"] = "How Not to Buy Apple";
if (!empty($CompID)) {
    $CompID = $_SESSION['CompID'];
}

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
                    <button class="btn btn-info float-right ml-2" data-toggle="modal" data-target="#myModal-fb">Formative Feedback</button>

                    <!-- <input class="btn btn-success float-right" type="file" accept=".xlxs"> -->
                    <button class="upload_btn btn btn-success float-right">Upload Class List</button>
                    <input id="html_btn" class="display-none" type='file' /><br>

                    <!-- <button class=" btn btn-success float-right" data-toggle="modal" data-target="#myModal">Upload Class List</button> -->
                </h4>
                <form class="form-inline mr-auto mb-4" method="post">
                    <div class="dropdown">

                        <select name="component" onchange="ChangeComponent(component.value)">
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
                                }
                            }

                            // echo "<input type='submit' onclick=\"Component(component)\" value='Submit'>";

                            //echo "<button class=\"btn btn-info float-right ml-2\" onclick='EditMod(" . $thisID . ",\"" . $thisTitle . "\")'>Load Component</button>";
                            //echo"$value";
                            ?>
                        </select>

                        <!-- &nbsp;<button class="btn btn-success float-right" onclick="Test(component.value)">Submit</button> -->
                    </div>
                    <input class="form-control mr-sm-2 ml-5" type="text" name="text" id="stringInput" placeholder="Search Student..." aria-label="Search" onkeyup="SearchStudent()" />

                    <!-- <button class="btn btn-outline-success btn-rounded" type="submit">Search</button> -->
                </form>

                <h4> <?php
                        if (!empty($CompID)) {
                            echo $_SESSION["CompTitle"];
                        }
                        ?> </h4>
                <table class="table table-striped table-hover" id="mytable">
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
                                $thisStudID = $row['StudID'];
                                echo "<tr>";
                                echo "<td><input class='chkbox' type=" . 'checkbox' . " name='studentID' value=" . $row['AccID'] . " /></td>";
                                echo "<td>" . $row['Name'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>";
                                if (empty($row['Grade'])) {
                                    echo "-----";
                                } else {
                                    echo "<div class='edit'>" . $row['Grade'] . ' ';
                                    echo '<a href="#"><i class="fa fa-pencil text-dark" ></i></a>';
                                    echo "</div></td>";
                                    echo "<td>";
                                    echo '<button class="btn btn-info float-left" data-toggle="modal"';
                                    echo 'data-target="#myModal-sm">Summative Feedback </button>';
                                    echo "<div>";
                                    echo "<div class='modal fade' id='myModal-sm' role='dialog'>";
                                    echo "<div class='modal-dialog'>";
                                    echo "<div class='modal-content'>";
                                    echo "<div class='modal-header'>";
                                    echo "<h4 class='modal-title'> Summative Feedback </h4>";
                                    echo "<button type='button' class='close' data-dismiss='modal'> &times; </button>";
                                    echo "</div>";
                                    echo "<div class='modal-body'>";
                                    echo "<form method='post'>";
                                    echo "<textarea id='" .$thisStudID. "summative' class='form-control' name='summative' rows='7' style='width:100%'>";
                                    echo "</textarea>";
                                    echo "</form>";
                                    echo "</div>";
                                    echo "<div class='modal-footer'>";
                                    echo "<button class='btn btn-success float-right' onclick='SaveSummative(" . $thisStudID . ", " . $ModID . ", " . $CompID . ")'> Submit </button> ";
                                    echo "</div> </div> </div> </div>";
                                }

                                echo "</td>";
                            }
                        }
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
                <br>
                <?php
                echo "<button class='btn btn-danger float-right ml-2'>Delete Selected Student Account</button>";
                echo "<button class='btn btn-success float-right ml-2' data-toggle='modal' data-target='#myModal' onclick='PublishGrades($CompID)'>Publish Grades to All students</button>";
                echo "<button class='btn btn-info float-right' data-toggle='modal' data-target='#myModal' onclick='PublishFeedback($CompID)'>Publish Feedback to Selected Students</button>";
                ?>
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
                            <form action="?" method="post">
                                <textarea id="formative" class="form-control" name="formative" rows="7" style="width: 100%;">
                                </textarea>
                                <div class="modal-footer">
                                    <?php echo "<button class='btn btn-success float-right' onclick='SaveFormative(formative.value, $ModID, $CompID)'>Submit</button>" ?>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- end of content -->
        </div>
    </div>

    <script>
        $(".fa").click(function() {
            $('div.edit').replaceWith($('<input>' + $('div.edit').innerHTML + '</input>'));
        });

        $('.upload_btn').on("click", function() {
            $('#html_btn').click();
        });

        function SaveFormative(feedback, m_id, c_id) {
            $.ajax({
                url: "factory/saveFormativeFeedback.php",
                type: "POST",
                data: {
                    comments: feedback,
                    ModID: m_id,
                    CompID: c_id
                },
                success: function(result) {
                    alert(result);
                    //updated items
                    location.reload();
                },

                error: function() {
                    alert('There was some error performing the AJAX call!');
                }

            })
        }

        function SaveSummative(s_id, m_id, c_id) {
            var temp = s_id + "summative";
            $.ajax({
                url: "factory/saveSummativeFeedback.php",
                type: "POST",
                data: {
                    comments: document.getElementById(temp).value,
                    StudID: s_id,
                    ModID: m_id,
                    CompID: c_id
                },
                success: function(result) {
                    alert(result);
                    //updated items
                    location.reload();
                }
            })
        }

        function ChangeComponent(c_id) {
            //alert(c_id);
            $.ajax({
                url: "factory/SessionIDComp.php",
                type: "POST",
                data: {
                    CompID: c_id
                },
                success: function(data) {
                    //updated items
                    location.reload();
                }
            })
        }

        function SearchStudent() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("stringInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function PublishGrades(c_id) {
            if (confirm("Confirm Publish Grades to All Students?")) {
                //alert(c_id);
                $.ajax({
                        url: "factory/publishGrades.php",
                        type: "POST",
                        data: {
                            CompID: c_id
                        },
                        success: function(result) {
                            alert(result);
                            //updated items
                            location.reload();
                        }
                    
                })
            }
        }

        function PublishFeedback(c_id) {
            if (confirm("Confirm Publish Feedback to selected students?")) {
                var selectedStudents = $(".chkbox:checked").map(function() {
                    return this.value;
                }).toArray();
                $.ajax({
                    url: "factory/publishFeedback.php",
                    type: "POST",
                    data: {
                        CompID: c_id,
                        students: selectedStudents
                    },
                    success: function(result) {
                        alert(result);
                        location.reload();
                    }
                })
                
            }
        }
    </script>


</body>

</html>