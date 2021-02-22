<?php
    function CheckEmail($email) {
        $db = devConnect();


        $sql = 'SELECT email FROM info WHERE email = :email';

        $stmt = $db -> prepare($sql);
        $stmt -> bindValue(':email', $email, PDO::PARAM_STR);

        $stmt -> execute();

        echo($sql);
        echo($email);

        $matchFound = $stmt -> fetch(PDO::FETCH_NUM);

        $stmt->closeCursor();

        if(empty($matchFound)){
            return 0;
        } else {
            return 1;
        }
        
        }
?>