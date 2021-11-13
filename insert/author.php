
<?php

    include '../config.php';

    if ($conn->connect_errno) 
    {
        echo '<div class="bg-danger text-white p-3">Connection error!</div>';
        exit;
    }

    if ( isset($_POST['lName']) && $_POST['lName'] ) 
    {
        $sql = "insert into AUTHOR (fName, lName) values ('$_POST[fName]', '$_POST[lName]')";
        $result = $conn->query($sql);

        if($result)
        {
            $_SESSION['success'] = 'Author added.';
            header('Location: ../view/author.php?id='.$conn->insert_id);
        }
        else
        {
            $err = $conn->errno;
            if ($err == 1062)
            {
                $_SESSION['error'] = 'An author with the same first name and last name already exists.';
                header('Location: ../create/author.php');
            }
        }
    } 
    else 
    {
        $_SESSION['error'] = 'A required data is needed.';
        header('Location: ../create/author.php');
    }
?>