<!--Μενού επιλογής προγραμμάτων εκγύμνασης. Τα προγράμματα στα οποία δεν
αντιστοιχει κανένα τμήμα δεν εμφανίζονται εδώ. Επίσης τα προγράμματα των
οποίων τα ηλικιακά όρια είναι απαγορευτικά για τον χρήστη εμφανίζονται
απενεργοποιημένα.-->
<?php
    session_start();
    if (!isset($_SESSION['email'])){
        $_SESSION['err_msg'] = "Μη εξουσιοδοτημένη πρόσβαση!";
        header("location: error.php");
    }
    include 'connect.php';
    $conn = $_SESSION['connection'];
    
    $all_programs_query = "SELECT DISTINCT program.program_id AS program_id "
            . "FROM class INNER JOIN program "
            . "ON class.program_id = program.program_id";
    $all_programs_result = mysqli_query($conn, $all_programs_query);
    
    $choiceQuery = "SELECT * FROM `trainee` "
            . "INNER JOIN `choice` ON `trainee`.`trainee_id` = `choice`.`trainee_id` "
            . "INNER JOIN `program` ON `choice`.`program_id` = `program`.`program_id` "
            . "WHERE `trainee`.`trainee_id` = {$_SESSION['id']}";
    
    $choiceResult = mysqli_query($conn, $choiceQuery);
    
    $my_programs = array();
    
    while($program = mysqli_fetch_assoc($choiceResult)){
        $my_programs[] = $program['program_id'];
    }
    
    if (isset($_POST['program_select_btn'])){
        while($program = mysqli_fetch_assoc($all_programs_result)){
            $id = $program['program_id'];
            $name = $program['name'];
            if (isset($_POST[$name]) && !(in_array($id, $my_programs))){
                $insert_query = "INSERT INTO `choice` (`trainee_id`, `program_id`) VALUES ('{$_SESSION['id']}', '$id')";
                $insert_result = mysqli_query($conn, $insert_query);
            }
            else if (!isset($_POST[$name])){
                $delete_query = "DELETE FROM `choice` WHERE `trainee_id` = '{$_SESSION['id']}' AND `program_id` = '$id'";
                $delete_result = mysqli_query($conn, $delete_query);
            }
        }
        $_SESSION['programs_selected'] = true;
        header("location: home.php");
    }
    
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Επιλογή Προγραμμάτων</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <form name="program_selection" action="select_program.php" method="POST">
                <?php
                    $all_programs_query = "SELECT DISTINCT "
                            . "program.program_id AS program_id, "
                            . "program.name AS name, "
                            . "program.description AS description, "
                            . "program.min_age AS min_age, "
                            . "program.max_age AS max_age, "
                            . "program.cost AS cost "
                            . "FROM class INNER JOIN program "
                            . "ON class.program_id = program.program_id";
                    $all_programs_result = mysqli_query($conn, $all_programs_query);
                    
                    while ($program = mysqli_fetch_assoc($all_programs_result)){
                        $program_id = $program['program_id'];
                        $program_name = $program['name'];
                        $description = $program['description'];
                        $min_age = $program['min_age'];
                        $max_age = $program['max_age'];
                        $cost = $program['cost'];
                                
                        $able = "";
                        $check = "";
                        $span = "";
                        if ($_SESSION['age'] < $program['min_age'] || $_SESSION['age'] > $program['max_age']){
                            $able = "disabled=\"disabled\"";
                            $span = "class=\"grayed_out\"";
                        }
                        if (in_array($program_id, $my_programs)){
                            $check = "checked";
                        }
                        echo "
                            <div class=\"class_container\">
                                <span $span>{$program['name']}</span>
                                <input type=\"checkbox\" name=\"$program_name\" value=\"$program_id\" $able $check><br>
                                <span $span>Κόστος: $cost ευρώ</span><br>
                                <span $span>Όρια Ηλικίας: από $min_age έως $max_age χρονών</span><br>    
                                <span $span>Σύντομη Περιγραφή: $description</span><br><br>
                            </div>
                        ";
                    }
                ?>
                <div style="clear: both;"></div>
                <input class="btn" type="submit" name="program_select_btn" value="Επιλογή">
                <input class="btn" type="button" onclick="location.href='home.php';" value="Ακύρωση">
            </form>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>