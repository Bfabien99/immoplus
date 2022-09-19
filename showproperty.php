<?php
include_once('_includes/functions.php');
include_once('class/Properties.php');
$properties = new Properties();

$errors = [];
$data = [];
if (isset($_GET['property_id'])) {
    $property = $_GET['property_id'];

    if (!is_numeric($property)) {
        $errors['id'] = "<p class='error'>L'id doit être un entier</p>";
    } else {
        $url = 'http://localhost/immoplus/api/v1/property/' . $property;

        // Get Data from Api
        $response = GetDataFromMyApi($url);
        // Decode API response to array
        $data = json_decode($response, JSON_UNESCAPED_UNICODE);

        if (!empty($data)) {
            if ($data['statusCode'] != 200) {
                foreach ($data['messages'] as $error) {
                    if ($error != "") {
                        $errors['api'] = "<p class='error'>$error</p>";
                    }
                }
            } else {
                $property = $data['data']['properties'][0];
                $properties->incrementView($_GET['property_id']);
            }
        } else {
            $error['api'] = "<p class='error'>Désolé, le serveur ne répond pas pour l'instant... Veuillez réessayer plus tard</p>";
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
    <title>Propriété <?php echo $property['id'] ?? ""?></title>
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
            background-color: #162c3bf9;
            z-index: 10001;
        }

        #banner {
            position: relative;
            width: 100%;
            height: 600px;
            background: url('<?php echo $property['picture'] ?? '../../assets/img/pexels-expect-best-323780.jpg' ?>') no-repeat center/cover;
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
            background-color: #162c3bf9;
            display: flex;
            flex-direction: column;
            font-family: cursive;
        }

        .property_background_picture {
            top: 0;
            position: fixed;
            width: 100%;
            height: 100%;
            opacity: 0.25;
            filter: grayscale(100);
        }

        .property {
            z-index: 1000;
        }

        .property_details {
            padding: 30px 10px;
            background: url('<?php echo $property['picture'] ?? '../../assets/img/pexels-expect-best-323780.jpg' ?>') no-repeat bottom/cover;
            margin: 0 auto;
            display: flex;
            justify-content: space-evenly;
            width: 100%;
            max-width: 700px;
            box-shadow: 0px 2px 2px #112430;
        }

        .property_details p {
            background-color: #142734;
            color: #fff;
            padding: 10px;
            border-radius: 2px;
            box-shadow: 0px 2px 2px #081117;
            font-weight: bold;
            font-family: cursive;
        }

        .property_details p:hover {
            background-color: #11202a;
            transition: ease-in 0.2s;
        }

        .property_informations {
            margin: 3em auto;
            width: 100%;
            max-width: 1400px;
            background-color: #112430;
            padding: 15px 10px;
            color: #fff;
            min-height: 400px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .imgBx {
            max-height: 500px;
        }

        .property_picture {
            width: 100%;
            height: 90%;
        }

        .property_address {
            font-style: italic;
            font-weight: 100;
        }

        .content {
            padding: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            gap: 1em;
        }

        .property_title {
            text-transform: uppercase;

        }

        .property_description {
            padding: 15px;
            text-align: justify;
            letter-spacing: 1px;
            padding-bottom: 5px;
            border-bottom: 1px solid #fff;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .details p {
            text-align: left;
            margin: 10px auto;
            font-size: 1.3rem;
        }

        .details p:first-child {
            font-size: 1.5rem;
        }

        .details .property_type {
            text-transform: capitalize;
        }

        .details p span {
            font-weight: bold;
            font-size: 1rem;
            text-decoration: underline;
        }

        #map {
            position: relative;
            margin: 3em auto;
            width: 100%;
            height: 300px;
            max-width: 1400px;
            background-color: #c5c5c5e9;
            color: rgb(168, 15, 15);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer {
            position: relative;
            padding: 20px 10px;
            background-color: #162c3bf9;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <header>
        <div id="banner">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus repellat, ut animi voluptates praesentium iste porro, a perspiciatis architecto obcaecati, impedit sed amet veniam ducimus libero! Optio et saepe nesciunt sapiente magni odit, ad commodi obcaecati velit deserunt error sunt?</p>
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
        <div id="searchbox">
            <h5>Faire une recherche</h5>
            <form action="property.html" method="get">
                <input type="number" name="searchprice" id="searchprice" placeholder="Rechercher par prix" min=5000>
                <input type="number" name="searcharea" id="searcharea" placeholder="Rechercher par superficie" min=50>
                <input type="text" name="searchaddress" id="searchaddress" placeholder="Rechercher par localité">
                <button type="submit">Recherche</button>
            </form>
        </div>
        <h3 class="slogan">Immoplus... 100% fiable</h3>
    </header>


    <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <?php echo $error ?>
        <?php endforeach; ?>
        <a href="/immoplus/property" class="back">Retour</a>
    <?php else : ?>
        <?php if (!empty($property)) : ?>
            <div class="container">
                <?php $location = $property['address']; ?>
                <img class="property_background_picture" src="<?php echo $property['picture'] ?? '../../assets/img/pexels-expect-best-323780.jpg' ?>" alt="image_propriete">
                <div class="property">
                    <div class="property_details">
                        <p class="property_bedroom"><?php echo $property['bedroom'] ?> chambres</p>
                        <p class="property_shower"><?php echo $property['shower'] ?> douches</p>
                        <p class="property_area"><?php echo number_format($property['area'], 0, ',', '.') ?> m2</p>
                    </div>

                    <div class="property_informations">
                        <div class="imgBx">
                            <img class="property_picture" src="<?php echo $property['picture'] ?? '../../assets/img/pexels-expect-best-323780.jpg' ?>" alt="image_propriete">
                            <p class="property_address"><?php echo $property['address'] ?></p>
                        </div>
                        <div class="content">
                            <h4 class="property_title"><?php echo $property['title'] ?></h4>
                            <p class="property_description">
                                <?php echo nl2br($property['description']) ?>
                            </p>
                            <div class="details">
                                <p class="property_price"><span>Prix :</span> <?php echo number_format($property['price'], 0, ',', '.') ?> FCFA</p>
                                <p class="property_type"><span>Type :</span> <?php echo ($property['type'] == "location") ? 'A Louer' : 'En Vente' ?></p>
                                <p class="property_date"><span>Date :</span><?php echo datediff($property['post_date']) ?></p>
                            </div>
                        </div>

                    </div>

                    <div id="map">
                        <p>Impossible de charger la map</p>
                    </div>

                </div>
            </div>
        <?php else : ?>
            <h4>Aucune propriété pour l'instant</h4>
        <?php endif; ?>
    <?php endif; ?>
    <?php include('_includes/footer.php'); ?>

    <?php

    if (!empty($location)) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($location) . "&key=AIzaSyAgwEcOb6n37QfBvC5JuTGKxV9QQUBxgs8",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $datas = curl_exec($curl);

        if ($datas === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        }
        $datas = json_decode($datas, true);

        if (!empty($datas['results'])) { ?>

            <script>
                // Initialize and add the map
                function initMap() {
                    var infoWindow = new google.maps.InfoWindow({
                        content: "<div style='display:flex'><img style='max-width:100px;max-heigth:50px;object-fit:cover;' src='<?php echo $property['picture']; ?>'></div><div style='float:right; padding: 10px;'><b><?php echo $property['title']; ?></b><br/><?php echo $property['address']; ?><br/> <?php echo $property['price']; ?> fcfa</div>"
                    });
                    // The location of Uluru
                    const propertyLocated = {
                        lat: <?php echo $datas['results'][0]["geometry"]["location"]["lat"] ?>,
                        lng: <?php echo $datas['results'][0]["geometry"]["location"]["lng"] ?>
                    };
                    // The map, centered at propertyLocated
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 15,
                        center: propertyLocated,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    // The marker, positioned at propertyLocated
                    const marker = new google.maps.Marker({
                        position: propertyLocated,
                        map: map,
                        title: "<?php echo $property['title']; ?>",
                    });

                    marker.addListener("click", function() {
                        infoWindow.open(map.gMap, marker)
                    })


                }

                window.initMap = initMap;
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgwEcOb6n37QfBvC5JuTGKxV9QQUBxgs8&callback=initMap&v=weekly" defer></script>
    <?php }
    }
    ?>