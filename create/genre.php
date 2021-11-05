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
        <h1>Add a Genre</h1>
        <hr>

        <form action="../insert/Genre.php" method="post">
            <div class="form-group mb-4">
                <label for="gName" class="mb-2">Name</label>
                <input type="text" class="form-control" id="gName" name="gName" placeholder="Adventure" maxlength="35">
            </div>
             <div class="form-group mb-4">
                <input type="submit" class="form-control btn btn-primary" value="Save">
            </div>
        </form>
     </main>
</div>

<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>