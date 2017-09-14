<!--Φόρμα δημιουργίας νέου λογαριασμού. Τα στοιχεία πριν καταχωρηθούν
ελέγχονται από την συνάρτηση validateRegistrationForm().-->
<?php 
    session_start();
    include 'connect.php';
    $conn = $_SESSION['connection'];
    
    if (isset($_POST['register_btn'])){
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
        
        $insertQuery = "INSERT INTO `trainee` "
                . "(`fname`, `lname`, `email`, `password`, `age`, `gender`) "
                . "VALUES "
                . "('$fname', '$lname', '$email', '$password', $age, $gender)";
        echo $insertQuery;
        $result = mysqli_query($conn, $insertQuery);
        
        if($result){
            header("location: index.php");
            $_SESSION['warning'] = "Δημιουργία λογαριασμού επιτυχής. Μπορείτε να συνδεθείτε.";
        }
        else {
            $_SESSION['err_msg'] = "Λυπούμαστε. Η καταχώρηση του λογαριασμού ήταν ανεπιτυχής. Δοκιμάστε ξανά.";
            header("location: error.php");
        }
    }
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Εγγραφείτε στο e-Gym</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="form_container">
               <form name="registration_form" method="POST" action="registration.php" onsubmit="return validateRegistrationForm()">
                    <p class="txt_white">Όνομα<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="fname" value="" placeholder="Όνομα">
                    <p class="txt_white">Επώνυμο<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="lname" value="" placeholder="Επώνυμο">
                    <p class="txt_white">E-mail<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="email" value="" placeholder="E-mail">
                    <p class="txt_white">Κωδικός Πρόσβασης<span class="req">*</span>:</p>
                    <input class="input_txt" type="password" name="password" value="" placeholder="Κωδικός Πρόσβασης">
                    <p class="txt_white">Ηλικία:</p>
                    <input class="input_txt" type="number" name="age" value="" placeholder="Ηλικία">
                    <p class="txt_white">Φύλο:</p>
                    <div style="clear: both;"></div>
                    <label class="radio_label" for="male"><input type="radio" name="gender" id="male" value="Άνδρας">Άνδρας</label>
                    <div style="clear: both;"></div>
                    <label class="radio_label" for="female"><input type="radio" name="gender" id="female" value="Γυναίκα">Γυναίκα</label>
                    <div style="clear: both;"></div>
                    <br><br>
                    <input class="btn" type="submit" name="register_btn" value="Υποβολή">
                    <input class="btn" type="button" onclick="location.href='index.php';" value="Ακύρωση"><br><br><br><br>
                    <p class="txt_white_footnote"><span class="req">*</span> Τα πεδία με αστερίσκο πρέπει να συμπληρωθούν υποχρεωτικά.</p>
                </form>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>
