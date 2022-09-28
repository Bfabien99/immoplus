<?php
    session_start();
    if(isset($_POST['input'])){
        if($_SESSION['immoplus_userPseudo']){
       unset($_SESSION['immoplus_userPseudo']);
       return true; 
    }
    }
