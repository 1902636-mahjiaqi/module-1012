<?php

session_start();
$_SESSION["ModID"] = $_POST['ModID'];
$_SESSION["ModTitle"] = $_POST['ModTitle'];

echo "Success";

?>>