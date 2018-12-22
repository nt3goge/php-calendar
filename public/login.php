<?php
declare(strict_types=1);

include_once '../sys/core/init.inc.php';

$pageTitle = 'Please Log In';
$cssFiles = ['style.css', 'admin.css'];

include_once 'assets/common/header.inc.php';
?>
<div id="content">
    <form action="public/assets/inc/process.inc.php" method="post">
        <fieldset>
            <legend>Please Log In</legend>
            <label for="username">UserName</label>
            <input type="text" name="username" id="username" value="" />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="" />
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
            <input type="hidden" name="action" value="user_login" />
            <input type="submit" name="login_submit" value="Log In" />
            or <a href="./">cancel</a>
        </fieldset>
    </form>
</div>
<?php include_once 'assets/common/footer.inc.php'; ?>