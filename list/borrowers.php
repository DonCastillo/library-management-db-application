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
        <h1>Borrowers</h1>
        <hr>

        <?php

            if ($conn->connect_errno)
            {
                echo '<div class="bg-danger text-white p-3">Init Error</div>';
                exit;
            }

            $sql = 'select id,
                           fName,
                           lName,
                           email,
                           phone,
                           street,
                           city,
                           prov,
                           postalCode
                    from BORROWER
                    order by id asc';

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
                echo '<th scope="col-3">First Name</th>';
                echo '<th scope="col-3">Last Name</th>';
                echo '<th scope="col-2">Email</th>';
                echo '<th scope="col-2">Phone Number</th>';
                echo '<th scope="col-2">Street</th>';
                echo '<th scope="col-2">City</th>';
                echo '<th scope="col-2">Province</th>';
                echo '<th scope="col-2">Postal Code</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="col-3">'.$row['fName'].'</td>';
                    echo '<td class="col-3">'.$row['lName'].'</td>';
                    echo '<td class="col-2">'.$row['email'].'</td>';
                    echo '<td class="col-2">'.$row['phone'].'</td>';
                    echo '<td class="col-2">'.$row['street'].'</td>';
                    echo '<td class="col-2">'.$row['city'].'</td>';
                    echo '<td class="col-2">'.$row['prov'].'</td>';
                    echo '<td class="col-2">'.$row['postalCode'].'</td>';
                    echo '<td class="col-2">';
                    echo '<a title="Update" class="mx-1 my-1 p-1 btn btn-primary" href="/"><i class="fas fa-eye"></i>';
                    echo '<a title="Edit" class="mx-1 my-1 p-1 btn btn-success" href="/"><i class="fas fa-edit"></i></a>';
                    echo '<a title="Delete" class="mx-1 my-1 p-1 btn btn-danger" href="/"><i class="fas fa-trash-alt"></i></a>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';

            }
            else
            {
                echo '<div class="text-muted">No borrowers found.</div>';
            }

        ?>

    </main>
</div>

<?php
    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>
