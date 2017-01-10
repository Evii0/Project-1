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

    //load any previous data from the form
    if($data["type"] == "load"){
        $sql = $conn->prepare('SELECT * FROM trainingagreement WHERE uid = ?');
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        $result = $sql->get_result();
        
        $sqlData = "";
        $count = 0;
        while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            foreach ($row as $r)
            {
                //don't bother returning the uid (the first item in the array)
                if($count == 0){
                    $count = 1;
                    continue;
                }
                $sqlData .= $r . "&";
            }
        }
        //remove trailing &
        $aResult["data"] = substr($sqlData, 0, (strlen($sqlData) - 1));
        
        if(!$aResult["data"]){
            $sql = $conn->prepare('INSERT INTO trainingagreement (uid) VALUES (?)');
            $sql->bind_param("s", $data["uid"]);
            $sql->execute();
            $sql->close();
        }
    }

    if($data["type"] == "general"){
        $sql = $conn->prepare('UPDATE trainingagreement SET title=?, firstName=?, middleName=?, lastName=?, preferredName=?, previousName=?, previousNameDocument=?, gender=?, dob=?, nsn=?, MOEExemption=? WHERE uid=?'); 
        $sql->bind_param("ssssssssssss", $data["title"], $data["first"], $data["middle"], $data["last"], $data["preferredName"], $data["previousName"], $data["previousNameDocument"], $data["gender"], $data["dob"], $data["nsn"], $data["MOEExemption"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "contact"){
        $sql = $conn->prepare('UPDATE trainingagreement SET address=?, streetNumber=?, streetName=?, city=?, region=?, postCode=?, country=?, workPhone=?, homePhone=?, mobile=?, email=? WHERE uid=?'); 
        $sql->bind_param("ssssssssssss", $data["address"], $data["streetNum"], $data["streetName"], $data["city"], $data["region"], $data["postCode"], $data["country"], $data["workPhone"], $data["homePhone"], $data["mobile"], $data["email"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "ethnicity"){
        $sql = $conn->prepare('UPDATE trainingagreement SET ethnicity1=?, ethnicity2=?, ethnicity3=?, iwi1=?, iwi2=?, iwi3=? WHERE uid=?'); 
        $sql->bind_param("sssssss", $data["ethnicity1"], $data["ethnicity2"], $data["ethnicity3"], $data["iwi1"], $data["iwi2"], $data["iwi3"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "education"){
        $sql = $conn->prepare('UPDATE trainingagreement SET secondarySchoolCountry=?, secondarySchool=?, lastYearSchool=?, mainLanguage=?, highestSecondQual=?, highestTertiaryQual=?, qualificationLevel=?, firstYearTertiary=?, priorActivity=? WHERE uid=?'); 
        $sql->bind_param("ssssssssss", $data["secondarySchoolCountry"], $data["secondarySchool"], $data["lastYearSchool"], $data["mainLanguage"], $data["highestSecondQual"], $data["highestTertiaryQual"], $data["qualificationLevel"], $data["firstYearTertiary"], $data["priorActivity"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "learningSkills"){
        $sql = $conn->prepare('UPDATE trainingagreement SET previousEmployment=?, completedAssessment=?, assessment=?, assessmentCompletedWith=?, learningDifficulty=?, learningDifficultyType=? WHERE uid=?'); 
        $sql->bind_param("sssssss", $data["previousEmployment"], $data["completedAssessment"], $data["assessment"], $data["assessmentCompletedWith"], $data["learningDifficulty"], $data["learningDifficultyType"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "employer"){
        $sql = $conn->prepare('UPDATE trainingagreement SET companyName=?, tradingAs=?, employerPostalAddress=?, employerStreetAddress=?, employerContactName=?, employerContactDDI=?, employerMobile=?, employerEmail=?  WHERE uid=?'); 
        $sql->bind_param("sssssssss", $data["companyName"], $data["tradingAs"], $data["employerPostalAddress"], $data["employerStreetAddress"], $data["employerContactName"], $data["employerContactDDI"], $data["employerMobile"], $data["employerEmail"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "identity"){
        $sql = $conn->prepare('UPDATE trainingagreement SET passportNumber=?, passportExpiry=?, birthCertNumber=?, identificationMethod=?, documentA=?, documentB=?, documentC=?  WHERE uid=?'); 
        $sql->bind_param("ssssssss", $data["passportNumber"], $data["passportExpiry"], $data["birthCertNumber"], $data["identificationMethod"], $data["documentA"], $data["documentB"], $data["documentC"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "terms"){
        $sql = $conn->prepare('UPDATE trainingagreement SET completed="Yes" WHERE uid=?'); 
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    //send the response
    echo json_encode($aResult);
?>