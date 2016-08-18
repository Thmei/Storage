<?php
require_once 'ArtRequestHandler.php';
$args = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$art_item_handler = new ArtRequestHandler();
$action_name = $args['action'];
unset($args['action']);
$art_item_handler->performAction($action_name, $args);
