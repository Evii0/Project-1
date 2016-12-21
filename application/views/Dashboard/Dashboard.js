function load(){
    if(!validateLoggedIn()) return;
    getForms();
}

function getForms(){
    var params = JSON.stringify({type: getListOfForms, uid: localStorage.getItem("email"),});
    
    getRequest(
        'application/Server/Server.php/', // URL for the PHP file
        params,   //json arguments
        getFormsSuccess,  // handle successful request
        formsError    // handle error
    );
}

function getFormsSuccess(responseText){
    //responseText = form1;completed&form2;completed&...
    var forms = responseText.split("&");
    var table = document.getElementById("formTable");
    
    
    for(var i = 1; i < forms.length; i++){
        var formSplit = forms[i-1].split(";");
        
        var row = table.insertRow(i);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        
        //TODO: add rest of path for link to the form controller
        cell1.innerHTML = "<a href='" + formSplit[0] + "'>" + forms[0] + "</a>";
        cell2.innerHTML = formSplit[1];
    }
}


// handles error from retrieving the forms
function formsError(){
    //oops something exploded
}

// helper function for cross-browser request object
function getRequest(url, success, error) {
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
    req.open("GET", url, true);
    req.send();
    return req;
}