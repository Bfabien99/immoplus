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

if (isset($_POST['publish'])) {
    if ($_POST['property_id'] == $_GET['property_id']) {

        $properties = new Properties();
        $property = $properties->getPropertiesById($_POST['property_id']);
        if ($properties->publishProperties($_POST['property_id'])) { ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Propriété mise en ligne',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = "/immoplus/admin/property";
                    }
                })
            </script>
<?php
            if ($property['_userId'] !== null) {
                $users = new Users();
                $user = $users->getUserById($property['_userId']);
                if ($user) {
                    $smessage = "<div><h3>Publication effectuée!</h3><strong>Votre propriété vient d'être publiée sur la plateforme immoplus</strong></div>";
                    sendmail('Publication Immoplus', $smessage, $user['email']);
                }
            }
        }
    }
}
?>
<?php if (isset($_POST['cancel'])) {
    if ($_POST['property_id'] == $_GET['property_id']) {

        $properties = new Properties();
        $property = $properties->getPropertiesById($_POST['property_id']);

        if ($property) {
            if ($property['_userId'] !== null) {
                $users = new Users();
                $user = $users->getUserById($property['_userId']);
                if ($user) {
                    if ($properties->deleteProperties($property['id'])) {
                        $smessage = "<div><h3>Publication annulée!</h3><strong>Publication d'une de vos propriétés annulée sur la plateforme immoplus</strong></div>";
                    sendmail('Publication Immoplus', $smessage, $user['email']);?>
                    <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Publication annulée',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = "/immoplus/admin/property";
                    }
                })
            </script>
                    <?php
                    }
                }
            } else {
                if ($properties->deleteProperties($property['id'])) {
                    header('Location:/immoplus/admin/property');
                } else {
                    return false;
                }
            }
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
                            <p><?php echo $property['shower'] ?> douche(s)</p>
                            <p><?php echo $property['bedroom'] ?> chambre(s)</p>
                            <p><?php echo $property['area'] ?> m2</p>
                        </div>
                        <div class="value">
                            <?php echo $property['type'] == 'location' ? "<p>A Louer</p>" : "<p>En vente</p>" ?>
                            <p><?php echo number_format($property['price'], 0, ',', '.') ?> Fcfa</p>
                            <?php echo ($property['etat'] == 0) ? "<span class='status attente'>En attente</span>" : "<span class='status confirmer'>Confirmer</span>" ?>
                        </div>
                        <div class="informations">
                            <h3 class="title"><?php echo $property['title'] ?></h3>
                            <p><ion-icon name="location-outline"></ion-icon><small><?php echo $property['address'] ?></small></p>
                            <p class="description">
                                <?php echo nl2br($property['description']) ?>
                            </p>
                        </div>
                        <div class="actions">
                            <a href="./../../property/edit/<?php echo $property['id'] ?>" class="edit">Modifier</a>
                            <?php echo ($property['etat'] == 0) ? "<form method='post'><input hidden type='number' name='property_id' value='{$property['id']}'><input type='submit' value='publier' class='publish' name='publish'><input type='submit' value='annuler' class='cancel' name='cancel'></form>" : "<i onclick='del({$property['id']})' class='del'>Supprimer</i>" ?>
                        </div>
                    </div>
                </div>


                <div id="map">
                    <p>
                        <ion-icon name="alert-circle"></ion-icon>
                    </p>
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
                    content: "<div style='display:flex;flex-direction:column;max-width:200px;word-wrap:break-word;text-align:center'><img style='width:200px;heigth:200px;object-fit:cover;' src='<?php echo $property['picture']; ?>'><div style='padding: 10px;'><b><?php echo $property['title']; ?></b><br/><?php echo $property['address']; ?><br/> <?php echo $property['price']; ?> fcfa</div></div>"
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
        Swal.fire({
            title: 'Voulez vous supprimer la propriété?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            denyButtonText: `Annuler`,
            cancelButtonText: `Fermer`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var input = id;

                if (input != "") {
                    $.ajax({
                        url: "/immoplus/admin/_deleteproperty.php",
                        method: "POST",
                        data: {
                            input: input,
                        },
                        success: function(data) {
                            if (data) {
                                window.location.href = '/immoplus/admin/property'
                            }

                        }
                    })
                } else {
                    window.location.reload()
                }
            } else if (result.isDenied) {
                Swal.fire('Suppression annulée', '', 'info')
            }
        })

    }
</script>
<?php include('includes/footer.php'); ?>