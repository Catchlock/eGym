<!--Φόρμα δημιουργίας νέου προγράμματος. Η βασική λειτουργία επιτελείται στη 
σελίδα admin.php όπου και στέλνει τα στοιχεία η φόρμα με τη μέθοδο POST για 
μεγαλύτερη ασφάλεια. Προτού αποσταλεί, ελέγχονται τα πεδία με τη συνάρτηση
javascript validateProgram()-->
<?php
    session_start();
    if (!($_SESSION['email'] == "trainer")){
        $_SESSION['err_msg'] = "Μη εξουσιοδοτημένη πρόσβαση!";
        header("location: error.php");
    }
    include 'connect.php';
    
    $conn = $_SESSION['connection'];
?>

<html>
    <meta charset="UTF-8">
    <head>
        <title>Δημιουργία Προγράμματος</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="form_container">
                <form name="program_form" method="POST" action="admin.php" onsubmit="return validateProgram()">
                    <p class="txt_white">Όνομα Προγράμματος<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="name" value="" placeholder="Όνομα">
                    <p class="txt_white">Σύντομη Περιγραφή<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="description" value="" placeholder="Περιγραφή">
                    <p class="txt_white">Ελάχιστο Ηλικιακό Όριο<span class="req">*</span>:</p>
                    <input class="input_txt" type="number" name="min_age" value="" placeholder="Ελάχιστη Ηλικία">
                    <p class="txt_white">Μέγιστο Ηλικιακό Όριο<span class="req">*</span>:</p>
                    <input class="input_txt" type="number" name="max_age" value="" placeholder="Μέγιστη Ηλικία">
                    <p class="txt_white">Ετήσιο Κόστος<span class="req">*</span>:</p>
                    <input class="input_txt" type="number" name="cost" value="" placeholder="Κόστος">
                    <br><br><br>
                    <input class="btn" type="submit" name="insert_program_btn" value="Υποβολή">
                    <input class="btn" type="button" onclick="location.href='admin.php';" value="Ακύρωση">
                </form>
                <br><br><br>
                <p class="txt_white_footnote"><span class="req">*</span> Τα πεδία με αστερίσκο πρέπει να συμπληρωθούν υποχρεωτικά.</p>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>