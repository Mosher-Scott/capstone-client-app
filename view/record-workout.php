<?php
    ob_start();
    class response {
        public $success;
        public $data;
    }
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (!$_SESSION['loggedin']) {
    
        header('Location: index.php');
        exit;
    }
    
    include_once('../common/header.php');
    // TODO: Setup POST handling method.  Prefer to set it up so values are saved in case data can't be saved to the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //print_r($_POST);

        
        $clientId = $_POST['clientId'];
        $sessionId = $_POST['sessionId'];

        $workoutInfo = [$clientId, $sessionId];

        //$exerciseInfo = [];

        foreach ($_POST['exercise'] AS $item) {
           // Get item info
           $singleExerciseInfo = [$item['id'], $item['sets'], $item['reps'], $item['weight'], $item['seconds']];

            $workoutInfo.push($singleExerciseInfo);
        }

        print_r($workoutInfo);
        // Check everything first
        // Save the data to variables

        //Commented out for testing
        // $data = json_encode($_POST);

        // echo("<br>");
        // print_r($data);

        // $result = PostRequestDataInBody(clientWorkoutHistory, $data);

        // $result = json_decode($result, true);

        // //echo("<br>");
        // print_r($result);

        // if($result['success'] == '1') {
        
        //     echo '<script type="text/javascript"> SuccessfullyAddedWorkout(); </script>'; 

        //     header("location: home.php");
        //     exit;
        // } else if ($result['success'] != '1') {
        //     //print_r($result);
        // }

        // End of comments

        // foreach ($_POST['exercise'] AS $item) {
        //    // Get item info
        //     $id = $item['id'];
        //     $sets = $item['sets'];
        //     $reps = $item['reps'];
        //     $weight = $item['weight'];
        //      $time = $item['seconds'];
           
        //     $date = date("Y-m-d H:i:s");
           
        //     //echo($item['id']);

        //     // Instead of all that, will probably just want to send the form data to the API, and let the API process it

        // }
    } else {

        $clientId = $_SESSION['clientData']['fitness_app_client_id'];

        // Get the workout ID
        $sessionId = isset($_GET['sessionId']) ? $_GET['sessionId'] : null;
    
        if($sessionId == 0 || $sessionId == null) {
            echo("<p>Training Session Not Found not found</p>");
            
        } else {
            echo("<a class='btn btn-primary' href='home.php'>Back</a>");
            $sessionInfo = GetTrainingSessionExercises($sessionId);
            // print_r($sessionInfo);
    
            echo(CreateTrainingSessionExercisesForm($sessionInfo, $sessionId, $clientId));

            echo("<br>");
            echo("<a class='btn btn-primary' href='home.php'>Back</a>");
    
        }
    }
    
    include_once('../common/footer.php');

?>

