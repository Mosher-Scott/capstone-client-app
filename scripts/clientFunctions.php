<?php
    
    function GetClientData($clientId) {
  
        $endpoint = clientEndpoint . $clientId;

        $clientJson = GetRequest($endpoint);
    
        $clientData = ParseJsonData($clientJson);

        return $clientData;
    }

    function GetAllClientData() {
        $endpoint = clientEndpoint;

        $clientJson = GetRequest($endpoint);
    
        $clientData = ParseJsonData($clientJson);

        return $clientData;
    }

    function GetTrainingSessions($clientId) {

        $endpoint = clientEndpoint . "{$clientId}/trainingsessions";
        
        $json = GetRequest($endpoint);

        $data = ParseJsondata($json);

        return $data;
    }

    function GetWorkouts($clientId) {

        $endpoint = clientEndpoint . "{$clientId}/workouthistory";
        
        $json = GetRequest($endpoint);

        $data = ParseJsondata($json);

        return $data;
    }

    function GetWorkoutHistory($id) {
        $endpoint = clientEndpoint . "/workouthistory/" . $id;

        $json = GetRequest($endpoint);

        $data = ParseJsondata($json);

        return $data;
    }

    function GetSingleTrainingSession($id) {

        $endpoint = clientEndpoint . "/workouthistory/" . $id;

        $json = GetRequest($endpoint);

        $data = ParseJsondata($json);

        return $data;
    }

    
    function GetExercises() {

        $endpoint = exerciseEndpoint;

        $json = GetRequest($endpoint);

        $data = ParseJsondata($json);

        return $data;
    }
    
    function GetTrainingSessionExercises($id) {
        
        $endpoint = trainingSessionEndpoint . "/" .  $id . "/exercises" ;

        $json = GetRequest($endpoint);

        $data = ParseJsondata($json);

        return $data;
    }

    function CreateTrainingSessionTable($data) {
        $trainingSessionDiv = "<div class='table-responsive-sm' id='trainingSessionTableDisplay'>";
        $trainingSessionDiv .= "<table class='table table-striped' id='trainingSessions'>";

        // Header setup
        $trainingSessionDiv .= "<thead class='thead-light'>";
        $trainingSessionDiv .= "<tr>";
        $trainingSessionDiv .= "<th>Name</th>";
        $trainingSessionDiv .= "<th>Description</th>";
        $trainingSessionDiv .= "<th>Sets</th>";
        $trainingSessionDiv .= "<th>Reps</th>";
        $trainingSessionDiv .= "<th></th>";
        $trainingSessionDiv .= "</tr>";
        $trainingSessionDiv .= "</thead>";

        // Rows
        $trainingSessionDiv .= "<tbody>";
        foreach($data AS $session) {

            $trainingSessionDiv .= "<tr>";
            $trainingSessionDiv .= "<td>$session[sessionname]</td>";
            $trainingSessionDiv .= "<td>$session[sessiondescription]</td>";
            $trainingSessionDiv .= "<td>$session[sessionsets]</td>";
            $trainingSessionDiv .= "<td>$session[sessionreps]</td>";
            $trainingSessionDiv .= "<td><a class='btn btn-primary' href='record-workout.php?sessionId=$session[id]'>Do It!</a></td>";
            $trainingSessionDiv .= "</tr>";
        }

        $trainingSessionDiv .="</table>";
        $trainingSessionDiv .= "</div>"; // End of table div

        return $trainingSessionDiv;
    }
  
    function CreateWorkoutHistoryTable($data) {
        $workoutHistoryDiv = "<div class='table-responsive-sm' id='WorkoutHistoryTableDisplay'>";
        $workoutHistoryDiv .= "<table class='table table-striped' id='WorkoutHistory'>";

        // Header setup
        $workoutHistoryDiv .= "<thead class='thead-light'>";
        $workoutHistoryDiv .= "<tr>";
        $workoutHistoryDiv .= "<th>ID</th>";
        $workoutHistoryDiv .= "<th>Date/Time</th>";
        $workoutHistoryDiv .= "<th>Name</th>";
        $workoutHistoryDiv .= "<th></th>";
        $workoutHistoryDiv .= "</tr>";
        $workoutHistoryDiv .= "</thead>";

        // Rows
        $workoutHistoryDiv .= "<tbody>";
        foreach($data AS $session) {

            // Convert date/time
            $time = strtotime($session["sessiondate"]);
            $date = date("m-d-Y H:i:s", $time);


            $workoutHistoryDiv .= "<tr>";
            $workoutHistoryDiv .= "<td>$session[workoutid]</td>";
            $workoutHistoryDiv .= "<td>$date</td>";
            $workoutHistoryDiv .= "<td>$session[trainingsessionname]</td>";
            $workoutHistoryDiv .= "<td><a class='btn btn-primary' href='view-workout.php?workoutId=$session[workoutid]'>View Details</a></td>";
            $workoutHistoryDiv .= "</tr>";
        }

        $workoutHistoryDiv .="</table>";
        $workoutHistoryDiv .= "</div>"; // End of table div

        return $workoutHistoryDiv;
    }

    function CreateSingleWorkoutTable($data) {
        //print_r($data[0]['workout_details']);

        $name = $data[0]['sessionname'];
        $description = $data[0]['sessiondescription'];

        $time = strtotime($data[0]['sessiondate']);
        $date = date("m-d-Y H:i:s", $time);
        
        $workoutDiv = "<div class='table-responsive-sm table-div' id='workouttableDisplay'>";
        $workoutDiv .= "<p><b>Name: </b> $name</p>";
        $workoutDiv .= "<p><b>Description: </b> $description</p>";
        $workoutDiv .= "<p><b>Date: </b> $date</p>";
        $workoutDiv .= "<table class='table table-striped' id='workoutTable'>";

        // Header setup
        $workoutDiv .= "<thead class='thead-light'>";
        $workoutDiv .= "<tr>";
        $workoutDiv .= "<th>Name</th>";
        $workoutDiv .= "<th>Sets</th>";
        $workoutDiv .= "<th>Reps</th>";
        $workoutDiv .= "<th>Weight</th>";
        $workoutDiv .= "<th>Seconds</th>";
        $workoutDiv .= "</tr>";
        $workoutDiv .= "</thead>";

        // Rows
        $workoutDiv .= "<tbody>";
        foreach($data[0]['workout_details'] AS $exercise) {

            $workoutDiv .= "<tr>";
            $workoutDiv .= "<td>$exercise[exercise_name]</td>";
            $workoutDiv .= "<td>$exercise[exercise_sets]</td>";
            $workoutDiv .= "<td>$exercise[exercise_reps]</td>";
            $workoutDiv .= "<td>$exercise[exercise_weight]</td>";
            $workoutDiv .= "<td>$exercise[exercise_seconds]</td>";
            $workoutDiv .= "</tr>";
        }

        $workoutDiv .="</table>";
        $workoutDiv .="<a class='btn btn-primary' href='home.php'>Back</a>";
        $workoutDiv .= "</div>"; // End of table div
        

        return $workoutDiv;
    }

    function CreateTrainingSessionExercisesForm($exercises, $sessionId, $postData ='') {
        // var_dump($exercises);
         $form = "<div id='sessionForm' class='form-group'>";
         $form .= "<form method='post'>";
         $arrayId = 0;

         $clientId = $_SESSION['clientData']['fitness_app_client_id'];
 
         $form .= "<input type='hidden' name='sessionId' value='$sessionId'>";
         $form .= "<input type='hidden' name='clientId' value='$clientId'>";
 
         foreach($exercises AS $exercise) {

             $name = $exercise['exercise_name'];
             $instructions = $exercise['instruction'];
             $muscleGroup = $exercise['muscle_group'];
             $id = $exercise['id'];
 
             $form .= "<div id='exercise[$arrayId]Info'>";
             $form .= "<p><b>Exercise: </b>$name</p>";
             $form .= "<p><b>Instructions: </b>$instructions</p>";
             // Future video
             //$form .= "<iframe width='400' height='315' src='https://www.youtube.com/embed/ysdVPVuj7_s' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
             $form .= "<p><b>Muscle Group: </b>$muscleGroup</p>";
             $form .= "</div>";
         
             $form .= "<input type='hidden' name='exercise[$arrayId][id]' value='$id'>";
 
             $form .= "<label for='exercise[$arrayId]sets'>Sets: </label>";

            $sets = '';
            $reps = '';
            $weight = '';
            $time = '';

            if($postData != '') {
                $sets = $postData[$arrayId][1];
                $reps = $postData[$arrayId][2];
                $weight = $postData[$arrayId][3];
                $seconds = $postData[$arrayId][4];
             }
             $form .= "<input type='text' class='form-control' id='exercise[$arrayId]sets' name='exercise[$arrayId][sets]' value='$sets' required>";
             
             $form .= "<label for='exercise[$arrayId]reps'>Reps: </label>";
             $form .= "<input type='text' class='form-control' id='exercise[$arrayId]reps' name='exercise[$arrayId][reps]' value='$reps' required>";
 
             $form .= "<label for='exercise[$arrayId]weight'>Weight: </label>";
             $form .= "<input type='text' class='form-control' id='exercise[$arrayId]weight' name='exercise[$arrayId][weight]' value='$weight'>";
 
             $form .= "<label for='exercise[$arrayId]seconds'>Seconds: </label>";
             $form .= "<input type='text' class='form-control' id='exercise[$arrayId]seconds' name='exercise[$arrayId][seconds]' value='$seconds'>";
             $form .= "<hr>";
         //print_r($exercise['exercise_name']);
             $arrayId++;
         }     
 
         $form .= "<button type='submit' class='btn btn-primary' value='save'>Save Workout</button>";
         $form .= "</form>";
         $form .= "</div>";
 
         return $form;
     }

?>