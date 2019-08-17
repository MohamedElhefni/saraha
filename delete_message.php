<?php
require './core/init.php';
$message_id = $_POST['message_id'];
$con = db::getInstance();
$con->delete('messages', array('message_id', '=', $message_id));
