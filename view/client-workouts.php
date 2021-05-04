<?php 
  session_start();
  include_once('../common/header.php');
  include_once($root . '/scripts/adminFunctions.php');
  
  if ($_SESSION['loggedin'] != 1 || $_SESSION['clientData']['roleid'] != 1) {
    header('Location: index.php');
  }


  

?>