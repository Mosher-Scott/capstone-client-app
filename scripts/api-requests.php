<?php

define("devEnvironment", "http://localhost:90/");
define("liveEnvironment", "https://frozen-meadow-69055.herokuapp.com/");

$environment = liveEnvironment;

$authToken;

define("clientEndpoint", $environment . "clients/");
define("trainingSessionEndpoint", $environment . "trainingsessions/");
define("clientWorkoutHistory", $environment . "clients/workouthistory");
define("exerciseEndpoint", $environment . "exercises/");
define("musculeGroupEndpoint", $environment . "/musclegroups");

class SecureToken {
  public $token = '';
  public $expireIn;
  public $expirationDate;
  public $test = 'hi';

  public function SetExpirationDate() {
    
    date_default_timezone_set('America/Denver');
  
    $today = date("Y-m-d H:i:s");
  
    $todayTimestamp = strtotime($today);
  
    $tokenExpires = $todayTimestamp + 86400;
  
    $expirationdate = date("Y-m-d H:i:s", $tokenExpires);

    $this->expirationDate = $expirationdate;
  }

  public function SetExpireIn($value) {
    $this->expireIn = $value;
  }

  public function SetToken($value) {

    $this->token = $value;
  }

}

$secureToken = new SecureToken();


// Requires an endpoint.  It should be a fully formed endpoint
function GetRequest($endpoint){

  GetAuthToken();

  $tokenString = "Authorization: Bearer " . $_SESSION['validationToken'];

   //var_dump($endpoint);
   $curl = curl_init();

    // From Postman
    curl_setopt_array($curl, array(
        CURLOPT_URL => $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          "$tokenString"
        ),
      ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
}

function PostRequest($endpoint){
  GetAuthToken();
  //var_dump($endpoint);

  $tokenString = "Authorization: Bearer " . $_SESSION['validationToken'];

  $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
    "$tokenString"
  ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
 }

 function PostRequestDataInBody($endpoint, $formData){
  GetAuthToken();
  //echo($formData);
  $curl = curl_init();

  //$formData = "'" . $formData . "'";
  $tokenString = "Authorization: Bearer " . $_SESSION['validationToken'];

  curl_setopt_array($curl, array(
  CURLOPT_URL => $endpoint,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  //CURLOPT_POSTFIELDS =>'{"sessionId":"6","clientId":"1","exercise":[{"id":"7","sets":"1","reps":"1","weight":"10","seconds":""},{"id":"8","sets":"3","reps":"10","weight":"52","seconds":""},{"id":"9","sets":"13","reps":"1","weight":"","seconds":"25"},{"id":"19","sets":"3","reps":"12","weight":"1","seconds":"23"},{"id":"20","sets":"3","reps":"12","weight":"15","seconds":"3"},{"id":"21","sets":"9","reps":"80","weight":"15","seconds":"23"}]}',
  CURLOPT_POSTFIELDS => $formData,
  CURLOPT_HTTPHEADER => array(
    "$tokenString",
    'Content-Type: application/json'
  ),
  ));

  print_r($curl);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    echo $response;
    return $response;
 }

// Parsss a web JSON response, and saves it as an array
function ParseJsonData($response){

    $data = json_decode($response, true);

    return $data;
}

// Gets an auth token to be used in the requests
function GetAuthToken() {
    global $secureToken;

    date_default_timezone_set('America/Denver');
    $validToken = false;

   if(isset($_SESSION['validationToken']) && isset($_SESSION['validationExpires'])) {
     if($_SESSION['validationExpires'] > date("Y-m-d H:i:s"))
     $validToken = true;
    // echo("token is valid");
     return;
   }
   //echo("Token not valid");

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://dev-w4x3pv3a.us.auth0.com/oauth/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{"client_id":"nxX9bmKfRHIYQm8ed9rgHLyuxKCDGfkJ","client_secret":"14jeDljEsFy0P8Jnam8M0fQIOByPjNZu-KDoKFTG6lL1c5GsRFG74E9q8Y8qnY4f","audience":"https://capstone-api-auth","grant_type":"client_credentials"}',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: __cfduid=d3ffb9dc6ab6765031fdfac29981f69551612104410; did=s%3Av0%3A26c33a30-63d3-11eb-923e-8b0fb8b172c4.GkGhLRf3Glj9hLdVmRrwrNY8Z2Y4LORvGl93Akgf6%2B0; did_compat=s%3Av0%3A26c33a30-63d3-11eb-923e-8b0fb8b172c4.GkGhLRf3Glj9hLdVmRrwrNY8Z2Y4LORvGl93Akgf6%2B0'
      ),
    ));
    
    $response = curl_exec($curl);

    curl_close($curl);

    ParseTokenResponse($response);

    return $response;
}

function ParseTokenResponse($response) {
  global $secureToken;
  
  //echo ($response);
  $json = json_decode($response);

  //echo(gettype($json));
 
  $secureToken-> SetToken($json->access_token);
  $secureToken-> SetExpireIn($json->expires_in);
  $secureToken-> SetExpirationDate();

  $_SESSION['validationToken'] = $secureToken->token;
  $_SESSION['validationExpires'] = $secureToken->expirationDate;

  //echo("Secure Token Parse Token Response:" . $secureToken->expirationDate);
  
}

function EchoToken() {
  date_default_timezone_set('America/Denver');
   global $secureToken;

  // echo($secureToken->expirationDate);

  // $today = date("Y-m-d H:i:s");

  // $todayTimestamp = strtotime($today);

  // $tokenExpires = $todayTimestamp + 86400;

  // $expirationdate = date("Y-m-d H:i:s", $tokenExpires);
  echo("token: <br>");
  echo($secureToken->token);
  echo("<br>expirationdate: " . $secureToken->expirationDate);
}

?>