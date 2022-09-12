<?php
$error = false;
if (isset($_POST['submit'])) {
    if (empty(trim($_POST['full_name']))) {
        $error = "<h4 class='error'>Veuillez entrer un nom valide</h4>";
    } else {
        $full_name = $_POST['full_name'];
    }

    if (empty(trim($_POST['contact']))) {
        $error = "<h4 class='error'>Veuillez entrer un contact valide</h4>";
    } else {
        $contact = $_POST['contact'];
    }

    if (empty(trim($_POST['message']))) {
        $error = "<h4 class='error'>Veuillez entrer un message valide</h4>";
    } else {
        $message = $_POST['message'];
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
    <title>Immoplus</title>
    <style>
        .error {
            background: red;
            color: #fff;
            text-align: center;
            padding: 0.5em;
        }
    </style>
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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores vitae impedit sint sapiente quo excepturi dolore sunt aperiam tempora. Eius vel perferendis aspernatur qui rerum nemo corrupti, quisquam odit animi!</p>
        </div>
    </div>

    <section class="about" id="about">
        <div class="contentBx">
            <h2 class="heading">A propos</h2>
            <p class="text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam assumenda voluptatum deleniti provident laboriosam sequi tempore impedit aperiam sit commodi maiores et eum saepe iusto vitae illo, optio animi eaque! <br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, voluptates id aperiam repellat est veritatis eveniet culpa eius, iste, dolor sint nostrum delectus amet quos accusantium porro necessitatibus quam sapiente minus fuga magnam libero laudantium! Ea eius fugit hic ex voluptate quidem, expedita quaerat? Cum omnis quos debitis doloribus reiciendis.
            </p>
        </div>
        <div class="imgBx"></div>
    </section>

    <section class="services" id="services">
        <h2 class="heading">Nos services</h2>
        <p class="text">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore maiores quae doloribus quos quibusdam dolorum accusamus dicta excepturi aperiam ducimus placeat sunt ea modi nobis, officia nostrum enim esse sequi!
        </p>
        <div class="container">
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/real_estate_128px.png">
                    <h2>Achat & Location</h2>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates deserunt commodi fugit, eaque ducimus vel numquam mollitia dolorem qui veritatis!</small>
                    <br>
                    <a href="property" class="btn-link">Accéder</a>
                </div>
            </div>
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/rent_64px.png">
                    <h2>Mettre un bien sur le marché</h2>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates deserunt commodi fugit, eaque ducimus vel numquam mollitia dolorem qui veritatis!</small>
                    <br>
                    <a href="sell" class="btn-link">Accéder</a>
                </div>
            </div>
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/loader_60px.png">
                    <h2>Aide à la construction de bien</h2>
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates deserunt commodi fugit, eaque ducimus vel numquam mollitia dolorem qui veritatis!</small>
                    <br>
                    <a href="#" class="btn-link">Accéder</a>
                </div>
            </div>
        </div>
    </section>

    <section class="technology" id="technology">
        <div class="contentBx">
            <h2 class="heading">100% fiable</h2>
            <p class="text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, voluptates id aperiam repellat est veritatis eveniet culpa eius, iste, dolor sint nostrum delectus amet quos accusantium porro necessitatibus quam sapiente minus fuga magnam libero laudantium! Ea eius fugit hic ex voluptate quidem, expedita quaerat? Cum omnis quos debitis doloribus reiciendis.</p>
        </div>
        <div class="imgBx">
            <img src="./assets/img/immoplus.png">
        </div>
    </section>

    <section class="client" id="client">
        <h2 class="heading">Nos partenaires</h2>
        <p class="text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, voluptates id aperiam repellat est veritatis eveniet culpa eius, iste, dolor sint nostrum delectus amet quos accusantium porro necessitatibus quam sapiente minus fuga magnam libero laudantium! Ea eius fugit hic ex voluptate quidem, expedita quaerat? Cum omnis quos debitis doloribus reiciendis.</p>
        <div class="imgBx">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <h2 class="heading">Ce que nos clients disent</h2>
        <div class="container">
            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Nom & prenoms</h3>
                </div>
            </div>

            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Nom & prenoms</h3>
                </div>
            </div>

            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Nom & prenoms</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <h2 class="heading">Nous contacter</h2>
        <p class="text">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt sunt deleniti eligendi numquam iusto repudiandae nisi? Nulla quaerat ducimus assumenda aspernatur omnis deserunt nesciunt tempore dicta laborum, consequatur sapiente fugit.
        </p>
    </section>

    <section class="about">
        <div class="contentBx redbg">
            <form action="" method="post" class="form" autocomplete="off" autocapitalize="on">
                <?php echo $error ?? ""; ?>
                <div class="inputBx">
                    <input type="text" name="full_name" placeholder="Nom & prénoms" required maxlength="50" value="<?php echo $_POST['full_name'] ?? ""; ?>" minlength="5">
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