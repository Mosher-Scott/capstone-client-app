<?php
function acmeConnect(){
    $server = 'localhost';
    $dbname = 'acme';

    /********   IMPORTANT  ************
     * To get this working on another site, you will need to also put the username/password into the acme/sql/dbConnection.php file */
     
    $username = "acmeAdmin"; // Desktop
    $password = "newPassword";
    $dsn = 'mysql:host='.$server.';dbname='.$dbname;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // Create the actual connection object and assign it to a variable
    try {
     $link = new PDO($dsn, $username, $password, $options);
     return $link;
    } catch(PDOException $e) {
     header('Location: /acme/view/500.php');
     exit;
    }
   }
?>
