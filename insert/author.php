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
        <h1>Add a Book</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_POST['lName']) && $_POST['lName'] ) 
            {
                $sql = "INSERT INTO author (fName, lName) VALUES ('$_POST[fName]', '$_POST[lName]')";
                $result = $conn->query($sql);

                if($result)
                {
                    echo '<div class="bg-success text-white p-3">Author added.</div>';
                }
                else
                {
                    $err = $conn->errno;
                    if ($err == 1062)
                    {
                        echo '<div class="bg-danger text-white p-3">An author with the same first name and last name already exists.</div>';
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