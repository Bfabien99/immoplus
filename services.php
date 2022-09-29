<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Nos Services</title>
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

        .title {
            text-align: center;
        }

        .text {
            text-align: justify;
        }

        .contentBx {
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 1em;
            margin: 0.2em auto;
        }

        section {
            display: grid;
            grid-template-columns: repeat(2, minmax(200px, 50%));
            gap: 0.5em;
            text-align: justify;
            padding: 15px;
            border: 1px solid lightgrey;
            border-radius: 5px 20px 4px 11px;
            box-shadow: 5px 7px 2px rgba(0, 0, 0, 0.08);
            background-color: white;
        }

        section .heading {
            text-transform: uppercase;
            color: #162c3bff;
            text-align: center;
            margin: 0.3em;
        }

        section p {
            font-size: 1.3rem;
        }

        section a {
            color: #f11;
            font-weight: 500;
            text-decoration: none;
            text-transform: capitalize;
            padding: 5px;
            max-width: 100px;
            background-color: #112430;
            color: white;
            border-radius: 5px;
            margin: 0.2em;
            text-align: center;
        }

        .imgBx {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .imgBx img {
            width: 100%;
            max-width: 300px;
        }

        .content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .moreBx {
            display: none;
        }

        .moreBx.active {
            border-top: 1px solid #081117;
            display: block;
        }

        .contactBx{
            display: flex;
            align-items: center;
        }

        .contacts{
            color: #f11;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: fit-content;
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
        @media (max-width: 700px) {
            section {
                grid-template-columns: repeat(1, 1fr);
            }

            section .imgBx {
                order: 1;
            }

            section .content {
                order: 2;
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
    <header>
        <div id="banner">
            <p>Nos differents services</p>
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
        <h1 class="title">Nos services</h1>
        <p class="text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum praesentium nostrum veniam provident molestiae incidunt, possimus magnam. Amet, totam, doloremque eos magni deleniti nemo deserunt est, molestias ducimus nihil quibusdam recusandae perspiciatis! Id molestias nulla error praesentium eum iste numquam ad ullam, unde aspernatur adipisci! Excepturi consectetur quasi esse officia.
        </p>
        <div class="contentBx">
            <section>
                <div class="imgBx">
                    <img src="assets/img/icons8-panier-chargé-100.png" alt="image">
                </div>
                <div class="content">
                    <h3 class="heading">Vente de bien</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima consequatur similique veritatis quasi adipisci modi repellendus aperiam mollitia pariatur nesciunt est maxime, porro et molestias vero beatae quam provident excepturi!</p>
                    <a href="" class="show">voir</a>
                    <div class="moreBx">
                    <p><ion-icon name="caret-forward-sharp"></ion-icon> Achat de bien</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Location de bien</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Vente de bien</p>
                        <p class="contactBx">Contactez-nous : <a class="contacts" href="./contact"><ion-icon name="call-sharp"></ion-icon></a></p>
                    </div>
                </div>
            </section>
            <section>
                <div class="content">
                    <h3 class="heading">Gestion de bien</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, quaerat.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae eveniet laborum sint consequatur, architecto corrupti tempora dolores iste dolor voluptatem!</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <a href="" class="show">voir</a>
                    <div class="moreBx">
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Agents immobiliers</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Gestionnaire d'actifs immobiliers</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Juriste immobilier</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Chasseurs de biens immobiliers</p>
                        <p class="contactBx">Contactez-nous : <a class="contacts" href="./contact"><ion-icon name="call-sharp"></ion-icon></a></p>
                    </div>
                </div>
                <div class="imgBx">
                    <img src="assets/img/icons8-affaire-100.png" alt="image">
                </div>
            </section>
            <section>
                <div class="imgBx">
                    <img src="https://img.icons8.com/external-house-maxicons/100/000000/external-construction-build-a-house-outline-house-maxicons.png"/>
                </div>
                <div class="content">
                    <h3 class="heading">Construction de bien</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt dolor provident magni, laudantium earum facilis. Aliquid molestiae quis accusantium! Corrupti ab repellat veritatis sint ipsam doloremque eligendi magnam ad impedit!</p>
                    <br>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum itaque corrupti veniam a soluta, amet necessitatibus expedita dolorem placeat officiis?</p>
                    <a href="" class="show">voir</a>
                    <div class="moreBx">
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Confection des plans de maison</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Recherche de terrain adéquat pour la construction</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Achat et livraison du matériel</p>
                        <p><ion-icon name="caret-forward-sharp"></ion-icon> Ouvriers et architectes disponibles</p>
                        <p class="contactBx">Contactez-nous : <a class="contacts" href="./contact"><ion-icon name="call-sharp"></ion-icon></a></p>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <script>
        let moreBx = document.querySelectorAll('.show');
        moreBx.forEach((item) => {
            item.addEventListener('click', function(e) {
                e.preventDefault()
                this.parentElement.lastElementChild.classList.toggle('active')
                if (this.textContent == "voir") {
                    this.textContent = "cacher"
                } else {
                    this.textContent = "voir"
                }
            })
        })
    </script>
    <?php include('_includes/footer.php'); ?>