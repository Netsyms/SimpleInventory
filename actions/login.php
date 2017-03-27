<?php

require __DIR__.'/../required.php';

if (is_empty($VARS['user'])) {
    header('Location: ' . URL . 'login.php?err=invaliduser');
    die();
}

if (is_empty($VARS['pass'])) {
    header('Location: ' . URL . 'login.php?err=invalidpass');
    die();
}

if (!authenticate_user($VARS['user'], $VARS['pass'])) {
    header('Location: ' . URL . 'login.php?err=incorrect');
    die();
}


$_SESSION['userid'] = $VARS['user'];
$_SESSION['loggedin'] = true;

header('Location: /');