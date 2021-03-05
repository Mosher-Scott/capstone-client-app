<?php
  ob_start();
  session_start();
  require_once('../common/initialize.php');
  //print_r($_SERVER);
  include_once($root . '/common/header.php');
  include_once($root . '/common/nav.php');
  include_once($root . '/library/connections.php');
  include_once($root . '/model/accounts.php');
  include_once($root . '/scripts/clientFunctions.php');
  include_once($root . '/scripts/login-scripts.php');
  include_once($root . '/scripts/api-requests.php');


//$response = GetAuthToken();

//print_r($response);

//ParseTokenResponse($response);

//EchoToken();

?>