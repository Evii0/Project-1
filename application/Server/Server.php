<?php
    $aResult = array();
    $data = json_decode(file_get_contents('php://input'), true);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //validate user's token
    if($data["type"] == "validate"){
        $sql = $conn->prepare('SELECT token, fullName FROM CurrentUsers WHERE uid = ?');
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        
        //save token from DB
        $sql->bind_result($token, $fullName);
        $sql->fetch();
        $sql->close();
        
        if($token != $data["token"] || $token == "") { 
            var_dump(http_response_code(400));
            $aResult['error'] = "Mismatched token. Token is either wrong or does not exist"; 
        }
        else{ $aResult['name'] = $fullName; }
    }


    if($data["type"] == "getListOfForms"){
        $sql = $conn->prepare('SELECT forms FROM Users WHERE uid = ?');
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        
        //save token from DB
        $sql->bind_result($forms);
        $sql->fetch();  
        $sql->close();
        
        $formsList = explode(",", $forms);
        $returnString = "";
        
        if($forms != ""){
            foreach($formsList as $form){
                $newSql = $conn->prepare("SELECT completed FROM " . str_replace(' ', '', $form) . " WHERE uid = ?");
                $newSql->bind_param("s", $data["uid"]);
                $newSql->execute();

                //save token from DB
                $newSql->bind_result($completed);
                $newSql->fetch();
                $newSql->close();
                
                //they have at least started the form
                if($completed != ""){ $returnString .= $form . ";" . $completed . "&"; }
                //haven't even started the form, so there's no data to get from the database.
                else $returnString .= $form . ";No&";
                
            }
            $aResult['forms'] = substr($returnString, 0, (strlen($returnString) - 1));
        }
        
        else{ $aResult['error'] = "No forms to complete"; }     
        
    }

    if($data["type"] == "retrieveFormInfo"){   
        $sql = $conn->prepare("SELECT * FROM ? WHERE uid = ?");
        $sql->bind_param("is", $data["form"], $data["uid"]);
        $sql->execute();

        $result = $stmt->get_result();
        $num_of_rows = $result->num_rows;
        
        $sql->close();
        
        //there's saved stuff!
        if($num_of_rows > 0){
            $aResult['success'] = implode("&", $result->fetch_array(MYSQLI_NUM));
        }
        //no saved information :'(
        else{ $aResult['error'] = "no saved information"; }
    }

    echo json_encode($aResult);

/*
    $contactDetails = "streetNum, streetName, city, region, postCode, country, workPhone, homePhone, mobile, email";
        $education = "schoolCountry, secondarySchool, lastSchoolYear, language, secondaryQual, HighestTertiaryQual, qualificationLevel, tertiaryYear, previousEmployment";
        $employerInfo = "companyName, tradingAs, postalAddress, streetAddress, mainContact, contactDDI, contactMobile, contactEmail";
        $ethnicity = "ethnicities, iwi";
        $generalDetails = "title, traineeFirstName, traineeMiddleName, traineeLastName, traineeGender, traineeDOB";
        $identity = "passportNumber, passportExpiry, birthCertificate, idMethod";
        $learningSkills = "previousEmployment, completedAssessment, typeOfAssessment, assessmentProvider, learningDifficulty, learningDifficultyDescription";
        
        $streetNum, $streetName, $city, $region, $postCode, $country, $workPhone, $homePhone, $mobile, $email, $schoolCountry, $secondarySchool, $lastSchoolYear, $language, $secondaryQual, $HighestTertiaryQual, $qualificationLevel, $tertiaryYear, $previousEmployment, $companyName, $tradingAs, $postalAddress, $streetAddress, $mainContact, $contactDDI, $contactMobile, $contactEmail, $ethnicities, $iwi, $title, $traineeFirstName, $traineeMiddleName, $traineeLastName, $traineeGender, $traineeDOB, $passportNumber, $passportExpiry, $birthCertificate, $idMethod, $previousEmployment, $completedAssessment, $typeOfAssessment, $assessmentProvider, $learningDifficulty, $learningDifficultyDescription
        
        $aResult['success'] = $streetNum  . "&" .  $streetName  . "&" . $city . "&" . $region . "&" . $postCode . "&" . $country . "&" . $workPhone . "&" . $homePhone . "&" . $mobile . "&" . $email . "&" . $schoolCountry . "&" . $secondarySchool . "&" . $lastSchoolYear . "&" . $language . "&" . $secondaryQual . "&" . $HighestTertiaryQual . "&" . $qualificationLevel . "&" . $tertiaryYear . "&" . $previousEmployment . "&" . $companyName . "&" . $tradingAs . "&" . $postalAddress . "&" . $streetAddress . "&" . $mainContact . "&" . $contactDDI . "&" . $contactMobile . "&" . $contactEmail . "&" . $ethnicities . "&" . $iwi . "&" . $title . "&" . $traineeFirstName . "&" . $traineeMiddleName . "&" . $traineeLastName . "&" . $traineeGender . "&" . $traineeDOB . "&" . $passportNumber . "&" . $passportExpiry . "&" . $birthCertificate . "&" . $idMethod . "&" . $previousEmployment . "&" . $completedAssessment . "&" . $typeOfAssessment . "&" . $assessmentProvider . "&" . $learningDifficulty . "&" . $learningDifficultyDescription;
*/
?>