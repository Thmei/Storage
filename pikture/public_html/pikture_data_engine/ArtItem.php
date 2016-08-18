<?php
require_once 'ArtItemHandler.php';
$args = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$art_item_handler = new ArtItemHandler();
$action_name = $args['action'];
unset($args['action']);
$art_item_handler->performAction($action_name, $args);
