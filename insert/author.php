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

            if ($_POST['lName']) 
            {
                $sql = "INSERT INTO author (fName, lName) VALUES ('$_POST[fName]', '$_POST[lName]')";
                $result = $conn->query($sql);
                echo $result;
            } 
            else 
            {
                echo 'Bye';
            }
        ?>

    </main>
</div>


<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>