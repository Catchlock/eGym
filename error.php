<!--Σελίδα που διαχειρίζεται μηνύματα σφαλμάτων. Εμφανίζει το μήνυμα, καθαρίζει
την global μεταβλητή, κι επιτρέπει στον χρήστη να επιστρέψει εκεί που ορίζει
το επίπεδο πρόσβασής του.-->
<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Εγγραφείτε "στου Jim"!</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <h2>Oops! Κάτι πήγε στραβά!</h2>
            <p>
                <?php
                    echo $_SESSION['err_msg'];
                    $_SESSION['err_msg'] = "";
                ?>
            </p>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>
