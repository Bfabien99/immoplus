<?php
    session_start();
    if(isset($_POST['input'])){
        if($_SESSION['immoplus_adminPseudo']){
       unset($_SESSION['immoplus_adminPseudo']);
       return true; 
    }
    }
