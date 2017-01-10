<?php
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


    $aResult = array();
    $data = json_decode(file_get_contents('php://input'), true);

    //received username/hash for logging in.
    if($data["type"] == "login"){
        //using pdo as it allows for databases running basically anything
        $sql = $conn->prepare('SELECT hash, fullName FROM Logins WHERE uid = ?'); 
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        //save hash from database
        $sql->bind_result($hash, $fullName);
        $sql->fetch();
	    $sql->close();
        
        if(password_verify($data["pass"], $hash) != 1){ 
            var_dump(http_response_code(400)); 
            $aResult['error'] = "Incorrect username or password"; 
        }
        else{
            $token = generateAndSaveToken($data, $conn, $fullName);
            if($token != null) {
                $aResult['token'] = $token;
                $aResult['name'] = $fullName;
            }
            else {
                var_dump(http_response_code(400));
                $aResult['error'] = "Could not access database";
            }  
        }  
    }
    
    //User is logging out, so remove login token from database
    if($data["type"] == "logout"){
        $sql = $conn->prepare('DELETE FROM CurrentUsers WHERE uid = ?');
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        $sql->close();
    }

    //creating new account
    if($data["type"] == "create"){
        
        $sql = $conn->prepare('SELECT uid FROM logins WHERE uid = ?');
        $sql->bind_param("s", $data["uid"]);
        $sql->execute();
        //save token from DB
        $sql->bind_result($uid);
        $sql->fetch();
        $sql->close();
        
        if($uid != null) {
            $aResult['error'] = "There is already an account for that email address.";
            var_dump(http_response_code(400));
        }
        else{
            $passHash = password_hash($data["pass"], PASSWORD_DEFAULT);

            $sql = $conn->prepare('INSERT INTO logins VALUES (?, ?, ?)'); 
            $sql->bind_param("sss", $data["uid"], $passHash, $data["name"]);
            $sql->execute();
            $sql->close();

            $token = generateAndSaveToken($data, $conn);
            if($token != null) $aResult['token'] = $token;
            else $aResult['error'] = "Could not access database";
        }
    }

    echo json_encode($aResult);

    //helper function for creating a token for the user to validate them.
    function generateAndSaveToken($data, $conn, $fullName){        
        //generate token for session
        $token = hash('ripemd160', $data["uid"] . time() . mt_rand());
        
        //get rid of any previous tokens
        $presql = $conn->prepare('DELETE FROM CurrentUsers WHERE uid = ?');
        $presql->bind_param("s", $data["uid"]);
        $presql->execute();
        $presql->close();
        
        //save token to database.
        $sql = $conn->prepare('INSERT INTO currentusers (uid, fullName, token) VALUES(?, ?, ?);'); 
        $sql->bind_param("sss", $data["uid"], $fullName, $token);
        $sql->execute();
        $sql->close();
        
        return $token;
    }
?>