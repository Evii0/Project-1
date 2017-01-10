function displayError(incorrectFields){    
    var split = incorrectFields.split(",");
    if(split[0] == "TooMany"){
        if(split[1] == "iwi"){
            document.getElementById("iwi").style.borderColor = "red";
            alert("Please enter between one and three iwi, sperarated by commas.");
        }
        else{
            alert("Please select between one and three ethnicities.");
        }
    }
    else{
        for(var i = 0; i < split.length-1; i++){
            document.getElementById(split[i]).style.borderColor = "red";
        }
        alert("Incorrect/Missing Information");
    }
    return;
}

function checkDataEntered(fields){
    var string = "";
    for(var i = 0; i < fields.length; i++){
        console.log(fields[i]);
        if(document.getElementById(fields[i]).value == "")string += fields[i] + ",";
    }
    if(string != ""){ displayError(string); return false;}
    else return true;
}

function generalDetails(){
    var compulsoryFields = ["traineeFirstName", "traineeLastName"];
    if(!checkDataEntered(compulsoryFields)) return;
    
    var dateField = document.getElementById("generalDetailsDate");
    
    
    var nameDocument = document.getElementById("traineePreviousNameDoc");
    var fileName = "";
    var fileType = "";
    if(nameDocument.files.length != 0){
        fileName = "sil_online_" + document.getElementById("traineeFirstName").value + "_" + document.getElementById("traineeLastName").value + "_Training Agreement_PreviousName-" + localStorage.getItem("email") + ".";
        fileType = nameDocument.files[0].name.split('.').pop();
        
        var uri = "../application/upload.php";
        var xhr = new XMLHttpRequest();
        var fd = new FormData();

        xhr.open("POST", uri, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) { 
            }
        };
        fd.append('documentA', nameDocument.files[0], fileName + fileType);
        fd.append('path', "Training Agreement/");
        // Initiate a multipart/form-data upload
        xhr.send(fd);
    }
    
    
    if(!validateDate(dateField.value)) { displayError("generalDetailsDate,"); }
    else{
        var params = JSON.stringify({
            type: "general", 
            uid: localStorage.getItem("email"),
            title: document.getElementById("salutation").value,
            first: document.getElementById("traineeFirstName").value, 
            middle: document.getElementById("traineeMiddleName").value, 
            last: document.getElementById("traineeLastName").value, 
            preferredName: document.getElementById("traineePreferredName").value, 
            previousName: document.getElementById("traineePreviousName").value, 
            previousNameDocument: fileName + fileType, 
            gender: document.getElementById("traineeGender").value,
            dob: document.getElementById("generalDetailsDate").value,
            nsn: document.getElementById("traineeNSN").value,
            MOEExemption: document.getElementById("traineeMOEEN").value
        });
        
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
        
        nextSection('contactDetails');

    }
}

function contactDetails(){
    var compulsoryFields = ["postalAddress", "route", "locality", "postal_code", "country", "mobilePhone"];
    if(!checkDataEntered(compulsoryFields)) return;
    
    var workPhone = document.getElementById("workPhone");
    var homePhone = document.getElementById("homePhone");
    var mobile = document.getElementById("mobile");
    var email = document.getElementById("email");
    
    var valid = true;
    
    if(!validateEmail(email.value)) { valid = false; displayError("email,"); }
    
    if(valid){   
        var params = JSON.stringify(
            {
                type: "contact", 
                uid: localStorage.getItem("email"),
                address: document.getElementById("postalAddress").value,
                streetNum: document.getElementById("street_number").value, 
                streetName: document.getElementById("route").value, 
                city: document.getElementById("locality").value,
                region: document.getElementById("administrative_area_level_1").value,
                postCode: document.getElementById("postal_code").value,
                country: document.getElementById("country").value,
                workPhone: document.getElementById("workPhone").value,
                homePhone: document.getElementById("homePhone").value,
                mobile: document.getElementById("mobilePhone").value,
                email: email.value
            });
        
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
        
        nextSection('ethnicity');
        //updateProgressBar();
    }
}

function ethnicity(){
    var checkBoxes = document.getElementById('columnContainer').getElementsByTagName('input');
    var other = document.getElementById('otherTextBox');
    var dontKnow = document.getElementById('dontKnow');
    var dontIdentify = document.getElementById('dontIdentify');
    var ethnicities = "";
    
    var valid = true;
    
    for(var i = 0; i < checkBoxes.length; i++){
        if(checkBoxes[i].checked){
            if(checkBoxes[i].id == "Other")ethnicities += other.value + ",";
            else ethnicities += checkBoxes[i].id + ",";
        }
    }
    if(!validateNumberOfSelections(ethnicities, 1, 3)) {valid = false; displayError('TooMany,ethnicity,1,3')}
    
    //NZ Maori ticked and neither 'don't know' or 'don't identify' ticked
    if(NZMaori.checked && !(dontKnow.checked || dontIdentify.checked)){
        checkDataEntered(["iwi"]);
        if(!validateNumberOfSelections(iwi.value, 1, 3)) { valid = false; displayError('TooMany,iwi,1,3'); }
    }
    
    if(valid){
        var ethSplit = ethnicities.split(",");
        var iwiSplit = document.getElementById("iwi").value.split(",");
        var ethnicity1 = "";
        var ethnicity2 = "";
        var ethnicity3 = "";
        var iwi1 = "";
        var iwi2 = "";
        var iwi3 = "";
        
        if(ethSplit[0] != undefined) ethnicity1 = ethSplit[0];
        if(ethSplit[1] != undefined) ethnicity2 = ethSplit[1];
        if(ethSplit[2] != undefined) ethnicity3 = ethSplit[2];
        
        if(iwiSplit[0] != undefined) iwi1 = iwiSplit[0];
        if(iwiSplit[1] != undefined) iwi2 = iwiSplit[1];
        if(iwiSplit[2] != undefined) iwi3 = iwiSplit[2];
        
        var params = JSON.stringify({type: "ethnicity", uid: localStorage.getItem("email"), ethnicity1: ethnicity1, ethnicity2: ethnicity2, ethnicity3: ethnicity3, iwi1: iwi1, iwi2: iwi2, iwi3: iwi3});       
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
                                     
        nextSection('education');
    }
}

function education(){
    var schoolYear = document.getElementById('lastSchoolYear');
    var tertiaryYear = document.getElementById('tertiaryYear');
    
    var compulsoryFields = ["lastSchoolYear", "language"];
    if(!checkDataEntered(compulsoryFields)) return;
    
    var valid = true;
    
    if (document.getElementById("HighestTertiaryQual").selectedIndex > 0){
        if(!validateYear(tertiaryYear.value)) { valid = false; displayError('tertiaryYear,'); }
    }
    
    if(!validateYear(schoolYear.value)) { valid = false; displayError('lastSchoolYear,'); }    
    
    if(valid){
        var params = JSON.stringify(
            {
                type: "education", 
                uid: localStorage.getItem("email"), 
                secondarySchoolCountry: document.getElementById("schoolCountry").value, 
                secondarySchool: document.getElementById("secondarySchool").value, 
                lastYearSchool: document.getElementById("lastSchoolYear").value,
                mainLanguage: document.getElementById("language").value,
                highestSecondQual: document.getElementById("HighestSecondryQual").value,
                highestTertiaryQual: document.getElementById("HighestTertiaryQual").value,
                qualificationLevel: document.getElementById("qualificationLevel").value,
                firstYearTertiary: document.getElementById("tertiaryYear").value,
                priorActivity: document.getElementById("previousEmployment").value
            });
        
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );    
        
        nextSection('learningSkills');
    }
}

function learningSkills(){
    console.log(document.getElementById("completedAssessment").selectedIndex + ", " + document.getElementById("typeOfAssessment").selectIndex + ", " + document.getElementById("assessmentProvider").value);
    
    
    if(document.getElementById("completedAssessment").selectedIndex == 0) {
        if(document.getElementById("typeOfAssessment").selectIndex == 0) { displayError("typeOfAssessment,"); return; }
    }
    if(document.getElementById("typeOfAssessment").selectedIndex > 0){
        if(document.getElementById("assessmentProvider").value == "") { displayError("assessmentProvider,"); return; }
    }
    
    if(document.getElementById("learningDifficulty").selectedIndex > 0 && document.getElementById("learningDifficultyDescription").value == "") { displayError("learningDifficultyDescription,"); return; }
           
    var params = JSON.stringify(
            {
                type: "learningSkills", 
                uid: localStorage.getItem("email"), 
                previousEmployment: document.getElementById("previousEmployment").value, 
                completedAssessment: document.getElementById("completedAssessment").value, 
                assessment: document.getElementById("typeOfAssessment").value,
                assessmentCompletedWith: document.getElementById("assessmentProvider").value,
                learningDifficulty: document.getElementById("learningDifficulty").value,
                learningDifficultyType: document.getElementById("learningDifficultyDescription").value
            });
        
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
    
    nextSection('employerInfo');
}

function employerInfo(){
    var compulsoryFields = ["companyName", "employerPostalAddress", "employerStreetAddress", "mainContact", "contactDDI", "contactEmail"];
    if(!checkDataEntered(compulsoryFields)) return;
    
    var mobile = document.getElementById('employerMobile');
    var landline = document.getElementById('employerLandline');
    var email = document.getElementById('employerEmail');
    
    var valid = true;
    
    //if(mobile.value.trim() != "" && validatePhoneNumber(mobile.value) != "valid") { valid = false; displayError("employerMobile"); }
    //if(validatePhoneNumber(landline.value) != "valid") { valid = false; displayError("employerLandline"); }
    //if(!validateEmail(email.value)) { valid = false; displayError("employerEmail"); }
    
    if(valid){
        var params = JSON.stringify(
            {
                type: "employer", 
                uid: localStorage.getItem("email"), 
                companyName: document.getElementById("companyName").value, 
                tradingAs: document.getElementById("tradingAs").value, 
                employerPostalAddress: document.getElementById("employerPostalAddress").value,
                employerStreetAddress: document.getElementById("employerStreetAddress").value,
                employerContactName: document.getElementById("mainContact").value,
                employerContactDDI: document.getElementById("contactDDI").value,
                employerMobile: document.getElementById("contactMobile").value,
                employerEmail: document.getElementById("contactEmail").value
            });
        
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
        
        nextSection('identity');
    }
}
    
function identity(){
    var date = document.getElementById('passportExpiry');
    var passportNumber = document.getElementById('passportNumber');
    var birthCertNumber = document.getElementById('birthCertificate');
    var documentA = document.getElementById("verificationDocumentA");
    var documentB = document.getElementById("verificationDocumentB");
    var documentC = document.getElementById("verificationDocumentC");
    
    var valid = true;
    
    if(passportNumber.value == "" && birthCertNumber.value == "" && documentA.files.length == 0 && documentB.files.length == 0 && documentC.files.length == 0){
        valid = false;
        alert("Please fill out at least one section");
        return;
    }
    
    if(passportNumber.value != ""){
        if(!validateDate(date.value)) { valid = false; displayError('passportExpiry'); return;}
    }
    
    
    if(documentA.files.length != 0 || documentB.files.length != 0 || documentC.files.length != 0){
        var fileNameA = "";
        var fileNameB = "";
        var fileNameC = "";
        var documentAType = "";
        var documentBType = "";
        var documentCType = "";
        
        //upload the files!
        var uri = "../application/upload.php";
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        
        xhr.open("POST", uri, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) { 
            }
        };

        if(documentA.files.length != 0){
            documentAType = documentA.files[0].name.split('.').pop();
            fileNameA = "sil_online_" + document.getElementById("traineeFirstName").value + "_" + document.getElementById("traineeLastName").value + "_Training Agreement_V1-" + localStorage.getItem("email") + "." + documentAType;
            fd.append('documentA', documentA.files[0], fileNameA);
        }

        if(documentB.files.length != 0){
            documentBType = documentB.files[0].name.split('.').pop(); 
            fileNameB = "sil_online_" + document.getElementById("traineeFirstName").value + "_" + document.getElementById("traineeLastName").value + "_Training Agreement_V2-" + localStorage.getItem("email") + "." + documentBType;
            fd.append('documentB', documentB.files[0], fileNameB);
        }

        if(documentC.files.length != 0){
            documentCType = documentC.files[0].name.split('.').pop();
            fileNameC = "sil_online_" + document.getElementById("traineeFirstName").value + "_" + document.getElementById("traineeLastName").value + "_Training Agreement_V3-" + localStorage.getItem("email") + "." + documentCType;
            fd.append('documentC', documentC.files[0], fileNameC);
        }
        fd.append('path', "Training Agreement/");
        // Initiate a multipart/form-data upload
        xhr.send(fd);
    }
    
    if(valid){
        var params = JSON.stringify({
            type: "identity", 
            uid: localStorage.getItem("email"), 
            passportNumber: passportNumber.value, 
            passportExpiry: date.value, 
            birthCertNumber: birthCertNumber.value, 
            identificationMethod: document.getElementById("idMethod").value, 
            documentA: fileNameA, 
            documentB: fileNameB, 
            documentC: fileNameC
        });
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );

        nextSection('terms');
    }
}

function terms(){
    var fields = ["traineeFirstName", "traineeLastName", "generalDetailsDate", "route", "locality", "postal_code", "country", "mobilePhone", "email", "lastSchoolYear", "language", "companyName", "employerPostalAddress", "employerStreetAddress", "mainContact", "contactDDI", "contactEmail"];
    checkDataEntered(fields);
    var documentA = document.getElementById("verificationDocumentA");
    var documentB = document.getElementById("verificationDocumentB");
    var documentC = document.getElementById("verificationDocumentC");
    
    if(documentA.files.length == 0 && documentB.files.length == 0 && documentC.files.length == 0 && document.getElementById("passportNumber").value == "" && document.getElementById("birthCertificate").value == ""){
        alert("Please fill out one section for proof of identity");
        return;
    }
    
    var check = document.getElementById("agreeTerms");
    
    if(check.checked){
        var params = JSON.stringify({type: "terms", uid: localStorage.getItem("email")});
        submitData(
            '../application/views/Forms/Training Agreement/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
        
        //go to payment
        window.location.href = localStorage.getItem("url") + "index.php/Payment/?form=trainingagreement&uid=" + localStorage.getItem("email") + "&submitter=1&amount=" + trainingAgreementAmount;
    }
    else{ displayError("termsAgree"); }
}

function submitData(url, params, success, error) {
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

function dataSaved(response){
    return true;
}

function dataSavingError(response){
    return false;
}