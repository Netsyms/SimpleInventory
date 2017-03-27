<?php

require __DIR__ . "/../required.php";

dieifnotloggedin();

if (is_empty($VARS['id'])) {
    sendError("Invalid locid.");
} else {
    if ($database->has('locations', ['locid' => $VARS['id']])) {
        
    } else {
        sendError("Invalid locid.");
    }
}

if ($database->has('items', ['locid' => $VARS['id']])) {
    sendError("Location cannot be deleted; there are still items associated with it.");
}

$database->delete('locations', ['locid' => $VARS['id']]);

checkDBError();

redirectToPageId("locs", "&delete=1");
