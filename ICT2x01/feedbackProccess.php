<?php
include "dbconn.php";

function insForFB(){
    $sql = "INSERT STATEMENT";
    
    if($conn->query($sql)==TRUE){
        echo "Summative Feedback Added";
        echo "<script type='text/javascript'>alert('Summative Feedback Added');</script>";
    }
    else{
        echo "Error: ".$conn->error;
    }
}

function insSumFB(){
    
}

