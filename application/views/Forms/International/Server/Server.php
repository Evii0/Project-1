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
        $sql = $conn->prepare('SELECT * FROM international WHERE uid = ?');
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        $result = $sql->get_result();
        $sql->close();
        
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
            $sql = $conn->prepare('INSERT INTO international (uid) VALUES (?)');
            $sql->bind_param("s", $data["uid"]);
            $sql->execute();
            $sql->close();
        }
    }

    if($data["type"] == "trainee"){
        $sql = $conn->prepare('UPDATE International SET title=?, firstName=?, middleName=?, lastName=?, gender=?, dob=? WHERE uid=?'); 
        $sql->bind_param("sssssss", $data["title"], $data["first"], $data["middle"], $data["last"], $data["gender"], $data["date"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "contact"){
        $sql = $conn->prepare('UPDATE International SET streetNumber=?, streetName=?, city=?, region=?, postCode=?, country=?, workPhone=?, homePhone=?, mobile=?, email=? WHERE uid=?'); 
        $sql->bind_param("sssssssssss", $data["streetNum"], $data["streetName"], $data["city"], $data["region"], $data["postCode"], $data["country"], $data["workPhone"], $data["homePhone"], $data["mobile"], $data["email"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "identity"){
        $sql = $conn->prepare('UPDATE International SET identityType=?, identityDocumentA=?, identityDocumentB=? WHERE uid=?'); 
        $sql->bind_param("ssss", $data["docType"], $data["documentA"], $data["documentB"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "terms"){
        $sql = $conn->prepare('UPDATE International SET completed="Yes" WHERE uid=?'); 
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    //send the response
    echo json_encode($aResult);
?>