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

        body {
            overflow-x: hidden;
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
            max-width: 750px;
            text-align: center;
        }

        .banner .content h2 {
            color: #fff;
            font-size: 60px;
        }

        .banner .content p {
            color: #fff;
            font-size: 18px;
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

        .about .imgBx {
            background: url('./assets/img/pexels-expect-best-323780.jpg') no-repeat center/cover;
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
            text-align: left;
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
        }

        .services .container .serviceBx {
            position: relative;
            background: #fff;
            width: 330px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 5px #333;
        }

        .services .container .serviceBx img {
            max-width: 100px;
        }

        .services .container .serviceBx h2 {
            font-weight: 500;
            font-size: 20px;
            letter-spacing: 1px;
        }


        .technology {
            background: #3f8ffc;
            width: 100%;
            padding: 100px;
            padding-top: 300px;
            margin-top: -300px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .technology .contentBx {
            max-width: 800px;
        }

        .technology .imgBx {
            max-width: 250px;
        }

        .technology .imgBx img {
            max-width: 100%;
        }


        .client {
            background: #162c3b;
            padding: 100px;
            text-align: center;
        }

        .client .imgBx {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .client .imgBx img {
            max-width: 200px;
            margin: 20px;
            opacity: 0.25;
            cursor: pointer;
        }

        .client .imgBx img:hover {
            opacity: 1.0;
        }


        .testimonials {
            position: relative;
            padding: 100px;
            background: #12222d;
            text-align: center;
        }

        .testimonials .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .testimonials .container .contentBx {
            background: #fff;
            padding: 40px 30px;
            width: 450px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: left;
            margin: 0 auto;
            margin-top: 5px;
        }

        .testimonials .container .contentBx p {
            font-style: italic;
        }

        .testimonials .container .contentBx h3 {
            width: 100%;
            text-align: end;
            font-weight: 500;
            color: #3f8ffc;
        }


        .contact {
            padding: 100px;
            background: #162c3b;
            text-align: center;
        }

        .imgBx2 {
            background: url('./assets/img/pexels-expect-best-323780.jpg') no-repeat center/cover;
            width: 50%;
        }

        .redbg {
            background: rgba(200, 40, 40) !important;
        }

        .form .inputBx {
            margin-bottom: 30px;
        }

        .form .inputBx input {
            width: 100%;
            background: transparent;
            box-shadow: none;
            border: none;
            outline: none;
            padding: 10px 0;
            font-size: 18px;
            font-weight: 300;
            color: #fff;
            border-bottom: 2px solid #fff;
        }

        .form .inputBx input::placeholder {
            color: #fff;
            font-style: italic;
            font-weight: 100;
        }

        .form .inputBx textarea {
            width: 100%;
            max-width: 100%;
            background: transparent;
            box-shadow: none;
            border: none;
            outline: none;
            padding: 10px 0;
            font-size: 18px;
            font-weight: 300;
            color: #fff;
            min-height: 150px;
            max-height: 200px;
            border-bottom: 2px solid #fff;
        }

        .form .inputBx textarea::placeholder {
            color: #fff;
            font-style: italic;
            font-weight: 100;
        }

        .form .inputBx input[type="submit"] {
            width: 150px;
            background: #fff;
            color: #111;
            cursor: pointer;
            font-weight: 400;
        }


        .footer {
            width: 100%;
            background: #162c3b;
            padding: 20px 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer ul {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer ul li {
            list-style: none;
        }

        .footer ul li a {
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }

        .footer ul li img {
            /*filter: invert(1);*/
            max-width: 20px;
        }


        @media (max-width: 991px) {
            .banner {
                padding: 50px;
            }
            .banner header {
                padding: 20px 50px;
            }
            .banner .content h2 {
                font-size: 36px;
            }
            .banner .content p {
                font-size: 16px;
            }


            .about {
                flex-direction: column;
            }
            .about .contentBx,
            .about .imgBx {
                width: 100%;
                padding: 50px;
                min-height: 400px;
                text-align: center;
            }
            .about .imgBx {
                position: absolute;
                opacity: 0.15;
            }


            .services {
                padding: 50px;
            }
            .services .container {
                justify-content: center;
                margin-top: 20px;
            }
            .services .container .serviceBx {
                margin: 20px;
                width: 300px;
                height: 350px;
            }


            .technology{
                padding: 50px;
                padding-top: 300px;
                justify-content: center;
                flex-direction: column;
            }
            .technology .imgBx{
                margin-top: 40px;
                max-width: 250px;
            }


            .client{
                padding: 50px;
            }
            .client .imgBx{
                justify-content: center;
            }


            .testimonials{
                padding: 50px;
            }
            .testimonials .contentBx{
                padding: 60px 40px;
                max-width: 550px;
                margin-bottom: 40px;
            }
            .testimonials .contentBx:last-child{
                margin-bottom: 0px;
            }


            .contact{
                padding: 50px;
            }


            .footer{
                padding: 20px 50px;
                flex-direction: column-reverse;
                text-align: center;
            }
            .footer ul{
                margin-bottom: 20px;
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

    <section class="client">
        <h2 class="heading">Nos partenaires</h2>
        <p class="text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, voluptates id aperiam repellat est veritatis eveniet culpa eius, iste, dolor sint nostrum delectus amet quos accusantium porro necessitatibus quam sapiente minus fuga magnam libero laudantium! Ea eius fugit hic ex voluptate quidem, expedita quaerat? Cum omnis quos debitis doloribus reiciendis.</p>
        <div class="imgBx">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
            <img src="./assets/img/pexels-expect-best-323780.jpg">
        </div>
    </section>

    <section class="testimonials">
        <h2 class="heading">Ce que nos clients disent</h2>
        <div class="container">
            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Nom & prenoms</h3>
                </div>
            </div>

            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Nom & prenoms</h3>
                </div>
            </div>

            <div class="contentBx">
                <div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis minus quisquam inventore vero velit error veritatis quod iure est facere, laborum reprehenderit, quis soluta minima laboriosam dolorum cum vel deserunt odio ipsum officiis aliquid optio, culpa debitis! Ut natus error esse tempore ratione nam libero quasi, distinctio tenetur sunt illum voluptas, repudiandae aliquam illo, odio enim iusto totam consequuntur deserunt.</p>
                    <h3>Nom & prenoms</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="contact">
        <h2 class="heading">Nous contacter</h2>
        <p class="text">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt sunt deleniti eligendi numquam iusto repudiandae nisi? Nulla quaerat ducimus assumenda aspernatur omnis deserunt nesciunt tempore dicta laborum, consequatur sapiente fugit.
        </p>
    </section>

    <section class="about">
        <div class="contentBx redbg">
            <form action="" class="form" autocomplete="off" autocapitalize="on">
                <div class="inputBx">
                    <input type="text" name="full_name" placeholder="Nom & prénoms" required maxlength="50" minlength="5">
                </div>
                <div class="inputBx">
                    <input type="tel" name="contact" placeholder="Contact" required maxlength="20" minlength="10">
                </div>
                <div class="inputBx">
                    <input type="email" name="email" placeholder="Email (optionnel)" minlength="5" maxlength="50">
                </div>
                <div class="inputBx">
                    <textarea name="message" id="" placeholder="Ecrivez votre message" required maxlength="200" minlength="5"></textarea>
                </div>
                <div class="inputBx">
                    <input type="submit" name="submit" value="Envoyer">
                </div>
            </form>
        </div>
        <div class="imgBx2"></div>
    </section>