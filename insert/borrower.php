<?php

    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Borrowers');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();

?>

<div class="right p-5">
    <main>
        <h1>Add a Borrower</h1>
        <hr>

        <?php

            if ($conn->connect_errno)
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_POST['lName']) && $_POST['email'] )
            {
                try
                {
                    $sql = "insert into BORROWER (fName, lName, email, phone, street, city, prov, postalCode)
                            values ('$_POST[fName]', '$_POST[lName]', '$_POST[email]',
                                    '$_POST[phone]', '$_POST[street]', '$_POST[city]',
                                    '$_POST[prov]', '$_POST[postalCode]')";

                    $result = $conn->query($sql);
                    $newBorrowerID = $conn->insert_id;

                    $borrowers = [];

                    // get all borrowers id from the $_POST['borrowers']
                    foreach ($_POST['borrowers'] as $borrower) {
                        array_push($borrowers, $borrower);
                    }

                    // remove duplicates
                    $borrowers = array_unique($borrowers);

                    echo '<div class="bg-success text-white p-3">Borrower added.</div>';
                }
                catch (Exception $e)
                {
                    echo '<div class="bg-danger text-white p-3">There was a problem in adding a borrower.</div>';
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
