<?php 
  ob_start();
  session_start();
  require_once('../common/initialize.php');
  //print_r($_SERVER);
  include_once($root . '/common/header.php');
  include_once($root . '/common/nav.php');
  include_once($root . '/library/connections.php');
  include_once($root . '/model/accounts.php');
  include_once($root . '/scripts/clientFunctions.php');
  include_once($root . '/scripts/login-scripts.php');
  include_once($root . '/scripts/api-requests.php');

  $action = filter_input(INPUT_POST,'pageType');

  if ($action == NULL) {
      $action = filter_input(INPUT_GET,'action');
   }
  
   // Check the action of what you wanted the form to do
   switch($action) {
      case 'signInRequest':
  
          // Filter & check patterns
          $clientEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
          $clientEmail = checkEmailFormat($clientEmail);
          $clientPassword = filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING);
  
          // If anything is wrong, send the user back to the page & have them fix things
          if (empty($clientEmail) || empty($clientPassword)) {
              $message = '<p class="errorMessage">Please enter a valid email address and password</p>';
              include 'login.php';
              include '../common/footer.php';
              exit;
          }
          
          // If you've gotten this far, then the user inputs are valid.  Now get the user data
          $clientData = getClient($clientEmail);

          $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

          // Now verify the passwords match using hash
          $hashCheck = password_verify($clientPassword, $clientData['password']);
          
          if (!$hashCheck) {
            $message = '<p class="errorMessage">Please enter a valid password</p>';
            include('login.php');
            include($root . '/common/footer.php');
            exit;
          }
          
          // If their login information is good, store some of it in the session data
          $_SESSION['loggedin'] = TRUE;
  
          // Remove the password from the session data
          array_pop($clientData);
  
          // Now store the rest in the session array
          $_SESSION['clientData'] = $clientData;
          
          header("Location: home.php"); // Taken out for testing

          //include '../common/footer.php';
          include($root . '/common/footer.php');
          exit;

        case 'logout':
          //echo("HI there");

          if ($_SESSION['loggedin'] == 1) {
            //$isLoggedIn = 'Yes';

            $cookie_name = 'email';
            $email = $_SESSION['clientData']['email'];
            $clientId = $_SESSION['clientData']['fitness_app_client_id'];

            setcookie($cookie_name,$email , 1, '/');
            unset($_COOKIE[$cookie_name]);
          } else {
              $isLoggedIn = 'No';
          }
  
          // $_SESSION = array();
          
          // $_SESSION['loggedin'] = 0;

          // Destroy the session
          session_destroy();

          header("location: index.php");
// Comments
      break;

      default:
      //echo($_SESSION['loggedin']);
          if($_SESSION['loggedin'] == TRUE) {
            header("Location: home.php");
            //include '../common/footer.php';
            include($root . '/common/footer.php');
            exit;
          } else {
            //echo("not logged");
          }
          break;
  
   } // End of switch statement

?>

<?php

  // If the user isn't logged in, display the login form
  if(!$_SESSION['loggedin']) {
    include 'login.php';
  } else {
    
  }
  
  
?>






<?php
    include($root . '/common/footer.php');
    ob_end_flush();
?>


