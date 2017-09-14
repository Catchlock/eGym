<!--Σελίδα στην οποία εμφανίζεται ο πίνακας με τα τμήματα στα οποία είναι
εγγεγραμμένος ο χρήστης.-->
<?php
    session_start();
    if (!isset($_SESSION['email'])){
        $_SESSION['err_msg'] = "Μη εξουσιοδοτημένη πρόσβαση!";
        header("location: error.php");
    }
    include 'connect.php';
    $conn = $_SESSION['connection'];
    
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Τα Τμήματά Μου</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="table_container">
                <h3>Τα τμήματά μου</h3>
                <table class="table_design">
                    <thead>
                        <tr>
                            <th>Πρόγραμμα</th>
                            <th>Τμήμα</th>
                            <th>Ημέρα</th>
                            <th>Έναρξη</th>
                            <th>Λήξη</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                             $class_query = "SELECT "
                                     . "`program`.`name` AS program_name, "
                                     . "`class`.`name` AS class_name, "
                                     . "`class`.`day` AS day, "
                                     . "`class`.`start` AS start, "
                                     . "`class`.`end` AS end "
                                     . "FROM `class` INNER JOIN `program` ON `class`.`program_id` = `program`.`program_id` "
                                     . "INNER JOIN `choice` ON `class`.`program_id` = `choice`.`program_id` "
                                     . "WHERE `choice`.`trainee_id` = '{$_SESSION['id']}'";
                            $class_result = mysqli_query($conn, $class_query);

                            while ($class = mysqli_fetch_assoc($class_result)){
                                $program_name = $class['program_name'];
                                $class_name = $class['class_name'];
                                $day = $class['day'];
                                $start = $class['start'];
                                $end = $class['end'];

                                echo "
                                    <tr>
                                        <td>$program_name</td>
                                        <td>$class_name</td>
                                        <td>$day</td>
                                        <td>$start</td>
                                        <td>$end</td>
                                    </tr>
                                ";

                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>