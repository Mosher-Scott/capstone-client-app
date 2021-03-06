<?php
    function CheckEmail($email) {
        $db = devConnect();
        //echo($email);
        $sql = 'SELECT email FROM info WHERE email = :email';

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':email', $email, PDO::PARAM_STR);

        $stmt -> execute();

        $matchFound = $stmt -> fetch(PDO::FETCH_NUM);

        $stmt->closeCursor();

        if(empty($matchFound)){
            return 0;
        } else {
            return 1;
        }
    }

// Get info on client based on email
function getClient($clientEmail) {
    try {
        $db = devConnect();

        $sql = 'SELECT fitness_app_client_id, email, password FROM info WHERE email = :email';
        
        $stmt = $db -> prepare($sql);
        //echo("<h1>suck</h1>");
        $stmt -> bindValue(':email', $clientEmail, PDO::PARAM_STR);
    
        $stmt -> execute();
    
        // We only want to see one result, so use fetch. Using FETCH_ASSOC we get a name/value pair to work with
        $clientData = $stmt -> fetch(PDO::FETCH_ASSOC);
    
        $stmt -> closeCursor();
    
        return $clientData;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;

    }
}

// Add a new client to the database
function AddNewClient($email, $userPassword, $id) {
    try {
        $db = devConnect();

        $sql = 'INSERT INTO info (fitness_app_client_id, email, password) VALUES (:id, :email, :password)';
        
        $stmt = $db -> prepare($sql);
        //echo("<h1>suck</h1>");
        $stmt -> bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> bindValue(':password', $userPassword, PDO::PARAM_STR);
        $stmt -> bindValue(':id', $id, PDO::PARAM_STR);
    
        $stmt -> execute();
    
        // Get the number of rows added
        $rowsChanged = $stmt->rowCount();
    
        $stmt -> closeCursor();
    
        return $rowsChanged;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;

    }
}


?>