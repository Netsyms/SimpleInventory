<?php

/**
 * This file contains global settings and utility functions.
 */
ob_start();
session_start();

header('Content-Type: text/html; charset=utf-8');

// Composer
require __DIR__ . '/vendor/autoload.php';
// Settings file
require __DIR__ . '/settings.php';

function sendError($error) {
    die("<!DOCTYPE html><html><head><title>Error</title></head><body><h1 style='color: red; font-family: sans-serif; font-size:100%;'>" . htmlspecialchars($error) . "</h1></body></html>");
}

date_default_timezone_set(TIMEZONE);

// Database settings
// Also inits database and stuff
use Medoo\Medoo;

$database;
try {
    $database = new Medoo([
        'database_type' => DB_TYPE,
        'database_name' => DB_NAME,
        'server' => DB_SERVER,
        'username' => DB_USER,
        'password' => DB_PASS,
        'charset' => DB_CHARSET
    ]);
} catch (Exception $ex) {
    //header('HTTP/1.1 500 Internal Server Error');
    sendError("Database error.  Try again later.  $ex");
}


if (!DEBUG) {
    error_reporting(0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}


$VARS;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $VARS = $_POST;
    define("GET", false);
} else {
    $VARS = $_GET;
    define("GET", true);
}

/**
 * Checks if a string or whatever is empty.
 * @param $str The thingy to check
 * @return boolean True if it's empty or whatever.
 */
function is_empty($str) {
    return (is_null($str) || !isset($str) || $str == '');
}

/**
 * Add a user to the system.  /!\ Assumes input is OK /!\
 * @param string $username Username, saved in lowercase.
 * @param string $password Password, will be hashed before saving.
 * @param string $realname User's real legal name
 * @param string $email User's email address.
 * @return int The new user's ID number in the database.
 */
function adduser($username, $password, $email) {
    global $database;
    $userid = $database->insert('accounts', [
        'username' => strtolower($username),
        'password' => encryptPassword($password),
        'email' => $email
    ]);
    return $userid;
}

/**
 * Checks if an email address is valid.
 * @param string $email Email to check
 * @return boolean True if email passes validation, else false.
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Check if an email exists in the database.
 * @param String $email
 */
function email_exists($email) {
    global $database;
    return $database->has('accounts', ['email' => $email, "LIMIT" => QUERY_LIMIT]);
}

/**
 * Check if a username exists in the database.
 * @param String $username
 */
function user_exists($username) {
    global $database;
    return $database->has('accounts', ['username' => $username, "LIMIT" => QUERY_LIMIT]);
}

/**
 * Checks the given credentials to see if they're legit.
 * @param string $username
 * @param string $password
 * @return boolean True if OK, else false
 */
function authenticate_user($username, $password) {
    $ds = ldap_connect(LDAP_SERVER);
    if ($ds) {
        $sr = ldap_search($ds, LDAP_BASEDN, "(&(|(uid=" . $username . ")(mail=" . $username . "))(description=*INVENTORY:yes;))", ['cn', 'uid', 'mail']);
        if (ldap_count_entries($ds, $sr) == 1) {
            $info = ldap_get_entries($ds, $sr);
            $name = $info[0]["cn"][0];
            $uid = $info[0]["uid"][0];
            $mail = $info[0]["mail"][0];
            $_SESSION['uid'] = $uid;
            $_SESSION['name'] = $name;
            $_SESSION['mail'] = $mail;
            return true;
        } else if (ldap_count_entries($ds, $sr) > 1) {
            sendError("Multiple users matched search criteria.  Unsure which one you are.");
        } else {
            return false;
        }
    } else {
        sendError("Login server offline.");
    }
}

/**
 * Hashes the given plaintext password
 * @param String $password
 * @return String the hash, using bcrypt
 */
function encryptPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

/**
 * Securely verify a password and its hash
 * @param String $password
 * @param String $hash the hash to compare to
 * @return boolean True if password OK, else false
 */
function comparePassword($password, $hash) {
    return password_verify($password, $hash);
}

function dieifnotloggedin() {
    if ($_SESSION['loggedin'] != true) {
        sendError("Session expired.  Please log out and log in again.");
    }
}

/**
 * Check if the previous database action had a problem.
 * @param array $specials int=>string array with special response messages for SQL errors
 */
function checkDBError($specials = []) {
    global $database;
    $errors = $database->error();
    if (!is_null($errors[1])) {
        foreach ($specials as $code => $text) {
            if ($errors[1] == $code) {
                sendError($text);
            }
        }
        sendError("A database error occurred:<br /><code>" . $errors[2] . "</code>");
    }
}

/*
 * http://stackoverflow.com/a/20075147/2534036
 */
if (!function_exists('base_url')) {

    function base_url($atRoot = FALSE, $atCore = FALSE, $parse = FALSE) {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf($tmplt, $http, $hostname, $end);
        } else
            $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path']))
                if ($base_url['path'] == '/')
                    $base_url['path'] = '';
        }

        return $base_url;
    }

}

function redirectToPageId($id, $args, $dontdie) {
    header('Location: ' . URL . '?id=' . $id . $args);
    if (is_null($dontdie)) {
        die("Please go to " . URL . '?id=' . $id . $args);
    }
}

function redirectIfNotLoggedIn() {
    if ($_SESSION['loggedin'] !== TRUE) {
        header('Location: /login.php');
        die();
    }
}
