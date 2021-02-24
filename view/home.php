<?php 

  // Get & Parse the client data
  
  $clientId = $clientData['fitness_app_client_id'];

  $endpoint = clientInfoEndpoint . $clientId;

  $clientJson = GetRequest($endpoint);

  $clientData = ParseClientJsonData($clientJson);

  $name = $clientData[0]['firstname'];
 
?>

<main>

<h1>Your workouts</h1>

<?php
// var_dump($clientData);


  
?>

<div id="trainingSessions">

</div>

<div id="workoutHistory">

</div>




