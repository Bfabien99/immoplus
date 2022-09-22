<?php include_once('../_includes/functions.php');?>
    <?php include_once('../class/Properties.php');?>
    <?php include_once('../class/Users.php');?>
<?php 
    if(isset($_POST['input']) && !empty($_POST['input']) && is_numeric($_POST['input'])){
        $properties = new Properties();
        if($properties->deleteProperties($_POST['input'])){
            return true;
        }else{
            return false;
        }
    }