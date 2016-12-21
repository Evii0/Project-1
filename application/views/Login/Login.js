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


function createAccount(){
    var email = document.getElementById("newEmail").value;
    var password1 = document.getElementById("pass1").value;
    var password2 = document.getElementById("pass2").value;
    
    if(password1 != password2){
        var container = document.getElementById('output');
        container.innerHTML = "Passwords do not match.";
        return;
    }
    
    var params = JSON.stringify({type: create, uid: email, pass: password1,});
    
    getRequest(
        'application/views/Login/Server.php/', // URL for the PHP file
        params,   //json arguments
        drawOutput,  // handle successful request
        drawError    // handle error
    );
}

function login(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("pass").value;
    var params = JSON.stringify({type: login, uid: email, pass: password,});
    
    getRequest(
        'application/views/Login/Server.php/', // URL for the PHP file
        params,   //json arguments
        success,  // handle successful request
        error    // handle error
    );
}

// handles drawing an error message
function error() {
    var container = document.getElementById('output');
    container.innerHTML = responseText;
}
// handles the response, adds the html
function success(responseText) {
    localStorage.setItem("email", document.getElementById("email").value);
    localStorage.setItem("token", responseText);
    
    document.location.href = ""; //navigate to dashboard controller
}
// helper function for cross-browser request object
function getRequest(url, params, success, error) {
    var req = false;
    try{
        // most browsers
        req = new XMLHttpRequest();
    } catch (e){
        // IE
        try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            // try an older version
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                return false;
            }
        }
    }
    if (!req) return false;
    if (typeof success != 'function') success = function () {};
    if (typeof error!= 'function') error = function () {};
    req.onreadystatechange = function(){
        if(req.readyState == 4) {
            return req.status === 200 ? 
                success(req.responseText) : error(req.status);
        }
    }
    req.open("POST", url, true);
    req.send(params);
    return req;
}