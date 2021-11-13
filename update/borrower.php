<?php

    include '../config.php';

    if ($conn->connect_errno)
    {
        echo '<div class="bg-danger text-white p-3">Connection error!</div>';
        exit;
    }

    if ( (isset($_POST['lName']) && $_POST['lName']) && (isset($_POST['email']) && $_POST['email']) )
    {
        $sql = "update BORROWER
                set fName = '$_POST[fName]',
                    lName = '$_POST[lName]',
                    email = '$_POST[email]',
                    phone = '$_POST[phone]',
                    street = '$_POST[street]',
                    city = '$_POST[city]',
                    prov = '$_POST[prov]',
                    postalCode = '$_POST[postalCode]'
                where id = '$_POST[id]'";

        $result = $conn->query($sql);


        if($result)
        {
            $_SESSION['success'] = 'Borrower updated.';
            header('Location: ../view/borrower.php?id='.$_POST['id']);
        }
        else
        {
            $err = $conn->errno;
            if ($err == 1062)
            {
                $_SESSION['error'] = 'A borrower with the same email already exists.';
                header('Location: ../edit/borrower.php?id='.$_POST['id']);
            }
        }
    }
    else
    {
        $_SESSION['error'] = 'A required data is needed.';
        header('Location: ../edit/borrower.php?id='.$_POST['id']);
    }

?>
