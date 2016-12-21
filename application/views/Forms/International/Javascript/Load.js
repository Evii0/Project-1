var array = ["streetNum", "streetName", "city", "region", "postCode", "country", "workPhone", "homePhone", "mobile", "email", "agreeTerms", "title", "traineeFirstName", "traineeMiddleName", "traineeLastName", "traineeGender", "traineeDOB"];

function onLoad(){
    if(!validateLoggedIn()) return;
    else{

    }
}

/*
Nothing in the database, onwards!
*/
function nothingToGet(responseText){
    return;
}

/*
information saved to database has been retrieved.
*/
function gotStuff(responseText){
    var data = responseText.split("&");
    for(var i = 0; i < array.length; i++){
        if(data[i] != "null"){
            //special cases (ie not just setting the value)
            //agree terms (10) is a checkbox
            if(i == 10){
              document.getElementById("agreeTerms").checked = true;
            }
            else{
                document.getElementById(array[i]).value = data[i];
            }
        }
    }
}

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
