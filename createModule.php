<?php

?>
<html>
    <head>
        <title>Create Module</title>
        <meta charset="UTF-8">
        <!-- BootStrap include: this will include all needed files for BootStrap 4.3.1 -->
        <?php include "interface/head/head.php" ?>
    </head>
    <body>
        <h2>Create Module</h2>
        
        <table class="table table-striped">
            <tr>
                <td><p>Module Code</p><input type="text" id="ModCode"></td>
                <td><p>Module Name</p><input type="text" id="ModName"></td>
            </tr>
        </table>
        
        <button class="btn btn-danger float-right" onclick="window.location.href='?.php'">Create</button>
    </body>
</html>