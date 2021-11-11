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
        <h1>Edit a Rental</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if( (isset($_GET['borrower']) && $_GET['borrower']) && 
                (isset($_GET['book']) && $_GET['book']) && 
                (isset($_GET['rental']) && $_GET['rental']))
            {

                $borrower = $_GET['borrower'];
                $book = $_GET['book'];
                $rentalDate = $_GET['rental'];


                $borrowerSql = "select * from BORROWER where id = '$borrower'";
                $bookSql = "select * from BOOK where id = '$book'";
                $authorSql = "select lName from AUTHOR join WRITES where AUTHOR.id = WRITES.authorID and WRITES.bookID = '$book'";
                $rentalSql = "select * from RENTAL where bookID = '$book' and borrowerID = '$borrower' and rentalDate = '$rentalDate'";

                $borrowerResult = $conn->query($borrowerSql);
                $bookResult = $conn->query($bookSql);
                $authorResult = $conn->query($authorSql);
                $rentalResult = $conn->query($rentalSql);


                $borrowerRow = $borrowerResult->fetch_assoc();
                $bookRow = $bookResult->fetch_assoc();
                $rentalRow = $rentalResult->fetch_assoc();
                
                $authors = [];
                while ($authorRow = $authorResult->fetch_assoc()) {
                    array_push($authors, $authorRow['lName']);
                }

                /** Borrower ***************************************************/
                echo '<div class="mb-4" data-page="1">';
                echo '    <h3 class="text-center fw-bold bg-dark text-white mt-3 p-3">Borrower Identification</h3>';
                echo '    <div class="d-none" data-current-borrower="'.$borrowerRow['id'].'"></div>';
                echo '    <div class="form-group mb-4">';
                echo '        <label for="search-borrowers" class="mb-2">Search by Borrower ID, Last Name, or Email (select only one)</label>';
                echo '        <input type="text" class="form-control" id="search-borrowers" name="search-borrowers" placeholder="" value="" onkeyup="showBorrowers(this.value, '.$borrowerRow['id'].')">';
                echo '    </div>';
                echo '    <div id="borrower-results" class="ajax-results bg-light"></div>';
                echo '    <h4>PREVIOUS BORROWER</h4>';
                echo '    <div id="previous-borrower" class="my-4 select-box bg-light position-relative"></div>';
                echo '    <h4>CURRENT BORROWER</h4>';
                echo '    <div id="selected-borrower" class="my-4 select-box bg-light position-relative">';
                echo '        <div class="p-4 border border-success" data-borrower="'.$borrowerRow['id'].'">';
                echo '              <div class="close close-borrower"><i class="fas fa-times"></i></div>';
                echo '              <div><strong>ID:</strong> '.$borrowerRow['id'].'</div>';
                echo '              <div>'.$borrowerRow['fName'].' '.$borrowerRow['lName'].'</div>';
                echo '              <div>'.$borrowerRow['email'].'</div>';
                echo '              <div>'.$borrowerRow['phone'].'</div>';
                echo '              <div>'.$borrowerRow['street'].' '.$borrowerRow['city'].' '.$borrowerRow['prov'].'</div>';
                echo '              <div>'.$borrowerRow['postalCode'].'</div>';
                echo '        </div>';
                echo '    </div>';
                echo '    <div class="my-4 d-flex justify-content-end">';
                echo '        <div id="nav-borrower-next" class="arrow" onclick="next()">NEXT <i class="fas fa-arrow-right"></i></div>';
                echo '    </div>';
                echo '</div> ';
                /** Borrower ***************************************************/


                /** Book ***************************************************/
                echo '<div class="mb-4 d-none" data-page="2">';
                echo '    <h3 class="text-center fw-bold bg-dark text-white mt-3 p-3">Book to Borrow</h3>';
                echo '    <div class="d-none" data-current-book="'.$bookRow['id'].'"></div>';
                echo '    <div class="form-group mb-4">';
                echo '        <label for="search-books" class="mb-2">Search by Book ID or Title</label>';
                echo '        <input type="text" class="form-control" id="search-books" name="search-books" placeholder="" value="" onkeyup="showBooks(this.value, '.$bookRow['id'].')">';
                echo '    </div>';
                echo '    <div id="book-results" class="ajax-results bg-light"></div>';
                echo '    <h4>PREVIOUS BOOK</h4>';
                echo '    <div id="previous-book" class="my-4 select-box bg-light position-relative"></div>';
                echo '    <h4>CURRENT BOOK</h4>';
                echo '    <div id="selected-book" class="my-4 select-box bg-light position-relative">';
                echo '          <div class="p-4 border border-success position-relative" data-book="'.$bookRow['id'].'">';
                echo '          <div class="close close-book"><i class="fas fa-times"></i></div>';
                echo '          <div><strong>ID:</strong> '.$bookRow['id'].'</div>';
                echo '          <div>'.$bookRow['title'].' ('.$bookRow['pubYear'].')</div>';
                echo '          <div>by '.implode(', ', $authors).'</div>';
                echo '          </div>';
                echo '    </div>';
                echo '    <div class="my-4 d-flex justify-content-between">';
                echo '        <div class="arrow" onclick="prev()">PREV <i class="fas fa-arrow-left"></i></div>';
                echo '        <div id="nav-book-next" class="arrow" onclick="next()">NEXT <i class="fas fa-arrow-right"></i></div>';
                echo '    </div>';
                echo '</div>';
                /** Book ***************************************************/

                /** Dates ***************************************************/
                echo '<div class="mb-4 d-none" data-page="3">';
                echo '    <h3 class="text-center fw-bold bg-dark text-white mt-3 p-3">Dates</h3>';
                echo '    <div class="form-group mb-4">';
                echo '        <label for="rentalDate" class="mb-2">Rental Date</label>';
                echo '        <input type="date" class="form-control" name="rentalDate" id="rentalDate" value="'.$rentalRow['rentalDate'].'" onchange="changeDueDate(this.value)">';
                echo '    </div>';
                echo '    <div class="form-group mb-4">';
                echo '        <label for="dueDate" class="mb-2">Due Date</label>';
                echo '        <input type="date" class="form-control" name="dueDate" id="dueDate" value="'.$rentalRow['dueDate'].'">';
                echo '    </div>';
                echo '    <div id="date-error" class="p-3 text-white bg-danger d-none"></div>';
                echo '    <div class="my-4 d-flex justify-content-between">';
                echo '        <div class="arrow" onclick="prev()">PREV <i class="fas fa-arrow-left"></i></div>';
                echo '        <div id="nav-date-next" class="arrow" onclick="next(); showSummary();">NEXT <i class="fas fa-arrow-right"></i></div>';
                echo '    </div>';
                echo '</div>';
                /** Dates ***************************************************/


                /** Summary *************************************************/
                echo '<div class="mb-4 d-none" data-page="4">';
                echo '    <h3 class="text-center fw-bold bg-dark text-white mt-3 p-3 mb-5">Summary</h3>';

                    /** Borrower Identification *************************************************/
                    echo '      <table class="table table-striped">';
                    echo '          <tr>';
                    echo '              <td class="col-12"><strong>UPDATED BORROWER IDENTIFICATION</strong></td>';
                    echo '          </tr>';
                    echo '          <tr>';
                    echo '              <td class="col-12" id="summary-borrower"></td>';
                    echo '          </tr>';
                    echo '      </table>';
                    /** Borrower Identification *************************************************/


                    /** Book ********************************************************************/
                    echo '      <table class="table table-striped">';
                    echo '          <tr>';
                    echo '              <td class="col-12"><strong>UPDATED RENTED BOOK</strong></td>';
                    echo '          </tr>';
                    echo '          <tr>';
                    echo '              <td class="col-12" id="summary-book"></td>';
                    echo '          </tr>';
                    echo '      </table>';
                    /** Book ********************************************************************/


                    /** Rental Date *************************************************************/
                    echo '      <table class="table table-striped">';
                    echo '          <tr>';
                    echo '              <td class="col-12"><strong>UPDATED RENTAL DATE</strong></td>';
                    echo '          </tr>';
                    echo '          <tr>';
                    echo '              <td class="col-12" id="summary-rental"></td>';
                    echo '          </tr>';
                    echo '      </table>';
                    /** Rental Date *************************************************************/


                    /** Due Date *******************************************************/
                    echo '      <table class="table table-striped">';
                    echo '          <tr>';
                    echo '              <td class="col-12"><strong>UPDATED DUE DATE</strong></td>';
                    echo '          </tr>';
                    echo '          <tr>';
                    echo '              <td class="col-12" id="summary-due"></td>';
                    echo '          </tr>';
                    echo '      </table>';
                    /** Due Date *******************************************************/

                echo '    <div class="my-4 d-flex justify-content-start">';
                echo '        <div class="arrow" onclick="prev()">PREV <i class="fas fa-arrow-left"></i></div>';
                echo '    </div>';
                echo '</div>';
                /** Summary *************************************************/

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
    $footer->addScript('../js/edit-rent.js');
    $footer->drawFooter();
?>