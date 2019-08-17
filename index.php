<?php

require 'core/init.php';

$user = new user();
if ($user->isloggedIn()) {
    header('Location:home.php');
}
