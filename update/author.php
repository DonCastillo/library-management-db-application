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
        <h1>Edit an Author</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( isset($_POST['lName']) && $_POST['lName'] ) 
            {
                $sql = "UPDATE author 
                        SET fName = '$_POST[fName]',
                            lName = '$_POST[lName]'
                        WHERE id = '$_POST[id]'";

                $result = $conn->query($sql);


                if($result)
                {
                    echo '<div class="bg-success text-white p-3">Author updated.</div>';
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