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
        <h1>Add a Genre</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_POST['genre']) && $_POST['genre'] ) 
            {
                $genre = strtolower($_POST['genre']);
                $sql = "insert into GENRE (name) values ('$genre')";
                $result = $conn->query($sql);

                if($result)
                {
                    echo '<div class="bg-success text-white p-3">Genre added.</div>';
                }
                else
                {
                    $err = $conn->errno;
                    if ($err == 1062)
                    {
                        echo '<div class="bg-danger text-white p-3">A genre with the same name already exists.</div>';
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