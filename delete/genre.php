<?php
    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Genre');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
?>




<div class="right p-5">
    <main>
        <h1>Delete a Genre</h1>
        <hr>

        <?php

            if ($conn->connect_errno)
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_GET['name']) && $_GET['name'] )
            {
                $sql = "delete from GENRE where name = '$_GET[name]'";
                $result = $conn->query($sql);
                echo '<div class="bg-warning text-dark p-3">Genre deleted.</div>';
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
