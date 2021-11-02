<?php
    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Borrowers');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
?>



<div class="right p-5">
    <main>
        <h1>Unreturned Book</h1>
        <hr>

        <div class="form-group mb-4">
            <label for="search-unreturned" class="mb-2">Filter Unreturned Books by Borrower ID, Borrower Last Name, or Rental Date</label>
            <input type="text" class="form-control" id="search-unreturned" name="search-unreturned" placeholder="" onkeyup="showRentals(this.value)">
        </div>
        <div id="rental-results" class="ajax-results bg-light"></div>
    </main>
</div>




<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->addScript('../js/list-rental.js');
    $footer->drawFooter();
?>
