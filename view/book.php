<?php
    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Authors');
    $head->addStyle('../../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
?>


<div class="right p-5">
    <main>
        <h1>View A Book</h1>
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
                $sql = "SELECT * FROM book where id = $id";


                $result = $conn->query($sql);

                // var_dump($result);
 
                if ($result->num_rows > 0)
                {

                    $row = $result->fetch_assoc();
                    var_dump($row);
                        
                    echo '<div class="row my-4">';
                    echo '<div class="col-12 col-md-2">Title</div>';
                    echo '<div class="col-12 col-md-10">'.$row['title'].'</div>';
                    echo '</div>';

                    echo '<div class="row my-4">';
                    echo '<div class="col-12 col-md-2">Publication Year</div>';
                    echo '<div class="col-12 col-md-10">'.$row['pubYear'].'</div>';
                    echo '</div>';

                    echo '<div class="row my-4">';
                    echo '<div class="col-12 col-md-2">Number of Copies</div>';
                    echo '<div class="col-12 col-md-10">'.$row['amount'].'</div>';
                    echo '</div>';
                        
                    

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