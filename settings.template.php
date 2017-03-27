<?php

// Whether to show debugging data in output.
// DO NOT SET TO TRUE IN PRODUCTION!!!
define("DEBUG", false);

// Database connection settings
// See http://medoo.in/api/new for info
define("DB_TYPE", "mysql");
define("DB_NAME", "inventory");
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_CHARSET", "utf8");

define("LDAP_SERVER", "localhost");
define("LDAP_BASEDN", "ou=users,dc=example,dc=com");

// Shell command to print barcode labels. The rendered label image path is appended.
define("LABEL_PRINT_CMD", 'lp -o job-sheets=none -o sides=one-sided -o fit-to-page -o media=om_standard-address-label_28.93x89.96mm -o page-left=0 -o page-right=0 -o page-top=0 -o page-bottom=0 -d QL-500');

define("SITE_TITLE", "Inventory System");
define("MINI_TITLE", "<b>Inv</b>");
define("HEAD_TITLE", "<b>Inventory</b>");

define("COPYRIGHT_NAME", "Netsyms Technologies");

// For supported values, see http://php.net/manual/en/timezones.php
define("TIMEZONE", "America/Denver");

// Base URL for site links.
define('URL', 'http://localhost:8000/');

// Maximum number of rows to get in a query.
define("QUERY_LIMIT", 1000);

// API version code.
// Apps will show a warning dialog if their code does not match.
define("SERVER_VERSION", "1.0");
