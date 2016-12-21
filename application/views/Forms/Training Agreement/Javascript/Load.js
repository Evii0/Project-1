var array = ["streetNum", "streetName", "city", "region", "postCode", "country", "workPhone", "homePhone", "mobile", "email", "schoolCountry", "secondarySchool", "lastSchoolYear", "language", "secondaryQual", "HighestTertiaryQual", "qualificationLevel", "tertiaryYear", "previousEmployment", "companyName",  "tradingAs", "postalAddress",  "streetAddress", "mainContact", "contactDDI", "contactMobile", "contactEmail", "ethnicities", "iwi", "title", "traineeFirstName", "traineeMiddleName", "traineeLastName", "traineeGender", "traineeDOB", "passportNumber", "passportExpiry", "birthCertificate", "idMethod", "previousEmployment", "completedAssessment", "typeOfAssessment", "assessmentProvider", "learningDifficulty", "learningDifficultyDescription"];

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
    var dataSplit = responseText.split("&");

    for(var i = 0; i < array.length; i++){
        if(dataSplit[i] != "null"){
            //special cases (ie not just setting the value)
            //ethnicity (27) and iwi (28) are both strings seperated by commas
            if(i == 27){
                var split = dataSplit[i].split(",");
                for(var j = 0; j < split.length; j++){
                    //if they selected other, the string saved is: 'other|' + value from otherTextBox
                    if(split[j].indexOf("other") != -1){
                        var otherSplit = split[j].split("|");
                        document.getElementById("other").checked = true;
                        document.getElementById("otherTextBox").value = otherSplit[1];
                    }
                    else{
                        document.getElementById(split[j]).checked = true;
                    }
                }
            }
            //iwi1, iwi2, iwi3|dontKnow|dontIdentify
            if(i == 28){
                var split = dataSplit[i].split("|");
                document.getElementById("iwi").value = split[0];
                if(split[1] == "true")document.getElementById("dontKnow").checked = true;
                if(split[2] == "true")document.getElementById("dontIdentify").checked = true;
            }
            else{
                document.getElementById(array[i]).value = dataSplit[i];
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
