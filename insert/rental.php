<?php
    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Authors');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
?>



<div class="right p-5">
    <main>
        <h1>Rent a Book</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            $proceed = (isset($_POST['borrowerID']) && $_POST['borrowerID']) &&
                       (isset($_POST['bookID']) && $_POST['bookID']) &&
                       (isset($_POST['rentDate']) && $_POST['rentDate']);

            if ($proceed) 
            {
                try 
                {
                    foreach ($_POST['bookID'] as $book) 
                    {
                        $bookAvailSql = "select amount from BOOK where id = '$book' LIMIT 1";
                        $bookResult = ($conn->query($bookAvailSql))->fetch_assoc();
                        $bookAmount = $bookResult['amount'];
                        
                        if ($bookAmount > 0)
                        {
                            // insert new tuple to the RENTAL table
                            $rentalSql = "insert into RENTAL (bookID, borrowerID, rentalDate, dueDate) 
                                          values ('$book', '$_POST[borrowerID]', '$_POST[rentDate]', '$_POST[dueDate]')";
                            $rentalResult = $conn->query($rentalSql);

                            if ($rentalResult)
                            {
                                echo '<div class="bg-danger text-white p-3">
                                        The borrower with ID '.$_POST['borrowerID'].' already rented a book with ID '.$book.' on '.$_POST['rentDate'].'.
                                      </div>';

                            }

                            // subtract amount of the book from the BOOK table
                            $newAmount = $bookAmount - 1;
                            $updateBook = "update BOOK set amount = '$newAmount' where id = '$book'";
                            $conn->query($updateBook);
                        }

                    }

                    echo '<div class="bg-success text-white p-3">Rental complete.</div>';
                }
                catch (Exception $e)
                {
                    echo '<div class="bg-danger text-white p-3">There was a problem adding a rental. Try again.</div>';
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