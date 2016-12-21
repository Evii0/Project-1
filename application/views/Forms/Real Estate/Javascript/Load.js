var array = ["sales", "property", "branch", "qualificationCheckbox", "qualificationList", "tasmanCheckbox", "qualificationName", "transferDate"];

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
          //regular inputs, just set the fields
          if(i == 4 || i == 6 || i == 7){
            document.getElementById(data[i]).value = data[i];
          }
          //is a radio button or checkbox, both need checking
          else{
            document.getElementById(data[i]).checked = true;
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
