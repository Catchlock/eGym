<!--Κεντρική σελίδα του διαχειριστή. Περιλαμβάνει τους πίνακες όλων των προγραμμάτων
και των τμημάτων κι υλοποιεί τις λειτουργικότητες της δημιουργίας/τροποποίησης/διαγραφής
προγραμμάτων και τμημάτων.
-->
<?php
    session_start();
//    Έλεγχος ώστε να μην έχει άλλος πρόσβαση εκτός του διαχείριστή.
    if (!($_SESSION['email'] == "trainer")){
        $_SESSION['err_msg'] = "Μη εξουσιοδοτημένη πρόσβαση!";
        header("location: error.php");
    }
    include 'connect.php';

    $conn = $_SESSION['connection'];

//    Διαγραφή τμήματος. Ενεργοποιείται με το πάτημα του αντίστοιχου πλήκτρου.
//    Το id το παίρνουμε από το hidden input της γραμμής του πίνακα.
    if (isset($_POST['class_delete_btn'])) {

        $deleteQuery = "DELETE FROM `class` WHERE `class_id` = {$_POST['id']}";

        $result = mysqli_query($conn, $deleteQuery);

        if($result) {
            $_SESSION['warning'] = "Το τμήμα διεγράφη επιτυχώς.";
        }
        else {
            $_SESSION['err_msg'] = "Δεν κατέστη δυνατή η διαγραφή του τμήματος. Δοκιμάστε αργότερα.";
        }
    }

//    Διαγραφή προγράμματος. Ενεργοποιείται με το πάτημα του αντίστοιχου πλήκτρου.
//    Το id το παίρνουμε από το hidden input της γραμμής του πίνακα.
    if (isset($_POST['program_delete_btn'])) {

        $deleteQuery = "DELETE FROM `program` WHERE `program_id` = {$_POST['id']}";

        $result = mysqli_query($conn, $deleteQuery);

        if($result) {
            $_SESSION['warning'] = "Το πρόγραμμα διεγράφη επιτυχώς.";
        }
        else {
            $_SESSION['err_msg'] = "Δεν κατέστη δυνατή η διαγραφή του προγράμματος. Δοκιμάστε αργότερα.";
            header("location: error.php");
        }
    }
    
//    Δημιουργία νέου προγράμματος. Ενεργοποιείται με το πάτημα του πλήκτρου
//    από τη σελίδα insert_program.php, αντλεί τα στοιχεία από την υποβληθείσα
//    φόρμα και τα εισάγει στη ΒΔ με το κατάλληλο query.
    if (isset($_POST['insert_program_btn'])) {
        
        $name = $_POST['name'];
        $description = $_POST['description'];
        $min_age = $_POST['min_age'];
        $max_age = $_POST['max_age'];
        $cost = $_POST['cost'];
        
        $query = "INSERT INTO `program` (`name`, `description`, `min_age`, `max_age`, `cost`) VALUES ('$name', '$description', '$min_age', '$max_age', '$cost')";
        
        $result = mysqli_query($conn, $query);
        
        if($result) {
            $_SESSION['warning'] = "Το νέο πρόγραμμα δημιουργήθηκε επιτυχώς!";
        }
        else {
            $_SESSION['err_msg'] = "Δεν κατέστη δυνατή η δημιουργία του νέου προγράμματος. Δοκιμάστε ξανά αργότερα.";
            header("location:error.php");
        }
    }
    
//    Τροποποίηση υπάρχοντος προγράμματος. Ενεργοποιείται με το πάτημα του πλήκτρου
//    από τη σελίδα modify_program.php, αντλεί τα στοιχεία από την υποβληθείσα
//    φόρμα και τα εισάγει στη ΒΔ με το κατάλληλο query.    
    if(isset($_POST['modify_program_btn'])){
        
       $modQuery = "UPDATE "
               . "`program` "
               . "SET "
               . "`name` = '{$_POST['name']}', "
               . "`description` = '{$_POST['description']}', "
               . "`min_age` = {$_POST['min_age']}, "
               . "`max_age` = {$_POST['max_age']}, "
               . "`cost` = {$_POST['cost']} "
               . "WHERE "
               . "`program_id`= {$_POST['id']}";
            
        $result = mysqli_query($conn, $modQuery);
        
        if($result) {
            $_SESSION['warning'] = "Το  πρόγραμμα {$_POST['name']} τροποποιήθηκε επιτυχώς!";
        }
        else {
            $_SESSION['err_msg'] = "Δεν κατέστη δυνατή η τροποποίηση του προγράμματος. Δοκιμάστε ξανά αργότερα.";
            header("location:error.php");
        }
    }
    
//    Δημιουργία νέου τμήματος. Ενεργοποιείται με το πάτημα του πλήκτρου
//    από τη σελίδα insert_class.php, αντλεί τα στοιχεία από την υποβληθείσα
//    φόρμα και τα εισάγει στη ΒΔ με το κατάλληλο query.    
    if (isset($_POST['insert_class_btn'])) {
        
        $programName = $_POST['program'];
        $q1 = "SELECT `program_id` FROM `program` WHERE `name` = '$programName'";
        $q1Result = mysqli_query($conn, $q1);
        $program = mysqli_fetch_assoc($q1Result);
        $program_id = $program['program_id'];
        
        $name = $_POST['name'];
        $day = $_POST['day'];
        $start = $_POST['start'];
        $end = $_POST['end'];
      
        $insertQuery = "INSERT INTO `class` (`program_id`, `name`, `day`, `start`, `end`) VALUES ('$program_id', '$name', '$day', '$start', '$end')";
        
        $result = mysqli_query($conn, $insertQuery);
        
        if($result) {
            $_SESSION['warning'] = "Το νέο τμήμα δημιουργήθηκε επιτυχώς!";
        }
        else {
            $_SESSION['err_msg'] = "Δεν κατέστη δυνατή η δημιουργία του νέου τμήματος. Δοκιμάστε ξανά αργότερα.";
            header("location:error.php");
        }
    }
    
//    Τροποποίηση υπάρχοντος τμήματος. Ενεργοποιείται με το πάτημα του πλήκτρου
//    από τη σελίδα modify_class.php, αντλεί τα στοιχεία από την υποβληθείσα
//    φόρμα και τα εισάγει στη ΒΔ με το κατάλληλο query.    
    if(isset($_POST['modify_class_btn'])){
        
       $modQuery = "UPDATE "
               . "`class` "
               . "SET "
               . "`name` = '{$_POST['name']}', "
               . "`day` = '{$_POST['day']}', "
               . "`start` = '{$_POST['start']}', "
               . "`end` = '{$_POST['end']}', "
               . "`program_id` = {$_POST['program']} "
               . "WHERE "
               . "`class_id`= {$_POST['id']}";
        $result = mysqli_query($conn, $modQuery);
        
        if($result) {
            $_SESSION['warning'] = "Το τμήμα {$_POST['name']} τροποποιήθηκε επιτυχώς!";
        }
        else {
            $_SESSION['err_msg'] = "Δεν κατέστη δυνατή η τροποποίηση του τμήματος. Δοκιμάστε ξανά αργότερα.";
            header("location:error.php");
        }
    }
    
//    Queries με βάση τα οποία δημιουργούνται οι πίνακες. Με ένα while loop μέσα
//    στον html κώδικα , για κάθε πρόγραμμα/τμήμα κατασκευάζεται και μία γραμμή 
//    στον αντίστοιχο πίνακα.
    $pQuery = "SELECT * FROM program";
    $cQuery = "SELECT * FROM class ORDER BY `day`, `start`";

    $pResult = mysqli_query($conn, $pQuery);
    $cResult = mysqli_query($conn, $cQuery);
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Σελίδα Διαχειριστή</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="table_container">
                <h3>Προγράμματα Γυμναστικής</h3>
                <table class="table_design">
                    <thead>
                        <tr>
                            <th>Όνομα</th>
                            <th>Ελάχιστη Ηλικία</th>
                            <th>Μέγιστη Ηλικία</th>
                            <th>Ετήσιο Κόστος</th>
                        </tr>
                    </thead>
                    <?php
                        while ($program = mysqli_fetch_assoc($pResult)){
                            $id = $program['program_id'];
                            $name = $program['name'];
                            $description = $program['description'];
                            $min_age = $program['min_age'];
                            $max_age = $program['max_age'];
                            $cost = $program['cost'];

                            echo "
                            <tr>
                                <td>$name</td>
                                <td>$min_age</td>
                                <td>$max_age</td>
                                <td>$cost<td>
                                <td>
                                    <form name=\"program_modify\" method= \"POST\" action=\"modify_program.php\">
                                        <input class=\"table_btn\" type=\"submit\" name=\"program_modify_btn\" value=\"Τροποποίηση\">
                                        <input type=\"hidden\" name=\"id\" value=\"$id\">
                                    </form>
                                </td>
                                <td>
                                    <form name=\"program_delete\" method= \"POST\" action=\"admin.php\" onsubmit=\"return confirmDeleteProgram()\">
                                        <input class=\"table_btn\" type=\"submit\" name=\"program_delete_btn\" value=\"Διαγραφή\">
                                        <input type=\"hidden\" name=\"id\" value=\"$id\">
                                    </form>
                                </td>
                            </tr>";
                        }
                    ?>
                </table>
                <form name="insert_program" method= "POST" action="insert_program.php">
                    <input class="btn" type="submit" name="insert_program_btn" value="Νέο Πρόγραμμα">
                </form>
            </div>
            <div class="table_container">
                <h3>Τμήματα Γυμναστικής</h3>
                <table class="table_design">
                    <thead>
                        <tr>
                            <th>Πρόγραμμα</th>
                            <th>Όνομα</th>
                            <th>Ημέρα</th>
                            <th>Ώρα Έναρξης</th>
                            <th>Ώρα Λήξης</th>
                        </tr>
                    </thead>
                    <?php
                        while ($class = mysqli_fetch_assoc($cResult)){
                            $programID = $class['program_id'];
                            $q = "SELECT name FROM program WHERE program_id = '$programID'";
                            $result = mysqli_query($conn, $q);
                            $classType = mysqli_fetch_assoc($result);
                            $program = $classType['name'];

                            $classID = $class['class_id'];
                            $name = $class['name'];
                            $day = $class['day'];
                            $start = $class['start'];
                            $end = $class['end'];

                            echo "
                            <tr>
                                <td>$program</td>
                                <td>$name</td>
                                <td>$day</td>
                                <td>$start</td>
                                <td>$end<td>
                                <td>
                                    <form name=\"class_modify\" method= \"POST\" action=\"modify_class.php\">
                                        <input class=\"table_btn\" type=\"submit\" name=\"class_modify_btn\" value=\"Τροποποίηση\">
                                        <input type=\"hidden\" name=\"id\" value=\"$classID\">
                                    </form>
                                </td>
                                <td>
                                    <form name=\"class_delete\" method= \"POST\" action=\"admin.php\" onsubmit=\"return confirmDeleteClass()\">
                                        <input class=\"table_btn\" type=\"submit\" name=\"class_delete_btn\" value=\"Διαγραφή\">
                                        <input type=\"hidden\" name=\"id\" value=\"$classID\">
                                    </form>
                                </td>
                            </tr>";
                        }

                    ?>
                </table>
                <form name="insert_class" method= "POST" action="insert_class.php">
                    <input class="btn" type="submit" name="insert_class_btn" value="Νέο Τμήμα">
                </form>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>
