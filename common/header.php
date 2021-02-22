<?php
    require_once('initialize.php');
    $isLoggedIn = '';

    if ($_SESSION['loggedin'] == TRUE) {
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

  <link rel="stylesheet" href="<?php echo urlPath('stylesheets/main.css'); ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<header class="text-center">
    <h1 class="text-center">Fitness Tracker - Client Portal</h1>
   
</header>

<?php require_once('loginInfo.php');?>

<body>