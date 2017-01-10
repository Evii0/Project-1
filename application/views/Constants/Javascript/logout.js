function logout(){
    var params = JSON.stringify({type: "logout", uid: localStorage.getItem("email")});
    getRequest(
        '../application/views/Login/Server.php/', // URL for the PHP file
        params,   //json arguments
        loggedOut,  // handle successful request
        logOutFail    // handle error
    );
}

function loggedOut(){
    //TODO: return to login page
    localStorage.removeItem("email");
    localStorage.removeItem("token");
    localStorage.removeItem("name");
    document.location.href = "../";
}

function logOutFail(){
    alert("Error: Could not log you out.");
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