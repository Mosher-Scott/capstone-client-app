<?php
session_start();

include_once('../common/header.php');
include_once('../common/nav.php');
include_once('../library/connections.php');
include_once('../model/accounts.php');
include_once('../scripts/login-scripts.php');

$action = filter_input(INPUT_POST,'pageType');


if ($action == NULL) {
    $action = filter_input(INPUT_GET,'action');
 }


 ?>