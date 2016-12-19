function createAccount(){
    validateEmail(document.getElementById('email').value);
}

function login(){
    //go to database and check email and password.
}

function showCreate(){
    console.log("called");
    document.getElementById('loginContainer').style.display = "none";
    document.getElementById('createContainer').style.display = "inline";
}

/*
Validates the given email string using a regex pattern
Returns bool
*/
function validateEmail(email){
    var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return pattern.test(email);
}