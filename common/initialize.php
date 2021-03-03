<?php
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("IMAGES_PATH", PROJECT_PATH . '/images');
    define("liveURL", "fitness.scottmosherphotography.com");
    define("l2URL", "localhost:90");

    $basePath;
    
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    //echo($root);
    if ($root == "G:\\xampp\htdocs") {
        $root = "G:\\xampp\htdocs\\fitness-app";
    }

    //echo($root);
    //define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . 'capstone-client-app');

    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']);

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path2 = $_SERVER['DOCUMENT_ROOT'] . 'capstone-client-app';

     // * Can dynamically find everything in URL up to "/fitness-app"
     $public_end = strpos($_SERVER['SCRIPT_NAME'], '/') + 0; // Decides that is where the document root is
     $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
     define("WWW_ROOT", $doc_root);

     // Send the function a path
    function urlPath($script_path) {
        
        // Add the leading / if not present
        if($script_path[0] != '/') {
            $script_path = $script_path;
        }


       //return WWW_ROOT . $script_path;
       return WWW_ROOT . $script_path;
    }

   

    if(isset($_COOKIE['firstname'])) {
       
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }

    $_SESSION['loggedin'] = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : FALSE;
   
?>