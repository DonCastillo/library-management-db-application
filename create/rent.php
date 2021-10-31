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
        <h1>Rent a Book</h1>
        <hr>

        <!--borrower-->
        <div class="mb-4" data-page="1">
            <h3 class="text-center fw-bold bg-dark text-white">Borrower Identification</h3>
            <div class="form-group mb-4">
                <label for="search-borrowers" class="mb-2">Search by Borrower ID, Last Name, or Email (select only one)</label>
                <input type="text" class="form-control" id="search-borrowers" name="search-borrowers" placeholder="" onkeyup="showBorrowers(this.value)">
            </div>
            <div id="borrower-results" class="ajax-results bg-light"></div>
            <div id="selected-borrower" class="my-4 select-box position-relative"></div>
            <div id="nav-borrower" class="my-4 d-flex justify-content-end d-none">
                <div class="arrow" onclick="next()">NEXT <i class="fas fa-arrow-right"></i></div>
            </div>
        </div>
        <!--borrower-->

        <!--book-->
        <div class="mb-4 d-none" data-page="2">
            <h3 class="text-center fw-bold bg-dark text-white mt-3">Books to Borrow</h3>
            <div class="form-group mb-4">
                <label for="search-books" class="mb-2">Search by Book ID or Title</label>
                <input type="text" class="form-control" id="search-books" name="search-books" placeholder="" onkeyup="showBooks(this.value)">
            </div>
            <div id="book-results" class="ajax-results bg-light"></div>
            <div id="selected-book" class="my-4 select-box d-flex justify-content-start flex-wrap"></div>
            <div id="nav-book" class="my-4 d-flex justify-content-between d-none">
                <div class="arrow" onclick="prev()">PREV <i class="fas fa-arrow-left"></i></div>
                <div class="arrow" onclick="next()">NEXT <i class="fas fa-arrow-right"></i></div>
            </div>
        </div>
        <!--book-->


        <div class="form-group mb-4 d-none">
            <input type="submit" class="form-control btn btn-primary" value="Rent">
        </div>

        <form action="../insert/rent.php" method="post">
        </form>
  </main>
</div>





<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->addScript('../js/create-rent.js');
    $footer->drawFooter();
?>