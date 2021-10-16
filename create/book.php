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
        <h1>Add a Book</h1>
        <hr>

        <form action="../insert/book.php" method="post">
            <div class="form-group mb-4">
                <label for="title" class="mb-2">Book Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Alice in Wonderland">
            </div>
            <div class="form-group mb-4">
                <label for="title" class="mb-2">Add author</label>
                <div class="container-fluid">

            
            <?php
                $sql = 'SELECT * FROM author ORDER BY lName ASC';
                $result = $conn->query($sql);
                if (!$result || $result->num_rows < 1) 
                { 
                    echo '<div class="px-2 py-2 bg-light text-dark">No authors found</div>';

                } 
                else 
                {
                    echo '<div class="row mt-3 author">';
                    echo '<select class="col-8">';
                    echo '<option value="">No author selected</option>';

                    while($row = $result->fetch_assoc()) 
                    {
                        if(!$row['lName']) 
                        {
                            echo '<option value="'.$row['id'].'">'.$row['fName'].'</option>';
                        } 
                        else 
                        {
                            echo '<option value="'.$row['id'].'">'.$row['lName'].', '.$row['fName'].'</option>';
                        }  
                    }
                    echo '</select>';
                    echo '<div class="col-2 btn btn-secondary addfield" onclick="addField(this)"><i class="fas fa-plus"></i></div>';
                    echo '<div class="col-2 btn btn-secondary addfield" onclick="removeField(this)"><i class="fas fa-minus"></i></div>';
                    echo '</div>';
                }
            ?>


                </div>
             </div>
            <div class="form-group mb-4">
                <label for="pubYear" class="mb-2">Publication Year</label>
                <input type="number" class="form-control" id="pubYear" name="pubYear" placeholder="1986" maxlength="4" min="1500">
            </div>
            <div class="form-group mb-4">
                <label for="amount" class="mb-2">Number of Copies</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="" maxlength="2" min="0" max="25">
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