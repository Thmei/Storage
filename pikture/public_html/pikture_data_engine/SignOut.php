<?php
require_once 'UserHandler.php';
$args = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$user_handler = new UserHandler();
$user_handler->signOut();
header('Location: /~s16g10/');
