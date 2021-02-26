<?php
require_once('common/initialize.php');

$action = filter_input(INPUT_POST,'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET,'action');
 }

switch($action) {
    case 'something':

    break;

default:

    header('location:/view/index.php');
}
?>