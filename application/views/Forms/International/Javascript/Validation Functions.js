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

function proofIdentity(){

}

function terms(){
  var check = document.getElementById("termsAgree");
  if(check.checked){
    nextSection("traineeInformation");
  }
}

function traineeInformation(){
  var valid = true;

  var firstName = document.getElementById("first_name");
  var lastName = document.getElementById("last_name");
  var date = document.getElementById("dob");

  if(firstName.equals("") || lastName.equals("")){
    valid = false;
  }

  //TODO Should also check for a valid date

  if(valid){
    nextSection();//dunno what comes next
  }
}
