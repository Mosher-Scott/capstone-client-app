<?php
    require_once('initialize.php');
    include_once($root . '/common/nav.php');
    include_once($root . '/library/connections.php');
    include_once($root . '/model/accounts.php');
    include_once($root . '/scripts/clientFunctions.php');
    include_once($root . '/scripts/login-scripts.php');
    include_once($root . '/scripts/api-requests.php');

    $isLoggedIn = '';

    if ($_SESSION['loggedin'] == 1) {
            $isLoggedIn = 'Yes';
    } else {
        $isLoggedIn = 'No';
    }
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>Fitness Tracker</title>
  <meta name="description" content="Fitness Tracker - Client Portal">
  <meta name="author" content="Scott Mosher">

  <link rel="stylesheet" href="../stylesheets/main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto&display=swap" rel="stylesheet">
    <script src="../scripts/javascripts.js"></script>

</head>
<body>
    <header class="text-center">
        <h1 class="text-center">Fitness Tracker - Client Portal</h1>
        <?php
            if($_SESSION['loggedin']) {
                include_once($root . '/common/loginInfo.php');
            }
        ?>
        
    </header>

    <main id="mainElement">