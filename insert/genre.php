<?php

    include '../config.php';

    if ($conn->connect_errno) 
    {
        echo '<div class="bg-danger text-white p-3 mb-5">Connection error!</div>';
        exit();
    }

    if ( isset($_POST['genre']) && $_POST['genre'] ) 
    {
        $genre = strtolower($_POST['genre']);
        $sql = "insert into GENRE (name) values ('$genre')";
        $result = $conn->query($sql);

        if($result)
        {
            $_SESSION['success'] = 'Genre added.';
            header('Location: ../view/genre.php?name='.$genre);
        }
        else
        {
            $err = $conn->errno;
            if ($err == 1062)
            {
                $_SESSION['error'] = 'A genre with the same name already exists.';
                header('Location: ../create/genre.php');
            }
        }
    } 
    else 
    {
        $_SESSION['error'] = 'A required data is needed.';
        header('Location: ../create/genre.php');
    }
?>
