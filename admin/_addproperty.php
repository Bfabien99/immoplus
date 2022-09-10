<?php
include_once('functions.php');

$message = false;
$error = false;
if (isset($_POST['submit'])) {

    if (empty(escape($_POST['title']))) {
        $error['title'] = "<p class='error'>Le titre est obligatoire</p>";
    }elseif(strlen($_POST['title']) < 6){
        $$error['title'] = "<p class='error'>Le titre doit comporter au moins 6 caractères</p>";
    } 
    elseif(!preg_match('/^[a-zA-Z\-\_\ \']+$/', $_POST['title'])){
        $error['title'] = "<p class='error'>Seul les lettres et les caractères ('),(-),(_) sont admis pour le titre de la propriété</p>";
    }
    else {
        $title = $_POST['title'];
    }

    if (empty(escape($_POST['description']))) {
        $error['description'] = "<p class='error'>La description est obligatoire</p>";
    }elseif(strlen($_POST['description']) < 10 || strlen($_POST['description']) > 200){
        $error['description'] = "<p class='error'>Le titre doit comporter entre 10 et 200 caractères</p>";
    }  
    elseif(!preg_match('/^[a-zA-Z0-9]+[a-zA-Z\-\_\ \.\']+$/', $_POST['description'])){
        $error['description'] = "<p class='error'>Seul les lettres et les caractères ('),(-),(_) sont admis pour la description</p>";
    }
    else {
        $description = $_POST['description'];
    }

    if (empty(strtolower(escape($_POST['type'])))) {
        $error['type'] = "<p class='error'>Le type est obligatoire</p>";
    } 
    elseif(!preg_match('/^[a-z]+$/', $_POST['type'])){
        $error['type'] = "<p class='error'>Seuls les lettres sont admis pour le type</p>";
    }
    else {
        $type = $_POST['type'];
    }

    if (empty(escape($_POST['address']))) {
        $error['address'] = "<p class='error'>L'adresse est obligatoire</p>";
    }elseif(strlen($_POST['description']) < 2 || strlen($_POST['description']) > 200){
        $error['address'] = "<p class='error'>L'adresse doit comporter entre 2 et 200 caractères</p>";
    }  
    elseif(!preg_match('/^[a-zA-Z0-9\-\_\ \,\']+$/', $_POST['address'])){
        $error['address'] = "<p class='error'>Seul les lettres, les chiffres et les caractères ('),(-),(_),(,) sont admis pour l'adresse</p>";
    }
    else {
        $address = $_POST['address'];
    }

    if (empty(escape($_POST['area']))) {
        $error['area'] = "<p class='error'>La superficie est obligatoire</p>";
    }elseif($_POST['area'] < 50 || $_POST['area'] > 1000000000000){
        $error['area'] = "<p class='error'>La superficie être comprise entre 50m2 et 1000000000000m2</p>";
    }  
    elseif(!preg_match('/[0-9]\d+/', $_POST['area'])){
        $error['area'] = "<p class='error'>Seuls les chiffres sont admis pour la superficie</p>";
    }
    else {
        $area = $_POST['area'];
    }

    if (empty(escape($_POST['price']))) {
        $error['price'] = "<p class='error'>Le prix est obligatoire</p>";
    }elseif($_POST['price'] < 5000 || $_POST['price'] > 900000000000){
        $error['price'] = "<p class='error'>Le prix doit être compris entre 5000 fcfa et 900.000.000.000 fcfa</p>";
    }  
    elseif(!preg_match('/[0-9]\d+/', $_POST['price'])){
        $error['price'] = "<p class='error'>Seuls les chiffres sont admis pour le prix</p>";
    }
    else {
        $price = $_POST['price'];
    }

    if (empty(escape($_POST['shower']))) {
        $error['shower'] = "<p class='error'>Le nombre de douche est obligatoire</p>";
    }elseif($_POST['shower'] < 1 || $_POST['shower'] > 100){
        $error['shower'] = "<p class='error'>Le nombre de douche doit être compris entre 1 fcfa et 100</p>";
    }  
    elseif(!preg_match('/[0-9]\d+/', $_POST['shower'])){
        $error['shower'] = "<p class='error'>Seuls les chiffres sont admis pour le nombre de douche</p>";
    }
    else {
        $shower = $_POST['shower'];
    }

    if (empty(escape($_POST['bedroom']))) {
        $error['bedroom'] = "<p class='error'>Le nombre de chambre est obligatoire</p>";
    }elseif($_POST['bedroom'] < 1 || $_POST['bedroom'] > 100){
        $error['bedroom'] = "<p class='error'>Le nombre de chambre doit être compris entre 1 fcfa et 100</p>";
    } 
    elseif(!preg_match('/[0-9]\d+/', $_POST['bedroom'])){
        $error['bedroom'] = "<p class='error'>Seuls les chiffres sont admis pour le nombre de chambre</p>";
    }
    else {
        $bedroom = $_POST['bedroom'];
    }

    if (empty($_FILES["image"]["name"])) {
        $error['image'] = "<p class='error'>Selectionnez une image à ajouter</p>";
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

            // Post image to Imgur via API
            $response = callApiImgur($postFields);
            // Decode API response to array
            $responseArr = json_decode($response);

            // Check image upload status
            if (!empty($responseArr)) {
                $imgurData = $responseArr;
            } else {
                $error['image'] = "<p class='error'>L'image n'a pas pu être téléchargé</p>";
            }
        } else {
            $error['image'] = "<p class='error'>Désolé, seule les images png, jpeg, jpg sont acceptées</p>";
        }

        if (!empty($title) && !empty($description) && !empty($type) && !empty($address) && !empty($area) && !empty($price) && !empty($shower) && !empty($bedroom) && !empty($imgurData)) {
            
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
                        $error['api'] = "<p class='error'>$error</p>";
                    }
                }
            } else {
                $error['api'] = "<p class='success'>Propriété ajoutée</p>";
            }
            }else {
                $error['api'] = "<p class='error'>Désolé, le serveur ne répond pas pour l'instant... Veuillez réessayer plus tard</p>";
            }
            
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<style>
    .error,
    .success {
        padding: 5px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: fit-content;
        color: #fff;
    }

    .error {
        background-color: red;
    }

    .success {
        background-color: greenyellow;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
</head>

<body>
<?php echo $error['api'] ?? "" ?>
    <form method="post" enctype="multipart/form-data" id="myForm">
        <div class="group">
            <label for="title">Titre</label>
            <input type="text" name="title" value="<?php echo $_POST['title'] ?? "" ?>" >
            <?php echo $error['title'] ?? "" ?>
        </div>
        <div class="group">
            <label for="title">Description</label>
            <input type="text" name="description" value="<?php echo $_POST['description'] ?? "" ?>" >
            <?php echo $error['description'] ?? "" ?>
        </div>
        <div class="group">
            <label for="type">Type</label>
            <select name="type" id="type">
                <option value="location">En Location</option>
                <option value="vendre">En Vente</option>
            </select>
            <?php echo $error['type'] ?? "" ?>
        </div>
        <div class="group">
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" value="<?php echo $_POST['address'] ?? "" ?>" >
            <?php echo $error['address'] ?? "" ?>
        </div>
        <div class="group">
            <label for="area">Superficie en m2</label>
            <input type="number" name="area" value="<?php echo $_POST['area'] ?? "" ?>" min=50>
            <?php echo $error['area'] ?? "" ?>
        </div>
        <div class="group">
            <label for="price">Prix</label>
            <input type="number" name="price" value="<?php echo $_POST['price'] ?? "" ?>" min=5000>
            <?php echo $error['price'] ?? "" ?>
        </div>
        <div class="group">
            <label for="shower">Nombre de douche</label>
            <input type="number" name="shower" value="<?php echo $_POST['shower'] ?? "" ?>" min=1>
            <?php echo $error['shower'] ?? "" ?>
        </div>
        <div class="group">
            <label for="bedroom">Nombre de chambre</label>
            <input type="number" name="bedroom" value="<?php echo $_POST['bedroom'] ?? "" ?>" min=1>
            <?php echo $error['bedroom'] ?? "" ?>
        </div>
        <div class="group">
            <label for="picture">Image de la propriété</label>
            <input type="file" name="image">
            <?php echo $error['image'] ?? "" ?>
        </div>
        <?php if (!empty($imgurData)) : ?>
            <img src="<?php echo $imgurData->data->link; ?>" alt="">
            <p>Title = <?php echo $imgurData->data->description; ?></p>
            <p><b>Imgur URL:</b> <a href="<?php echo $imgurData->data->link; ?>" target="_blank"><?php echo $imgurData->data->link; ?></a></p>
        <?php endif; ?>
        <input type="submit" value="Enregistrer" name="submit" id="submit">
    </form>
</body>
</html>