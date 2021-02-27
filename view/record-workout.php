<?php

    // TODO: Setup POST handling method.  Prefer to set it up so values are saved in case data can't be saved to the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //print_r($_POST);

        //print '<pre>' . print_r($_POST, true) . '</pre>';
        // Send the entire body to the API and have it process

        $data = json_encode($_POST);

        //echo($data);

        foreach ($_POST['exercise'] AS $item) {
           // Get item info
            $id = $item['id'];
            $sets = $item['sets'];
            $reps = $item['reps'];
            $weight = $item['weight'];
           
            $date = date("Y-m-d H:i:s");
           
            echo($item['id']);

            // Instead of all that, will probably just want to send the form data to the API, and let the API process it

        }
    }
    
    include_once('../common/header.php');

    // Get the workout ID
    $sessionId = isset($_GET['sessionId']) ? $_GET['sessionId'] : null;

    if($sessionId == 0 || $sessionId == null) {
        echo("<p>Training Session Not Found not found</p>");
        
    } else {

        $sessionInfo = GetTrainingSessionExercises($sessionId);
        // print_r($sessionInfo);

        echo(CreateTrainingSessionExercisesForm($sessionInfo, $sessionId));

        echo("");

    }
   
    include_once('../common/footer.php');

?>

