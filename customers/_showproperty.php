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
                if ($property['_userId'] != $user['id']) {
                    $property = false;
                    $errors['property'] = "<p class='error'>Désolé, aucune propriété ne correspond</p>";
                }
            }
        } else {
            $error['api'] = "<p class='error'>Désolé, le serveur ne répond pas pour l'instant... Veuillez réessayer plus tard</p>";
        }
    }
}

if(isset($_POST['publish'])){
    if($_POST['property_id'] == $_GET['property_id']){

        $properties =new Properties();
        if($properties->publishProperties($_POST['property_id'])){?>
        <script>
            alert('Publication effectuée')
            window.location.href = ''
        </script>
<?php
        }
    }
}
?>
<div class="container">

    <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <?php echo $error ?>
        <?php endforeach; ?>
        <a href="./../../property" class="back">Retour</a>
    <?php else : ?>
        <?php if (!empty($property)) : ?>
            <?php $location = $property['address']; ?>
            <div id="propertyBx">
                <img class="property_background_picture" src="<?php echo $property['picture'] ?>" alt="image_propriete">
                <div class="property">
                    <div class="imgBx">
                        <img src="<?php echo $property['picture'] ?>" alt="">
                    </div>
                    <div class="contentBx">
                        <div class="details">
                            <p><?php echo $property['shower']?> douche(s)</p>
                            <p><?php echo $property['bedroom']?> chambre(s)</p>
                            <p><?php echo $property['area']?> m2</p>
                        </div>
                        <div class="value">
                            <?php echo $property['type'] == 'location' ? "<p>A Louer</p>" : "<p>En vente</p>"?>
                            <p><?php echo number_format($property['price'],0,',','.')?> Fcfa</p>
                            <?php echo ($property['etat'] == 0) ? "<span class='status attente'>En attente</span>" : "<span class='status confirmer'>Confirmer</span>"?>
                        </div>
                        <div class="informations">
                            <h3 class="title"><?php echo $property['title']?></h3>
                            <p class="description">
                            <?php echo nl2br($property['description'])?>
                            </p>
                        </div>
                        <div class="actions">
                            <a href="./../../property/edit/<?php echo $property['id']?>" class="edit">Modifier</a>
                            <i onclick="del(<?php echo $property['id']?>)" class='del'>Supprimer</i>
                        </div>
                    </div>
                </div>
            

            <div id="map">
            <p><ion-icon name="alert-circle"></ion-icon></p>
                <h3>Impossible de charger la map</h3>
            </div>
        </div>
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
<script>
    function del(id) {
        var input = id;

        if (input != "") {
            $.ajax({
                url: "/immoplus/customers/_deleteproperty.php",
                method: "POST",
                data: {
                    input: input,
                },
                success: function(data) {
                    if (data) {
                        window.location.href = '/immoplus/customers/property'
                    }

                }
            })
        } else {
            window.location.reload()
        }
    }
</script>
<?php include('includes/footer.php'); ?>