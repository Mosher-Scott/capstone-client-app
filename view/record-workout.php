<?php
    class response {
        public $success;
        public $data;
    }
    
    include_once('../common/header.php');
    // TODO: Setup POST handling method.  Prefer to set it up so values are saved in case data can't be saved to the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //print_r($_POST);

        $data = json_encode($_POST);


        //echo($data);

        $result = PostRequestDataInBody(clientWorkoutHistory, $data);

        $result = json_decode($result, true);

        echo("<br>");

        if($result['success'] == '1') {
            echo '<script type="text/javascript"> SuccessfullyAddedWorkout(); </script>'; 

            header('location:home.php');
        }

        // foreach ($_POST['exercise'] AS $item) {
        //    // Get item info
        //     $id = $item['id'];
        //     $sets = $item['sets'];
        //     $reps = $item['reps'];
        //     $weight = $item['weight'];
           
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

            $sessionInfo = GetTrainingSessionExercises($sessionId);
            // print_r($sessionInfo);
    
            echo(CreateTrainingSessionExercisesForm($sessionInfo, $sessionId, $clientId));

            echo("<br>");
            echo("<a class='btn btn-primary' href='home.php'>Back</a>");
    
        }
    }
    
    include_once('../common/footer.php');

?>

