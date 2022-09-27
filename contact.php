<?php
include('_includes/functions.php');
include('class/Users.php');
$error = false;
$success = false;
if (isset($_POST['submit'])) {
    if (empty(escape($_POST['fullname']))) {
        $error = "Veuillez entrer un nom valide";
    } elseif (strlen(escape($_POST['fullname'])) < 5) {
        $error = "Le nom doit comporter au moins 5 caractères";
    } elseif (!ctype_alpha(str_replace(' ', '', escape($_POST['fullname'])))) {
        $error = "Le titre ne doit comporter que des lettres";
    } else {
        $fullname = $_POST['fullname'];
    }

    if (empty(escape($_POST['contact']))) {
        $error = "Veuillez entrer un contact valide";
    } elseif (!preg_match('/^[-+0-9]+$/', escape($_POST['contact']))) {
        $error = "Le contact n'est pas valide";
    } elseif (strlen(str_replace(['+', '-'], ['', ''], escape($_POST['contact']))) < 10) {
        $error = "Le contact doit contenir au moins dix chiffres";
    } else {
        $contact = $_POST['contact'];
    }

    if (!empty(escape($_POST['email']))) {
        if (!filter_var(escape($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $error = "L'email n'est pas valide";
        } else {
            $email = escape(mb_strtolower($_POST['email']));
        }
    }

    if (empty(escape($_POST['message']))) {
        $error = "Veuillez entrer un message valide";
    } else {
        $message = $_POST['message'];
    }

    if (!$error && !empty($fullname) && !empty($contact) && !empty($message)) {
        $user = new Users();
        if ($user->insertMessages($fullname, $contact, $email ?? "", $message)) {
            $success = true;
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
    <link rel="stylesheet" href="assets/css/index.css" type="text/css">
    <title>Nos Contacts</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600;800;900&family=Rajdhani&family=Roboto:wght@100;300;400;500;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            user-select: none;
            font-family: 'Rajdhani', 'Poppins';
        }

        body {
            width: 100%;
            overflow-x: hidden;
        }

        header {
            position: relative;
            width: 100%;
            padding-bottom: 3em;
            background-color: #162c3bff;
        }

        #banner {
            position: relative;
            width: 100%;
            height: 600px;
            background: url('/immoplus/assets/img/pexels-expect-best-323780.jpg') no-repeat center/cover;
            padding: 15px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #banner p {
            margin-top: 2em;
            max-width: 500px;
            text-align: justify;
            color: #fff;
            font-size: 1.4rem;
        }

        nav {
            position: absolute;
            width: 100%;
            top: 10px;
            display: flex;
            justify-content: center;
        }

        nav ul {
            background-color: #162c3bf9;
            width: 80%;
            max-width: 800px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            padding: 20px 15px;
            list-style: none;
        }

        nav ul li {
            text-align: center;
            padding: 5px;
            margin: 0.2em;
        }

        nav ul li:hover {
            background: #081117;
            transition: ease-in-out 0.2s;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
        }

        #searchbox {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 90%;
            max-width: 700px;
            margin: auto;
            margin-top: -4em;
            padding: 10px 5px;
            box-shadow: 2px 2px 2px rgba(16, 16, 16, 0.762);
            z-index: 1000;
            background-color: #fff;
        }

        #searchbox h5 {
            font-size: 1.3rem;
            text-transform: uppercase;
            font-weight: 100;
            color: #444;
        }

        #searchbox form {
            width: 100%;
            max-width: 500px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            padding: 20px 0;
        }

        #searchbox form input {
            height: 35px;
            padding: 5px;
            text-align: center;
            margin: 0.2em;
            text-transform: lowercase;
            outline: none;
            color: #162c3bf9;
        }

        #searchbox form input:focus {
            border: 2px solid #112430;
            transition: ease-in-out 0.3s;
        }

        #searchbox form button {
            height: 35px;
            border: none;
            padding: 5px;
            background-color: #162c3bc8;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }

        #searchbox form button:hover {
            transition: ease-in-out 0.3s;
            background-color: #112430;
        }

        .slogan {
            text-align: center;
            margin-top: 1.5em;
            color: #fff;
            text-shadow: 2px 2px 2px rgba(16, 16, 16, 0.762);
            text-transform: uppercase;
            letter-spacing: 0.3rem;
        }

        .container {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 0.2em;
            background-color: rgba(232, 229, 229, 0.497);
        }

        .title{
            text-align: center;
        }

        .infotext{
            text-align: justify;
        }

        #groupBx{
            display: grid;
            grid-template-columns: repeat(auto-fill,minmax(30%,1fr));
            padding: 10px;
            gap: 20px;
        }

        #groupBx .group{
            margin: 0 auto;
            text-align: center;
            padding: 5px;
            background-color: #fff;
            width: 100%;
            border-radius: 5px;
            border-top: 2px solid #112430;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.07);
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

        @media (max-width: 560px) {
            #groupBx{
            grid-template-columns: repeat(1,1fr);
        }
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
    <header>
        <div id="banner">
            <p>Nous contacter</p>
        </div>
        <nav>
            <ul>
                <li><a href="/immoplus/property">Accueil</a></li>
                <li><a href="/immoplus/property/location">Location</a></li>
                <li><a href="/immoplus/property/vente">En vente</a></li>
                <li><a href="/immoplus/about">A propos</a></li>
                <li><a href="/immoplus/service">Services</a></li>
                <li><a href="/immoplus/contact">Contact</a></li>
            </ul>

        </nav>
        <h3 class="slogan">Immoplus... 100% fiable</h3>
    </header>
    <div class="container">
        <h2 class="title">Contact</h2>
        <p class="infotext">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam, omnis officiis architecto quisquam dolor reprehenderit et labore aut dolorum quibusdam molestiae fugit, consequuntur incidunt ut sed, adipisci tempore quo facere commodi reiciendis eum ipsum tenetur. Impedit voluptate illo ad recusandae.</p>
        <hr>
        <section id="groupBx">
            <div class="group">
                <h3><i>icon</i> Adresse</h3>
                <p>08 BP ABIDJAN 04</p>
            </div>
            <div class="group">
                <h3><i>icon</i> Contact</h3>
                <p>00225 0504774183</p>
                <p>00225 0153148864</p>
            </div>
            <div class="group">
                <h3><i>icon</i> Email</h3>
                <p>fabienbrou99@gmail.com</p>
                <p>mytestomailer@gmail.com</p>
            </div>
        </section>
        <section class="about">
            <?php if ($error) : ?>
                <script>
                    alert("<?php echo $error; ?>");
                    location.href = "#Contactform"
                </script>
            <?php elseif ($success) : ?>
                <script>
                    alert("Message Envoyé");
                    location.href = "#Contactform"
                </script>
            <?php endif; ?>
            <div class="contentBx redbg">
                <form action="" method="post" class="form" autocomplete="off" autocapitalize="on">
                    <p id="Contactform"></p>
                    <?php if ($error) : ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php elseif ($success) : ?>
                        <p class="success">Message envoyé</p>
                    <?php endif; ?>
                    <div class="inputBx">
                        <input type="text" name="fullname" placeholder="Nom & prénoms" required maxlength="50" value="<?php echo $_POST['fullname'] ?? ""; ?>" minlength="5">
                    </div>
                    <div class="inputBx">
                        <input type="tel" name="contact" placeholder="Contact" required maxlength="20" value="<?php echo $_POST['contact'] ?? ""; ?>" minlength="10">
                    </div>
                    <div class="inputBx">
                        <input type="email" name="email" placeholder="Email (optionnel)" value="<?php echo $_POST['email'] ?? ""; ?>" minlength="5" maxlength="50">
                    </div>
                    <div class="inputBx">
                        <textarea name="message" id="" placeholder="Ecrivez votre message" required maxlength="200" minlength="5"><?php echo $_POST['message'] ?? ""; ?></textarea>
                    </div>
                    <div class="inputBx">
                        <input type="submit" name="submit" value="Envoyer">
                    </div>
                </form>
            </div>
            <div class="imgBx2"></div>
        </section>
    </div>
    <?php include('_includes/footer.php'); ?>