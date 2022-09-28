<?php include_once('../_includes/functions.php'); ?>
    <?php include_once('../class/Users.php'); ?>
<?php
if (isset($_POST['input']) && !empty($_POST['input']) && is_numeric($_POST['input'])) {
    $users = new Users();
    if ($users->deleteUser($_POST['input'])) {
        return true;
    } else {
        return false;
    }
}
