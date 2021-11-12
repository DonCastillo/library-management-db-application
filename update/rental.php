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
        <h1>Edit a Rental</h1>
        <hr>
        

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            $proceed = (isset($_POST['form-old-borrower']) && $_POST['form-old-borrower']) && 
                       (isset($_POST['form-old-book']) && $_POST['form-old-book']) &&
                       (isset($_POST['form-old-rentalDate']) && $_POST['form-old-rentalDate']) &&
                       (isset($_POST['form-old-dueDate']) && $_POST['form-old-dueDate']);



            if ( $proceed ) 
            {
                $oldBorrower = $_POST['form-old-borrower'];
                $oldBook = $_POST['form-old-book'];
                $oldRentalDate = $_POST['form-old-rentalDate'];
                $oldDueDate = $_POST['form-old-dueDate'];

                $newBorrower = $_POST['form-new-borrower'];
                $newBook = $_POST['form-new-book'];
                $newRentalDate = $_POST['form-new-rentalDate'];
                $newDueDate = $_POST['form-new-dueDate'];

                try
                {
                    // check if new book is available
                    $newBookAvailSql = "select amount from BOOK where id = '$newBook' LIMIT 1";
                    $bookResult = ($conn->query($newBookAvailSql))->fetch_assoc();
                    $bookAmount = $bookResult['amount'];

                    if ($bookAmount > 0)
                    {
                        $rentalSql = "update RENTAL
                                      set bookID = '$newBook', borrowerID = '$newBorrower', rentalDate = '$newRentalDate', dueDate = '$newDueDate'
                                      where bookID = '$oldBook' and borrowerID = '$oldBorrower' and rentalDate = '$oldRentalDate'";
                        $rentalResult = $conn->query($rentalSql);

                        if ($rentalResult)
                        {
                                echo '<div class="bg-success text-white p-3">Rental updated.</div>';
                                
                                // subtract amount of old book
                                $oldBookSql = "select amount from BOOK where id = '$oldBook'";
                                $oldBookResult = ($conn->query($oldBookSql))->fetch_assoc();
                                $oldBookAmount = $oldBookResult['amount'];

                                $a = $oldBookAmount + 1;
                                $oldBookSql = "update BOOK set amount = '$a' where id = '$oldBook'";
                                $conn->query($oldBookSql);

                                // add amount of new book
                                $newBookSql = "select amount from BOOK where id = '$newBook'";
                                $newBookResult = ($conn->query($newBookSql))->fetch_assoc();
                                $newBookAmount = $newBookResult['amount'];

                                $a = $newBookAmount - 1;
                                $newBookSql = "update BOOK set amount = '$a' where id = '$newBook'";
                                $conn->query($newBookSql);

                        }
                        else
                        {
                                echo '<div class="bg-danger text-white p-3">
                                      The borrower with ID '.$_POST['borrowerID'].' already rented a book with ID '.$book.' on '.$_POST['rentDate'].'.
                                      <br>
                                      A borrower is not allowed to rent the same books on the same date.
                                      </div>';
                        }
                    }
                    else
                    {
                        echo '<div class="bg-danger text-white p-3">Book to be rented is unavailable.</div>';
                    }



                    
                }
                catch (Exception $e)
                {
                    echo '<div class="bg-danger text-white p-3">There was a problem updating a rental. Try again.</div>';
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