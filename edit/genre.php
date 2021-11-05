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
        <h1>Edit a Genre</h1>
        <hr>

        <?php

            if ($conn->connect_errno)
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if( isset($_GET['name']) && $_GET['name'] )
            {

                $id = $_GET['name'];

                $authorSql = "select *
                              from Genre
                              where name = $name";

                $authorResult = $conn->query($genreSql);

                if ($genreResult && $genreResult->num_rows > 0)
                {
                    $genreRow = $genreResult->fetch_assoc();
                    echo '<form action="../update/genre.php" method="post">';
                    echo '    <input type="hidden" name="name" value="'.$genreRow['name'].'">';
                    echo '    <div class="form-group mb-4">';
                    echo '        <label for="name" class="mb-2">Name</label>';
                    echo '        <input type="text" class="form-control" name="name" placeholder="Adventure" value="'.$genreRow['name'].'" maxlength="35">';
                    echo '    </div>';
                    echo '    <div class="form-group mb-4">';
                    echo '        <input type="submit" class="form-control btn btn-primary" value="Update">';
                    echo '    </div>';
                    echo '</form>';

                }
                else
                {
                    echo '<div class="text-muted">No Genre found.</div>';
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
    $footer->addScript('../js/edit-book.js');
    $footer->drawFooter();
?>
