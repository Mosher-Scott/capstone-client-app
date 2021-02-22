<?php
function devConnect(){
    
    if ($_SERVER["DOCUMENT_ROOT"] == "C:/Users/smosher/source/repos/capstone-client-app") {
        $server = 'localhost';
        $dbname = 'fitnessapp';
        $userName = "localUser";
        $password = "testing123";
    } else {
        $server = 'localhost';
        $dbname = 'scott58_capstonefitness';
        $userName = 'scott58_capstone';
        $password = 'SwingKid98!';
    }
    

    /********   IMPORTANT  ************
     * To get this working on another site, you will need to also put the username/password into the acme/sql/dbConnection.php file */
     
    
    $dsn = 'mysql:host='.$server.';dbname='.$dbname;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // Create the actual connection object and assign it to a variable
    try {
     $link = new PDO($dsn, $userName, $password, $options);
     return $link;
    } catch(PDOException $e) {
        
     print_r($e);
     exit;
    }
   }
?>
