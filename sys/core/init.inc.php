<?php

declare(strict_types=1);

$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = sha1(uniqid((string)mt_rand(), true));
}
// include_once (dirname(__FILE__) . 'sys/config/db-cred.inc.php'); // D:\xampp\htdocs\php-calendar\sys\core/sys/config/db-cred.inc.php
include_once dirname(__DIR__) . '/config/db-cred.inc.php'; // D:\xampp\htdocs\php-calendar\sys/sys/config/db-cred.inc.php
// include_once __DIR__ . '/sys/config/db-cred.inc.php'; // D:\xampp\htdocs\php-calendar\sys\core/sys/config/db-cred.inc.php
// include_once __FILE__ . '/sys/config/db-cred.inc.php'; // D:\xampp\htdocs\php-calendar\sys\core/sys/config/db-cred.inc.php

foreach ($C as $name => $value) {
    define($name, $value);
}

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
$dbo = new PDO($dsn, DB_USER, DB_PASS);

function __autoload($class)
{
    $fileName = dirname(__DIR__) . '/class/class.' . $class . '.inc.php';

    if (file_exists($fileName)) {
        include_once $fileName;
    }
}
?>