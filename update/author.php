<?php

    include '../config.php';
    
    if ($conn->connect_errno) 
    {
        echo '<div class="bg-danger text-white p-3">Connection error!</div>';
        exit;
    }

    if ( isset($_POST['lName']) && $_POST['lName'] ) 
    {
        $sql = "update AUTHOR 
                set fName = '$_POST[fName]',
                    lName = '$_POST[lName]'
                where id = '$_POST[id]'";

        $result = $conn->query($sql);


        if($result)
        {
            $_SESSION['success'] = 'Author updated.';
            header('Location: ../view/author.php?id='.$_POST['id']);
        }
        else
        {
            $err = $conn->errno;
            if ($err == 1062)
            {
                $_SESSION['error'] = 'An author with the same first name and last name already exists.';
                header('Location: ../edit/author.php?id='.$_POST['id']);
            }
        }
    } 
    else 
    {
        $_SESSION['error'] = 'A required data is needed.';
        header('Location: ../edit/author.php?id='.$_POST['id']);
    }

?>
