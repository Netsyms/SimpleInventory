<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

$insert = true;

if (is_empty($VARS['catid'])) {
    $insert = true;
} else {
    if ($database->has('categories', ['catid' => $VARS['catid']])) {
        $insert = false;
    } else {
        sendError("Invalid catid.");
    }
}

if (is_empty($VARS['catname'])) {
    sendError('Missing required fields.');
}

$data = [
    'catname' => $VARS['catname']
];

if ($insert) {
    $database->insert('categories', $data);
} else {
    $database->update('categories', $data, ['catid' => $VARS['catid']]);
}

checkDBError();

if ($insert) {
    redirectToPageId("addcat", "&success=1");
} else {
    redirectToPageId("cats", "&success=1");
}