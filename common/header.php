<?php
    require_once('initialize.php');
    $isLoggedIn = '';

    if ($_SESSION['loggedin'] == TRUE && isset($_SESSION['clientData'])) {
            $isLoggedIn = 'Yes';
    } else {
        $isLoggedIn = 'No';
    }
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Fitness Tracker</title>
  <meta name="description" content="Fitness Tracker - Client Portal">
  <meta name="author" content="Scott Mosher">

  <link rel="stylesheet" href="<?php echo urlPath('stylesheets/main.css'); ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<header class="text-center">
    <h1 class="text-center">Fitness Tracker - Client Portal</h1>
    <div id="accountInfo">
        <div id="loggedInName">
            <?php if($isLoggedIn == 'Yes') {
            // echo ("<h4><span>Welcome " . $clientData['clientFirstname'] . "</span></h4>"); 
            echo ('<h4><a href="' . urlPath('/controller/index.php?action=userAlreadyLoggedIn') . '">Welcome ' . $_SESSION['clientData']['clientFirstname'] . "</a></h4>");  
            }
            ?>
        </div>
                    
        <?php
            if ($_SESSION['loggedin'] == TRUE) {
                echo ('<a href="' . urlPath('/controller/index.php?action=logout') . '">logOut</a>');
            } else {
                echo('<a href="' . urlPath('/controller/index.php?action=login') . '">Login To My Account</a>');
            }
            ?>
    </div>
    <nav>
        <ul>
            <li>Login</li>
        </ul>   
    </nav>
</header>

<body>