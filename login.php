<?php
session_start();
include_once('_includes/functions.php');
include_once('class/Users.php');
$users = new Users();
$errors = false;

if (isset($_POST['login'])) {
    if (empty(escape($_POST['identifiant']))) {
        $errors['identifiant'] = "<p class='error'>Votre pseudo est obligatoire</p>";
    } else {
        $identifiant = $_POST['identifiant'];
    }

    if (empty(escape($_POST['password']))) {
        $errors['password'] = "<p class='error'>Le mot de passe est obligatoire</p>";
    }else {
        $password = md5($_POST['password']);
    }

    if (!$errors) {
        if ($users->adminLogin($identifiant, $password)) {
            $user = $users->adminLogin($identifiant, $password);
            $_SESSION['immoplus_adminPseudo'] = $user['pseudo'];
            header('location:/immoplus/admin');
        } elseif ($users->usersLogin($identifiant, $password)) {
            $user = $users->usersLogin($identifiant, $password);
            $_SESSION['immoplus_userPseudo'] = $user['pseudo'];
            header('location:/immoplus/customers');
        }else{
            $errors['result'] = "<p class='error'>Utilisateur inconnu</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se Connecter</title>
</head>

<body>
    <div class="container">
        <h1 class="heading">Inscription</h1>
        <p class="urgent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat inventore eum doloremque dolores praesentium a nulla minima hic omnis. Amet.</p>
        <div class="contentBx">
        <?php echo $errors['result'] ?? ""?>
            <form action="" method="post">
                <div class="group">
                    <label for="identifiant">Pseudonyme</label>
                    <input type="text" name="identifiant">
                    <?php echo $errors['identifiant'] ?? ""?>
                </div>
                <div class="group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password"> 
                    <?php echo $errors['password'] ?? ""?>
                </div>
                <input type="submit" value="Se connecter" name="login">
            </form>
        </div>
    </div>
</body>
<script>
    var pass = document.querySelector('#password');
    pass.addEventListener('dblclick', function(){
        if(pass.getAttribute('type') == 'password'){
            pass.setAttribute('type','text')
        }else{
            pass.setAttribute('type','password')
        }
    })
</script>
</html>