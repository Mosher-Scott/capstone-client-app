<?php
session_start();

include_once('../common/header.php');
include_once('../common/nav.php');
include_once('../library/connections.php');
include_once('../model/accounts.php');
include_once('../scripts/login-scripts.php');

$action = filter_input(INPUT_POST,'pageType');


if ($action == NULL) {
    $action = filter_input(INPUT_GET,'action');
 }

 switch($action) {
    case 'signInRequest':

        // Filter & check patterns
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmailFormat($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        //$passwordCheck = checkPasswordFormat($clientPassword);

        // If anything is wrong, send the user back to the page & have them fix things
        if (empty($clientEmail) || empty($clientPassword)) {
            $message = '<p class="errorMessage">Please enter a valid email address and password</p>';
            include '../view/login.php';
            exit;
        }

        // If you've gotten this far, then the user inputs are valid.  Now get the user data
        $clientData = getClient($clientEmail);

        // Now verify the passwords match using hash
        // EDIT: NOT USING THIS RIGHT NOW
        // $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        // if (!$hashCheck) {
        //     $message = '<p class="errorMessage">Please enter a valid password</p>';
        //     include '../view/login.php';
        //     exit;
        // }

        // Unhashed passwords
        if($clientData['clientPassword'] != $clientPassword) {
            $message = '<p class="errorMessage">Please enter a valid password</p>';
            header('../view/login.php');
            exit;
        }

        // If their login information is good, store some of it in the session data
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the session data
        array_pop($clientData);

        // Now store the rest in the session array
        $_SESSION['clientData'] = $clientData;


        header('../view/home.php');
        exit;

 }

?>