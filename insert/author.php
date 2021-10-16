<?php

    include '../config.php';

    if ($_POST['lName']) {
        
        $sql = "INSERT INTO author (fName, lName) VALUES ('$_POST[fName]', '$_POST[lName]')";
        $conn->query($sql);
       
        header('Location: ../list/authors.php');

    } else {
        echo 'Bye';
    }


?>