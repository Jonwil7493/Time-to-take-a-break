<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'Productivity');
define('DB_PORT', 3307);

$mysqli = new mysqli("localhost", "root", "", "Productivity", 3307);

if($mysqli->connect_error){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
