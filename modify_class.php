<!--Φόρμα τροποποίησης τμήματος. Κάθε πεδίο είναι συμπληρωμένο με την
τιμή που ήδη έχει στο υπάρχον τμήμα, αλλά η βασική
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
    
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $q = "SELECT * FROM `class` WHERE `class_id` = '$id'";
        $result = mysqli_query($conn, $q);
        $class = mysqli_fetch_assoc($result);

        $program_id = $class['program_id'];
        $name = $class['name'];
        $day = $class['day'];
        $start = $class['start'];
        $end = $class['end'];
    }
    
?>

<html>
    <meta charset="UTF-8">
    <head>
        <title>Τροποποίηση Τμήματος</title>
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
                            $programQuery = "SELECT * FROM program";
                            $queryResult = mysqli_query($conn, $programQuery);

                            while ($program = mysqli_fetch_assoc($queryResult)){
                                $program_name = $program['name'];
                                if ($program['program_id'] ==  $program_id){
                                    echo "<option selected=\"selected\" value=\"{$program['program_id']}\">$program_name</option>";
                                }
                                else {
                                    echo "<option value=\"{$program['program_id']}\">$program_name</option>";
                                }
                            }
                        ?>
                    </select>
                    <p class="txt_white">Όνομα Τμήματος<span class="req">*</span>:</p>
                    <input class="input_txt" type="text" name="name" value="<?php echo $name ?>">
                    <p class="txt_white">Ημέρα<span class="req">*</span>:</p>
                    <select class="input_txt" name="day">
                        <?php
                            $days = array("Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο", "Κυριακή");
                            for ($i=0; $i<7; $i++){
                                if ($days[$i]==$day) {
                                    echo "<option selected=\"selected\">{$days[$i]}</option>";
                                }
                                else {
                                    echo "<option>{$days[$i]}</option>";
                                }
                            }
                        ?>
                    </select>
                    <p class="txt_white">Ώρα Έναρξης<span class="req">*</span>:</p>
                    <input class="input_txt" type="time" name="start" value="<?php echo $start ?>">
                    <p class="txt_white">Ώρα Λήξης<span class="req">*</span>:</p>
                    <input class="input_txt" type="time" name="end" value="<?php echo $end ?>">
                    <br><br><br>
                    <input class="btn" type="submit" name="modify_class_btn" value="Τροποποίηση">
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