var array = ["title", "traineeFirstName", "traineeMiddleName", "traineeLastName", "gender", "traineeDOB", "street_number", "route", "locality", "administrative_area_level_1", "postal_code", "country", "workPhone", "homePhone", "mobilePhone", "email", "idMethod", "verificationA", "verificationB", "agreeTerms"];

function load(){
    validateLoggedIn();
    var params = JSON.stringify({type: "load", uid: localStorage.getItem("email"),});
    getRequest(
        '../application/views/Forms/International/Server/Server.php/', // URL for the PHP file
        params,   //json arguments
        gotStuff,  // handle successful request
        error    // handle error
    );
    document.getElementById("name").innerHTML = localStorage.getItem("name");
    if(localStorage.getItem("logo") != undefined) document.getElementById("logo").src = "../application/views/Forms/International/assets/logos/" + localStorage.getItem("logo");
    else document.getElementById("logo").src = "../application/views/Forms/International/assets/logos/skillsIntLogo.png";
}

/*
Nothing in the database, onwards!
*/
function error(response){
    alert("Error: Could not access the database. Please try again later.");
}

/*
information saved to database has been retrieved.
*/
function gotStuff(response){
    var json = JSON.parse(response);
    //no data in the database
    if(!json["data"]) return;
    
    //data retrieved
    var data = json["data"].split("&");
    for(var i = 0; i < array.length; i++){
        if(data[i] != ""){
            //special cases (ie not just setting the value)
            if(i == 17){
                if(data[i] == "")continue;
                document.getElementById("verificationDocumentAUploaded").innerHTML = "Verification document A has been uploaded";
            }
            if(i == 18){
                if(data[i] == "")continue;
                document.getElementById("verificationDocumentBUploaded").innerHTML = "Verification document B has been uploaded";
            }
            if(i == 19){
                if(data[i] == "")continue;
                document.getElementById("agreeTerms").checked = true;
            }
            if(i != 17 && i != 18 && i != 19){
                console.log(i + ": " + array[i]);
                document.getElementById(array[i]).value = data[i];
            }
        }
    }
}