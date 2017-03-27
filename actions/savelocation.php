<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

$insert = true;

if (is_empty($VARS['locid'])) {
    $insert = true;
} else {
    if ($database->has('locations', ['locid' => $VARS['locid']])) {
        $insert = false;
    } else {
        sendError("Invalid locid.");
    }
}

if (is_empty($VARS['locname']) || is_empty($VARS['loccode'])) {
    sendError('Missing required fields.');
}

$data = [
    'locname' => $VARS['locname'],
    'loccode' => $VARS['loccode']
];

if ($insert) {
    $database->insert('locations', $data);
} else {
    $database->update('locations', $data, ['locid' => $VARS['locid']]);
}

checkDBError();

if ($insert) {
    redirectToPageId("addloc", "&success=1");
} else {
    redirectToPageId("locs", "&success=1");
}