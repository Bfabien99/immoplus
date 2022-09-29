<?php include('includes/header.php'); ?>
<?php
$error = false;
if ($user) {
    $fullname = $user['fullname'];
    $email = $user['email'];
    $contact = $user['contact'];
    $pseudo = $user['pseudo'];
}

$users = new Users();

if (isset($_POST['editinfo'])) {
    if (empty(escape($_POST['fullname']))) {
        $error['fullname'] = "<p class='error'>Veuillez entrer votre nom complet</p>";
    } elseif (strlen(escape($_POST['fullname'])) < 5) {
        $error['fullname'] = "<p class='error'>Le nom doit comporter au moins 5 caractères</p>";
    } elseif (!ctype_alpha(str_replace(' ', '', escape($_POST['fullname'])))) {
        $error['fullname'] = "<p class='error'>Le nom ne doit comporter que des lettres</p>";
    } else {
        $fullname = escape(mb_strtoupper($_POST['fullname']));
    }

    if (empty(escape($_POST['contact']))) {
        $error['contact'] = "<p class='error'>Veuillez entrer votre contact</p>";
    } elseif (!preg_match('/^[-+0-9]+$/', escape($_POST['contact']))) {
        $error['contact'] = "<p class='error'>Le contact n'est pas valide</p>";
    } elseif (strlen(str_replace(['+', '-'], ['', ''], escape($_POST['contact']))) < 10) {
        $error['contact'] = "<p class='error'>Le contact doit contenir au moins dix chiffres</p>";
    } else {
        $contact = escape($_POST['contact']);
    }

    if (empty(escape($_POST['email']))) {
        $error['email'] = "<p class='error'>Veuillez entrer votre Email</p>";
    } elseif (!filter_var(escape($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "<p class='error'>L'email n'est pas valide</p>";
    } else {
        if (escape(mb_strtolower($_POST['email'])) == $email) {
        } elseif ($users->isEmail(escape(mb_strtolower($_POST['email'])))) {
            $error['email'] = "<p class='error'>L'Email existe déja!</p>";
        } else {
            $email = escape(mb_strtolower($_POST['email']));
        }
    }

    if (empty(escape($_POST['pseudo']))) {
        $error['pseudo'] = "<p class='error'>Veuillez entrer votre pseudonyme</p>";
    } elseif (strlen(escape($_POST['pseudo'])) < 5) {
        $error['pseudo'] = "<p class='error'>Le pseudonyme doit comporter au moins 5 caractères</p>";
    } elseif (!preg_match('/^[a-zA-Z_0-9]+$/', escape($_POST['pseudo']))) {
        $error['pseudo'] = "<p class='error'>Le pseudonyme ne doit comporter que des lettres et/ou des chiffres</p>";
    } else {
        if (escape(mb_strtolower($_POST['pseudo'])) == $pseudo) {
        } elseif ($users->isPseudo(escape(mb_strtolower($_POST['pseudo'])))) {
            $error['pseudo'] = "<p class='error'>Le pseudonyme existe déja!</p>";
        } else {
            $pseudo = escape(mb_strtolower($_POST['pseudo']));
        }
    }

    if (!$error && !empty($fullname) && !empty($email) && !empty($contact) && !empty($pseudo)) {
        if ($users->updateUsers($user['id'], $fullname, $contact, $email, $pseudo)) {
            $_SESSION['immoplus_userPseudo'] = $pseudo;
            $error['editinfo'] = "<p class='success'>Informations modifiées</p>";
        }
    }
}

if (isset($_POST['editpass'])) {
    if (empty(escape($_POST['password']))) {
        $error['password'] = "<p class='error'>Veuillez entrer votre mot de passe</p>";
    } elseif (strlen(escape($_POST['password'])) < 6) {
        $error['password'] = "<p class='error'>Le mot de passe doit comporter au moins 6 caractères</p>";
    } else {
        $password = escape($_POST['password']);
    }

    if (empty(escape($_POST['cpassword']))) {
        $error['cpassword'] = "<p class='error'>Veuillez confirmer votre mot de passe</p>";
    } elseif (!empty($_POST['cpassword']) && escape($_POST['cpassword']) != escape($_POST['password'])) {
        $error['cpassword'] = "<p class='error'>Le mot de passe ne correspond pas</p>";
    } else {
        $cpassword = escape($_POST['cpassword']);
    }

    if (!$error && !empty($password) && !empty($cpassword) && $password == $cpassword) {
        $password = md5($password);
        if ($users->updateUsersPass($user['id'], $password)) {
            $error['editpass'] = "<p class='success'>Mot de passe modifié</p>";
        }
    }
}
?>
<div class="container">
    <section id="editprofil">
        <form action="" method="post">
            <?php echo $error['editinfo'] ?? "" ?>
            <div class="group">
                <label for="fullname">Nom & Prénoms</label>
                <input type="text" name="fullname" value="<?php echo $fullname ?? '' ?>">
                <?php echo $error['fullname'] ?? "" ?>
            </div>
            <div class="group">
                <label for="email">Adresse E-mail</label>
                <input type="text" name="email" value="<?php echo $email ?? '' ?>">
                <?php echo $error['email'] ?? "" ?>
            </div>
            <div class="group">
                <label for="contact">Contact</label>
                <input type="tel" name="contact" value="<?php echo $contact ?? '' ?>">
                <?php echo $error['contact'] ?? "" ?>
            </div>
            <div class="group">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" value="<?php echo $pseudo ?? '' ?>">
                <?php echo $error['pseudo'] ?? "" ?>
            </div>
            <input type="submit" value="modifier" name="editinfo">
        </form>
        <form action="" method="post">
            <?php echo $error['editpass'] ?? "" ?>
            <div class="group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? '' ?>">
                <?php echo $error['password'] ?? "" ?>
            </div>
            <div class="group">
                <label for="cpassword">Confirmer le Mot de passe</label>
                <input type="password" name="cpassword" value="<?php echo $_POST['cpassword'] ?? '' ?>">
                <?php echo $error['cpassword'] ?? "" ?>
            </div>
            <input type="submit" value="modifier mot de passe" name="editpass">
        </form>
    </section>
</div>
<?php include('includes/footer.php'); ?>