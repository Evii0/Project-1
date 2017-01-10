var array = ["sales", "property", "branch", "qualificationCheckbox", "qualificationList", "qualificationFile", "tasmanCheckbox", "qualificationName", "transferDate", "transTasFile"];

function load(){
    validateLoggedIn();
    var params = JSON.stringify({type: "load", uid: localStorage.getItem("email"),});
    submitRealEstateData(
        '../application/views/Forms/Real Estate/Server/Server.php/', // URL for the PHP file
        params,   //json arguments
        realEstateLoaded,  // handle successful request
        realEstateError    // handle error
    );
    document.getElementById("name").innerHTML = localStorage.getItem("name");
    if(localStorage.getItem("logo") != undefined) document.getElementById("logo").src = "../application/views/Forms/Real Estate/assets/logos/" + localStorage.getItem("logo");
    else document.getElementById("logo").src = "../application/views/Forms/Training Agreement/assets/logos/skillsLogo.png";
}

/*
Nothing in the database, onwards!
*/
function realEstateError(response){
    alert(response);
    return;
}

/*
information saved to database has been retrieved.
*/
function realEstateLoaded(response){
    var json = JSON.parse(response);
    //no data in the database
    if(!json["data"]) return;
    
    //data retrieved
    var data = json["data"].split("&");
    for(var i = 0; i < array.length; i++){
        if(data[i] != ""){
            console.log(array[i] + ": " + data[i]);
            //checkboxes
            if(i == 3 || i == 6){
                if(data[i] == "yes") document.getElementById(array[i]).checked = true;
            }
            //textbox/dropdown
            if(i == 4){
                document.getElementById(array[i]).value = data[i];
            }
            if(i == 7 || i == 8){
                document.getElementById(array[i]).value = data[i];
            }
            //radio buttons
            if(i == 0|| i == 1 || i == 2){
                document.getElementById(data[i]).checked = true;
            }
            //files
            if(i == 5 || i == 9){
                if(data[i] != null)document.getElementById("verificationDocumentUploaded").innerHTML = "Note: Your previously uploaded documents have been saved.";
            }
        }
    }
}

function submitRealEstateData(url, params, success, error) {
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