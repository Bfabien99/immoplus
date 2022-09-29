<?php
include_once('_includes/functions.php');
include_once('class/Users.php');
include_once('mail.php');


$error = false;
$users = new Users();

if (isset($_POST['inscrire'])) {
    if (empty(escape($_POST['fullname']))) {
        $error['fullname'] = "<p class='error'>Veuillez entrer votre nom complet</p>";
    } elseif (strlen(escape($_POST['fullname'])) < 5) {
        $error['fullname'] = "<p class='error'>Le nom doit comporter au moins 5 caractères</p>";
    } elseif (!ctype_alpha(str_replace(' ', '', escape($_POST['fullname'])))) {
        $error['fullname'] = "<p class='error'>Le nom ne doit comporter que des lettres, sans accents</p>";
    } else {
        $fullname = escape(mb_strtoupper($_POST['fullname']));
    }

    if (isset($_POST['gender'])) {
        if (empty(escape($_POST['gender']))) {
            $error['gender'] = "<p class='error'>Veuillez choisir votre genre</p>";
        } elseif (escape($_POST['gender']) != "m" && escape($_POST['gender']) != "f") {
            $error['gender'] = "<p class='error'>Le genre n'est pas reconnu</p>";
        } else {
            $gender = escape(strtolower($_POST['gender']));
        }
    }


    if (empty(escape($_POST['birth']))) {
        $error['birth'] = "<p class='error'>Veuillez entrer votre date de naissance</p>";
    } else {
        $birth = escape($_POST['birth']);
    }

    if (empty(escape($_POST['description']))) {
        $error['description'] = "<p class='error'>Veuillez entrer votre description</p>";
    } elseif (strlen(escape($_POST['description'])) < 10 || strlen(escape($_POST['description'])) > 200) {
        $error['description'] = "<p class='error'>La description est comprise entre 10 et 200 caractères</p>";
    } else {
        $description = escape($_POST['description']);
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
        $email = escape(mb_strtolower($_POST['email']));
        if ($users->isEmail($email)) {
            $error['email'] = "<p class='error'>L'Email existe déja!</p>";
        }
    }

    if (empty(escape($_POST['pseudo']))) {
        $error['pseudo'] = "<p class='error'>Veuillez entrer votre pseudonyme</p>";
    } elseif (strlen(escape($_POST['pseudo'])) < 5) {
        $error['pseudo'] = "<p class='error'>Le pseudonyme doit comporter au moins 5 caractères</p>";
    } elseif (!preg_match('/^[a-zA-Z_0-9]+$/', escape($_POST['pseudo']))) {
        $error['pseudo'] = "<p class='error'>Le pseudonyme ne doit comporter que des lettres et/ou des chiffres</p>";
    } else {
        $pseudo = escape(mb_strtolower($_POST['pseudo']));
        if ($users->isPseudo($pseudo)) {
            $error['pseudo'] = "<p class='error'>Le pseudonyme existe déja!</p>";
        }
    }

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

    if (!$error && !empty($fullname) && !empty($gender) && !empty($birth) && !empty($description) && !empty($contact) && !empty($email) && !empty($pseudo) && !empty($password)) {
        if ($users->insertUsers($fullname, $gender, $birth, $description, $contact, $email, $pseudo, md5($password))) {
            $smessage = "<div><h2>Inscription réussie!</h2>";
            $smessage .= "<strong>Vous recevez ce mail car vous venez de vous incrire sur la plateforme Immoplus</strong></div>"; 
            sendmail('Inscription Immoplus',$smessage,$email);
            $error['success'] = "Inscription réussie";
        } else {
            $error['error'] = "Inscription échoué, veuillez reéssayer plus tard";
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>S'inscrire</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 100;
            font-family: 'Rajdhani', 'Poppins';
            color: #444;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            min-height: 90vh;
            position: relative;
            width: 100%;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 1em;
            background-color: rgba(232, 229, 229, 0.497);
        }

        .heading {
            text-align: center;
            padding: 15px;
            background: #162c3bff;
            color: #fff;
        }

        .urgent {
            text-align: center;
            color: #f11;
            font-weight: bold;
            text-decoration: underline;
            font-size: 1.3rem;
            letter-spacing: 2px;
        }

        #contentBx {
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 1em;
            margin: 0.2em auto;
            width: 100%;
            max-width: 800px;
        }

        #postForm {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 30px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
        }

        #postForm .group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }

        #postForm .group label {
            font-weight: bold;
            font-size: 1rem;
            padding: 5px 0;
            border-top: 1px solid #444;
            display: flex;
            align-items: center;
            margin-right: 2em;
            text-transform: uppercase;
        }

        #postForm .group input {
            font-style: italic;
            height: 40px;
            text-transform: capitalize;
        }

        .radio p {
            display: flex;
            text-align: center;
            align-items: center;
            gap: 0.2em;
        }

        #postForm .group input,
        #postForm .group textarea {
            padding: 5px;
            outline: none;
            border: 1px solid #444;
            background-color: #fff;
            text-align: justify;
            border-radius: 5px;
            transition: 0.2s;
        }

        #postForm .group input:focus,
        #postForm .group textarea:focus {
            border: 1.5px solid #fc8d59;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
        }

        #submit {
            width: 100%;
            max-width: 200px;
            padding: 5px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: 0.2s;
            cursor: pointer;
            height: 40px;
        }

        #submit:hover {
            background-color: #fc8d59;
        }

        .error {
            background-color: #f22;
            margin: auto 1.2em;
            padding: 10px;
            text-align: center;
            height: fit-content;
            width: fit-content;
            color: #fff;
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
        }

        .success {
            background-color: green;
            margin: auto 1.2em;
            padding: 10px;
            text-align: center;
            height: fit-content;
            width: fit-content;
            color: #fff;
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
        }

        .back {
            background-color: #444;
            margin: 0.2em;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
            height: fit-content;
            width: fit-content;
            color: #fff;
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
            text-decoration: none;
        }

        footer {
            position: relative;
            padding: 20px 10px;
            background-color: #162c3bf9;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.3em;
        }

        #footernav {
            width: 100%;
            padding: 5px;
            display: flex;
            justify-content: space-around;
        }

        #footernav ul {
            display: flex;
            flex-direction: column;
            gap: 0.5em;
        }

        #footernav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: all 0.3s;
        }

        #footernav ul li a:hover {
            text-decoration: underline;
            color: #ccc;
        }

        /* responsive */
        @media (max-width: 650px) {
            .container {
                padding: 0 20px;
            }

            #postForm .group {
                grid-template-columns: 1fr;
                grid-gap: 10px;
            }

            #postForm .group label {
                justify-content: center;
            }

            #postForm .group .error {
                text-align: center;
            }


        }

        @media (max-width: 560px) {
            #footernav {
                padding: 5px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 20px;
            }

            #footernav ul {
                margin: 0 auto;
                text-align: left;
                width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="heading">Inscription</h1>
        <p class="urgent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat inventore eum doloremque dolores praesentium a nulla minima hic omnis. Amet.</p>
        <div id="contentBx">
            <?php if (isset($error['error'])) : ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        confirmButtonText: 'OK',
                        text: "<?php echo $error['error'] ?>",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            location.href = "#Contactform"
                        }
                    })
                </script>
            <?php elseif (isset($error['success'])) : ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Super!',
                        confirmButtonText: 'OK',
                        text: "<?php echo $error['success'] ?>",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            location.href = "#Contactform"
                        }
                    })
                </script>
            <?php endif; ?>
            <form action="" method="post" id="postForm">
                <div class="group">
                    <label for="fullname">Nom & Prénoms</label>
                    <input type="text" name="fullname" placeholder="Jhon Doe" value="<?php echo $_POST['fullname'] ?? '' ?>" required>
                    <?php echo $error['fullname'] ?? "" ?>
                </div>
                <div class="group">
                    <label for="gender">Genre</label>
                    <div class="radio">
                        <p><input required type="radio" name="gender" value="m">Homme</p>
                        <p><input required type="radio" name="gender" value="f">Femme</p>
                    </div>

                    <?php echo $error['gender'] ?? "" ?>
                </div>
                <div class="group">
                    <label for="birth">Date de naissance</label>
                    <input type="date" name="birth" value="<?php echo $_POST['birth'] ?? '' ?>" required>
                    <?php echo $error['birth'] ?? "" ?>
                </div>
                <div class="group">
                    <label for="description">Comment vous décririez-vous ?</label>
                    <textarea name="description" id="" cols="30" rows="10" placeholder="sincère..." required><?php echo $_POST['description'] ?? '' ?></textarea>
                    <?php echo $error['description'] ?? "" ?>
                </div>
                <div class="group">
                    <label for="contact">Votre contact</label>
                    <input type="tel" name="contact" placeholder="002250101010101" value="<?php echo $_POST['contact'] ?? '' ?>" required>
                    <?php echo $error['contact'] ?? "" ?>
                </div>
                <hr>
                <div class="group">
                    <label for="email">Votre adresse E-mail</label>
                    <input type="email" name="email" placeholder="Jhon-Doe@mail.org" value="<?php echo $_POST['email'] ?? '' ?>" required>
                    <?php echo $error['email'] ?? "" ?>
                </div>
                <div class="group">
                    <label for="pseudo">Veuillez choisir un pseudonyme</label>
                    <input type="text" name="pseudo" placeholder="Jhon_Doe" value="<?php echo $_POST['pseudo'] ?? '' ?>" required>
                    <?php echo $error['pseudo'] ?? "" ?>
                </div>
                <div class="group">
                    <label for="password">Veuillez entrer un mot de passe</label>
                    <input type="password" name="password" placeholder="******" id="password" required>
                    <?php echo $error['password'] ?? "" ?>
                </div>
                <div class="group">
                    <label for="cpassword">Confirmer votre mot de passe</label>
                    <input type="password" name="cpassword" placeholder="******" required>
                    <?php echo $error['cpassword'] ?? "" ?>
                </div>
                <input type="submit" value="S'inscrire" name="inscrire" id="submit">
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? "/immoplus/property" ?>" class="back">Retour</a>
            </form>
        </div>
    </div>
    <script>
        var pass = document.querySelector('#password');
        pass.addEventListener('dblclick', function() {
            if (pass.getAttribute('type') == 'password') {
                pass.setAttribute('type', 'text')
            } else {
                pass.setAttribute('type', 'password')
            }
        })
    </script>
    <?php include('_includes/footer.php'); ?>