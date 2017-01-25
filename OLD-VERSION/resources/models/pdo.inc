<?php

// This file opens/connects to the database, and sets up the global $db
// handle...  This would be better in an object-oriented manner, but that
// is next month's lesson...
global $pdo;
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ffdatabase', 'Read_User', 'readOnly');
} catch (PDOException $e) {
    die("Could not open database. " . $e->getMessage());
}


// simple function to handle any query with no parameters...
function adHocQuery($q) {
    global $pdo;
    $st = $pdo -> prepare($q);
    $st -> execute();
    return $st -> fetchAll(PDO::FETCH_ASSOC);
}
?>
