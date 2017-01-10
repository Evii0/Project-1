function showCreate(){
    document.getElementById('loginContainer').style.display = "none";
    document.getElementById('createContainer').style.display = "inline";
}

function back(){
    document.getElementById('loginContainer').style.display = "inline";
    document.getElementById('createContainer').style.display = "none";
}

function forgotEmail(){
    localStorage.setItem("logo", logo);
    window.href="../index.php/PasswordReset";
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
    var name = document.getElementById("firstName").value + " " + document.getElementById("lastName").value;
    
    if(password1 != password2){
        alert("Passwords do not match.");
        return;
    }
    if(password1.length < 15){
        alert("Please provide a password at least 15 characters long.");
        return;
    }
    
    var params = JSON.stringify({type: "create", uid: email, pass: password1, name: name,});
    
    getRequest(
        'application/views/Login/Server.php/', // URL for the PHP file
        params,   //json arguments
        createAccountSuccess,  // handle successful request
        createAccountError    // handle error
    );
}

function createAccountSuccess(response){
    var json = JSON.parse(response);
    localStorage.setItem("email", document.getElementById("newEmail").value);
    localStorage.setItem("name", document.getElementById("firstName").value + " " + document.getElementById("lastName").value);
    localStorage.setItem("token", json.token);
    localStorage.setItem("logo", logo);
    localStorage.setItem("url", baseUrl);
    
    document.location.href = baseUrl + "/index.php/dashboard"; //navigate to dashboard controller
}

function createAccountError(response){
    var json = JSON.parse(response.split(")")[1]);
    alert(json.error);
}




function login(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("pass").value;
    var params = JSON.stringify({type: "login", uid: email, pass: password,});
    
    getRequest(
        'application/views/Login/Server.php/', // URL for the PHP file
        params,   //json arguments
        loginSuccess,  // handle successful request
        loginError    // handle error
    );
}

// handles drawing an error message
function loginError(response) {
    var json = JSON.parse(response.split(")")[1]);
    alert("Error: Incorrect username or password");
}
// handles the response, adds the html
function loginSuccess(response) {
    var json = JSON.parse(response);
    localStorage.setItem("email", document.getElementById("email").value);
    localStorage.setItem("token", json.token);
    localStorage.setItem("name", json.name);
    localStorage.setItem("logo", logo);
    localStorage.setItem("url", baseUrl);
    
    document.location.href = baseUrl + "/index.php/dashboard"; //navigate to dashboard controller
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
                success(req.responseText) : error(req.responseText);
        }
    }
    req.open("POST", url, true);
    req.send(params);
    return req;
}