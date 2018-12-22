<?php

declare(strict_types=1);

include_once '../sys/core/init.inc.php';

$obj = new Admin($dbo);

$hash1 = $obj->testSaltedHash('test');
echo $hash1 . '<br/>';

sleep(1);

$hash2 = $obj->testSaltedHash('test');
echo $hash2 . '<br/>';

sleep(1);

$hash3 = $obj->testSaltedHash('test', $hash2);
echo $hash3 . '<br/>';

$password = $obj->testSaltedHash('admin');
echo $password . '<br/>';
?>