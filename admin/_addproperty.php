<?php
include_once('uploadToImgur.php');
$api_url = 'http://localhost/immoplus/api/v1/property';

function escape($data) {
    $data = strip_tags(trim($data));
    return ucfirst($data);
}

$message = false;
if(isset($_POST['submit'])){

    if(escape($_POST['title'])){
        $message .= "<p class='error'>Le titre est obligatoire</p>"."</br>";
    }
    if(escape($_POST['description'])){
        $message .= "<p class='error'>La description est obligatoire</p>"."</br>";
    }
    if(escape($_POST['type'])){
        $message .= "<p class='error'>Le type est obligatoire</p>"."</br>";
    }
    if(escape($_POST['address'])){
        $message .= "<p class='error'>L'adresse est obligatoire</p>"."</br>";
    }
    if(escape($_POST['area'])){
        $message .= "<p class='error'>La superficie est obligatoire</p>"."</br>";
    }
    if(escape($_POST['price'])){
        $message .= "<p class='error'>Le prix est obligatoire</p>"."</br>";
    }
    if(escape($_POST['shower'])){
        $message .= "<p class='error'>Le nombre de douche est obligatoire</p>"."</br>";
    }
    if(escape($_POST['bedroom'])){
        $message .= "<p class='error'>Le nombre de chambre est obligatoire</p>"."</br>";
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
    <?php if(isset($message)):?>
    <?php echo $message ?>
    <?php endif;?>
    <form method="post" enctype="multipart/form-data">
        <div class="group">
            <label for="title">title</label>
            <input type="text" name="title">
        </div>
        <div class="group">
            <label for="title">description</label>
            <input type="text" name="description">
        </div>
        <div class="group">
            <label for="type">type</label>
            <input type="text" name="type">
        </div>
        <div class="group">
            <label for="address">address</label>
            <input type="text" name="address">
        </div>
        <div class="group">
            <label for="area">area</label>
            <input type="text" name="area">
        </div>
        <div class="group">
            <label for="price">price</label>
            <input type="text" name="price">
        </div>
        <div class="group">
            <label for="shower">shower</label>
            <input type="text" name="shower">
        </div>
        <div class="group">
            <label for="bedroom">bedroom</label>
            <input type="text" name="bedroom">
        </div>
        <div class="group">
            <label for="picture">picture</label>
            <input type="file" name="picture" accept="image/png,jpeg,jpg">
        </div>
        <?php if(!empty($imgurData)):?>
            <img src="<?php echo $imgurData->data->link;?>" alt="">
            <p>Title = <?php echo $imgurData->data->description;?></p>
            <p><b>Imgur URL:</b> <a href="<?php echo $imgurData->data->link;?>" target="_blank"><?php echo $imgurData->data->link;?></a></p>
        <?php endif;?>
        <input type="submit" value="Enregistrer" name="submit">
    </form>
</body>
</html>