<?php

declare(strict_types=1);

include_once dirname(__FILE__) . '/sys/core/init.inc.php';

$calendar = new Calendar($dbo, '2018-16-11 12:00:00');

if (is_object($calendar)) {
    echo '<div class="displaynone">';
    echo '<pre>';
    print_r($calendar);
    print_r($calendar->buildCalendar());
    echo '</pre>';
    echo '</div>';
}
?>