function displayError(incorrectFields){    
    var split = incorrectFields.split(",");
    for(var i = 0; i < split.length-1; i++){
        document.getElementById(split[i]).style.borderColor = "red";
    }
    alert("Incorrect/Missing Information");
    return;
}

function traineeInformation(){
    var valid = true;
    var invalid = "";

    var title = document.getElementById("title").value;
    var firstName = document.getElementById("traineeFirstName").value;
    var middleName = document.getElementById("traineeMiddleName").value;
    var lastName = document.getElementById("traineeLastName").value;
    var gender = document.getElementById("gender").value;
    var date = document.getElementById("traineeDOB").value;

    if(firstName == ("")){
        invalid += "traineeFirstName,";
        valid = false;
    }
    if(lastName == ("")){ 
        invalid += "traineeLastName,";
        valid = false;
    }

    if(!validateDate(date)) { 
        invalid += "traineeDOB,";
        valid = false; 
    }
    
    if(invalid != "") displayError(invalid);

    if(valid){
        var params = JSON.stringify({type: "trainee", uid: localStorage.getItem("email"), title: title, first: firstName, middle: middleName, last: lastName, gender: gender, date: date});
        submitData(
            '../application/views/Forms/International/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            test,  // handle successful request
            test1    // handle error
        );
        
        nextSection("contactDetails"); 
    }
}

function contactDetails(){
    var fields = ["route", "locality", "postal_code", "country"];
    var email = document.getElementById("email");
    var invalid = "";
    for(var i = 0; i < fields.length; i++){
        if(document.getElementById(fields[i]).value == "")invalid += fields[i] + ",";
    }   
    if(!validateEmail(email.value)) { invalid += "email,"; }
    
    if(invalid != "") { displayError(invalid); }

    if(invalid == ""){
        var params = JSON.stringify(
            {
                type: "contact", 
                uid: localStorage.getItem("email"), 
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
            '../application/views/Forms/International/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            test,  // handle successful request
            test1    // handle error
        ); 
            
        nextSection('proofIdentity');
        //updateProgressBar();
    }
}

function proofIdentity(){
    /*
    there is a file size limit, not sure what it is.
    by limit I mean if you try to upload something too large it just breaks
    */
    var documentA = document.getElementById("verificationDocumentA");   
    var documentB = document.getElementById("verificationDocumentB");
    var uploadedA = document.getElementById("verificationDocumentAUploaded");
    var uploadedB = document.getElementById("verificationDocumentBUploaded");
    
    if(documentA.files.length == 0 && documentB.files.length == 0 && uploadedA.innerHTML == "" && uploadedB.innerHTML == ""){
        window.alert("Please upload at least one document");
        return;
    }
    if(document.getElementById("traineeFirstName").value == "" || document.getElementById("traineeLastName").value == "") alert("Please fill out the sections prior to this before uploading your files.");
    
    var uri = "../application/upload.php";
    var xhr = new XMLHttpRequest();
    var fd = new FormData();

    xhr.open("POST", uri, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) { 
        }
    };
    
    var fileNameA = "sil_online_" + document.getElementById("traineeFirstName").value + "_" + document.getElementById("traineeLastName").value + "_International_V1-" + localStorage.getItem("email") + ".";
    var fileNameB = "sil_online_" + document.getElementById("traineeFirstName").value + "_" + document.getElementById("traineeLastName").value + "_International_V2-" + localStorage.getItem("email") + ".";
    
    if(documentA.files.length != 0){
        var documentAType = documentA.files[0].name.split('.').pop();
        fd.append('documentA', documentA.files[0], fileNameA + documentAType);
    }
    
    if(documentB.files.length != 0){ 
        var documentBType = documentB.files[0].name.split('.').pop();
        fd.append('documentB', documentB.files[0], fileNameB + documentBType);
    }
    
    fd.append('path', "International/");
    // Initiate a multipart/form-data upload
    xhr.send(fd);
    
    var docType;
    if(document.getElementById("idMethod").selectedIndex == -1) docType = "Passport";
    else docType = document.getElementById("idMethod").options[document.getElementById("idMethod").selectedIndex].value;
     
    var params = JSON.stringify({type: "identity", uid: localStorage.getItem("email"), docType: docType, documentA: fileNameA, documentB: fileNameB});
        submitData(
            '../application/views/Forms/International/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            test,  // handle successful request
            test1    // handle error
        );
    
    nextSection('terms');
}


function terms(){
    var fields = ["traineeFirstName", "traineeLastName", "traineeDOB", "route", "locality", "postal_code", "country", "mobilePhone", "email"];
    checkDataEntered(fields);
    var documentA = document.getElementById("verificationDocumentA");   
    var documentB = document.getElementById("verificationDocumentB");
    var uploadedA = document.getElementById("verificationDocumentAUploaded");
    var uploadedB = document.getElementById("verificationDocumentBUploaded");
    
    if(documentA.files.length == 0 && documentB.files.length == 0 && uploadedA.innerHTML == "" && uploadedB.innerHTML == ""){
        window.alert("Please upload at least one document for proof of identity");
        return;
    }
    
    var check = document.getElementById("agreeTerms");
    
    if(check.checked){
        var params = JSON.stringify({type: "terms", uid: localStorage.getItem("email")});
        submitData(
            '../application/views/Forms/International/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            test,  // handle successful request
            test1    // handle error
        );
        
        //go to payment
        //window.location.href = "";
    }
    else{ displayError("termsAgree"); }
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

function test(response){
    return true;
}

function test1(response){
    return false;
}