<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

$insert = true;

if (is_empty($VARS['itemid'])) {
    $insert = true;
} else {
    if ($database->has('items', ['itemid' => $VARS['itemid']])) {
        $insert = false;
    } else {
        sendError("Invalid itemid.");
    }
}

if (is_empty($VARS['itemname']) || is_empty($VARS['itemcat']) || is_empty($VARS['itemloc'])) {
    sendError('Missing required fields.');
}

if (!$database->has('categories', ['catid' => $VARS['itemcat']])) {
    sendError('Invalid category.');
}

if (!$database->has('locations', ['locid' => $VARS['itemloc']])) {
    sendError('Invalid location.');
}

$data = [
    'itemname' => $VARS['itemname'],
    'itemcode1' => $VARS['itemcode1'],
    'itemcode2' => $VARS['itemcode2'],
    'itemtext1' => $VARS['itemtext1'],
    'itemtext2' => $VARS['itemtext2'],
    'itemtext3' => $VARS['itemtext3'],
    'catid' => $VARS['itemcat'],
    'locid' => $VARS['itemloc']
];

if ($insert) {
    $database->insert('items', $data);
} else {
    $database->update('items', $data, ['itemid' => $VARS['itemid']]);
}

checkDBError();

if ($insert) {
    redirectToPageId("additem", "&success=1");
} else {
    redirectToPageId("items", "&success=1");
}