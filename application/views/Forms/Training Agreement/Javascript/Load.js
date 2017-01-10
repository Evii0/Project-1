var array = ["salutation", "traineeFirstName", "traineeMiddleName", "traineeLastName", "traineePreferredName", "traineePreviousName", "traineePreviousNameDoc", "traineeGender", "generalDetailsDate", "traineeNSN", "traineeMOEEN", "postalAddress", "street_number", "route", "locality", "administrative_area_level_1", "postal_code", "country", "workPhone", "homePhone", "mobilePhone", "email", "ethnicity1", "ethnicity2", "ethnicity3", "iwi1", "iwi2", "iwi3", "schoolCountry", "secondarySchool", "lastSchoolYear", "language", "HighestSecondryQual", "HighestTertiaryQual", "qualificationLevel", "tertiaryYear", "priorActivity", "previousEmployment", "completedAssessment", "typeOfAssessment", "assessmentProvider", "learningDifficulty", "learningDifficultyDescription", "companyName", "tradingAs", "employerPostalAddress", "employerStreetAddress", "mainContact", "contactDDI", "contactMobile", "contactEmail", "passportNumber", "passportExpiry", "birthCertificate", "verificationDocumentA", "verificationDocumentB", "verificationDocumentC"];

function load(){
    validateLoggedIn();
    var params = JSON.stringify({type: "load", uid: localStorage.getItem("email"),});
    submitTrainingRequest(
        '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
        params,   //json arguments
        trainingLoaded,  // handle successful request
        trainingError    // handle error
    );
    document.getElementById("name").innerHTML = localStorage.getItem("name");
    if(localStorage.getItem("logo") != undefined) document.getElementById("logo").src = "../application/views/Forms/Training Agreement/assets/logos/" + localStorage.getItem("logo");
    else document.getElementById("logo").src = "../application/views/Forms/Training Agreement/assets/logos/skillsLogo.png";
}

/*
Nothing in the database, onwards!
*/
function trainingError(response){
    alert(response);
    return;
}

/*
information saved to database has been retrieved.
*/
function trainingLoaded(response){
    var json = JSON.parse(response);
    //no data in the database
    if(!json["data"]) return;
    
    //data retrieved
    var dataSplit = json["data"].split("&");
    
    for(var i = 0; i < array.length; i++){  
        if(dataSplit[i] != ""){
            //special cases (ie not just setting the value)
            if(array[i].includes("ethnicity")){
                if(document.getElementById(dataSplit[i]) == undefined){
                    document.getElementById("otherTextBox").value = dataSplit[i];
                    document.getElementById("Other").checked = true;
                } 
                else document.getElementById(dataSplit[i]).checked = true;
                continue;
            }
            if(array[i].includes("iwi")){
                if(dataSplit[i] != ""){
                    document.getElementById("iwi").value = document.getElementById("iwi").value + dataSplit[i] + ",";
                }
                continue;
            }
            if(array[i].includes("verification")){
                if(dataSplit[i] != "")document.getElementById("verificationDocumentUploaded").innerHTML = "<b>Note:</b> Your previously uploaded documents have been saved, so you do not need to upload them again.";
            }
            else{
                document.getElementById(array[i]).value = dataSplit[i];
            }
        }
    }
    //remove trailing comma from the iwi text box
    document.getElementById("iwi").value = document.getElementById("iwi").value.substring(0, document.getElementById("iwi").value.length-2);
}

function submitTrainingRequest(url, params, success, error) {
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
                success(req.response) : error(req.status);
        }
    }
    req.open("POST", url, true);
    req.send(params);
    return req;
}