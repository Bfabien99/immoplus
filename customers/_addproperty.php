<?php include('includes/header.php'); ?>
<?php
$message = false;
$errors = false;
if (isset($_POST['submit'])) {
    
    if (empty(escape($_POST['title']))) {
        $errors['title'] = "<p class='error'>Le titre est obligatoire</p>";
    } elseif (strlen($_POST['title']) < 6) {
        $errors['title'] = "<p class='error'>Le titre doit comporter au moins 6 caractères</p>";
    }elseif (!ctype_alpha(str_replace(' ','',$_POST['title']))){
        $errors['title'] = "<p class='error'>Le titre ne doit comporter que des lettres</p>";
    } 
    else {
        $title = $_POST['title'];
    }

    if (empty(escape($_POST['description']))) {
        $errors['description'] = "<p class='error'>La description est obligatoire</p>";
    } elseif (strlen($_POST['description']) < 10 || strlen($_POST['description']) > 3000) {
        $errors['description'] = "<p class='error'>La description doit comporter entre 10 et 3000 caractères</p>";
    } else {
        $description = $_POST['description'];
    }

    if (empty(strtolower(escape($_POST['type'])))) {
        $errors['type'] = "<p class='error'>Le type est obligatoire</p>";
    } else {
        $type = $_POST['type'];
    }

    if (empty(escape($_POST['address']))) {
        $errors['address'] = "<p class='error'>L'adresse est obligatoire</p>";
    } elseif (strlen($_POST['address']) < 2 || strlen($_POST['address']) > 200) {
        $errors['address'] = "<p class='error'>L'adresse doit comporter entre 2 et 200 caractères</p>";
    } else {
        $address = $_POST['address'];
    }

    if (empty(escape($_POST['area']))) {
        $errors['area'] = "<p class='error'>La superficie est obligatoire</p>";
    } elseif ($_POST['area'] < 50 || $_POST['area'] > 100000000) {
        $errors['area'] = "<p class='error'>La superficie être comprise entre 50m2 et 100000000m2</p>";
    } else {
        $area = $_POST['area'];
    }

    if (empty(escape($_POST['price']))) {
        $errors['price'] = "<p class='error'>Le prix est obligatoire</p>";
    } elseif ($_POST['price'] < 5000 || $_POST['price'] > 900000000000) {
        $errors['price'] = "<p class='error'>Le prix doit être compris entre 5000 fcfa et 900.000.000.000 fcfa</p>";
    } else {
        $price = $_POST['price'];
    }

    if (empty(escape($_POST['shower']))) {
        $errors['shower'] = "<p class='error'>Le nombre de douche est obligatoire</p>";
    } elseif ($_POST['shower'] < 1 || $_POST['shower'] > 100) {
        $errors['shower'] = "<p class='error'>Le nombre de douche doit être compris entre 1 et 100</p>";
    } else {
        $shower = $_POST['shower'];
    }

    if (empty(escape($_POST['bedroom']))) {
        $errors['bedroom'] = "<p class='error'>Le nombre de chambre est obligatoire</p>";
    } elseif ($_POST['bedroom'] < 1 || $_POST['bedroom'] > 100) {
        $errors['bedroom'] = "<p class='error'>Le nombre de chambre doit être compris entre 1 et 100</p>";
    } else {
        $bedroom = $_POST['bedroom'];
    }

    if (!empty(escape($_POST['raison'])) && (strlen($_POST['description']) < 10 || strlen($_POST['description']) > 2000)) {
        $errors['raison'] = "<p class='error'>La raison doit comporter entre 10 et 2000 caractères</p>";
    }else {
        $raison = $_POST['raison'] ?? "";
    }

    if (empty($_FILES["image"]["name"])) {
        $errors['image'] = "<p class='error'>Selectionnez une image à ajouter</p>";
    } else {
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file format
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            // Source image
            $image_source = file_get_contents($_FILES["image"]["tmp_name"]);

            // API post parameters
            $postFields = array('image' => base64_encode($image_source));

            if(!$errors){
                // Post image to Imgur via API
            $response = callApiImgur($postFields);
            // Decode API response to array
            $responseArr = json_decode($response);
            // Check image upload status
            if (!empty($responseArr)) {
                $imgurData = $responseArr;
            } else {
                $errors['image'] = "<p class='error'>L'image n'a pas pu être téléchargé</p>";
            }
            }
            
        } else {
            $errors['image'] = "<p class='error'>Désolé, seule les images png, jpeg, jpg sont acceptées</p>";
        }


        if ((!$errors) && !empty($title) && !empty($description) && !empty($type) && !empty($address) && !empty($area) && !empty($price) && !empty($shower) && !empty($bedroom) && !empty($imgurData)) {

            // get Posted data and transform to json
            $data = array(
                "title" => $title,
                "description" => $description,
                "type" => $type,
                "address" => $address,
                "area" => $area,
                "price" => $price,
                "shower" => $shower,
                "bedroom" => $bedroom,
                "userId" => $user['id'],
                "raison" => $raison,
                "picture" => $imgurData->data->link
            );
            $data_string = json_encode($data);

            // MyAPI url
            $url = 'http://localhost/immoplus/api/v1/property';

            // Post Data to Api
            $response = PostToMyApi($data_string, $url);
            // Decode API response to array
            $data = json_decode($response, JSON_UNESCAPED_UNICODE);

            if (!empty($data)) {
                if ($data['statusCode'] != 200 && $data['statusCode'] != 201) {
                    foreach ($data['messages'] as $error) {
                        if ($error != "") {
                            $errors['api'] = "<p class='error'>$error</p>";
                        }
                    }
                } else {
                    $errors['api'] = "<p class='success'>Propriété ajoutée</p>";
                }
            } else {
                $errors['api'] = "<p class='error'>Désolé, le serveur ne répond pas pour l'instant... Veuillez réessayer plus tard</p>";
            }
        }
    }
}

?>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgwEcOb6n37QfBvC5JuTGKxV9QQUBxgs8&libraries=places&callback=initAutocomplete" async defer>
</script>
<div class="container">
<h3 style="text-align: center;margin:1em;color:var(--black2)">Ajouter une nouvelle propriété</h3>
    <?php echo $errors['api'] ?? "" ?>
    <form method="post" enctype="multipart/form-data" id="postForm">
        <div class="group">
            <label for="title">Titre</label>
            <input required placeholder="Entrer un titre" type="text" name="title" value="<?php echo $_POST['title'] ?? "" ?>">
            <?php echo $errors['title'] ?? "" ?>
        </div>
        <div class="group">
            <label for="title">Description</label>
            <textarea name="description" cols="30" rows="10" placeholder="Entrer les descriptions de la propriété"><?php echo $_POST['description'] ?? "" ?></textarea>
            <?php echo $errors['description'] ?? "" ?>
        </div>
        <div class="group">
            <label for="type">Type</label>
            <select name="type" id="type" required>
                <option value="">Veuillez choisir le type</option>
                <option value="location">En Location</option>
                <option value="vendre">En Vente</option>
            </select>
            <?php echo $errors['type'] ?? "" ?>
        </div>
        <div class="group">
            <label for="address">Adresse</label>
            <input required placeholder="Entrer l'adresse géographique de la propriété" type="text" id="address" name="address" value="<?php echo $_POST['address'] ?? "" ?>">
            <?php echo $errors['address'] ?? "" ?>
        </div>
        <div class="group">
            <label for="area">Superficie en m2</label>
            <input required placeholder="Entrer la superficie de la propriété" type="number" name="area" value="<?php echo $_POST['area'] ?? "" ?>" min=50>
            <?php echo $errors['area'] ?? "" ?>
        </div>
        <div class="group">
            <label for="price">Prix</label>
            <input required placeholder="Entrer le prix de la propriété" type="number" name="price" value="<?php echo $_POST['price'] ?? "" ?>" min=5000>
            <?php echo $errors['price'] ?? "" ?>
        </div>
        <div class="group">
            <label for="shower">Nombre de douche</label>
            <input required placeholder="Le nombre de douche est compris entre 1 et 100" type="number" name="shower" value="<?php echo $_POST['shower'] ?? "" ?>" min=1 max=100>
            <?php echo $errors['shower'] ?? "" ?>
        </div>
        <div class="group">
            <label for="bedroom">Nombre de chambre</label>
            <input required placeholder="Le nombre de chambre est compris entre 1 et 100" type="number" name="bedroom" value="<?php echo $_POST['bedroom'] ?? "" ?>" min=1 max=100>
            <?php echo $errors['bedroom'] ?? "" ?>
        </div>
        <div class="group">
            <label for="raison">Pourquoi voulez vous vendre la propriété ?</label>
            <textarea name="raison" id="" cols="30" rows="10"><?php echo $_POST['raison'] ?? "" ?></textarea>
        </div>
        <div class="group">
            <label for="picture">Choisir l'image de la propriété</label>
            <input required type="file" name="image">
            <?php echo $errors['image'] ?? "" ?>
        </div>
        <input type="submit" value="Enregistrer" name="submit" id="submit">
    </form>
    <div id="map"></div>
</div>

<script>
    let autocomplete;

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('address'), {
                types: ['establishment'],
                componentRestrictions: {
                    country: ['CI']
                },
                fields: ['place_id', 'address_components', 'geometry', 'icon', 'name']
            });

    }
</script>
<?php include('includes/footer.php'); ?>