<!--Φόρμα τροποποίησης στοιχείων χρήστη. Τα στοιχεία στέλνονται με τη μέθοδο
POST στην αρχική σελίδα του χρήστη όπου κι υπάρχει ο κώδικας που τα καταχωρεί
στη ΒΔ. Τα στοιχεία ελέγχονται πριν καταχωρηθούν από την συνάρτηση validateProfile()-->
<?php 
    session_start();
    if (!isset($_SESSION['email'])){
        $_SESSION['err_msg'] = "Μη εξουσιοδοτημένη πρόσβαση!";
        header("location: error.php");
    }
    
    include 'connect.php';
    $conn = $_SESSION['connection'];
    
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $age = $_SESSION['age'];
    $gender = $_SESSION['gender'];
    
    $m_selected = "";
    $f_selected = "";
    
    if ($gender == "Άνδρας"){
        $m_selected = "checked";
        $f_selected = "";
    }
    else if ($gender == "Γυναίκα"){
        $m_selected = "";
        $f_selected = "checked";
    }
    else {
        $m_selected = "";
        $f_selected = "";
    }
       
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Το προφίλ μου</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="form_container">
                <form name="modify_form" method="POST" action="home.php" onsubmit="return validateProfile()">
                    <p class="txt_white">Όνομα<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="fname" value="<?php echo $fname ?>" placeholder="Όνομα"><br><br>
                    <p class="txt_white">Επώνυμο<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="lname" value="<?php echo $lname ?>" placeholder="Επώνυμο"><br><br>
                    <p class="txt_white">E-mail<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="email" value="<?php echo $email ?>" placeholder="E-mail"><br><br>
                    <p class="txt_white">Κωδικός Πρόσβασης<span class="req">*</span>:</p>
                    <input class="input_txt" type="password" name="password" value="<?php echo $password ?>" placeholder="password"><br><br>
                    <p class="txt_white">Ηλικία:</p>
                    <input class="input_txt" type="number" name="age" value="<?php echo $age ?>" placeholder="Ηλικία"><br><br>
                    <p class="txt_white">Φύλο:</p>
                    
                    <div style="clear: both;"></div>
                    <label class="radio_label" for="male"><input type="radio" name="gender" id="male" value="Άνδρας" <?php echo $m_selected ?>>Άνδρας</label>
                    <div style="clear: both;"></div>
                    <label class="radio_label" for="female"><input type="radio" name="gender" id="female" value="Γυναίκα" <?php echo $f_selected ?>>Γυναίκα</label>
                    <div style="clear: both;"></div>
                    <br><br>
                    
                    <input class="btn" type="submit" name="modify_btn" value="Τροποποίηση">
                    <input class="btn" type="button" onclick="location.href='home.php';" value="Ακύρωση">
                </form>
            </div>
            <div class="form_container">
                <form name="delete_profile" method="POST" action="profile.php" onsubmit="return confirmDelete()">
                    <input class="btn" type="submit" name="delete_btn" value="Διαγραφή"><br>
                </form>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>
