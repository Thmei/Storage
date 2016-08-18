<?php
require_once 'UserHandler.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$args = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$user_handler = new UserHandler();
$action_name = $args['action'];
unset($args['action']);
$user_handler->performAction($action_name, $args);

