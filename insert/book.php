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

            if ( isset($_POST['title']) && $_POST['title'] ) 
            {
                try 
                {
                    $sql = "INSERT INTO book (title, pubYear, amount) 
                            VALUES ('$_POST[title]', '$_POST[pubYear]', '$_POST[amount]')";

                    $result = $conn->query($sql);
                    $newBookID = $conn->insert_id; // id of the new book just inserted

                    $authors = [];
                    $genres = [];

                    // get all authors id from the $_POST['authors']
                    foreach ($_POST['authors'] as $author) {
                        array_push($authors, $author);
                    }

                    // get all genres name from the $_POST['genres']
                    foreach ($_POST['genres'] as $genre) {
                        array_push($genres, $genre);
                    }

                    // remove duplicates
                    $authors = array_unique($authors);
                    $genres = array_unique($genres);

                    foreach ($authors as $author) {
                        $sql = "INSERT INTO writes (bookID, authorID) VALUES ($newBookID, $author)";
                        $conn->query($sql);
                    }

                    foreach ($genres as $genre) {
                        $sql = "INSERT INTO assigns (genreName, bookID) VALUES ('$genre', $newBookID)";
                        $conn->query($sql);
                    }

                    echo '<div class="bg-success text-white p-3">Book added.</div>';
                }
                catch (Exception $e)
                {
                    echo '<div class="bg-danger text-white p-3">There was a problem in adding a book.</div>';
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