function displayError(incorrectField){
    
}

function addToDatabase(table, fields, data){
    //Needs to be done using php (ie server side) so this should just pass the stuff off the controller somehow
    "INSERT INTO " + table + "(" + fields + ") VALUES (" + encodeURIComponent(data) + ");";
}

function generalDetails(){
    var dateField = document.getElementById("generalDetailsDate");
    
    var valid = true;
    
    if(!validateDate(dateField.value)) { valid = false; displayError("generalDetailsDate"); }
    
    if(valid){
        addToDatabase();
        nextSection('contactDetails');
    }
}

function contactDetails(){
    var workPhone = document.getElementById("workPhone");
    var homePhone = document.getElementById("homePhone");
    var mobile = document.getElementById("mobile");
    var email = document.getElementById("email");
    
    var valid = true;
    
    //if(workPhone.value.trim() != "" && validatePhoneNumber(workPhone.value) != "valid") { valid = false; displayError("workPhone"); }
    //if(homePhone.value.trim() != "" && validatePhoneNumber(homePhone.value) != "valid") { valid = false; displayError("homePhone"); }
    //if(validatePhoneNumber(mobile.value) != "valid") { valid = false; displayError("mobile"); }
    if(!validateEmail(email.value)) { valid = false; displayError("email"); }
    
    if(valid){
        addToDatabase();
        nextSection('ethnicity');
        //updateProgressBar();
    }
}

function ethnicity(){
    var checkBoxes = document.getElementById('columnContainer').getElementsByTagName('input');
    var other = document.getElementById('otherTextBox');
    var dontKnow = document.getElementById('dontKnow');
    var dontIdentify = document.getElementById('dontIdentify');
    var ethnicities = "";
    
    var valid = true;
    
    for(var i = 0; i < checkBoxes.length; i++){
        if(checkBoxes[i].checked){
            if(checkBoxes[i].name == "Other")ethnicities += other + ";";
            ethnicities += checkBoxes[i].name + ";";
        }
    }
    if(!validateNumberOfSelections(ethnicities, 1, 3)) {valid = false; displayError('TooManySelected.ethnicity.1.3')}
    
    //NZ Maori ticked and neither 'don't know' or 'don't identify' ticked
    if(NZMaori.selected && !(dontKnow.checked || dontIdentify.checked)){
        if(!validateNumberOfSelections(iwi.value, 1, 3)) { valid = false; displayError('TooManySelected.iwi.1.3'); }
    }
    
    if(valid){
        addToDatabase();
        nextSection('education');
    }
}

function education(){
    var schoolYear = document.getElementById('lastSchoolYear');
    var tertiaryYear = document.getElementById('tertiaryYear');
    
    var valid = true;
    
    if(!validateYear(schoolYear.value)) { valid = false; displayError('lastSchoolYear'); }
    if(!validateYear(tertiaryYear.value)) { valid = false; displayError('tertiaryYear'); }
    
    
    if(valid){
        addToDatabase();
        nextSection('learningSkills');
    }
}

function learningSkills(){
    addToDatabase();
    nextSection('employerInfo');
}

function employerInfo(){
    var mobile = document.getElementById('employerMobile');
    var landline = document.getElementById('employerLandline');
    var email = document.getElementById('employerEmail');
    
    var valid = true;
    
    if(mobile.value.trim() != "" && validatePhoneNumber(mobile.value) != "valid") { valid = false; displayError("employerMobile"); }
    if(validatePhoneNumber(landline.value) != "valid") { valid = false; displayError("employerLandline"); }
    if(!validateEmail(email.value)) { valid = false; displayError("employerEmail"); }
    
    if(valid){
        addToDatabase();
        nextSection('identity');
    }
}
    
function identity(){
    var date = document.getElementById('passportExpiry');
    var passportNumber = document.getElementById('passportNumber');
    var birthCertNumber = document.getElementById('birthCertNum');
    
    var valid = true;
    
    if(!validateDate(date.value)) { valid = false; displayError('passportExpiry'); }
    
    if(valid){
        addToDatabase();
        nextSection('terms');
    }
}