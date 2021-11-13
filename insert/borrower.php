<?php

    include '../config.php';

    if ($conn->connect_errno)
    {
        echo '<div class="bg-danger text-white p-3">Connection error!</div>';
        exit;
    }

    if ( (isset($_POST['lName']) && $_POST['lName']) && (isset($_POST['email']) && $_POST['email']) )
    {
        try
        {
            $sql = "insert into BORROWER (fName, lName, email, phone, street, city, prov, postalCode)
                    values ('$_POST[fName]', '$_POST[lName]', '$_POST[email]',
                            '$_POST[phone]', '$_POST[street]', '$_POST[city]',
                            '$_POST[prov]', '$_POST[postalCode]')";

            $result = $conn->query($sql);

            if ($result)
            {
                $_SESSION['success'] = 'Borrower added.';
                header('Location: ../view/borrower.php?id='.$conn->insert_id);
            }
            else
            {
                $err = $conn->errno;
                if ($err == 1062)
                {
                    $_SESSION['error'] = 'A borrower with the same email already exists.';
                    header('Location: ../create/borrower.php');
                }
                // $_SESSION['error'] = 'Adding a borrower failed.';
                // header('Location: ../create/borrower.php');
            }
        }
        catch (Exception $e)
        {
            $_SESSION['error'] = 'There was a problem in adding a borrower.';
            header('Location: ../create/borrower.php');
        }
    }
    else
    {
        $_SESSION['error'] = 'A required data is needed.';
        header('Location: ../create/borrower.php');
    }
?>
