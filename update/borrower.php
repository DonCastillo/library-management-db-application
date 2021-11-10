<?php
    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Borrower');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
?>



<div class="right p-5">
    <main>
        <h1>Edit a Borrower</h1>
        <hr>

        <?php

            if ($conn->connect_errno)
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_POST['lName']) && $_POST['email'] )
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
                    echo '<div class="bg-success text-white p-3">Borrower updated.</div>';
                }
                else
                {
                    $err = $conn->errno;
                    if ($err == 1062)
                    {
                        echo '<div class="bg-danger text-white p-3">A Borrower with the same first name and last name already exists.</div>';
                    }
                }
            }
            else
            {
                echo '<div class="bg-danger text-white p-3">A required data is needed.</div>';
            }

        ?>
    </main>
</div>


<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>
