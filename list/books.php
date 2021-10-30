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
        <h1>Home</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            $sql = 'select BOOK.id,
                           BOOK.title,
                           group_concat(concat(AUTHOR.fName," ",AUTHOR.lName)) as authorNames,
                           BOOK.pubYear,
                           BOOK.amount
                    from BOOK
                    left join WRITES
                        on BOOK.id = WRITES.bookID
                    left join AUTHOR
                        on WRITES.authorID = AUTHOR.id
                    group by BOOK.id';

            $result = $conn->query($sql);

            if (!$result) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            } 
            else if ($result->num_rows > 0)
            {
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col-3">Title</th>';
                echo '<th scope="col-3">Author(s)</th>';
                echo '<th scope="col-2">Year Published</th>';
                echo '<th scope="col-2">Copies</th>';
                echo '<th scope="col-2">Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="col-3">'.$row['title'].'</td>'; 
                    echo '<td class="col-3">'.$row['authorNames'].'</td>'; 
                    echo '<td class="col-2">'.$row['pubYear'].'</td>'; 
                    echo '<td class="col-2">'.$row['amount'].'</td>'; 
                    echo '<td class="col-2">';
                    echo '<a title="Update" class="mx-1 my-1 p-1 btn btn-primary" href="../view/book.php/?id='.$row['id'].'"><i class="fas fa-eye"></i>';
                    echo '<a title="Edit" class="mx-1 my-1 p-1 btn btn-success" href="../edit/book.php/?id='.$row['id'].'"><i class="fas fa-edit"></i></a>';
                    echo '<a title="Delete" class="mx-1 my-1 p-1 btn btn-danger" href="/"><i class="fas fa-trash-alt"></i></a>';
                    echo '</td>'; 
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';

            } 
            else 
            {
                echo '<div class="text-muted">No authors found.</div>';
            }

        ?>

    </main>
</div>

<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>