<?php

    
    include_once('../common/header.php');

    // Get the workout ID
    $workoutId = isset($_GET['workoutId']) ? $_GET['workoutId'] : null;

    if($workoutId == 0 || $workoutId == null) {
        echo("<p>Workout not found</p>");
        
    } else {
        $workoutInfo = GetWorkoutHistory($workoutId);

        echo(CreateSingleWorkoutTable($workoutInfo));

    }
   
    include_once('../common/footer.php');

?>