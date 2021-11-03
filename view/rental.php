<?php
    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('View a Book');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
?>



<div class="right p-5">
    <main id="view-page">
        <h1>View a Rental</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if ( (isset($_GET['borrower']) && $_GET['borrower']) && 
                 (isset($_GET['book']) && $_GET['book']) && 
                 (isset($_GET['rental']) && $_GET['rental']) )
            {
                
                $borrowerID = $_GET['borrower'];
                $bookID = $_GET['book'];
                $rentalDate = $_GET['rental'];


                $sql = "select * from RENTAL where bookID = '$bookID' and borrowerID = '$borrowerID' and rentalDate = '$rentalDate'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0)
                {
                    $borrowerSql = "select * from BORROWER where id = '$borrowerID'";
                    $bookSql = "select * from BOOK where id = '$bookID'";
                    $authorSql = "select AUTHOR.lName 
                                  from WRITES 
                                  join AUTHOR 
                                  where AUTHOR.id = WRITES.authorID and 
                                        WRITES.bookID = '$bookID'";
                    $rentalSql = "select * from RENTAL
                                  where bookID = '$bookID' and 
                                        borrowerID = '$borrowerID' and
                                        rentalDate = '$rentalDate'";

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
                    echo '<table class="table table-striped">';

                    echo '<tr>';
                    echo '<td class="col-12"><strong>BORROWER IDENTIFICATION</strong></td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td class="col-12">';
                    echo $borrowerRow['fName'].' '.$borrowerRow['lName'].'<br>';
                    echo $borrowerRow['email'].'<br>';
                    echo $borrowerRow['phone'].'<br><br>';
                    echo $borrowerRow['street'].' '.$borrowerRow['city'].' '.$borrowerRow['prov'].'<br>'.$borrowerRow['postalCode'];
                    echo '</td>';
                    echo '</tr>';

                    echo '</table>';
                    /** Borrower ***************************************************/


                    /** Book *******************************************************/
                    echo '<table class="table table-striped">';

                    echo '<tr>';
                    echo '<td class="col-12"><strong>RENTED BOOK</strong></td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td class="col-12">'.$bookRow['title'].' ('.$bookRow['pubYear'].')<br>'.implode(', ', $authors).'</td>';
                    echo '</tr>';

                    echo '</table>';
                    /** Book *******************************************************/


                    /** Rental Date *******************************************************/
                    echo '<table class="table table-striped">';

                    echo '<tr>';
                    echo '<td class="col-12"><strong>RENTAL DATE</strong></td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td class="col-12" id="rentalDate-raw">'.$rentalRow['rentalDate'].'</td>';
                    echo '</tr>';

                    echo '</table>';
                    /** Rental Date *******************************************************/

                     /** Due Date *******************************************************/
                     echo '<table class="table table-striped">';

                     echo '<tr>';
                     echo '<td class="col-12"><strong>DUE DATE</strong></td>';
                     echo '</tr>';
                     
                     echo '<tr>';
                     echo '<td class="col-12" id="dueDate-raw">'.$rentalRow['dueDate'].'</td>';
                     echo '</tr>';
 
                     echo '</table>';
                     /** Due Date *******************************************************/

                      /** Due Date *******************************************************/
                      echo '<table class="table table-striped">';

                      echo '<tr>';
                      echo '<td class="col-12"><strong>STATUS</strong></td>';
                      echo '</tr>';
                      
                      echo '<tr>';
                      echo '<td class="col-12" id="rent-status"></td>';
                      echo '</tr>';
  
                      echo '</table>';
                      /** Due Date *******************************************************/
                } 
                else 
                {
                    echo '<div class="text-muted">No rental found.</div>';
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
    $footer->addScript('../js/view-rental.js');
    $footer->drawFooter();
?>