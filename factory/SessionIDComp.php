<?php

session_start();
$_SESSION["CompID"] = $_POST['CompID'];
$_SESSION["CompTitle"] = $_POST['CompTitle'];
$_SESSION["IgnoreWeightage"] = $_POST['Weightage'];

echo "Success";

?>>