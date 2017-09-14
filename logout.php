<!--Υλοποίηση της αποσύνδεσης. Καταστρέφει τον πίνακα των global μεταβλητών
$_SESSION, κλείνει το session κι επιστρέφει στην αρχική.-->
<?php
    session_start();
    
    $_SESSION = array();
    
    session_destroy();
    
    header("location: index.php");
?>

