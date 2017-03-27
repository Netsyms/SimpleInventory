<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

if (is_empty($VARS['id'])) {
    sendError("Invalid itemid.");
} else {
    if ($database->has('items', ['itemid' => $VARS['id']])) {
        
    } else {
        sendError("Invalid itemid.");
    }
}

$database->delete('items', ['itemid' => $VARS['id']]);

checkDBError();

redirectToPageId("items", "&delete=1");
