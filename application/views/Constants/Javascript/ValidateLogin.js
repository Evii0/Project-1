
function validateLoggedIn(){
    var params = JSON.stringify({type: "validate", uid: localStorage.getItem("email"), token: localStorage.getItem("token"),});
    
    getRequest(
        '../application/Server/Server.php/', // URL for the PHP file
        params,   //json arguments
        validationSuccess,  // handle successful request
        validationError    // handle error
    );
}

// successful Validation, adds users name to header and saves it to local storage
function validationSuccess(response) {
    var json = JSON.parse(response);
    localStorage.setItem("name", json.name);
}

// handles an error message from validation
function validationError(response) {
    //THROW THEM OUT!!!!!!
    alert("Error: Mismatched token, please log in again.");
    document.location.href = "../";
    return false;
}

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