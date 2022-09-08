<?php
$api_url = 'http://localhost/immoplus/api/v1/property';

$message = false;
if(isset($_POST['submit'])){

    if(preg_match('/^[a-zA-Z\'\-]+$/',trim($_POST['title']))){
        $message .= "<p class='error'>Le titre ne doit contenir que des lettres</p>"."</br>";
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
    <form method="post" enctype="multipart/form-data">
        <div class="group">
            <label for="title">title</label>
            <input type="text" name="title">
        </div>

        <input type="submit" value="Enregistrer" name="submit">
    </form>
</body>
</html>