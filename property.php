<?php
include_once('_includes/functions.php');

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
    <title>PROPRIETES</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            overflow-x: hidden;
        }
        .properties{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 0.5em;
            padding: 10px;
            border-radius: 3px;
        }

        .property{
            padding: 5px;
            box-shadow: 0px 2px 5px #ccc;
        }

        .property .imgBx{
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 200px;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
        <?php if(!empty($properties)):?>
            <div class="properties">
            <?php foreach ($properties as $property):?>
            <div class="property">
                <div class="imgBx" style="background-image:url('<?php echo $property['picture'] ?? 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8aG91c2V8ZW58MHx8MHx8&auto=format&fit=crop&w=1100&q=60'?>')">
                </div>
                <div class="contentBx">
                    <h3 class="title"><?php echo $property['title'] ?></h3>
                    <section class="description">
                        <?php echo $property['description'] ?>
                    </section>
                    <a href="./property/view/<?php echo $property['id'] ?>" class="see">Voir</a>
                </div>
            </div>
            <?php endforeach;?>
            </div>
        <?php else :?>
            <h4>Aucune propriété pour l'instant</h4>
        <?php endif; ?>
    </div>
</body>
</html>

