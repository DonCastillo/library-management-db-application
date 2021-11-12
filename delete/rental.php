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
        <h1>Return a Book</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            $proceed = (isset($_GET['borrower']) && $_GET['borrower']) && 
                       (isset($_GET['book']) && $_GET['book']) &&
                       (isset($_GET['rental']) && $_GET['rental']);


            if ( $proceed ) 
            {
                $sql = "delete from RENTAL 
                        where bookID = '$_GET[book]' and
                              borrowerID = '$_GET[borrower]' and
                              rentalDate = '$_GET[rental]'";
                              
                $result = $conn->query($sql);

                if($result)
                {
                        // subtract aount of returned book
                        $bookSql = "select amount from BOOK where id = '$_GET[book]'";
                        $bookResult = ($conn->query($bookSql))->fetch_assoc();
                        $bookAmount = $bookResult['amount'];

                        $newBookAmount = $bookAmount + 1;
                        $bookSql = "update BOOK set amount = '$newBookAmount' where id = '$_GET[book]'";
                        $conn->query($bookSql);

                        echo '<div class="bg-warning text-dark p-3">Book returned.</div>';
                }
                else
                {
                        echo '<div class="bg-danger text-white p-3">Book return failed.</div>';
                }
            } 
            else 
            {
                echo '<div class="bg-danger text-white p-3">A required data is needed. Check the url.</div>';
            }

        ?>
    </main>
</div>



<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>