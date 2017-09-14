<?php
//Κώδικας php για τη σύνδεση στη ΒΔ. Η σύνδεση περνάει στην global μεταβλητή 
//$_SESSION['connection'], από όπου και την παίρνουμε σε όλες τις άλλες σελίδες.
    $username = "root";
    $password = "";
    $database = "egymdb";
    $server = "localhost";

    $conn = mysqli_connect($server, $username, $password, $database);
    mysqli_set_charset($conn, "utf8");

    if(!$conn) {
        die("Problem with the database");
    }

    $_SESSION['connection'] = $conn;
?>