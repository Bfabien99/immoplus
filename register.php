<?php
    include_once('_includes/functions.php');
    include_once('class/Users.php');
    
    $error = false;
    $users = new Users();
    // $users->insertUsers()
    
    if(isset($_POST['inscrire'])){
        if(empty(escape($_POST['fullname']))){
            $error['fullname'] = "<p class='error'>Veuillez entrer votre nom complet</p>";
        }elseif (strlen(escape($_POST['fullname'])) < 5) {
            $error['fullname'] = "<p class='error'>Le nom doit comporter au moins 5 caractères</p>";
        }elseif (!ctype_alpha(str_replace(' ','',trim($_POST['fullname'])))){
            $error['fullname'] = "<p class='error'>Le titre ne doit comporter que des lettres</p>";
        } 
        else {
            $fullname = escape($_POST['fullname']);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 100;
            font-family: 'Rajdhani','Poppins';
            color: #444;
        }
        body {
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            position: relative;
            width: 100%;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 1em;
        }
        .heading{
            text-align: center;
            padding: 15px;
            background: #162c3bff;
            color: #fff;
        }
        .urgent{
            text-align: center;
            color: #f11;
            font-weight: bold;
            text-decoration: underline;
            font-size: 1.3rem;
            letter-spacing: 2px;
        }
        #contentBx{
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 1em;
            margin: 0.2em auto;
        }

        .step{
            display: flex;
            flex-direction: column;
            gap: 0.2em;
            text-align: justify;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 5px 7px 2px rgba(0, 0, 0, 0.08);
            border-top: 1px solid #444;
        }
        .step p{
            font-size: 1.3rem;
        }
        .step a{
            color: #f11;
            font-weight: 500;
        }
        .step i{
            font-weight: 500;
        }
        .step:hover .num{
            color: tomato;
        }
        .num{
            font-family: 'Poppins';
            font-weight: bold;
            font-size: 2rem;
            color: #162c3bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">Inscription</h1>
        <p class="urgent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat inventore eum doloremque dolores praesentium a nulla minima hic omnis. Amet.</p>
        <div id="contentBx">
            <form action="" method="post">
                <div class="group">
                    <label for="fullname">Nom & Prénoms</label>
                    <input type="text" name="fullname" required placeholder="Jhon Doe">
                    <?php echo $error['fullname'] ?? ""?>
                </div>
                <div class="group">
                    <label for="gender">Genre</label>
                    <p><input type="radio" name="gender" value="m" required>Homme</p>
                    <p><input type="radio" name="gender" value="f" required>Femme</p>
                    <?php echo $error['gender'] ?? ""?>
                </div>
                <div class="group">
                    <label for="birth">Date de naissance</label>
                    <input type="date" name="birth" required>
                    <?php echo $error['birth'] ?? ""?>
                </div>
                <div class="group">
                    <label for="description">Comment vous décririez-vous ?</label>
                    <textarea name="description" id="" cols="30" rows="10" placeholder="sincère..."></textarea>
                    <?php echo $error['description'] ?? ""?>
                </div>
                <div class="group">
                    <label for="contact">Votre contact</label>
                    <input type="tel" name="contact" required placeholder="002250101010101">
                    <?php echo $error['contact'] ?? ""?>
                </div>
                <hr>
                <div class="group">
                    <label for="email">Votre adresse E-mail</label>
                    <input type="email" name="email" required placeholder="Jhon-Doe@mail.org">
                    <?php echo $error['email'] ?? ""?>
                </div>
                <div class="group">
                    <label for="pseudo">Veuillez choisir un pseudonyme</label>
                    <input type="text" name="pseudo" required placeholder="Jhon_Doe">
                    <?php echo $error['pseudo'] ?? ""?>
                </div>
                <div class="group">
                    <label for="password">Veuillez entrer un mot de passe</label>
                    <input type="password" name="password" required placeholder="******">
                </div>
                <div class="group">
                    <label for="cpassword">Confirmer votre mot de passe</label>
                    <input type="password" name="cpassword" required placeholder="******">
                    <?php echo $error['password'] ?? ""?>
                </div>
                <input type="submit" value="S'inscrire" name="inscrire">
            </form>
    <a href="./" class="back">Retour</a>
        </div>
    </div>
</body>
</html>