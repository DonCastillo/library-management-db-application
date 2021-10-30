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
        <h1>Edit a Book</h1>
        <hr>
        

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_POST['title']) && $_POST['title'] ) 
            {

                $bookID = $_POST['id'];
                $bookTitle = addslashes($_POST['title']);

                $bookSql = "update BOOK 
                            set title = '$bookTitle',
                                pubYear = '$_POST[pubYear]',
                                amount = '$_POST[amount]'
                            where id = '$_POST[id]'";

                $bookResult = $conn->query($bookSql);
                

                // delete existing records from WRITES and ASSIGNS table related to this book
                $deleteWritesSql = "delete from WRITES where bookID = '$bookID'";
                $deleteAssignsSql = "delete from ASSIGNS where bookID = '$bookID'";
                $conn->query($deleteWritesSql);
                $conn->query($deleteAssignsSql);
                

                // insert updated WRITES tuple for this book
                foreach ( $_POST['authors'] as $authorID )
                {
                    $authorSql = "insert into WRITES (authorID, bookID) 
                                  values ('$authorID', '$bookID')";
                    $conn->query($authorSql);
                }

                foreach ( $_POST['genres'] as $genreName )
                {
                    $genreSql = "insert into ASSIGNS (genreName, bookID)
                                 values ('$genreName', '$bookID')";
                    $conn->query($genreSql);
                }

                if($bookResult)
                {
                    echo '<div class="bg-success text-white p-3">Book updated.</div>';
                }
                else
                {
                    echo '<div class="bg-danger text-white p-3">Book failed to update.</div>';
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