<?php 
  session_start();
  include_once('../common/header.php');
  include_once($root . '/scripts/adminFunctions.php');
  
  if ($_SESSION['loggedin'] != 1 || $_SESSION['clientData']['roleid'] != 1) {
    header('Location: index.php');
  }

  $action = filter_input(INPUT_POST,'pagetype');

  // For when the user saves the edited data
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    $id = $_POST['exerciseId'];
    $name = $_POST['name'];
    $instruction = $_POST['instruction'];
    $videoLink = $_POST['videoLink'];
    $muscleGroupId = $_POST['muscleGroupId'];
    $muscleGroupName = $_POST['exerciseId'];
    $active = $_POST['activeCheckbox'];

    // TODO: Validate the data. If fails, return user to the form with error message

    // TODO: If passes, save data to database and check result
  }
  

  if ($action == NULL) {
      $action = filter_input(INPUT_GET,'action');
   }

   // Load exercises if they aren't filled already
   if(!isset($_SESSION['exercises'])) {
    $exercises = GetExercises();
    $_SESSION['exercises'] = $exercises;
   }
   
   echo("<a class='btn btn-primary' href='admin.php'>Admin Home</a>");
   switch($action) {
        
    case 'viewAll':
         // Get all the exercises in the database
        
        //adminLinks();
        echo("<h3>Exercises</h3>");
        $exerciseTable = CreateExercisesTable($_SESSION['exercises']);

        echo($exerciseTable);
        break;

    case 'edit':
        $exerciseId = filter_input(INPUT_GET,'exerciseId');
        
        echo(ModifyExercise($exerciseId));

        break;

    case 'delete':
        $exerciseId = filter_input(INPUT_GET,'exerciseId');
        echo("ExerciseId: " . $exerciseId);
        break;

    case 'exerciseEdited':
      echo("ACTION" . $action);
   }

 



?>