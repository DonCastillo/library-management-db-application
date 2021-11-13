<?php

    include '../config.php';

    if ($conn->connect_errno)
    {
        echo '<div class="bg-danger text-white p-3 mb-5">Connection error!</div>';
        exit();
    }

    if ( isset($_GET['name']) && $_GET['name'] )
    {
        $sql = "delete from GENRE where name = '$_GET[name]'";
        $result = $conn->query($sql);

        $_SESSION['success'] = 'Genre deleted.';
        header('Location: ../list/genres.php');
    }
    else
    {
        $_SESSION['error'] = 'A required data is needed. Check the url.';
        header('Location: ../list/genres.php');
    }

?>
