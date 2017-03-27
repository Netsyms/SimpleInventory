<?php

require __DIR__.'/../required.php';

session_unset();
session_destroy();

redirectIfNotLoggedIn();