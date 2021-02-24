<?php

define("devEnvironment", "http://localhost:90/");
define("liveEnvironment", "https://frozen-meadow-69055.herokuapp.com");

$environment = devEnvironment;

define("clientInfoEndpoint", $environment . "clients/");

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

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
}


function ParseClientJsonData($response){

    $clientData = json_decode($response, true);

    return $clientData;
}

?>