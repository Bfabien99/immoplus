<?php session_start(); ?>
<?php include_once('../_includes/functions.php'); ?>
<?php include_once('../class/Properties.php'); ?>
<?php include_once('../class/Users.php'); ?>
<?php



if (isset($_POST['input']) && !empty($_POST['input']) && is_numeric($_POST['input'])) {

    $properties = new Properties();
    $property = $properties->getPropertiesById($_POST['input']);

    $users = new Users();
    $user = $users->getUserByPseudo($_SESSION['immoplus_userPseudo']);

    if ($user['id'] == $property['_userId']) {
        if ($properties->deleteProperties($_POST['input'])) {
            return true;
        } else {
            return false;
        }
    }
}
