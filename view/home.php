<?php 
  session_start();
  include_once('../common/header.php');
  
  //echo($_SESSION['loggedin']);
  if ($_SESSION['loggedin'] != 1) {
    
    header('Location: index.php');

  }
  
  $clientId = $_SESSION['clientData']['fitness_app_client_id'];

  // echo("<h1>$clientId</h1>");
  // Get & Parse the client data
  $clientDbData = GetClientData($clientId);

  //print_r($clientId);
  
  $firstName = $clientDbData[0]['firstname'];
  $lastName = $clientDbData[0]['lastname'];

  // Get training sessions
  $trainingSessionsArray = GetTrainingSessions($clientId);

  // Get workout history
  $workoutHistoryArray = GetWorkouts($clientId);
  
  
  // For troubleshooting and seeing what everything is
  // print_r($clientDbData);
  // echo("<br>Training Sessions<br>");
  // var_dump($trainingSessionsArray);
  // echo("<br>Workout History<br>");
  //var_dump($workoutHistoryArray);

 
?>
  <div id="clientInfo">

    <?php echo("<p><b>Name: </b>$firstName $lastName</p>");?>
    <hr>
  </div>

  <div id="trainingSessionSection">
    <h3 class='text-center'>Available Training Sessions</h3>
    <?php echo(CreateTrainingSessionTable($trainingSessionsArray, $clientId)); ?>
    <hr>
  </div>

  <div id="workoutHistorySection">
    <h3 class='text-center'>Workout History</h3>
    <?php echo(CreateWorkoutHistoryTable($workoutHistoryArray));?>
  </div>


<?php
include($root . '/common/footer.php');
?>

