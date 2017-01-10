function load(){
    if(localStorage.getItem("token") == 'undefined'){
        document.location.href = "../";
    }
    validateLoggedIn();
    document.getElementById("name").innerHTML = localStorage.getItem("name");
    
    if(localStorage.getItem("logo") != undefined) document.getElementById("logo").src = "../application/views/Dashboard/logos/" + localStorage.getItem("logo");
    else document.getElementById("logo").src = "../application/views/Forms/Dashboard/logos/skillsLogo.png";
    
    getForms();
}

function getForms(){
    var params = JSON.stringify({type: "getListOfForms", uid: localStorage.getItem("email"),});
    getRequest(
        '../application/Server/Server.php/', // URL for the PHP file
        params,   //json arguments
        getFormsSuccess,  // handle successful request
        formsError    // handle error
    );
}

function getFormsSuccess(response){
    var json = JSON.parse(response);
    //responseText = form1;completed&form2;completed&...
    var forms = json["forms"].split("&");
    var table = document.getElementById("formTable");
    
    
    for(var i = 0; i < forms.length; i++){
        var formSplit = forms[i].split(";");
        console.log(formSplit);
        
        var row = table.insertRow(i+1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        
        //TODO: add rest of path for link to the form controller
        console.log("'" + formSplit[0] + "' -  '" + removeCharacter(formSplit[0], " ") + "'");
        cell1.innerHTML = "<a href='../index.php/" + removeCharacter(formSplit[0], " ") + "'>" + formSplit[0] + "</a>";
        cell2.innerHTML = formSplit[1];
        cell1.className = "first";
        cell2.className = "second";
    }
}

function removeCharacter(string, remove){
    var newString = string;
    for(var i = 0; i < string.length; i++){
        if(string[i] == remove) newString = newString.replace(remove, "");
    }
    return newString;
}


// handles error from retrieving the forms
function formsError(response){
    alert(response);
    //oops something exploded
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
    req.open("GET", url, true);
    req.send(params);
    return req;
}