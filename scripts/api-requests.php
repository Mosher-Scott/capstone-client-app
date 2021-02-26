<?php

define("devEnvironment", "http://localhost:90/");
define("liveEnvironment", "https://frozen-meadow-69055.herokuapp.com");

$environment = devEnvironment;

$authToken;

define("clientEndpoint", $environment . "clients/");
define("trainingSessionEndpoint", $environment . "trainingsessions/");

// Requires an endpoint.  It should be a fully formed endpoint
function GetRequest($endpoint){

   //var_dump($endpoint);
   $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
    ));

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
          'Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InFTRndhd1czYUVjZXF1cnUwZXdVeCJ9.eyJpc3MiOiJodHRwczovL2Rldi13NHgzcHYzYS51cy5hdXRoMC5jb20vIiwic3ViIjoibnhYOWJtS2ZSSElZUW04ZWQ5cmdITHl1eEtDREdma0pAY2xpZW50cyIsImF1ZCI6Imh0dHBzOi8vY2Fwc3RvbmUtYXBpLWF1dGgiLCJpYXQiOjE2MTIxMDYzMjEsImV4cCI6MTYxMjE5MjcyMSwiYXpwIjoibnhYOWJtS2ZSSElZUW04ZWQ5cmdITHl1eEtDREdma0oiLCJndHkiOiJjbGllbnQtY3JlZGVudGlhbHMifQ.tbZAdrfTSHWXiwFFn5AdlKl0To9eopEj8FnMgijRJc0R2TJz2PrMamOAk0AhHNqeUd-B4qRQgOQZzpLVeOO57n6SFmQl1OnyhF01tYKNgzzuE40vNnZd3R1V-u1sf17SltcraXHE8lAc4XCotU5-z-1WhbjzSz8b3BrMJdwofDlfGvw7ylhLRuAZvZldH_-6XC3MlhsAbOuvGw-aQDFAnU5AZNkup9qEgB-QyddMPBmbHHCkotfb-yu62p_1gkiMiBivpok3elLP8dUooR4FQuI5NmCy2yb7pi3d4hfpREm7IdZk_1dch3zxE_Dr5bGsMuF6KsfNMomjJz8PzsOMcA'
        ),
      ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
}

function PostRequest($endpoint){

    //var_dump($endpoint);
    $curl = curl_init();
 
     curl_setopt_array($curl, array(
     CURLOPT_URL => $endpoint,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_HTTPHEADER => array(
         "cache-control: no-cache"
     ),
     ));
 
     $response = curl_exec($curl);
     $err = curl_error($curl);
 
     curl_close($curl);
 
     return $response;
 }

 function PostRequestDataInBody($endpoint){

    //var_dump($endpoint);
    $curl = curl_init();
 
     curl_setopt_array($curl, array(
     CURLOPT_URL => $endpoint,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_HTTPHEADER => array(
         "cache-control: no-cache"
     ),
     ));
 
     $response = curl_exec($curl);
     $err = curl_error($curl);
 
     curl_close($curl);
 
     return $response;
 }

// Parsss a web JSON response, and saves it as an array
function ParseJsonData($response){

    $data = json_decode($response, true);

    return $data;
}


// Gets an auth token to be used in the requests
function GetAuthToken() {

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
    return $response;
}

?>