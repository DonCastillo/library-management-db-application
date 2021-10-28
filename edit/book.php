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
        <h1>Edit a Book</h1>
        <hr>

        <?php

            if ($conn->connect_errno) 
            {
                echo '<div class="bg-danger text-white p-3">Connection error!</div>';
                exit;
            }

            if( $_GET['id'] != "" && $_GET['id'] != NULL )
            {

                $id = $_GET['id'];

                $bookSql = "SELECT * 
                            FROM book 
                            WHERE id = $id";

                $authorSql = "SELECT author.id, author.fName, author.lName
                              FROM writes
                              JOIN author
                              WHERE writes.authorID = author.id AND writes.bookID = $id
                              ORDER BY author.lName";

                $genreSql = "SELECT genre.name 
                             FROM assigns 
                             JOIN genre 
                             WHERE assigns.genreName = genre.name AND assigns.bookID = $id
                             ORDER BY genre.name";

                $allAuthors = "SELECT * 
                               FROM author 
                               ORDER BY lName ASC";

                $allGenres = "SELECT *
                              FROM genre
                              ORDER BY name ASC";

                $bookResult = $conn->query($bookSql);
                $authorResult = $conn->query($authorSql);
                $genreResult = $conn->query($genreSql);
                $allAuthorsResult = $conn->query($allAuthors);
                $allGenresResult = $conn->query($allGenres);

                if ($bookResult->num_rows > 0)
                {

                    $bookRow = $bookResult->fetch_assoc();

                    $authorOptions = [];
                    $genreOptions = [];

                    /** hidden values **************************************************************************************************************************************************/
                    while ($authorRow = $authorResult->fetch_assoc())
                    {
                        echo '<span class="d-none" data-author="'.$authorRow['id'].'"></span>';
                    }
                    while ($genreRow = $genreResult->fetch_assoc())
                    {
                        echo '<span class="d-none" data-genre="'.$genreRow['name'].'"></span>';
                    }
                    /** hidden values **************************************************************************************************************************************************/

             

                    echo '<form action="../update/book.php" method="post">';

                    /** title **********************************************************************************************************************************************************/
                    echo '<div class="form-group mb-4">';
                    echo '      <label for="title" class="mb-2">Book Title</label>';
                    echo '      <input type="text" class="form-control" id="title" name="title" placeholder="Alice in Wonderland" value="'.$bookRow['title'].'" maxlength=100 required>';
                    echo '</div>';
                    /** title **********************************************************************************************************************************************************/


                    /** initial author *************************************************************************************************************************************************/
                    echo '<div class="form-group mb-4 p-4 multiple-select author-multiple-select">';
                    echo '      <label for="title" class="mb-2">Add Author</label>';
                    echo '      <div class="container-fluid">';
                    echo '          <div class="row mt-3 author">';
                    echo '              <select name="authors[]" class="form-control flex-grow-1">';
                    echo '                  <option value="">No author selected</option>';
                                            while ($authorRow = $allAuthorsResult->fetch_assoc())
                                            {
                                                if(!$authorRow['fName']) 
                                                {
                                                    echo '<option value="'.$authorRow['id'].'">'.$authorRow['lName'].'</option>';
                                                } 
                                                else 
                                                {
                                                    echo '<option value="'.$authorRow['id'].'">'.$authorRow['lName'].', '.$authorRow['fName'].'</option>';
                                                }
                                            } 
                    echo '              </select>';
                    echo '              <div class="btn btn-secondary addfield" onclick="addField(this)"><i class="fas fa-plus"></i></div>';
                    echo '              <div class="btn btn-secondary addfield" onclick="removeField(this)"><i class="fas fa-minus"></i></div>';
                    echo '          </div>';   
                    echo '      </div>';
                    echo '</div>';
                    /** initial author *************************************************************************************************************************************************/


                    /** pub year *******************************************************************************************************************************************************/
                    echo '<div class="form-group mb-4">';
                    echo '    <label for="pubYear" class="mb-2">Publication Year</label>';
                    echo '    <input type="number" class="form-control" id="pubYear" name="pubYear" placeholder="1986" value="'.$bookRow['pubYear'].'" maxlength="4" min="1500">';
                    echo '</div>';
                    /** pub year *******************************************************************************************************************************************************/


                    /** num copies *****************************************************************************************************************************************************/
                    echo '<div class="form-group mb-4">';
                    echo '    <label for="amount" class="mb-2">Number of Copies</label>';
                    echo '    <input type="number" class="form-control" id="amount" name="amount" placeholder="" value="'.$bookRow['amount'].'" maxlength="2" min="0" max="25">';
                    echo '</div>';
                    /** num copies *****************************************************************************************************************************************************/

                    
                    /** genre **********************************************************************************************************************************************************/

                    echo '<div class="form-group mb-4 p-4 multiple-select genre-multiple-select">';
                    echo '      <label for="genre" class="mb-2">Assign Genre</label>';
                    echo '      <div class="container-fluid">';
                    echo '          <div class="row mt-3 genre">';
                    echo '              <select name="genres[]" class="form-control flex-grow-1">';
                    echo '                  <option value="">No genre selected</option>';
                                            while ($genreRow = $allGenresResult->fetch_assoc()) 
                                            {
                                                echo '<option value="'.$genreRow['name'].'">'.$genreRow['name'].'</option>';
                                            }
                    echo '              </select>';
                    echo '              <div class="btn btn-secondary addfield" onclick="addField(this)"><i class="fas fa-plus"></i></div>';
                    echo '              <div class="btn btn-secondary addfield" onclick="removeField(this)"><i class="fas fa-minus"></i></div>';
                    echo '          </div>';
                    echo '      </div>';
                    echo '</div>';
                    /** genre **********************************************************************************************************************************************************/


                    echo '<div class="form-group mb-4">';
                    echo '      <input type="submit" class="form-control btn btn-primary" value="Update">';
                    echo '</div>';
            

                    echo '</form>';

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
    $footer->addScript('../../js/edit-book.js');
    $footer->drawFooter();
?>