<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immoplus</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body{
            overflow-x:hidden;
        }

        .banner {
            position: relative;
            width: 100%;
            height: 100vh;
            background: #3475ca;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .banner img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.25;
        }

        .banner .content {
            position: relative;
            max-width: 80%;
            text-align: center;
        }

        .banner .content h2 {
            color: #fff;
            font-size: 3vmax;
        }

        .banner .content p {
            color: #fff;
            font-size: 1.1vmax;
        }

        .banner header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 40px 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .banner header .logo {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .banner header .toggle {
            position: relative;
            width: 36px;
            height: 28px;
            background: url('./assets/img/menu_rounded_100px.png') no-repeat center/cover;
            cursor: pointer;
        }

        .about {
            position: relative;
            width: 100%;
            display: flex;
        }

        .about .contentBx {
            background: #162c3b;
            padding: 100px;
            width: 50%;
        }

        .heading {
            color: #fff;
            font-size: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .text {
            color: #fff;
            font-size: 16px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .about .imgBx {
            background: url('./assets/img/pexels-expect-best-323780.jpg') no-repeat center/cover;
            width: 50%;
        }

        .services {
            background-color: #12222f;
            padding: 100px;
            text-align: center;
        }

        .services .container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 60px;
            gap: 5px;
        }

        .services .container .serviceBx {
            position: relative;
            background: #fff;
            width: 350px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 5px #333;
        }

        .services .container .serviceBx img {
            max-width: 100px;
        }

        .services .container .serviceBx h2{
            font-weight: 500;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .technology{
            background: #3f8ffc;
            width: 100%;
            padding: 100px;
            padding-top: 300px;
            margin-top: -300px;
            display:flex;
            justify-content: space-between;
            align-items: center;
        }

        .technology .contentBx{
            max-width: 800px;
        }

        .technology .imgBx{
            max-width: 250px;
        }

        .technology .imgBx img{
            width:100%;
        }

        @media screen and (max-width:950px) {
            .banner .content h2 {
                color: #fff;
                font-size: 60px;
            }

            .banner .content p {
                color: #fff;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="banner">
        <header>
            <a href="./" class="logo">Immoplus</a>
            <div class="toggle"></div>
        </header>
        <img src="./assets/img/pexels-expect-best-323780.jpg">
        <div class="content">
            <h2>Immo plus</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores vitae impedit sint sapiente quo excepturi dolore sunt aperiam tempora. Eius vel perferendis aspernatur qui rerum nemo corrupti, quisquam odit animi!
                Sint adipisci nemo perspiciatis dolorum saepe illo quam, placeat doloribus architecto dolor labore voluptatibus ipsam, ea, minus ipsa impedit ad odio nisi dignissimos? Atque fugiat sequi deserunt maxime nostrum molestias?
                Blanditiis laboriosam doloribus accusantium quaerat asperiores iste itaque dolorem explicabo nulla. Perspiciatis placeat reprehenderit similique amet neque illo, perferendis dicta sunt ad sit, numquam blanditiis commodi exercitationem provident tenetur officia.</p>
        </div>
    </div>

    <section class="about">
        <div class="contentBx">
            <h2 class="heading">A propos</h2>
            <p class="text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam assumenda voluptatum deleniti provident laboriosam sequi tempore impedit aperiam sit commodi maiores et eum saepe iusto vitae illo, optio animi eaque! <br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, voluptates id aperiam repellat est veritatis eveniet culpa eius, iste, dolor sint nostrum delectus amet quos accusantium porro necessitatibus quam sapiente minus fuga magnam libero laudantium! Ea eius fugit hic ex voluptate quidem, expedita quaerat? Cum omnis quos debitis doloribus reiciendis.
            </p>
        </div>
        <div class="imgBx"></div>
    </section>

    <section class="services">
        <h2 class="heading">Nos services</h2>
        <p class="text">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore maiores quae doloribus quos quibusdam dolorum accusamus dicta excepturi aperiam ducimus placeat sunt ea modi nobis, officia nostrum enim esse sequi!
        </p>
        <div class="container">
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/pexels-expect-best-323780.jpg">
                    <h2>Service 1</h2>
                </div>
            </div>
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/pexels-expect-best-323780.jpg">
                    <h2>Service 1</h2>
                </div>
            </div>
            <div class="serviceBx">
                <div>
                    <img src="./assets/img/pexels-expect-best-323780.jpg">
                    <h2>Service 1</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="technology">
        <div class="contentBx">
        <h2 class="heading">100% fiable</h2>
        <p class="text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, voluptates id aperiam repellat est veritatis eveniet culpa eius, iste, dolor sint nostrum delectus amet quos accusantium porro necessitatibus quam sapiente minus fuga magnam libero laudantium! Ea eius fugit hic ex voluptate quidem, expedita quaerat? Cum omnis quos debitis doloribus reiciendis.</p>
        </div>
        <div class="imgBx">
        <img src="./assets/img/pexels-expect-best-323780.jpg">
        </div>
    </section>

    <section class="technology">
        <h2 class="heading">Nos partenaires</h2>
        <p class="text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, voluptates id aperiam repellat est veritatis eveniet culpa eius, iste, dolor sint nostrum delectus amet quos accusantium porro necessitatibus quam sapiente minus fuga magnam libero laudantium! Ea eius fugit hic ex voluptate quidem, expedita quaerat? Cum omnis quos debitis doloribus reiciendis.</p>
        <div class="imgBx">
        <img src="./assets/img/pexels-expect-best-323780.jpg">
        </div>
    </section>