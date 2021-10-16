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
            <h1>Home</h1>
            <hr>';


    if ($conn->connect_errno) {

        echo '<div class="bg-danger text-white p-3">Connection error!</div>';
        exit;

    }

    $sql = 'SELECT lName, fName FROM `author` ORDER BY lName ASC';
    $result = $conn->query($sql);

    if (!$result) {

        echo '<div class="bg-danger text-white p-3">Connection error!</div>';
        exit;

    } else if ($result->num_rows > 0) {

        echo '<table class="table table-striped">';
        echo '<thead>
            <tr>
                <th scope="col-5">Last Name</th>
                <th scope="col-5">First Name</th>
                <th scope="col-2">Action</th>
            </tr>
        </thead>
        <tbody>';

        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="col-5">'.$row['lName'].'</td>'; 
            echo '<td class="col-5">'.$row['fName'].'</td>'; 
            echo '
            <td class="col">
                <a title="Update" class="mx-1 my-1 p-1 btn btn-primary" href="/"><i class="fas fa-eye"></i>
                <a title="Edit" class="mx-1 my-1 p-1 btn btn-success" href="/"><i class="fas fa-edit"></i></a>
                <a title="Delete" class="mx-1 my-1 p-1 btn btn-danger" href="/"><i class="fas fa-trash-alt"></i></a>
            </td>'; 
            echo '</tr>';
        }

        echo '</tbody></table>';

    } else {

        echo '<div class="text-muted">No authors found.</div>';

    }



    


    echo
    '   </main>
    </div>';


    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>