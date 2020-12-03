<!DOCTYPE html>
<html lang="en">
<?php include_once "factory/usersClass.php";
include_once "factory/usersInterface.php";?>
<?php include "interface/head/head.php" ?>
<?php include "interface/header/header.php" ?>

<?php

//session_start();
//for Session profID
  if (!isset($_SESSION['sessionToken'])) {
      session_unset();
      $_SESSION = array();
      session_destroy();
      header('Location:index.php');
    }

    else {
      if ($_SESSION['sessionToken']->getUserType() == "2") {
        header("Location:studDashboard.php");
      }
      else if ($_SESSION['sessionToken']->getUserType() == "0") {
        header("Location:adminDashboard.php");
      }
    }

    if (isset($_SESSION['status'])) {
      if ($_SESSION['status'] - time() < 1800) {
        $_SESSION['status'] = time();
      }
      else {
        unset_session();
        $_SESSION = array();
        session_destroy();
        header('Location:index.php');
      }
    }


$profID = $_SESSION['sessionToken']->getUser();



//check for entering new mod
if($_SESSION["NewMod"] == 1){
    $_SESSION["NewMod"] = 0;
    unset($_SESSION['CompID']);
}

$ModID = $_SESSION['ModID'];
if (isset($_SESSION['CompID'])){
    $CompID = $_SESSION['CompID'];
}
//$_SESSION["ModTitle"] = "How Not to Buy Apple";
if (!empty($CompID)) {
    $CompID = $_SESSION['CompID'];
}

if ($_SESSION['error'] == 1){
    echo "<script> alert('Non csv document uploaded error') </script>";
    $_SESSION['error'] = 0;
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
                    <button class="upload_btn btn btn-success float-right" data-toggle="modal" data-target="#uploadFileModal">Upload Class List</button>

                    <div id="uploadFileModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">File upload form</h4>
                          </div>
                          <div class="modal-body">
                            <!-- Form -->
                            <form method='POST' action='_uploadCL.php' enctype="multipart/form-data">
                              Select file : <input type='file' name='file' id='file' class='form-control' ><br>
                              <input type='submit' name="submit" class='btn btn-info' value='Upload' id='btn_upload'>
                            </form>

                            <!-- Preview-->
                            <div id='preview'></div>
                          </div>
                     
                        </div>

                      </div>
                    </div>


                    <!-- <button class=" btn btn-success float-right" data-toggle="modal" data-target="#myModal">Upload Class List</button> -->
                </h4>
                <form class="form-inline mr-auto mb-4" method="post">
                    <div class="dropdown">

                        <select name="component" onchange="ChangeComponent(component.value)">
                            <?php
                            if (!isset($_SESSION['CompID'])) {
                                echo "<option disabled selected>" . "Select a Component..." . "</option>";
                            }
                            if ($success) {
                                // echo "<option disabled selected>" . "Select Component..." . "</option>";
                                for ($i = 0; $i < $subResult->num_rows; $i++) {
                                    $row = $subResult->fetch_assoc();
                                    $thisTitle = $row['Title'];
                                    $thisWeightage = $row['Weightage'];
                                    $thisID = $row['ID'];
                                    if ($row['CompID'] == $_SESSION['CompID']) {
                                        echo "<option value='" . $row["CompID"] . "' selected>" . $thisTitle . " (" . $thisWeightage . "%) </option>";
                                    }
                                    else {
                                        echo "<option value=" . $row['CompID'] . ">" . $thisTitle . " (" . $thisWeightage . "%)" . "</option>";
                                    }
                                }
                            }

                            // echo "<input type='submit' onclick=\"Component(component)\" value='Submit'>";

                            //echo "<button class=\"btn btn-info float-right ml-2\" onclick='EditMod(" . $thisID . ",\"" . $thisTitle . "\")'>Load Component</button>";
                            //echo"$value";
                            ?>
                        </select>

                        <!-- &nbsp;<button class="btn btn-success float-right" onclick="Test(component.value)">Submit</button> -->
                    </div>
                    <!-- <input class="form-control mr-sm-2 ml-5" type="text" name="text" id="stringInput" placeholder="Search Student..." aria-label="Search" onkeyup="SearchStudent()" /> -->

                    <!-- <button class="btn btn-outline-success btn-rounded" type="submit">Search</button> -->
                </form>

                <h4> <?php
                        /*if (!empty($CompID)) {
                            echo $_SESSION["CompTitle"];
                        }*/
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
                            <th style='text-align:center'>Feedback Published</th>
                            <th style='text-align:center'>Grades Published</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Generate Class List with Names, Emails, Marks
                        if ($success and isset($_SESSION['CompID'])) {
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $row = $result->fetch_assoc();
                                $thisName = $row['Name'];
                                $thisEmail = $row['Email'];
                                $thisStudID = $row['StudID'];
                                
                                include_once "_dbconn.php";

                                $sql1 = "SELECT * FROM feedback where StudID = $thisStudID AND ModID = $ModID AND CompID = $CompID";
                                $result1 = $conn->query($sql1);

                                if ($result1->num_rows == 1) {
                                    $row1 = $result1->fetch_assoc();
                                    $thisComment = $row1['Comments'];
                                    $thisPublished = $row1['Publish'];
                                }

                                $sql2 = "SELECT * FROM grades where StudID = $thisStudID and CompID = $CompID";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows == 1) {
                                    $row2 = $result2->fetch_assoc();
                                    $thisGradesPublished = $row2['Publish'];
                                }


                                echo "<tr>";
                                echo "<td><input class='chkbox' type=" . 'checkbox' . " name='studentID' value=" . $row['AccID'] . " /></td>";
                                echo "<td>" . $row['Name'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td style='padding:5px'>";

                                echo "<div>" . $row['Grade'] . " ";
                                echo "<button type='button' class='btn btn-outline-primary float-right' data-toggle='modal' data-target='#gradesModal" .$thisStudID. "'>";
                                echo "<svg width='1em' height='1em' viewBox='0 0 20 20' class='bi bi-pencil' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
                                echo "<path fill-rule='evenodd' d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/> </svg>";
                                echo "</button> </div>";
                                echo "</td>";
                                echo "<td style='text-align:center'>";
                                if ($thisPublished == 1) {
                                    echo "<input type='checkbox'  id='" .$thisStudID. "published' checked>";
                                }
                                else {
                                    echo "<input type='checkbox' id='" .$thisStudID. "published'>";
                                }

                                echo "<script> document.getElementById('" .$thisStudID. "published').disabled = true </script>";
                                echo "</td> <td style='text-align:center'>";
                                if ($thisGradesPublished == 1) {
                                    echo "<input type='checkbox'  id='" .$thisStudID. "gradesPublished' checked>";
                                }
                                else {
                                    echo "<input type='checkbox' id='" .$thisStudID. "gradesPublished'>";
                                }
                                echo "</td> <td>";
                                echo "<script> document.getElementById('" .$thisStudID. "gradesPublished').disabled = true </script>";
                                echo '<button class="btn btn-info float-left" data-toggle="modal"';
                                echo 'data-target="#myModal-sm' .$thisStudID. '">Summative Feedback </button>';
                                echo "<div>";
                                echo "<div class='modal fade' id='myModal-sm" .$thisStudID. "' role='dialog'>";
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

                                echo "<div id='gradesModal" .$thisStudID. "' class='modal fade' role='dialog'>";
                                echo "<div class='modal-dialog'>";
                                echo "<div class='modal-content'>";
                                echo "<div class='modal-header'>";
                                echo "<h4 class='modal-title'> Edit Grades </h4>";
                                echo "<button type='button' class='close' data-dismiss='modal'> &times; </button> </div>";
                                echo "<div class='modal-body'> <input type='number' id='" .$thisStudID. "grades' min='1' max='100' value='" .$row['Grade']. "'> </div>";
                                echo "<div class='modal-footer'>";
                                echo "<button type='button' class='btn btn-success float-right' onclick='EditGrades(" .$thisStudID. ", " .$CompID. ")'>Submit</button> </div>";
                                echo "</div> </div> </div>";
                                

                                echo "</td>";
                                echo "<script> document.getElementById('" .$thisStudID. "summative').value = '" .$thisComment. "' </script>";
                                //echo "<script> document.getElementById('" .$thisStudID. "grades').value = '" .$thisGrades. "' </script>";                                
                            }
                        }
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
                <br>
                <?php
                if (isset($_SESSION['CompID'])) {
                    echo "<button class='btn btn-danger float-right ml-2' onClick='DeleteStudents($ModID)'>Delete Selected Student Account</button>";
                    echo "<button class='btn btn-success float-right ml-2'  onclick='PublishGrades($CompID)'>Publish Grades to Selected students</button>";
                    echo "<button class='btn btn-info float-right' data-toggle='modal' data-target='#myModal' onclick='PublishFeedback($CompID)'>Publish Feedback to Selected Students</button>";
                }

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
                    //updated items
                    location.reload();
                }
            })
        }

        function EditGrades(s_id, c_id) {
            var temp = s_id + "grades";
            var newG = document.getElementById(temp).value
            if (newG < 0 || newG > 100){
                alert("Invalid Marks Entered (0 - 100 only)");
                return 0;
            }
            $.ajax({
                url: "factory/editGrades.php",
                type: "POST",
                data: {
                    grades: document.getElementById(temp).value,
                    StudID: s_id,
                    CompID: c_id
                },
                success: function(result) {
                    //updated items
                    location.reload();
                }
            })
        }

        function ChangeComponent(c_id) {
            //alert(c_id);
            $.ajax({
                url: "factory/SessionIDComp2.php",
                type: "POST",
                data: {
                    CompID: c_id
                },
                success: function(data) {
                    //alert(data);
                    location.reload();
                    //updated items
                    //tell the page not to reset page fully
                    $_SESSION["NewMod"] = 0;
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
                var selectedStudents = $(".chkbox:checked").map(function() {
                    return this.value;
                }).toArray();
                //alert(c_id);
                $.ajax({
                        url: "factory/publishGrades.php",
                        type: "POST",
                        data: {
                            CompID: c_id,
                            students: selectedStudents
                        },
                        success: function(result) {
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
                        location.reload();
                    }
                })
                
            }
        }

        function DeleteStudents(m_id) {
            if (confirm("Confirm delete selected students?")) {
                var selectedStudents = $(".chkbox:checked").map(function() {
                    return this.value;
                }).toArray();
                $.ajax({
                    url: "factory/deleteStudents.php",
                    type: "POST",
                    data: {
                        ModID: m_id,
                        students: selectedStudents
                    },
                    success: function(data) {
                        location.reload();
                    }
                })
                
            }
        }
    </script>


</body>

</html>