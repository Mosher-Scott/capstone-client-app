<?php
    include_once('../common/initialize.php');
    include_once($root . '/library/connections.php');
    include_once($root . '/model/accounts.php');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        header('Content-type: application/json');

        if(!isset($_POST['appId'])) {
            $errorArray = array('error' => "appId not found");
            $message = json_encode($errorArray);
            echo($message);
            return;
        } if (!isset($_POST['appSecret'])) {
            $errorArray = array('error' => "appSecret not found");
            $message = json_encode($errorArray);
            echo($message);
            return;
        }

        if(($_POST['appId'] != 'desktopApp') || $_POST['appSecret'] != '192837465') {
            $errorArray = array('error' => "Either your id or secret is incorrect");
            $message = json_encode($errorArray);
            echo($message);
            return;
        }

        if(!isset($_POST['email'])) {
            $errorArray = array('error' => "Email address is not found");
            $message = json_encode($errorArray);
            echo($message);
            return;
        }

        if(!isset($_POST['password'])) {
            $errorArray = array('error' => "Password is not found");
            $message = json_encode($errorArray);
            echo($message);
            return;
        }

        if(!isset($_POST['fitness_app_id'])) {
            $errorArray = array('error' => "fitness App ID not found");
            $message = json_encode($errorArray);
            echo($message);
            return;
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['fitness_app_id'], FILTER_SANITIZE_NUMBER_INT);

        $doesEmailExist = CheckEmail($email);

        //echo($email);
        //echo("<br>" . $doesEmailExist);
        
        if($doesEmailExist == 1) {
            $errorArray = array('error' => "Email already exists");
            $message = json_encode($errorArray);
            echo($message);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $wasSuccessfull = AddNewClient($email, $hashedPassword, $id);

        if($wasSuccessfull == 1) {
            $errorArray = array('success' => "User registered");
            $message = json_encode($errorArray);
            echo($message);
            return;
        } else if ($wasSuccessfull == 0) {
            $errorArray = array('error' => "An error occured adding the user");
            $message = json_encode($errorArray);
            echo($message);
            return;
        }

    } else {
        echo("Get request");
    }

?>