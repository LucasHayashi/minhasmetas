<?php
define('ROOT_PATH', dirname(__DIR__) . '/');

include_once(ROOT_PATH . "/class/Database.class.php");
include_once(ROOT_PATH . "/environments/environments.php");

$driver   = $CFG_PROD["driver"];
$hostname = $CFG_PROD["hostname"];
$username = $CFG_PROD["username"];
$password = $CFG_PROD["password"];
$database = $CFG_PROD["database"];

$database = new Database($driver, $hostname, $username, $password, $database);
$con = $database->getConnection();
