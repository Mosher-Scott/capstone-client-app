<?php
function devConnect(){
    echo($_SERVER["DOCUMENT_ROOT"]);
    if ($_SERVER["DOCUMENT_ROOT"] == "C:/Users/smosher/source/repos/capstone-client-app" || $_SERVER["DOCUMENT_ROOT"] == "G:/xampp/htdocs") {
        $server = 'localhost';
        $dbname = 'fitnessapp';
        $userName = "localUser";
        $password = "testing123";

        $dsn = 'mysql:host='.$server.';dbname='.$dbname;
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        // Create the actual connection object and assign it to a variable
        try {
            //echo("Connecting to db");
         $link = new PDO($dsn, $userName, $password, $options);
         return $link;
        } catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    } else {
        $server = 'localhost';
        $dbname = 'scott58_capstonefitness';
        $userName = 'scott58_capstone';
        $password = 'SwingKid98!';

        try {
            $conn = new PDO("mysql:host=$server;dbname=$dbname", $userName, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    
   }
}
?>
