<?php
include_once('_includes/functions.php');
include_once('class/Properties.php');

$properties = [];
// MyAPI url
if (isset($_GET['property_type'])) {
    $property_type = $_GET['property_type'];
    $url = 'http://localhost/immoplus/api/v1/property/' . $property_type;


    // Get Data from Api
    $response = GetDataFromMyApi($url);
    // Decode API response to array
    $data = json_decode($response, JSON_UNESCAPED_UNICODE);
    if ($data) {
        if ($data['statusCode'] == 200) {
            foreach ($data['data']['properties'] as $property) {
                // Vérifie si la propriété a été publiée
                if ($property['etat'] == 1) {
                    $properties[] = $property;
                }
            }
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
    <?php if ($property_type == 'location') : ?>
        <title>Propriétés à louer</title>
    <?php else : ?>
        <title>Propriétés en vente</title>
    <?php endif; ?>
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

        .heading {
            width: fit-content;
            color: #162c3bc8;
            font-weight: 100;
            font-style: italic;
            font-family: cursive;
            border-top: 3px solid #162c3bc8;
            padding: 2px 0px;
            margin-top: 3em;
        }

        .heading::first-letter {
            font-size: 1.3em;
            font-weight: bold;
            color: #3f8ffc;
        }

        #all_property {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 400px));
            grid-gap: 1em;
            padding: 5px;
        }

        .property {
            position: relative;
            display: flex;
            flex-direction: column;
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            background-color: #162c3bf9;
            max-height: 670px;
        }

        .property_header {
            position: relative;
            height: 500px;
            overflow: hidden;
        }

        .property_header a {
            display: inline-block;
            min-width: 300px;
            max-width: 100%;
            height: 500px;
        }

        .property_picture {
            width: 100%;
            height: 100%;
        }

        .property_picture:hover {
            scale: 2;
            transition: ease-in-out 5s;
        }

        .property_title,
        .property_type,
        .property_price,
        .property_view {
            position: absolute;
            color: #fff;
            text-transform: uppercase;
            word-wrap: break-word;
            letter-spacing: 1px;
        }

        .property_title {
            top: 10px;
            left: 10px;
            background-color: rgba(4, 3, 3, 0.663);
            padding: 5px;
            font-style: italic;
        }

        .property_type {
            bottom: 10px;
            right: 10px;
            color: #fff;
            font-weight: 200;
            padding: 5px;
            font-style: italic;
        }

        .property_view {
            bottom: 50px;
            right: 10px;
            background-color: #444;
            color: #fff;
            font-weight: 200;
            padding: 5px;
            font-size: 1.4rem;
        }

        .location {
            background-color: #3f8ffc;
        }

        .vente {
            background-color: #ca2d22;
        }

        .property_price {
            bottom: 10px;
            left: 10px;
            background-color: #162c3bc8;
            color: #fff;
            font-weight: 200;
            padding: 5px;
            font-size: 1.4rem;
        }

        .property_informations {
            padding: 10px 5px;
            color: #444;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.2em;
            letter-spacing: 1px;
            background-color: #fff;
        }

        .property_address {
            text-align: center;
            font-style: italic;
        }

        .property_description {
            text-align: justify;
            text-transform: initial;
            font-size: 1.2rem;
            height: 78px;
            overflow: hidden;
        }

        .property_detail {
            display: flex;
            justify-content: space-evenly;
            font-weight: bold;
        }

        .property_detail p {
            background-color: lightgray;
            padding: 5px;
            border-radius: 5px;
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

        .error {
            background-color: #f22;
            margin: auto 1.2em;
            padding: 10px;
            text-align: center;
            height: fit-content;
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
            color: #fff;
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
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
            <?php if ($property_type == 'location') : ?>
                <p>Voir Toutes Les Propriétés A Louer</p>
            <?php else : ?>
                <p>Voir Toutes Les Propriétés En Vente</p>
            <?php endif; ?>
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
        <?php if ($property_type == 'location') : ?>
            <h3 class="heading">Toutes Les Propriétés A Louer</h3>
        <?php else : ?>
            <h3 class="heading">Toutes Les Propriétés En Vente</h3>
        <?php endif; ?>
        <?php if (!empty($properties)) : ?>
            <section id="all_property">
                <?php foreach ($properties as $property) : ?>
                    <div class="property">
                        <div class="property_header">
                            <a href="property/view/<?php echo $property['id'] ?>"><img class="property_picture" src="<?php echo $property['picture'] ?? './assets/img/pexels-expect-best-323780.jpg' ?>" alt="image_propriete"></a>
                            <h3 class="property_title"><?php echo $property['title'] ?></h3>
                            <?php if ($property['type'] == 'location') : ?>
                                <h3 class="property_type location">A Louer</h3>
                            <?php else : ?>
                                <h3 class="property_type vente">En vente</h3>
                            <?php endif; ?>
                            <h6 class="property_view"><?php echo number_format($property['view'], 0, ',', '.')  ?></h6>
                            <h4 class="property_price"><?php echo number_format($property['price'], 0, ',', '.')  ?> fcfa</h4>
                        </div>
                        <div class="property_informations">
                            <h5 class="property_address"><?php echo $property['address'] ?></h5>
                            <div class="property_description">
                                <p><?php echo substr(nl2br($property['description']), 0, 100) . '...' ?></p>
                            </div>
                            <div class="property_detail">
                                <p class="property_bedroom"><?php echo $property['bedroom'] ?> chambres</p>
                                <p class="property_shower"><?php echo $property['shower'] ?> douches</p>
                                <p class="property_area"><?php echo number_format($property['area'], 0, ',', '.') ?> m2</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php else : ?>
            <h4>Aucune propriété pour l'instant</h4>
        <?php endif; ?>
    </div>
    <?php include('_includes/footer.php'); ?>