<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

echo json_encode($database->select('locations', ['locid (id)', 'locname (name)']));