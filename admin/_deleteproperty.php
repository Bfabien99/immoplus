<?php include_once('../_includes/functions.php'); 
include_once('../mail.php');?>
    <?php include_once('../class/Properties.php'); ?>
    <?php include_once('../class/Users.php'); ?>
<?php
if (isset($_POST['input']) && !empty($_POST['input']) && is_numeric($_POST['input'])) {
    $properties = new Properties();
    $property = $properties->getPropertiesById($_POST['input']);

    if ($property) {
        if ($property['_userId'] !== null) {
            $users = new Users();
            $user = $users->getUserById($property['_userId']);
            if ($user) {
                if($properties->deleteProperties($property['id'])){
                    $smessage = "<div><h3>Suppression effectuée!</h3><strong>Suppression d'une de vos propriétés sur la plateforme immoplus</strong></div>";
                sendmail('Suppression Immoplus', $smessage, $user['email']);
                }
                
            }
        } else {
            if ($properties->deleteProperties($property['id'])) {
                return true;
            } else {
                return false;
            }
        }
    }
}
