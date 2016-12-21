<?php
    $aResult = array();
    $data = json_decode(file_get_contents('php://input'), true);

    if($data["type"] == "getListOfForms"){
        $sql = $conn->prepare('SELECT forms FROM Users WHERE uid = ?');
        $sql->bind_param("i", $data["uid"]));
        $sql->execute();
        
        //save token from DB
        $sql->bind_result($forms);
        $sql->fetch();
        $sql->close();
        
        $formsList = explode(",", $forms);
        $returnString = "";
        
        if($sql->num_rows > 0){
            foreach($formsList as $form){
                $sql = $conn->prepare("SELECT completed FROM " . $form . " WHERE uid = ?");
                $sql->bind_param("i", $data["uid"]));
                $sql->execute();

                //save token from DB
                $sql->bind_result($completed);
                $sql->fetch();
                $sql->close();
                
                //they have at least started the form
                if($sql->num_rows > 0){ $returnString .= $form . ";" . $completed . "&"; }
                //haven't even started the form, so there's no data to get from the database.
                else $returnString .= $form . ";No&";
            }
            $aResult['success'] = substr($returnString, 0, (strlen($returnString) - 1));
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