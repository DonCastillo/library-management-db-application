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
        <h1>Delete a Book</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_GET['id']) && $_GET['id'] ) 
            {
                $sql = "delete from BOOK where id = '$_GET[id]'";
                $result = $conn->query($sql);

                if($result)
                {
                    echo '<div class="bg-warning text-dark p-3">Book deleted.</div>';
                }
                else
                {
                    $err = $conn->errno;
                    if($err == 1451) {
                        echo '<div class="bg-danger text-white p-3">This book is currently being rented. Book deletion failed.</div>';
                    } else {
                        echo '<div class="bg-danger text-white p-3">Book deletion failed.</div>';
                    }
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