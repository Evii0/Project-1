function displayError(incorrectFields){    
    var split = incorrectFields.split(",");
    for(var i = 0; i < split.length-1; i++){
        document.getElementById(split[i]).style.borderColor = "red";
    }
    alert("Incorrect/Missing Information");
    return;
}

function qualificationSelection(){
    var valid = false;
    var salesPerson = "";
    var property = "";
    var branch = "";

    var radios = document.getElementsByName("sales");
    for( i = 0; i < radios.length; i++){
      if(radios[i].checked){
          salesPerson = radios[i].id;
          valid = true;
      }
    }

    radios = document.getElementsByName("property");
    for( i = 0; i < radios.length; i++){
      if(radios[i].checked){
          property = radios[i].id;
        valid = true;
      }
    }

    radios = document.getElementsByName("branch");
    for( i = 0; i < radios.length; i++){
      if(radios[i].checked){
          branch = radios[i].id;
          valid = true;
      }
    }
    
    
    if(valid){
        var params = JSON.stringify({type: "selection", uid: localStorage.getItem("email"), salesPerson: salesPerson, propertyManagement: property, branchAgentManagement: branch});
        submitData(
            '../application/views/Forms/Real Estate/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
        
        nextSection('qualificationRecognition');
    }
    else{
        alert("Please select a qualification");
    }
}

function qualificationRecognition(){
    var qualification = document.getElementById("qualificationCheckbox");
    var qualList = document.getElementById("qualificationList");
    var qualRecogDocument = document.getElementById("qualRecogUploader");
    var qual = "";
    var qualDocName = "";
    var qualDocType = "";
    
    var transTasman = document.getElementById("tasmanCheckbox");
    var tasQual = document.getElementById("qualificationName").value;
    var tasDate = document.getElementById("transferDate").value;
    var tasDoc = document.getElementById("tasQualUploader");
    var tasDocName = "";
    var tasDocType = "";
    
    if(qualification.checked){
        if(qualList.selectedIndex == -1) qual = "Bachelor of Commerce (Valuation and Property Management) conferred by Lincoln University after 1992";
        else qual = qualList.options[qualList.selectedIndex].value;
        
        if(qualRecogDocument.files.length == 0){
            alert("Please select a file to upload for the recognition of your qualification");
            return;
        }
        else{
            qualDocType = qualRecogDocument.files[0].name.split('.').pop();
            qualDocName = "sil_online_" + localStorage.getItem("name") + "_Real Estate_V1-" + localStorage.getItem("email") + ".";
        }
    }
    
    if(transTasman.checked){
        var missing = "";
        if(tasQual == "")missing += "qualificationName,";
        if(tasDate == "")missing += "transferDate,";
        if(missing != ""){ displayError(missing); return; }
        
        validateDate(tasDate);
        if(tasDoc.files.length == 0){
            alert("Please select a file to upload for your TTMR licence");
            return;
        }
        else{
            tasDocType = tasDoc.files[0].name.split('.').pop();
            tasDocName = "sil_online_" + localStorage.getItem("name") + "_Real Estate_V2-" + localStorage.getItem("email") + ".";
        }
    }
    
    var uri = "../application/upload.php";
    var xhr = new XMLHttpRequest();
    var fd = new FormData();

    xhr.open("POST", uri, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) { 
        }
    };
    fd.append('path', "Real Estate/");
    // Initiate a multipart/form-data upload
    xhr.send(fd);
    
    var params = JSON.stringify({type: "recognition", uid: localStorage.getItem("email"), recogniseQualification: qualification.checked ? "yes" : "no", qualification: qual, qualificaitonFile: qualDocName + qualDocType, recogniseTransTasman: transTasman.checked ? "yes" : "no", transTasmanQualification: tasQual, dateTransfer: tasDate, transTasmanFile: tasDocName + tasDocType});
    alert(params);
        submitData(
            '../application/views/Forms/Real Estate/Server/Server.php/', // URL for the PHP file
            params,   //json arguments
            dataSaved,  // handle successful request
            dataSavingError    // handle error
        );
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
    alert(response);
    return true;
}

function dataSavingError(response){
    alert(response);
    return false;
}