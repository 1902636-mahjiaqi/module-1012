<?php

session_start();
//compare if mod change
$_SESSION["ModID"] = $_POST['ModID'];
$_SESSION["ModTitle"] = $_POST['ModTitle'];
$_SESSION["NewMod"] = 1;

echo "Success";

?>>