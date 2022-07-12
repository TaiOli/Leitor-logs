<?php

// connect to the database to get the PDO instance
$pdo = require 'connect.php';

$sql = 'SELECT book_id, title 
        FROM books 
        WHERE publisher_id =:publisher_id';

// prepare the query for execution
$statement = $pdo->prepare($sql);

// execute the query
$statement->execute([
    ':publisher_id' => 1
]);

// fetch the next row
while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
    echo $row['title'] . PHP_EOL;
}