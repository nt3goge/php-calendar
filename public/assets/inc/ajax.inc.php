<?php

declare(strict_types=1);

$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/php-calendar/sys/config/db-cred.inc.php';

foreach ($C as $name => $val) {
    define($name, $val);
}

define('ACTIONS', [
    'event_view' => [
        'object' => 'Calendar',
        'method' => 'displayEvent'
    ],
    'edit_event' => [
        'object' => 'Calendar',
        'method' => 'displayForm'
    ],
    'event_edit' => [
        'object' => 'Calendar',
        'method' => 'processForm'
    ],
    'delete_event' => [
        'object' => 'Calendar',
        'method' => 'confirmDelete'
    ]
]);

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
$dbo = new PDO($dsn, DB_USER, DB_PASS);

if (isset(ACTIONS[$_POST['action']])) {
    $use_array = ACTIONS[$_POST['action']];
    $obj = new $use_array['object']($dbo);
    $method = $use_array['method'];

    if (isset($_POST['event_id'])) {
        $id = (int)$_POST['event_id'];
    } else {
        $id = NULL;
    }

    echo $obj->$method($id);
}

function __autoload($class_name)
{
    $fileName = $_SERVER["DOCUMENT_ROOT"] . '/php-calendar/sys/class/class.' . strtolower($class_name) . '.inc.php';
    if (file_exists($fileName)) {
        include_once $fileName;
    }
}
?>