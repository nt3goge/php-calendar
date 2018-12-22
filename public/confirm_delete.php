<?php

declare(strict_types=1);

$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['event_id']) && isset($_SESSION['user'])) {
    $id = preg_replace('/[^0-9]/', '', $_POST['event_id']);

    if (empty($id)) {
        header('Location: ./');
        exit;
    }
} else {
    header('Location: ./');
    exit;
}

include_once '../sys/core/init.inc.php';

$pageTitle = 'View Event';
$cssFiles = ['style.css', 'admin.css'];

include_once 'assets/common/header.inc.php';

$cal = new Calendar($dbo);
$markup = $cal->confirmDelete($id);
?>
<div id="content">
    <?php echo $markup; ?>
</div>
<?php include_once 'assets/common/footer.inc.php'; ?>