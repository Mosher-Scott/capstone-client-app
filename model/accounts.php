<?php
    function CheckEmail($email) {
        $db = devConnect();

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
    $db = devConnect();

    $sql = 'SELECT fitness_app_client_id, email, password FROM info WHERE email = :email';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':email', $clientEmail, PDO::PARAM_STR);

    $stmt -> execute();

    // We only want to see one result, so use fetch. Using FETCH_ASSOC we get a name/value pair to work with
    $clientData = $stmt -> fetch(PDO::FETCH_ASSOC);

    $stmt -> closeCursor();

    return $clientData;
}


?>