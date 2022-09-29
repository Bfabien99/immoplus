<?php
     session_start();
     if(isset($_POST['input'])){
        unset($_SESSION['immoplus_userPseudo']);
        return true; 
     }
