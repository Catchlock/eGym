function validateLoginForm() {
    var loginForm = document.forms.login_form;
    var errStr = '';
    loginForm.email.style.backgroundColor = "#FFFFFF";
    loginForm.password.style.backgroundColor = "#FFFFFF";

    if ( loginForm.email.value == ''){
        errStr = errStr + 'Το πεδίο <E-mail> δεν μπορεί να είναι κενό.\n';
        loginForm.email.style.backgroundColor = "#c8daf7";
    }

    if ( loginForm.password.value == ''){
        errStr = errStr + 'Το πεδίο <Κωδικός Πρόσβασης> δεν μπορεί να είναι κενό.\n';
        loginForm.password.style.backgroundColor = "#c8daf7";
    }

    if (errStr.length > 0){
        alert(errStr);
        return false;
    }
        
}
 
function validateRegistrationForm() {
    var regForm = document.forms.registration_form;
    var errStr = '';
    regForm.fname.style.backgroundColor = "#FFFFFF";
    regForm.lname.style.backgroundColor = "#FFFFFF";
    regForm.email.style.backgroundColor = "#FFFFFF";
    regForm.password.style.backgroundColor = "#FFFFFF";

    if ( regForm.fname.value == ''){
        errStr = errStr + 'Το πεδίο <Όνομα> δεν μπορεί να είναι κενό.\n';
        regForm.fname.style.backgroundColor = "#c8daf7";
    }

    if ( regForm.lname.value == ''){
        errStr = errStr + 'Το πεδίο <Επώνυμο> δεν μπορεί να είναι κενό.\n';
        regForm.lname.style.backgroundColor = "#c8daf7";
    }

    if ( regForm.email.value == ''){
        errStr = errStr + 'Το πεδίο <E-mail> δεν μπορεί να είναι κενό.\n';
        regForm.email.style.backgroundColor = "#c8daf7";
    }

    if ( regForm.password.value == ''){
        errStr = errStr + 'Το πεδίο <Κωδικός Πρόσβασης> δεν μπορεί να είναι κενό.\n';
        regForm.password.style.backgroundColor = "#c8daf7";
    }
    
    if ( regForm.email.value == 'trainer'){
        errStr = errStr + 'Δεν μπορείτε να χρησιμοποιήσετε αυτό το email.\n';
        regForm.email.style.backgroundColor = "#c8daf7";
    }

    if (errStr.length > 0){
        alert(errStr);
        return false;
    }
}
 
function validateProfile() {
    var profileForm = document.forms.modify_form;
    var errStr = '';
    profileForm.fname.style.backgroundColor = "#FFFFFF";
    profileForm.lname.style.backgroundColor = "#FFFFFF";
    profileForm.email.style.backgroundColor = "#FFFFFF";
    profileForm.password.style.backgroundColor = "#FFFFFF";

    if ( profileForm.fname.value == ''){
        errStr = errStr + 'Το πεδίο <Όνομα> δεν μπορεί να είναι κενό.\n';
        profileForm.fname.style.backgroundColor = "#c8daf7";
    }

    if ( profileForm.lname.value == ''){
        errStr = errStr + 'Το πεδίο <Επώνυμο> δεν μπορεί να είναι κενό.\n';
        profileForm.lname.style.backgroundColor = "#c8daf7";
    }

    if ( profileForm.email.value == ''){
        errStr = errStr + 'Το πεδίο <E-mail> δεν μπορεί να είναι κενό.\n';
        profileForm.email.style.backgroundColor = "#c8daf7";
    }

    if ( profileForm.password.value == ''){
        errStr = errStr + 'Το πεδίο <Κωδικός Πρόσβασης> δεν μπορεί να είναι κενό.\n';
        profileForm.password.style.backgroundColor = "#c8daf7";
    }

    if ( profileForm.email.value == 'trainer'){
        errStr = errStr + 'Δεν μπορείτε να χρησιμοποιήσετε αυτό το email.\n';
        profileForm.email.style.backgroundColor = "#c8daf7";
    }

    if (errStr.length > 0){
        alert(errStr);
        return false;
    }
}

function confirmDelete(){
    var result = confirm("Ο λογαριασμός σας θα διαγραφεί οριστικά! Είστε σίγουρη/ος?");
    
    if (result){
        return true;
    }
    else {
        return false;
    }
}

function checkAgeSet(x){
    if (x == ""){
        alert("Πριν επιλέξετε προγράμματα, θα πρέπει να ορίσετε την ηλικία σας. Μπορείτε να το κάνετε επιλέγοντας \"Το Προφίλ Μου\" από το μενού.");
        return false;
    }
    else{
        return true;
    }
}

function confirmDeleteProgram(){
    var result = confirm("Είστε βέβαιος ότι θέλετε να διαγράψετε το πρόγραμμα αυτό οριστικά?\nΠροσοχή: Θα διαγραφούν και τα αντίστοιχα τμήματα!");
    
    if (result){
        return true;
    }
    else {
        return false;
    }
}

function confirmDeleteClass(){
    var result = confirm("Είστε βέβαιος ότι θέλετε να διαγράψετε το τμήμα αυτό οριστικά?");
    
    if (result){
        return true;
    }
    else {
        return false;
    }
}

function validateProgram(){
    var programForm = document.forms.program_form;
    var errStr = '';
    programForm.name.style.backgroundColor = "#FFFFFF";
    programForm.description.style.backgroundColor = "#FFFFFF";
    programForm.min_age.style.backgroundColor = "#FFFFFF";
    programForm.max_age.style.backgroundColor = "#FFFFFF";
    programForm.cost.style.backgroundColor = "#FFFFFF";

    if ( programForm.name.value == ''){
        errStr = errStr + 'Το πεδίο <Όνομα Προγράμματος> δεν μπορεί να είναι κενό.\n';
        programForm.name.style.backgroundColor = "#c8daf7";
    }

    if ( programForm.description.value == ''){
        errStr = errStr + 'Το πεδίο <Σύντομη Περιγραφή> δεν μπορεί να είναι κενό.\n';
        programForm.description.style.backgroundColor = "#c8daf7";
    }

    if ( programForm.min_age.value == ''){
        errStr = errStr + 'Το πεδίο <Ελάχιστο Ηλικιακό Όριο> δεν μπορεί να είναι κενό.\n';
        programForm.min_age.style.backgroundColor = "#c8daf7";
    }

    if ( programForm.max_age.value == ''){
        errStr = errStr + 'Το πεδίο <Μέγιστο Ηλικιακό Όριο> δεν μπορεί να είναι κενό.\n';
        programForm.max_age.style.backgroundColor = "#c8daf7";
    }

    if ( programForm.cost.value == ''){
        errStr = errStr + 'Το πεδίο <Ετήσιο Κόστος> δεν μπορεί να είναι κενό.\n';
        programForm.cost.style.backgroundColor = "#c8daf7";
    }
    
    if ( programForm.min_age.value > programForm.max_age.value){
        errStr = errStr + 'Το ελάχιστο ηλικιακό όριο δεν μπορεί να είναι μεγαλύτερο από το μέγιστο\n';
        programForm.min_age.style.backgroundColor = "#c8daf7";
        programForm.max_age.style.backgroundColor = "#c8daf7";
    }
    
    if ( programForm.min_age.value < 0 || programForm.max_age.value <0) {
        errStr = errStr + 'Οι ηλικίες δεν μπορούν να είναι αρνητικοί αριθμοί.\n';
        programForm.min_age.style.backgroundColor = "#c8daf7";
        programForm.max_age.style.backgroundColor = "#c8daf7";
    }
    
    if ( programForm.cost.value < 0 ) {
        errStr = errStr + 'Το ετήσιο κόστος ενός προγράμματος δεν μπορεί να είναι αρνητικό.\n';
        programForm.cost.style.backgroundColor = "#c8daf7";
    }
    
    if (errStr.length > 0){
        alert(errStr);
        return false;
    }
}

function validateClass(){
    var classForm = document.forms.class_form;
    var errStr = '';
    classForm.program.style.backgroundColor = "#FFFFFF";
    classForm.name.style.backgroundColor = "#FFFFFF";
    classForm.day.style.backgroundColor = "#FFFFFF";
    classForm.start.style.backgroundColor = "#FFFFFF";
    classForm.end.style.backgroundColor = "#FFFFFF";
    
    if ( classForm.program.value == ''){
        errStr = errStr + 'Το πεδίο <Πρόγραμμα Γυμναστικής> δεν μπορεί να είναι κενό.\n';
        classForm.program.style.backgroundColor = "#c8daf7";
    }
    
    if ( classForm.name.value == ''){
        errStr = errStr + 'Το πεδίο <Όνομα Τμήματος> δεν μπορεί να είναι κενό.\n';
        classForm.name.style.backgroundColor = "#c8daf7";
    }

    if ( classForm.day.value == ''){
        errStr = errStr + 'Το πεδίο <Ημέρα> δεν μπορεί να είναι κενό.\n';
        classForm.day.style.backgroundColor = "#c8daf7";
    }

    if ( classForm.start.value == ''){
        errStr = errStr + 'Το πεδίο <Ώρα Έναρξης> δεν μπορεί να είναι κενό.\n';
        classForm.start.style.backgroundColor = "#c8daf7";
    }

    if ( classForm.end.value == ''){
        errStr = errStr + 'Το πεδίο <Ώρα Λήξης> δεν μπορεί να είναι κενό.\n';
        classForm.end.style.backgroundColor = "#c8daf7";
    }

    if (errStr.length > 0){
        alert(errStr);
        return false;
    }
}