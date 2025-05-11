<?php
define('BASE_URL', '/Project-root/');

session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'drive_journal');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_error) {
    die('DB connect error: ' . $mysqli->connect_error);
}
?>
