<!--Η αρχική σελίδα που βλέπει κάθε επισκέπτης. Συμπεριλαμβάνει την λειτουργικότητα
της σύνδεσης των χρηστών και του διαχειριστή.-->
<?php 
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['warning'])){
        $_SESSION['warning'] = "";
    }
    $conn = $_SESSION['connection'];
    $error_msg = "<p class=\"error\"><br></p>";
    
    if (isset($_POST['login_btn'])){
        $user = $_POST['email'];
        $pwd = $_POST['password'];

        $q1 = "SELECT * FROM trainer WHERE username = '$user'";
        $q2 = "SELECT * FROM trainee WHERE email = '$user'";

        $result1 = mysqli_query($conn,$q1);
        $result2 = mysqli_query($conn,$q2);

        $num1 = mysqli_num_rows($result1);
        $num2 = mysqli_num_rows($result2);

        if ($num1 != 0){
            $admin = mysqli_fetch_assoc($result1);

            if ($admin['password'] == $pwd){
                $_SESSION['email'] = $admin['username'];
                header("location: admin.php");
            }
            else {
                $error_msg = "<p class=\"error\">Λάθος κωδικός</p>";
                $_SESSION['warning'] = "Λάθος κωδικός";
            }
        } 
        else if ($num2 != 0) {
            $user = mysqli_fetch_assoc($result2);

            if ($user['password'] == $pwd) {
                $_SESSION['id'] = $user['trainee_id'];
                $_SESSION['fname'] = $user['fname'];
                $_SESSION['lname'] = $user['lname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['age'] = $user['age'];
                $_SESSION['gender'] = $user['gender'];
                $_SESSION['password'] = $user['password'];

                header("location: home.php");
            }
            else {
                $error_msg = "<p class=\"error\">Λάθος κωδικός</p>";
                $_SESSION['warning'] = "Λάθος κωδικός";
            }
        }
        else {
            $error_msg = "<p class=\"error\">Δεν υπάρχει χρήστης καταχωρημένος με αυτό το e-mail.</p>";
            $_SESSION['warning'] = "Δεν υπάρχει χρήστης καταχωρημένος με αυτό το e-mail.";
        }
    }
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
            <h2>Καλώς ήλθατε στο e-Gym!</h2>
            <div class="form_container">
                <form name="login_form" method="POST" action="index.php" onsubmit="return validateLoginForm()">
                    <p class="txt_white">Κωδικός Χρήστη (e-mail):</p>
                    <input class="input_txt" type="text" name="email" value="" placeholder="e-mail"><br><br>
                    <p class="txt_white">Κωδικός Πρόσβασης:</p>
                    <input class="input_txt" type="password" name="password" value="" placeholder="password"><br><br>
                    <input class="btn" type="submit" name="login_btn" value="Είσοδος"><br><br><br>
                    <?php echo $error_msg ?>
                </form>
            </div>
            <div class="form_container">
                <form name="register" method="POST" action="registration.php">
                    <span class="txt_white">Νέος Χρήστης? </span>
                    <input class="btn" type="submit" name="registration_btn" value="Εγγραφή">
                </form>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>
