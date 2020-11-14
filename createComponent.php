<?php

?>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <!-- BootStrap include: this will include all needed files for BootStrap 4.3.1 -->
        <?php include "interface/head/head.php" ?>
    </head>
    <body>
        <h2>Create Component</h2>
        <table class="table table-striped">
            <tr>
                <td><p>Component Name</p><input type="text" id="ComName"></td>
                <td><p>Component Weightage</p><input type="text" id="ComWei"></td>
            </tr>
        </table>
        
        <button class="btn btn-danger float-right" onclick="window.location.href='??.php'">Create</button>
    </body>
</html>
