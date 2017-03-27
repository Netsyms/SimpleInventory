<?php

require __DIR__ . '/../required.php';

dieifnotloggedin();

use GDText\Box;
use GDText\Color;

function trans2white($src) {
    // Get the width and height.
    $width = imagesx($src);
    $height = imagesy($src);

    // Create a white background, the same size as the original.
    $bg = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($bg, 255, 255, 255);
    imagefill($bg, 0, 0, $white);

    // Merge the two images.
    imagecopyresampled(
            $bg, $src, 0, 0, 0, 0, $width, $height, $width, $height);

    return $bg;
}

function printitembarcode($itemname, $itemcode) {
    $width = 1063;
    $height = 342;
    $img = trans2white(imagecreatefrompng(__DIR__ . "/blanklabel.png"));
    //$img = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($img, 255, 255, 255);
    imagefill($img, 0, 0, $white);

    $box = new Box($img);

    $box->setFontColor(new Color(200, 200, 200));
    $box->setFontFace(__DIR__ . "/fontawesome.ttf");
    $box->setFontSize(100);
    $box->setBox(10, 10, 1053, 110);
    $box->setTextAlign('center', 'center');
    $box->draw("\u{f1b2}");
    
    $box->setFontColor(new Color(0, 0, 0));
    $box->setFontFace(__DIR__ . "/fontawesome.ttf");
    $box->setFontSize(60);
    $box->setBox(40, 280, 40, 40);
    $box->setTextAlign('left', 'bottom');
    $box->draw("\u{f1b2}");

    $box->setFontColor(new Color(0, 0, 0));

    $box->setFontFace(__DIR__ . "/ubuntu.ttf");
    $box->setFontSize(80);
    $box->setBox(10, 10, 1053, 110);
    $box->setTextAlign('center', 'center');
    $box->draw($itemname);

    $box->setFontFace(__DIR__ . "/free3of9.ttf");
    $box->setFontSize(120);
    $box->setBox(10, 110, 1053, 110);
    $box->setTextAlign('center', 'top');
    $box->draw("*" . strtoupper($itemcode) . "*");

    $box->setFontFace(__DIR__ . "/ubuntu.ttf");
    $box->setFontSize(40);
    $box->setBox(10, 240, 1053, 100);
    $box->setTextAlign('center', 'top');
    $box->draw("*" . strtoupper($itemcode) . "*");


    $tmpname = time() . ".png";
    imagepng($img, __DIR__ . "/tmp/$tmpname");
    $output = shell_exec(LABEL_PRINT_CMD . " " . __DIR__ . "/tmp/$tmpname");
    unlink(__DIR__ . "/tmp/$tmpname");
}

function printlocbarcode($locname, $loccode) {
    $width = 1063;
    $height = 342;
    $img = trans2white(imagecreatefrompng(__DIR__ . "/blanklabel.png"));
    //$img = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($img, 255, 255, 255);
    imagefill($img, 0, 0, $white);

    $box = new Box($img);

    $box->setFontColor(new Color(200, 200, 200));
    $box->setFontFace(__DIR__ . "/fontawesome.ttf");
    $box->setFontSize(100);
    $box->setBox(10, 10, 1053, 110);
    $box->setTextAlign('center', 'center');
    $box->draw("\u{f041}");

    $box->setFontColor(new Color(0, 0, 0));
    $box->setFontFace(__DIR__ . "/fontawesome.ttf");
    $box->setFontSize(60);
    $box->setBox(40, 280, 40, 40);
    $box->setTextAlign('left', 'bottom');
    $box->draw("\u{f041}");

    $box->setFontColor(new Color(0, 0, 0));

    $box->setFontFace(__DIR__ . "/ubuntu.ttf");
    $box->setFontSize(80);
    $box->setBox(10, 10, 1053, 110);
    $box->setTextAlign('center', 'center');
    $box->draw($locname);

    $box->setFontFace(__DIR__ . "/free3of9.ttf");
    $box->setFontSize(120);
    $box->setBox(10, 110, 1053, 110);
    $box->setTextAlign('center', 'top');
    $box->draw("*" . strtoupper($loccode) . "*");

    $box->setFontFace(__DIR__ . "/ubuntu.ttf");
    $box->setFontSize(40);
    $box->setBox(10, 240, 1053, 100);
    $box->setTextAlign('center', 'top');
    $box->draw("*" . strtoupper($loccode) . "*");


    $tmpname = time() . ".png";
    imagepng($img, __DIR__ . "/tmp/$tmpname");
    $output = shell_exec(LABEL_PRINT_CMD . " " . __DIR__ . "/tmp/$tmpname");
    unlink(__DIR__ . "/tmp/$tmpname");
}

if (!is_empty($VARS['itemid'])) {
    if ($database->has('items', ['itemid' => $VARS['itemid']])) {
        $item = $database->select('items', ['itemname', 'itemcode1'], ['itemid' => $VARS['itemid']])[0];
        printitembarcode($item['itemname'], $item['itemcode1']);
    } else {
        sendError("Invalid itemid.");
    }
} else if (!is_empty($VARS['locid'])) {
    if ($database->has('locations', ['locid' => $VARS['locid']])) {
        $loc = $database->select('locations', ['locname', 'loccode'], ['locid' => $VARS['locid']])[0];
        printlocbarcode($loc['locname'], $loc['loccode']);
    } else {
        sendError("Invalid locid.");
    }
} else {
    sendError("No itemid or locid specified.  Aborting.");
}

header("HTTP/1.0 204 No Content");