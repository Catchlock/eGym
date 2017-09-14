<!--Φόρμα τροποποίησης υπάρχοντος προγράμματος. Τα πεδια εμφανίζονται 
συμπληρωμένα με τις υπάρχουσεσ τιμές. Η βασική λειτουργία επιτελείται στη 
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
    
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $q = "SELECT * FROM `program` WHERE `program_id` = '$id'";
        $result = mysqli_query($conn, $q);
        $program = mysqli_fetch_assoc($result);

        $name = $program['name'];
        $description = $program['description'];
        $min_age = $program['min_age'];
        $max_age = $program['max_age'];
        $cost = $program['cost'];
    }
?>

<html>
    <meta charset="UTF-8">
    <head>
        <title>Τροποποίηση Προγράμματος</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="form_container">
                <form name="program_form" method="POST" action="admin.php" onsubmit="return validateProgram()">
                    <p class="txt_white">Όνομα Προγράμματος<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="name" value="<?php echo $name ?>" placeholder="Όνομα">
                    <p class="txt_white">Σύντομη Περιγραφή<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="description" value="<?php echo $description ?>" placeholder="Περιγραφή">
                    <p class="txt_white">Ελάχιστο Ηλικιακό Όριο<span class="req">*</span>:</p>
                    <input class="input_txt" type="number" name="min_age" value="<?php echo $min_age ?>" placeholder="Ελάχιστη Ηλικία">
                    <p class="txt_white">Μέγιστο Ηλικιακό Όριο<span class="req">*</span>:</p>
                    <input class="input_txt" type="number" name="max_age" value="<?php echo $max_age ?>" placeholder="Μέγιστη Ηλικία">
                    <p class="txt_white">Ετήσιο Κόστος<span class="req">*</span>:</p>
                    <input class="input_txt" type="number" name="cost" value="<?php echo $cost ?>" placeholder="Κόστος">
                    <br><br><br>
                    <input class="btn" type="submit" name="modify_program_btn" value="Υποβολή">
                    <input class="btn" type="button" onclick="location.href='admin.php';" value="Ακύρωση">
                    <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
                </form>
                <br><br><br>
                <p class="txt_white_footnote"><span class="req">*</span> Τα πεδία με αστερίσκο πρέπει να συμπληρωθούν υποχρεωτικά.</p>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>