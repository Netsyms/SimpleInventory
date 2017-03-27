<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

if (is_empty($VARS['id'])) {
    sendError("Invalid catid.");
} else {
    if ($database->has('categories', ['catid' => $VARS['id']])) {
        
    } else {
        sendError("Invalid catid.");
    }
}

if ($database->has('items', ['catid' => $VARS['id']])) {
    sendError("Category cannot be deleted; there are still items associated with it.");
}

$database->delete('categories', ['catid' => $VARS['id']]);

checkDBError();

redirectToPageId("cats", "&delete=1");
