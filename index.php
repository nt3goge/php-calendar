<?php

declare(strict_types=1);

include_once dirname(__FILE__) . '/sys/core/init.inc.php';

$calendar = new Calendar($dbo, '2018-16-11 12:00:00');

$pageTitle = 'Events Calendar';
$cssFiles = array('style.css');

include_once 'public/assets/common/header.inc.php';
?>

<div id="content">
<?php echo $calendar->buildCalendar(); ?>
</div>

<?php include_once 'public/assets/common/header.inc.php'; ?>