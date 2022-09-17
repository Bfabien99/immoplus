<?php include('includes/header.php'); ?>
<?php
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
            }
        } else {
            $error['api'] = "<p class='error'>Désolé, le serveur ne répond pas pour l'instant... Veuillez réessayer plus tard</p>";
        }
    }
}
?>
<div class="container">
    <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <?php echo $error ?>
        <?php endforeach; ?>
        <a href=".." class="back">Retour</a>
    <?php else : ?>
        <?php if (!empty($property)) : ?>
            <?php $location = $property['address']; ?>
            <div class="property">
                <div class="imgBx" style="background-image:url('<?php echo $property['picture'] ?? 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8aG91c2V8ZW58MHx8MHx8&auto=format&fit=crop&w=1100&q=60' ?>')">
                </div>
                <div class="contentBx">
                    <h3 class="title"><?php echo $property['title'] ?></h3>
                    <section class="description">
                        <?php echo $property['description'] ?>
                    </section>
                </div>
            </div>

            <div id="map"></div>
        <?php else : ?>
            <h4>Aucune propriété pour l'instant</h4>
        <?php endif; ?>
    <?php endif; ?>
</div>
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
<?php include('includes/footer.php'); ?>