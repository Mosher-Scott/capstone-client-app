<?php

    // TODO: Setup POST handling method.  Prefer to set it up so values are saved in case data can't be saved to the database
    
    include_once('../common/header.php');

    // Get the workout ID
    $sessionId = isset($_GET['sessionId']) ? $_GET['sessionId'] : null;

    if($sessionId == 0 || $sessionId == null) {
        echo("<p>Training Session Not Found not found</p>");
        
    } else {
        $sessionInfo = GetTrainingSessionExercises($sessionId);
        // print_r($sessionInfo);

        echo(CreateTrainingSessionExercisesForm($sessionInfo));

    }
   
    include_once('../common/footer.php');

?>