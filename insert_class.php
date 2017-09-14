<!--Φόρμα δημιουργίας νέου τμήματος. Χρησιμοποιούμε ένα query μέσα στη φόρμα
για την δημιουργία του dropdown selector για το πρόγραμμα, αλλά η βασική
λειτουργία επιτελείται στη σελίδα admin.php όπου και στέλνει τα στοιχεία
η φόρμα με τη μέθοδο POST για μεγαλύτερη ασφάλεια. Προτού αποσταλεί, ελέγχονται 
τα πεδία με τη συνάρτηση javascript validateClass()-->
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
        <title>Δημιουργία Τμήματος</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="form_container">
                <form name="class_form" method="POST" action="admin.php" onsubmit="return validateClass()">
                    <p class="txt_white">Πρόγραμμα Γυμναστικής<span class="req">*</span>:</p>
                    <select class="input_txt" name="program">
                        <?php
                            $programQuery = "SELECT name FROM program";
                            $queryResult = mysqli_query($conn, $programQuery);

                            while ($program_name = mysqli_fetch_assoc($queryResult)){
                                $program = $program_name['name'];
                                echo "<option>$program</option>";
                            }
                        ?>
                    </select>
                    <p class="txt_white">Όνομα Τμήματος<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="name" value="" placeholder="Όνομα">
                    <p class="txt_white">Ημέρα<span class="req">*</span>:</p>
                    <select class="input_txt" name="day">
                        <option selected="selected">Δευτέρα</option>
                        <option>Τρίτη</option>
                        <option>Τετάρτη</option>
                        <option>Πέμπτη</option>
                        <option>Παρασκευή</option>
                        <option>Σάββατο</option>
                        <option>Κυριακή</option>
                    </select>
                    <p class="txt_white">Ώρα Έναρξης<span class="req">*</span>:</p>
                    <input class="input_txt" type="time" name="start" value="">
                    <p class="txt_white">Ώρα Λήξης<span class="req">*</span>:</p>
                    <input class="input_txt" type="time" name="end" value="">
                    <br><br><br>
                    <input class="btn" type="submit" name="insert_class_btn" value="Υποβολή">
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