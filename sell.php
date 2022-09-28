<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise en vente du bien</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 100;
            font-family: 'Rajdhani', 'Poppins';
            color: #444;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            position: relative;
            width: 100%;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 1em;
        }

        .heading {
            text-align: center;
            padding: 15px;
            background: #162c3bff;
            color: #fff;
        }

        .urgent {
            text-align: center;
            color: #f11;
            font-weight: bold;
            text-decoration: underline;
            font-size: 1.3rem;
            letter-spacing: 2px;
        }

        #contentBx {
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 1em;
            margin: 0.2em auto;
        }

        .step {
            display: flex;
            flex-direction: column;
            gap: 0.2em;
            text-align: justify;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 5px 7px 2px rgba(0, 0, 0, 0.08);
            border-top: 1px solid #444;
        }

        .step p {
            font-size: 1.3rem;
        }

        .step a {
            color: #f11;
            font-weight: 500;
        }

        .step i {
            font-weight: 500;
        }

        .step:hover .num {
            color: tomato;
        }

        .num {
            font-family: 'Poppins';
            font-weight: bold;
            font-size: 2rem;
            color: #162c3bff;
        }

        .back {
            background-color: #444;
            margin: 2em 1.2em;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
            height: fit-content;
            width: fit-content;
            color: #fff;
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="heading">Mettre un bien en vente</h1>
        <p class="urgent">À LIRE</p>
        <div id="contentBx">
            <section class="step"><span class="num">1</span>
                <p>Vous devez disposer d'un compte utilisateur.</p>
                <p>Cliquez sur le lien <a href="./register">s'inscrire</a> pour vous inscrire </p>
            </section>
            <section class="step"><span class="num">2</span>
                <p>Connectez vous à votre compte.</p>
                <p>Cliquez sur le lien <a href="./login">connexion</a> pour vous connectez </p>
            </section>
            <section class="step"><span class="num">3</span>
                <p>Une fois connectez cliquez sur le menu <i>poster un bien</i>.</p>
                <p>Ensuite suivre les étapes </p>
            </section>
            <section class="step"><span class="num">4</span>
                <p>Une fois le bien posté, il ne sera pas directement publié sur la plateforme</p>
                <p>Vous serez contacter afin de verifier que le bien vous appartient</p>
            </section>
            <section class="step"><span class="num">5</span>
                <p>Après vérification, si tout est en accord, le bien sera mis en ligne</p>
                <p>Le cas échéant, il ne sera pas mis en ligne</p>
            </section>
            <a href="./" class="back">Retour</a>
        </div>
    </div>
</body>

</html>