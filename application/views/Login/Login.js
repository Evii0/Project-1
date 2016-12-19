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
    
}

function login(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("pass").value;
}


// handles the click event for link 1, sends the query
function getOutput() {
    console.log("hi");
    
  getRequest(
      'application/views/Login/Server.php/', // URL for the PHP file
       drawOutput,  // handle successful request
       drawError    // handle error
  );
  return false;
}  
// handles drawing an error message
function drawError() {
    var container = document.getElementById('output');
    container.innerHTML = 'Bummer: there was an error!';
}
// handles the response, adds the html
function drawOutput(responseText) {
    //TODO: go to dashboard controller
}
// helper function for cross-browser request object
function getRequest(url, success, error) {
    var params = JSON.stringify({a: 1, b: 2,});
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