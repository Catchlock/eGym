<!--Αρχική σελίδα ενός εγγεγραμμένου χρήστη. Εμφανίζει όλα τα διαθέσιμα
τμήματα, καθώς και το δημοφιλέστερο τμήμα και το συνολικό κόστος. Εδώ
περιλαμβάνονται επίσης ο κώδικας για την τροποποίηση του προφίλ, αλλα
και για τη διαγραφή του.-->
<?php
    session_start();
    if (!isset($_SESSION['email'])){
        $_SESSION['err_msg'] = "Μη εξουσιοδοτημένη πρόσβαση!";
        header("location: error.php");
    }
    
    include 'connect.php';
    $conn = $_SESSION['connection'];
    
    $popular_query = "SELECT p.name AS program_name, COUNT(c.trainee_id) AS num "
            . "FROM program AS p "
            . "INNER JOIN choice AS c "
            . "ON p.program_id = c.program_id "
            . "GROUP BY p.program_id "
            . "ORDER BY num DESC";
    $popular_result = mysqli_query($conn, $popular_query);
    $popular_program = mysqli_fetch_assoc($popular_result);
    $popular_program_name = $popular_program['program_name'];
    
    $cost_query = "SELECT SUM(p.cost) AS totalcost "
            . "FROM program AS p "
            . "INNER JOIN choice AS c "
            . "ON p.program_id = c.program_id "
            . "INNER JOIN trainee AS t "
            . "ON c.trainee_id = t.trainee_id "
            . "WHERE t.trainee_id = '{$_SESSION['id']}'";
    $cost_result = mysqli_query($conn, $cost_query);
    $cost_temp = mysqli_fetch_assoc($cost_result);
    $total_cost = $cost_temp['totalcost'];
    if($total_cost == null){
        $total_cost = 0;
    }
    
    if (isset($_POST['modify_btn'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($_POST['age'] != ""){
            $age = $_POST['age'];
        }
        else {
            $age = 'NULL';
        }
        if(isset($_POST['gender'])){
            $gender = "'{$_POST['gender']}'";
        }
        else {
            $gender = 'NULL';
        }
        
        
        $modifyQuery = "UPDATE `trainee` "
                . "SET "
                . "`fname` = '$fname', "
                . "`lname` = '$lname', "
                . "`email` = '$email', "
                . "`password` = '$password', "
                . "`age` = $age, "
                . "`gender` = $gender "
                . "WHERE "
                . "`trainee_id` = {$_SESSION['id']}";
        
        $result = mysqli_query($conn, $modifyQuery);
        
        if($result){
            $_SESSION['warning'] = "Η τροποποίηση των προσωπικών σας στοιχείων ήταν επιτυχής!";
            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
        }
        else {
            $_SESSION['err_msg'] = "Λυπούμαστε. Τα στοιχεία δεν αποθηκεύτηκαν. Δοκιμάστε ξανά.";
            header("location: error.php");
        }
    }
    
    if (isset($_POST['delete_btn'])){
        $deleteQuery = "DELETE FROM `trainee` WHERE `trainee_id` = '{$_SESSION['id']}'";
        
        $result = mysqli_query($conn, $deleteQuery);
        
        if($result){
            header("location: index.php");
            $_SESSION['warning'] = "Ο λογαριασμός διεγράφη. Μπορείτε να δημιουργήσετε νέο λογαριασμό κάνοντας πάλι εγγραφή.";
        }
        else {
            $_SESSION['err_msg'] = "Δεν κατέστει δυνατό να διαγραφεί ο λογαριασμός σας. Δοκιμάστε ξανά αργότερα.";
            header("location: error.php");
        }
    }
    
    if(isset($_SESSION['programs_selected'])){
        if($_SESSION['programs_selected']){
            $_SESSION['warning'] = "Η επιλογή των προγραμμάτων ολοκληρώθηκε επιτυχώς!";
            $_SESSION['programs_selected'] = false;
        }
    }
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Καλώς ήλθες <?php echo $_SESSION['fname'] ?>  στο e-Gym</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="table_container">
                <h3>Όλα τα Διαθέσιμα Τμήματα</h3>
                <table class="table_design">
                    <thead>
                        <tr>
                            <th>Ημέρα</th>
                            <th>Έναρξη</th>
                            <th>Λήξη</th>
                            <th>Τμήμα</th>
                            <th>Πρόγραμμα</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query1 = "SELECT * FROM `class` ORDER BY `day`, `start`";
                            $result1 = mysqli_query($conn, $query1);

                            while ($class = mysqli_fetch_assoc($result1)){
                                $query2 = "SELECT * FROM `program` WHERE `program_id` = {$class['program_id']}";
                                $result2 = mysqli_query($conn, $query2);
                                $p = mysqli_fetch_assoc($result2);
                                $p_name = $p['name'];
                                $name = $class['name'];
                                $day = $class['day'];
                                $start = $class['start'];
                                $end = $class['end'];

                                echo "
                                <tr>
                                    <td>$day</td>
                                    <td>$start</td>
                                    <td>$end</td>
                                    <td>$name</td>
                                    <td>$p_name</td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <p>Δημοφιλέστερο Πρόγραμμα: <?php echo $popular_program_name ?></p>
            <p>Το συνολικό ετήσιο κόστος των προγραμμάτων σας είναι:  <?php echo $total_cost ?> ευρώ</p>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>