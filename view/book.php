<?php
    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('View a Book');
    $head->addStyle('../../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
?>


<div class="right p-5">
    <main id="view-page">
        <h1>View a Book</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            //var_dump($_GET['id']);
            if ( $_GET['id'] != "" && $_GET['id'] != NULL )
            {
                
                $id = $_GET['id'];

                $bookSql = "SELECT * 
                            FROM book 
                            WHERE id = $id";

                $authorSql = "SELECT author.fName, author.lName
                              FROM writes
                              JOIN author
                              WHERE writes.authorID = author.id AND writes.bookID = $id";

                $genreSql = "SELECT genre.name 
                             FROM assigns 
                             JOIN genre 
                             WHERE assigns.genreName = genre.name AND assigns.bookID = $id";


                $bookResult = $conn->query($bookSql);
                $authorResult = $conn->query($authorSql);
                $genreResult = $conn->query($genreSql);

 
                if ($bookResult->num_rows > 0)
                {

                    $bookRow = $bookResult->fetch_assoc();

                    $authors = [];
                    while($authorRow = $authorResult->fetch_assoc())
                        array_push($authors, '<span class="badge badge-pill badge-secondary">'.$authorRow['fName'].' '.$authorRow['lName'].'</span>');

                    $genres = [];
                    while($genreRow = $genreResult->fetch_assoc())
                        array_push($genres, '<span class="badge badge-pill badge-secondary">'.$genreRow['name'].'</span>');

                    echo '<table class="table table-striped">';

                    echo '<tr>';
                    echo '<td class="col-3">Title</td>';
                    echo '<td class="col-9">'.$bookRow['title'].'</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td class="col-3">Publication Year</td>';
                    echo '<td class="col-9">'.$bookRow['pubYear'].'</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td class="col-3">Author(s)</td>';
                    echo '<td class="col-9">'.implode('', $authors).'</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td class="col-3">Genre(s)</td>';
                    echo '<td class="col-9">'.implode('', $genres).'</td>';
                    echo '</tr>';

                    echo '<tr>';
                    echo '<td class="col-3">Number of Copies</td>';
                    echo '<td class="col-9">'.$bookRow['amount'].'</td>';
                    echo '</tr>';
                    echo '</table>';

                } 
                else 
                {
                    echo '<div class="text-muted">No books found.</div>';
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
    $footer->addScript('../../js/site.js');
    $footer->addScript('../../js/urlfix.js');
    $footer->drawFooter();
?>