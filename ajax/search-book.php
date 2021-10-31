

<?php

include '../config.php';

if ($conn->connect_errno) {
    echo 'No results found.';
    exit;
}


$searchSql = "select * from BOOK";

if ( $_GET['search'] )
{
    $searchSql = "select * from BOOK 
                  where title like '%$_GET[search]%' or 
                        id like '%$_GET[search]%'";   
}

$searchResult = $conn->query($searchSql);

if ($searchResult && $searchResult->num_rows > 0) 
{
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">ID</th>';
    echo '<th scope="col">Title</th>';
    echo '<th scope="col">Author(s)</th>';
    echo '<th scope="col">Year</th>';
    echo '<th scope="col">Status</th>';
    echo '<th scope="col">Select</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $searchResult->fetch_assoc())
    {
        echo '<tr>';
        echo '<td class="col">'.$row['id'].'</td>';
        echo '<td class="col">'.$row['title'].'</td>';
        echo '<td class="col">';
            $authorSql = "select AUTHOR.lName 
                        from WRITES 
                        join AUTHOR 
                        where WRITES.authorID = AUTHOR.id and 
                                WRITES.bookID = '$row[id]'";
            $authorResult = $conn->query($authorSql);
            $authors = [];
            while ($authorRow = $authorResult->fetch_assoc()) {
                array_push($authors, $authorRow['lName']);
            }
            $authors = implode(', ', $authors);
        echo $authors;
        echo '</td>';
        echo '<td class="col">'.$row['pubYear'].'</td>';
        // availability
        echo '<td class="col">';
            if ($row['amount'] > 0) {
                echo '<span class="badge bg-success">AVAILABLE</span>';
            } else {
                echo '<span class="badge bg-danger">UNAVAILABLE</span>';
            }
        echo '</td>';
        // availability
        // select
        echo '<td class="col">';
            if ($row['amount'] > 0) {
                echo '<button type="button" class="select-tuple">SELECT</button>';
            } else {
                echo '<button type="button" class="select-tuple" disabled>SELECT</button>';
            }
        echo '</td>';
        // select
        echo '</tr>';

    }
    
    echo '</tbody>';
    echo '</table>';
}
else
{
    echo 'No results found.';
}



?>