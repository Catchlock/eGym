<!--Πίνακας που προβάλλει το ετήσιο κέρδος του γυμναστηρίου ανά πρόγραμμα
αλλά και συνολικά. Υποδεικνύει επίσης το δημοφιλέστερο πρόγραμμα.-->
<?php
    session_start();
    if (!($_SESSION['email'] == "trainer")){
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
    
?>

<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <head>
        <title>Στατιστικά Στοιχεία Προγραμμάτων</title>
        <script type="text/javascript" src="functions.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
        <?php include 'nav_bar.php' ?>
        <div class="main_body">
            <div class="table_container">
                <h3>Κέρδος ανά Πρόγραμμα</h3>
                <table class="table_design">
                    <thead>
                        <tr>
                            <th>Πρόγραμμα</th>
                            <th>Κέρδος</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $profit_query = "SELECT "
                                    . "p1.name AS program_name, SUM(p2.cost) AS profit "
                                    . "FROM program AS p1 "
                                    . "LEFT JOIN choice AS c "
                                    . "ON p1.program_id = c.program_id "
                                    . "LEFT JOIN program AS p2 "
                                    . "ON c.program_id = p2.program_id "
                                    . "GROUP BY p1.program_id "
                                    . "ORDER BY profit DESC";
                            $profit_result = mysqli_query($conn, $profit_query);
                            $total_profit = 0;
                            while ($profit_temp = mysqli_fetch_assoc($profit_result)){
                                $program_name = $profit_temp['program_name'];
                                $profit = $profit_temp['profit'];
                                if($profit == ""){
                                    $profit = 0;
                                }
                                $total_profit += $profit;
                                $asterix = "";
                                if ($program_name == $popular_program_name){
                                    $asterix = "*";
                                }

                                echo "
                                    <tr>
                                        <td>$program_name{$asterix}</td>
                                        <td>$profit</td>
                                    </tr>
                                    ";
                            }
                        ?>
                        <tr>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>Συνολικό Κέρδος</td>
                            <td><?php echo $total_profit ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <p class="txt_white_footnote"><span class="req">*</span> Με αστερίσκο σημειώνεται το πιο δημοφιλές πρόγραμμα. (Αυτό με τους περισσότερους εγγεγραμμένους πελάτες)</p>
        </div>
        <?php include 'contact_card.php' ?>
        <?php include 'footer.php' ?>
    </body>
</html>