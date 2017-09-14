<!--Σελίδα που δίνει μερικά στοιχεία για το γυμναστήριο. Περιλαμβάνει μία εικονα
και μία μικρή παράγραφο και δεν έχει κάποια ιδιαίτερη λειτουργικότητα.-->
<?php 
    session_start();
    include 'connect.php';
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Γυμναστήριο e-Gym</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <h2>Λίγα λόγια για εμάς...</h2>
            <img id="about_img" src="images/gym.jpg">
            <div class="form_container">
                <p>
                    Το e-Gym Club είναι ένα γυμναστήριo διαφορετικά απο 
                    τα συνηθισμένα της εποχής, σύγχρονο και εξυπηρετικό για κάθε 
                    επιθυμία του πελάτη. Εδώ γνωρίζουμε οτι η γυμναστική είναι 
                    ΑΠΑΡΑΙΤΗΤΟ συστατικό τόσο για την υγεία, όσο και για την 
                    ψυχολογία μας. Στο περιβάλλον που δημιουργήσαμε, προσφέρουμε 
                    άψογη εξυπηρέτηση, καθαριότητα, σύγχρονα μηχανήματα και πάνω 
                    απ” όλα σωστή εκγύμναση με αξιόπιστους και εξυπηρετικούς 
                    επαγγελματίες στο χώρο.
                </p>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>
