<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos</title>
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
            gap: 10px;
            background-color: rgba(232, 229, 229, 0.497);
        }

        .title {
            text-align: center;
            color: #112430;
        }

        section {
            border-top: 2px solid rgba(0, 0, 0, 1);
            background-color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 0.2em;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);
        }

        section .heading {
            color: #112430;
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
            <p>Qui sommes nous et que faisons nous?</p>
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
        <h2 class="title">Qui sommes nous ?</h2>
        <section>
            <h3 class="heading">Qu'est ce que Immoplus ?</h3>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
        </section>
        <section>
            <h3 class="heading">Que fesons nous ?</h3>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
        </section>
        <section>
            <h3 class="heading">Sommes nous fiable ?</h3>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
        </section>
        <section>
            <h3 class="heading">Quels sont les crit??res pour mettre en vente ou acheter/louer un bien ?</h3>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, quos? Quaerat rerum voluptate quo necessitatibus earum, provident nisi laboriosam velit quasi odio repellat illum expedita obcaecati reiciendis fugit aliquam. Corrupti?</p>
        </section>
    </div>
    <?php include('_includes/footer.php'); ?>