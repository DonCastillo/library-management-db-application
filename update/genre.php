<?php

    include '../config.php';

    if ($conn->connect_errno)
    {
        echo '<div class="bg-danger text-white p-3 mb-5">Connection error!</div>';
        exit();
    }

    if ( (isset($_POST['oldGenre']) && $_POST['oldGenre']) && 
            (isset($_POST['newGenre']) && $_POST['newGenre']) )
    {
        $sql = "update GENRE
                set name = '$_POST[newGenre]'
                where name = '$_POST[oldGenre]'";

        $result = $conn->query($sql);

        if($result)
        {
            $_SESSION['success'] = 'Genre updated.';
            header('Location: ../view/genre.php?name='.$_POST['newGenre']);
        }
        else
        {
            $err = $conn->errno;
            if ($err == 1062)
            {
                $_SESSION['error'] = 'An genre with the same name already exists.';
                header('Location: ../edit/genre.php?name='.$_POST['oldGenre']);
            }
        }
    }
    else
    {
        $_SESSION['error'] = 'A required data is needed.';
        header('Location: ../edit/genre.php?name='.$_POST['oldGenre']);
    }

?>
