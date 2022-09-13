<?php include_once('../_includes/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <title>Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
            width: 100vw;
        }

        .properties {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 0.5em;
            padding: 10px;
            border-radius: 3px;
        }

        .property {
            padding: 5px;
            box-shadow: 0px 2px 5px #ccc;
        }

        .property .imgBx {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 200px;
            width: 100%;
        }

        #map {
            width: 300px;
            height: 300px;
        }

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

        .doublescreen{
            display: flex;
            height: 100vh;
            position: relative;
        }

        .doublescreen nav{
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            height: 100%;
            position: fixed;
            width: 300px;
            top: 0;
        }

        .doublescreen nav ul{
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.3em;
        }

        .doublescreen nav ul li a{
            text-decoration: none;
            color: white;
            font-style: 'Poppins';
            text-align: center;
            font-size: 1.4em;
        }

        .doublescreen nav

        main{
            position: relative;
            left: 300px;
            display: grid;
            grid-template-columns: 1fr;
            width: calc(100%-300px);
        }
    </style>
</head>

<body>
    