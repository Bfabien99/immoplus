<?php
include_once('functions.php');

// MyAPI url
$url = 'http://localhost/immoplus/api/v1/property';

// Get Data from Api
$response = GetDataFromMyApi($url);
// Decode API response to array
$data = json_decode($response, JSON_UNESCAPED_UNICODE);
$properties = [];
if($data){
    if($data['statusCode'] == 200)
    foreach ($data['data']['properties'] as $property) {
        $properties [] = $property;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php if(!empty($properties)):?>
            <?php foreach ($properties as $property):?>
            <div class="property">
                <div class="imgBx">
                    <img src="<?php echo $property['picture'] ?? "" ?>" alt="">
                </div>
                <div class="contentBx">
                    <h3 class="title"><?php echo $property['title'] ?></h3>
                    <section class="description">
                        <?php echo $property['description'] ?>
                    </section>
                </div>
            </div>
            <?php endforeach;?>
        <?php else :?>
            <h4>Aucune propriété pour l'instant</h4>
        <?php endif; ?>
    </div>
</body>
</html>