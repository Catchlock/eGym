<!--Footer, σε σταθερή θέση στο κάτω μέρος της σελίδας. Εμφανίζει ένα σταθερό
μήνυμα στο δεξί μέρος, και μηνύματα συστήματος μέσω μίας global μεταβλητής 
στο αριστερο.-->
<div id="footer">
    <div id="footer_msg">
        <?php 
            $warning = $_SESSION['warning'];
            echo "<p>$warning</p>" ;
            $_SESSION['warning'] = "";
        ?>
    </div>
    <div id="footer_text">
        <p> Νικόλας Λάσκαρης, ΠΛΗ23 - 3η Γραπτή Εργασία</p>
    </div>
</div>

