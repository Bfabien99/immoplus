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
    } elseif (strlen(escape($_POST['message'])) < 20) {
        $error = "Le message doit comporter au moins 20 caractères";
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
    <link rel="shortcut icon" href="assets/img/immoplus.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/index.css" type="text/css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Immoplus</title>
</head>

<body>
    <a href="#banner" class="defile">^</a>
    <div class="banner" id="banner">
        <header>
            <a href="./" class="logo">
                ImmoPlus
            </a>
            <nav>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#about">A propos</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#client">Partenaire</a></li>
                    <li><a href="#testimonials">Avis</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="toggle"></div>
        </header>
        <img src="./assets/img/pexels-expect-best-323780.jpg">
        <div class="content">
            <h2>Immo plus</h2>
            <p>Achetez ou louez la maison qui vous convient sur notre plateforme</p>
            <p>Vous avez une maison en votre possession, vous pouvez la vendre...</p>
        </div>
    </div>

    <section class="about" id="about">
        <div class="contentBx">
            <h2 class="heading">A propos</h2>
            <p class="text">
                Immoplus est une agence de gestion immobilière. Elle permet aux personnes en quête de maison de retrouver ce qu'il leur faut. 
            </p>
            <p class="text">
                Selon votre budget, vos convenances, vous trouverez sur notre plateforme ce qu'il vous faut.
                grâce à Immoplus, vous pouvez mettre en vente votre maison sans risque.
            </p>
        </div>
        <div class="imgBx"></div>
    </section>

    <section class="services" id="services">
        <h2 class="heading">Nos services</h2>
        <p class="text">
            Nous mettons à votre disposition plusieurs services dans le but de faire votre bonheur
        </p>
        <div class="container">
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/real_estate_128px.png">
                    <h2>Achat & Location</h2>
                    <small>Achetez ou louez la maison qui vous convient</small>
                    <br>
                    <a href="property" class="btn-link">Accéder</a>
                </div>
            </div>
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/rent_64px.png">
                    <h2>Mettre un bien sur le marché</h2>
                    <small>Vous voulez vendre vendre vos maison, vous êtes à la bonne place</small>
                    <br>
                    <a href="sell" class="btn-link">Accéder</a>
                </div>
            </div>
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/loader_60px.png">
                    <h2>Plus de service</h2>
                    <small>Nous ne nous limitons pas qu'à la vente et l'achat, nous avons d'autres services qui pourraient vous interresser</small>
                    <br>
                    <a href="./service" class="btn-link">Accéder</a>
                </div>
            </div>
        </div>
    </section>

    <section class="technology" id="technology">
        <div class="contentBx">
            <h2 class="heading">100% fiable</h2>
            <p class="text">Nous sommes une agence fiable. Avec nous, aucune mauvaise suprise.</p>
            <p class="text">Entre nos mains votre bien est en sécurité. Guarantie 100%</p>
        </div>
        <div class="imgBx">
            <img src="./assets/img/immoplus.png">
        </div>
    </section>

    <section class="client" id="client">
        <h2 class="heading">Nos partenaires</h2>
        <p class="text">
            Nous sommes soutenues par des partenaires de confiance qui nous offres leur assistance dans le but de pouvoir repondre à vos attentes.
        </p>
        <div class="imgBx">
            <img src="https://img.icons8.com/color/480/000000/windows-logo.png" title="Windows" alt="partenaire1"/>
            <img src="https://img.icons8.com/color/480/000000/mac-logo.png" title="MacOs" alt="partenaire2"/>
            <img src="https://img.icons8.com/color/480/000000/google-logo.png" title="powerSchool" alt="partenaire3"/>
            <img src="https://img.icons8.com/fluency/480/000000/telegram-app.png" alt="partenaire4"/>
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <h2 class="heading">Ce que nos clients disent</h2>
        <div class="container">
            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Brou Fabien</h3>
                </div>
            </div>

            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Pen Js</h3>
                </div>
            </div>

            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Chris Onesiphore</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <h2 class="heading">Nous contacter</h2>
        <p class="text">
            Besoin de plus d'informations, avez vous une préocupation... Ecrivez nous!
        </p>
    </section>

    <section class="about">
        <?php if ($error) : ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    confirmButtonText: 'OK',
                    text: "<?php echo $error ?>",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        location.href = "#Contactform"
                    }
                })
            </script>
        <?php elseif ($success) : ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Super!',
                    confirmButtonText: 'OK',
                    text: 'Message Envoyé',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        location.href = "#Contactform"
                    }
                })
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

    <section class="footer">
        <p class="text">&copy2022 - BatiPlus/ImmoPlus NAN PROJECT - bfabienn99</p>
        <ul>
            <p class="text">Suivez nous: </p>
            <li><a href="#"><img src="./assets/img/facebook_96px.png" alt="facebook"></a></li>
            <li><a href="#"><img src="./assets/img/twitter_circled_100px.png" alt="twitter"></a></li>
            <li><a href="#"><img src="./assets/img/whatsapp_100px.png" alt="whatsapp"></a></li>
        </ul>
    </section>
</body>
<script src="./assets/js/jquery.js"></script>
<script src="./assets/js/toggle.js"></script>

</html>