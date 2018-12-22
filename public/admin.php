<?php

declare(strict_types=1);

include_once '../sys/core/init.inc.php';

if (!isset($_SESSION['user'])) {
    header('Location: ./');exit;
}

$pageTitle = 'Add/Edit Event';
$cssFiles = ['style.css', 'admin.css'];

include_once 'assets/common/header.inc.php';

$cal = new Calendar($dbo);
?>
<div id="content">
<?php echo $cal->displayForm(); ?>
</div>
<?php 
include_once 'assets/common/footer.inc.php';
?>