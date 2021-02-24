<?php 
  include_once('common/header.php');
  include_once('common/nav.php');
  include_once('library/connections.php');
  include_once('model/accounts.php');
  include_once('scripts/login-scripts.php');
  include_once('scripts/api-requests.php');
  //print_r($_SERVER);
  //var_dump($_REQUEST);

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
          //$passwordCheck = checkPasswordFormat($clientPassword);
  
          // If anything is wrong, send the user back to the page & have them fix things
          if (empty($clientEmail) || empty($clientPassword)) {
              $message = '<p class="errorMessage">Please enter a valid email address and password</p>';
              include 'login.php';
              include 'common/footer.php';
              exit;
          }
  
          // If you've gotten this far, then the user inputs are valid.  Now get the user data
          $clientData = getClient($clientEmail);
          //var_dump($clientData);
  
          // Now verify the passwords match using hash
          // EDIT: NOT USING THIS RIGHT NOW
          // $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
          
          // if (!$hashCheck) {
          //     $message = '<p class="errorMessage">Please enter a valid password</p>';
          //     include '../view/login.php';
          //     exit;
          // }
  
          // Unhashed passwords
          if($clientData['password'] != $clientPassword) {
              $message = '<p class="errorMessage">Please enter a valid password</p>';
              include('login.php');
              include 'common/footer.php';
              exit;
          }
  
          // If their login information is good, store some of it in the session data
          $_SESSION['loggedin'] = TRUE;
  
          // Remove the password from the session data
          array_pop($clientData);
  
          // Now store the rest in the session array
          $_SESSION['clientData'] = $clientData;
          
          include('common/loginInfo.php');
  
          //header("location:view/home.php");
         include('home.php');
         include 'common/footer.php';
          exit;

        case 'logout':

          if ($_SESSION['loggedin'] == TRUE && isset($_SESSION['clientData'])) {
              $isLoggedIn = 'Yes';

              $cookie_name = 'email';
          $email = $_SESSION['clientData']['email'];

          setcookie($cookie_name,$email , 1, '/');
          unset($_COOKIE[$cookie_name]);
          } else {
              $isLoggedIn = 'No';
          }
  
          $_SESSION = array();
          
          $_SESSION['loggedin'] = FALSE;

          // Destroy the session
          session_destroy();

          header('location:../index.php');

      break;
  
   } // End of switch statement
  
   






?>



<main>
<?php

  // If the user isn't logged in, display the login form
  if(!$_SESSION['loggedin']) {
    include 'login.php';
  } else {
    
  }
  
  
?>
</main>





<?php
    require_once('common/footer.php');
?>


