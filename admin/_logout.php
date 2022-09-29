<?php
    session_start();
    if(isset($_POST['input'])){
       unset($_SESSION['immoplus_adminPseudo']);
       return true;
    }
