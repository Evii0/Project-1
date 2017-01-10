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
        $sql = $conn->prepare('SELECT * FROM realestate WHERE uid = ?');
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
            $sql = $conn->prepare('INSERT INTO realestate (uid) VALUES (?)');
            $sql->bind_param("s", $data["uid"]);
            $sql->execute();
            $sql->close();
        }
    }

    if($data["type"] == "selection"){
        $sql = $conn->prepare('UPDATE realestate SET salesPerson=?, propertyManagement=?, branchAgentManagement=? WHERE uid=?'); 
        $sql->bind_param("ssss", $data["salesPerson"], $data["propertyManagement"], $data["branchAgentManagement"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    if($data["type"] == "recognition"){
        $sql = $conn->prepare('UPDATE realestate SET recogniseQualification=?, qualification=?, qualificationFile=?, recogniseTransTasman=?, transTasmanQualification=?, dateTransfer=?, transTasmanFile=?, completed="Yes" WHERE uid=?'); 
        $sql->bind_param("ssssssss", $data["recogniseQualification"], $data["qualification"], $data["qualificaitonFile"], $data["recogniseTransTasman"], $data["transTasmanQualification"], $data["dateTransfer"], $data["transTasmanFile"], $data["uid"]);
        $sql->execute();
        
        if(!$sql) var_dump(http_response_code(400));
        
        $sql->close();
    }

    //send the response
    echo json_encode($aResult);
?>