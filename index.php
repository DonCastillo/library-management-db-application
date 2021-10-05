<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample</title>
</head>
<body>
    <?php
        include "partials/heading.php";
    ?>
    <?php

        // $DB_HOST = "localhost";
        // $DB_USER = "root";
        // $DB_PASS = "sql29059";
        // $DB      = "library_management";
        
        // $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB) or
        // die("Connection failed: %s\n".$conn->error);

        // $sql = "SELECT * FROM AUTHOR";

        // echo "<h2>Records</h2>";
        // $result = $conn->query($sql);
        // if ($result->num_rows != 0)
        // {
        //     while($val = $result->fetch_assoc()) 
        //     {
        //         echo $val['firstName'] . " " . $val['lastName'] . "<br />";
        //     }
        // }

    ?>
        <?php
        include "partials/footer.php";
    ?>
</body>
</html>

