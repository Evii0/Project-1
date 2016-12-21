<?php
    $aResult = array();
    $data = json_decode(file_get_contents('php://input'), true);

    //received username/hash for logging in.
    if($data["type"] == "login"){
        //using pdo as it allows for databases running basically anything
        $sql = $conn->prepare('SELECT hash FROM Logins WHERE UID = ?'); 
        $sql->bind_param("i", $data["uid"]));
        $sql->execute();
        //save hash from database
        $sql->bind_result($hash);
        $sql->fetch();
	    $sql->close();
        
        //create hash of given password
        $passHash = password_hash(data["pass"], PASSWORD_BCRYPT);
        
        if($hash != $passHash){ $aResult['error'] = 'Incorrect username or password'; }
        else{
            $login = generateAndSaveToken();
            if($login) $aResult['result'] = "success";
            else $aResult['error'] = "Could not access database";
        }  
    }
    
    //User is logging out, so remove login token from database
    if($data["type"] == "logout"){
        $sql = $conn->prepare('DELETE FROM CurrentUsers WHERE uid = ?');
        $sql->bind_param("i", $data["uid"]));
        $sql->execute();
        $sql->close();
    }

    //creating new account
    if($data["type"] == "create"){
        $passHash = password_hash(data["pass"], PASSWORD_BCRYPT);
        
        $sql = $conn->prepare('INSERT INTO Logins VALUES (?, ?);'); 
        $sql->bind_param("is", $data["uid"], passHash));
        $sql->execute();
        $sql->close();
        
        $token = generateAndSaveToken();
        if($login) $aResult['result'] = $token;
        else $aResult['error'] = "Could not access database";
    }

    //validate user's token
    if($data["type"] == "validate"){
        $sql = $conn->prepare('SELECT token, fullName FROM CurrentUsers WHERE uid = ?');
        $sql->bind_param("i", $data["uid"]));
        $sql->execute();
        
        //save token from DB
        $sql->bind_result($token, $fullName);
        $sql->fetch();
        $sql->close();
        
        if($data["token"] != $token) { $aResult['error'] = "Mismatched token. Token is either wrong or does not exist"; }
        else{ $aResult['success'] = $fullName; }
    }



    echo json_encode($aResult);

    //helper function for creating a token for the user to validate them.
    function generateAndSaveToken(){        
        //generate token for session
        $token = hash('ripemd160', $data["uid"] . time() . mt_rand());
        
        //get rid of any previous tokens
        $presql = $conn->prepare('DELETE FROM CurrentUsers WHERE uid = ?');
        $presql->bind_param("i", $data["uid"]));
        $presql->execute();
        $presql->close();
        
        //save token to database.
        $sql = $conn->prepare('INSERT INTO CurrentUsers VALUES(?, ?);'); 
        $sql->bind_param("is", $data["uid"], $token);
        $sql->execute();
        $sql->close;
        
        return $token;
    }
?>