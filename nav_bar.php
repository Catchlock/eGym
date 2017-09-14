<!--Η οριζόντια μπάρα πλοήγησης που βρίσκεται σε ολες τις σελίδες.
Ελέγχοντας την $_SESSION['email'] γνωριζουμε ποιός χρήστης είναι
συνδεδεμένος κι εμφανίζονται οι κατάλληλες επιλογές.-->
<div id="header"></div>
<?php

    if(isset($_SESSION['age'])){
        $age = $_SESSION['age'];
    }
    else {
        $age = "";
    }
    
    if (isset($_SESSION['email'])){
        if ($_SESSION['email'] == "trainer"){
            echo "
                <div id=\"menu\">
                    <ul id=\"menu_list\">
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"admin.php\">Αρχική</a></li>
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"statistics.php\">Στατιστικά</a></li>
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"logout.php\">Αποσύνδεση</a></li>
                    </ul>
                </div>
            ";
        }
        else {
            echo "
                <div id=\"menu\">
                    <ul id=\"menu_list\">
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"home.php\">Η Αρχική Μου</a></li>
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"profile.php\">Το Προφίλ Μου</a></li>
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"select_program.php\" onclick=\"return checkAgeSet('$age')\">Τα Προγράμματά Μου</a></li>
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"my_classes.php\">Τα Τμήματά Μου</a></li>
                        <li class=\"menu_item\"><a class=\"menu_link\" href=\"logout.php\">Αποσύνδεση</a></li>
                    </ul>
                </div>
            ";
        }
    }
    else {
        echo "
            <div id=\"menu\">
                <ul id=\"menu_list\">
                    <li class=\"menu_item\"><a class=\"menu_link\" href=\"index.php\">Αρχική</a></li>
                    <li class=\"menu_item\"><a class=\"menu_link\" href=\"about.php\">Ποιοί Είμαστε</a></li>
                    <li class=\"menu_item\"><a class=\"menu_link\" href=\"registration.php\">Εγγραφή</a></li>
                </ul>
            </div>
        ";
    }
        

?>

