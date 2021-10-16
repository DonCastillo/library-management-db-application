<?php

    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Authors');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();

    echo 
    '<div class="right p-5">
        <main>
            <h1>Add an Author</h1>
            <hr>';
   
    echo '
        <form action="../insert/author.php" method="post">
            <div class="form-group mb-4">
                <label for="fName" class="mb-2">First Name</label>
                <input type="text" class="form-control" id="fName" name="fName" placeholder="John">
            </div>
            <div class="form-group mb-4">
                <label for="lName" class="mb-2">Last Name</label>
                <input type="text" class="form-control" id="lName" name="lName" placeholder="Smith">
            </div>
             <div class="form-group mb-4">
                <input type="submit" class="form-control btn btn-primary" value="Save">
            </div>
        </form>
    ';

    echo
    '   </main>
    </div>';


    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>