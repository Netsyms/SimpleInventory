<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

echo json_encode($database->select('categories', ['catid (id)', 'catname (name)']));