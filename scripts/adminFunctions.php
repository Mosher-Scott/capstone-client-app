<?php
    //
    function adminLinks() {

        if(!isset($_SESSION['allClientData'])) {
            $clientInfo = GetAllClientData();

            $_SESSION['allClientData'] = $clientInfo;
        }


        echo("<div id='adminOptions'>");

        echo("<h3>Exercises</h3>");
        echo("<a class='btn btn-primary' href='exercises.php?action=viewAll'>Exercise Management</a>");
        echo("</div>");

        echo("<div id='clientTable'>");
        echo("<h3>Clients</h3>");
        echo("<a class='btn btn-primary' href='add-client.php'>Add New Client</a>");
        echo(CreateClientTable( $_SESSION['allClientData']));
        echo("</div>");
    }

    function CreateClientTable($data) {
        //print_r($data);

        $clientTableDiv = "<div class='table-responsive-sm' id='clientTableDisplay'>";
        $clientTableDiv .= "<table class='table table-striped' id='clientTable'>";

        // Header setup
        $clientTableDiv .= "<thead class='thead-light'>";
        $clientTableDiv .= "<tr>";
        $clientTableDiv .= "<th>ID</th>";
        $clientTableDiv .= "<th>Name</th>";
        $clientTableDiv .= "<th>Action</th>";
        $clientTableDiv .= "</tr>";
        $clientTableDiv .= "</thead>";

        $clientTableDiv .= "<tbody>";
        
        foreach($data AS $client) {
            $clientTableDiv .= "<tr>";
            $clientTableDiv .= "<td>$client[client_id]</td>";
            $clientTableDiv .= "<td>$client[firstname] $client[lastname]</td>";
            $clientTableDiv .= "<td>
            <a class='btn btn-primary' href='edit-client.php?clientId=$client[client_id]'>Edit</a>

            <a class='btn btn-primary' href='client-workouts.php?clientId=$client[client_id]'>Workouts</a>

            <a class='btn btn-primary' href='edit-client.php?clientId=$client[client_id]'>History</a>
            </td>";
            $clientTableDiv .= "</tr>";
        }

        $clientTableDiv .= "</tbody>";

        $clientTableDiv .="</table>";
        $clientTableDiv .= "</div>"; // End of table div

        return $clientTableDiv;
    }

    function CreateExercisesTable($data) {
        //print_r($data);

        $tableDiv = "<div class='table-responsive-sm' id='exerciseTableDisplay'>";
        $tableDiv .= "<table class='table table-striped' id='exerciseTable'>";

        // Header setup
        $tableDiv .= "<thead class='thead-light'>";
        $tableDiv .= "<tr>";
        $tableDiv .= "<th>ID</th>";
        $tableDiv .= "<th>Name</th>";
        $tableDiv .= "<th>Instructions</th>";
        $tableDiv .= "<th>Group</th>";
        $tableDiv .= "<th>Options</th>";
        $tableDiv .= "</tr>";
        $tableDiv .= "</thead>";

        $tableDiv .= "<tbody>";
        
        foreach($data AS $exercise) {
            $tableDiv .= "<tr>";
            $tableDiv .= "<td>$exercise[exercise_id]</td>";
            $tableDiv .= "<td>$exercise[name]</td>";
            $tableDiv .= "<td>$exercise[instruction]</td>";
            $tableDiv .= "<td>$exercise[muscle_group_name]</td>";
            $tableDiv .= "<td>
            <a class='btn btn-primary' href='exercises.php?action=edit&exerciseId=$exercise[exercise_id]'>Edit</a>

            <a class='btn btn-primary' href='exercises.php?action=delete&exerciseId=$exercise[exercise_id]'>Delete</a>
            </td>";
            $tableDiv .= "</tr>";
        }

        $tableDiv .= "</tbody>";

        $tableDiv .="</table>";
        $tableDiv .= "</div>"; // End of table div

        return $tableDiv;
    }

    function ModifyExercise($exerciseId, $postData = '') {

        $arrayKey = array_search($exerciseId, array_column($_SESSION['exercises'], 'exercise_id'));

        //print_r($_SESSION['exercises'][$arrayKey]);

        if($postData == '') {
            $exerciseId = $_SESSION['exercises'][$arrayKey]['exercise_id'];
            $name = $_SESSION['exercises'][$arrayKey]['name'];
            $instruction = $_SESSION['exercises'][$arrayKey]['instruction'];
            $videoLink = ''; // TODO: Modify the database to store video URL, and have the API return that value
            $muscleGroupId = $_SESSION['exercises'][$arrayKey]['musclegroup'];
            $muscleGroupName = $_SESSION['exercises'][$arrayKey]['muscle_group_name'];
            $active = $_SESSION['exercises'][$arrayKey]['active'];
        }
        // TODO: Use post data if available
        

        $form = "<div id='sessionForm' class='form-group'>";
        $form .= "<form method='post'>";

        $arrayId = 0;

        $form .= "<input type='hidden' name='exerciseId' value='$exerciseId'>";
        
        $form .= "<label for='name'>Name: </label>";
        $form .= "<input type='text' class='form-control' id='name' name='name' value='$name' required>";

        $form .= "<label for='instruction'>Instructions: </label>";
        $form .= "<input type='text' class='form-control' id='instruction' name='instruction' value='$instruction' required>";

        $form .= "<label for='videoLink'>Video Link: </label>";
        $form .= "<input type='text' class='form-control' id='videoLink' name='videoLink' value='$videoLink' required>";

        $form .= "<input type='hidden' name='muscleGroupId' value='$muscleGroupId'>";

        // TODO: Change this to a dropdown list, and default it to the value in the exercises array
        $form .= "<label for='muscleGroupName'>Muscle Group: </label>";
        $form .= "<input type='text' class='form-control' id='muscleGroupName' name='muscleGroupName' value='$muscleGroupName' required>";

        $form .= "<button type='submit' class='btn btn-primary' value='save'>Save Changes</button>";
        $form .= "</form>";

        $form .= "<a class='btn btn-primary' href='exercises.php?action=viewAll'>Back</a>";

        $form .= "</div>";

        return $form;

    }



?>