<?php include_once('../_includes/functions.php');?>
<?php include_once('../class/Properties.php');?>
<?php include_once('../class/Users.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://kit.fontawesome.com/1f88d87af5.js" crossorigin="anonymous"></script> -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600;800;900&family=Rajdhani&family=Roboto:wght@100;300;400;500;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 100;
        }

        :root {
            --blue: #287bff;
            --green: #162c3bf9;
            --white: #fff;
            --grey: #f5f5f5;
            --black1: #222;
            --black2: #999;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            position: relative;
            width: 100%;
        }

        .navigation {
            position: fixed;
            width: 300px;
            height: 100%;
            background: var(--green);
            border-left: 10px solid var(--green);
            transition: 0.5s;
            overflow: hidden;
        }

        .navigation.active {
            width: 80px;
        }

        .navigation ul {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .navigation ul li {
            position: relative;
            width: 200%;
            list-style: none;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .navigation ul li:hover,
        .navigation ul li.hovered {
            background-color: var(--white);
        }

        .navigation ul li:nth-child(1) {
            margin-bottom: 40px;
            pointer-events: none;
        }

        .navigation ul li a {
            position: relative;
            display: block;
            width: 100%;
            display: flex;
            text-decoration: none;
            color: var(--white);
        }

        .navigation ul li:hover a,
        .navigation ul li.hovered a {
            color: var(--green);
        }

        .navigation ul li a .icon {
            position: relative;
            display: block;
            min-width: 60px;
            height: 60px;
            line-height: 70px;
            text-align: center;
        }

        .navigation ul li a .icon i {
            font-size: 1.75rem;
        }

        .navigation ul li a .title {
            position: relative;
            display: block;
            padding: 0 10px;
            height: 60px;
            line-height: 60px;
            text-align: start;
            white-space: nowrap;
        }

        .main {
            position: absolute;
            width: calc(100% - 300px);
            left: 300px;
            min-height: 100vh;
            background-color: var(--white);
            transition: 0.5s;
        }

        .main.active {
            width: calc(100% - 80px);
            left: 80px;
        }

        .topbar {
            width: 100%;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
        }

        .toggle {
            position: relative;
            top: 0;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .main.active .toggle{
            rotate: 180deg;
        }

        .name {
            position: relative;
            width: 400px;
            margin: 0 10px;
            font-size: 1.5rem;
            text-align: center;
        }

        .user {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }

        .user img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        main{
            padding: 30px 20px;
            background-color: var(--grey);
            min-height: 85vh;
            display: flex;
            flex-direction: column;
        }

        .cardBox{
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 30px;
        }

        .cardBox .card{
            position: relative;
            background-color: var(--white);
            padding: 30px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            transition: 0.2s;
        }
        .cardBox .card .numbers{
            position: relative;
            font-weight: bold;
            font-size: 2.5rem;
            color: var(--blue);
        }

        .cardBox .card .cardName{
            color: var(--black2);
            font-size: 1.1em;
            margin-top: 5px;
        }

        .cardBox .card .iconBx{
            font-size: 3.5em;
            color: var(--green);
        }

        .cardBox .card:hover{
            background-color: var(--green);
        }

        .cardBox .card:hover .numbers,
        .cardBox .card:hover .cardName,
        .cardBox .card:hover .iconBx{
            color: var(--white);
        }

        .details{
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-gap: 30px;
            /* margin-top: 10px; */
        }

        .recentOrders, .recentCustomers{
            position: relative;
            display: grid;
            min-height: 200px;
            background-color: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
        }

        .cardHeader{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cardHeader h2{
            font-weight: 600;
            color: var(--green);
            text-transform: capitalize;
        }

        .btn{
            position: relative;
            padding: 5px 10px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
        }

        .details table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .details table thead td{
            font-weight: 600;
        }

        .details .recentOrders table tr{
            color: var(--black1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .details .recentOrders table tr:last-child{
            border-bottom: none;
        }
        .details .recentOrders table tbody tr:hover, .recentCustomers table tr:hover{
            background: var(--blue);
            color: var(--white);
        }

        .details .recentOrders table tr td:last-child{
            text-align: end;
        }

        .details .recentOrders table tr td:nth-child(2){
            text-align: center;
        }
        .details .recentOrders table tr td:nth-child(3){
            text-align: center;
        }
        .details .recentOrders table tr td:nth-child(4){
            text-align: center;
        }

        .details .recentOrders table tr td,.details .recentCustomers table tr td{
            padding: 12px 10px;
        }
        .status.attente{
            padding: 2px 4px;
            background-color: #f9ca3f;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .status.confirmer{
            padding: 2px 4px;
            background-color: #8de02c;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .recentCustomers .imgBx{
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }

        .recentCustomers .imgBx img{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recentCustomers table tr td h4{
            font-size: 16px;
            font-weight: bold;
            line-height: 1.2em;
        }

        .recentCustomers table tr td span{
            font-size: 14px;
            color: var(--black2);
        }

        .recentCustomers table tr:hover span{
            color: var(--white);
        }
        /* ## @DASHBOARD ## */
        /* ##############################################################*/
        /* ##############################################################*/
        #map{
            width: 100%;
            height: 80vh;
        }
        main .container{
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        #postForm{
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 30px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: var(--white);
            border-radius: 5px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
        }

        #postForm .group{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px,1fr));
        }

        #postForm .group label{
            font-weight: bold;
            font-size: 1rem;
            padding: 5px 0;
            border-top: 1px solid var(--green);
            display: flex;
            align-items: center;
            margin-right: 2em;
            text-transform: uppercase;
        }
        #postForm .group input{
            font-style: italic;
            height: 40px;
            text-transform: capitalize;
        }
        #postForm .group input, #postForm .group select, #postForm .group textarea{
            padding: 5px;
            outline: none;
            border: 1px solid var(--green);
            background-color: var(--white);
            text-align: justify;
            border-radius: 5px;
            transition: 0.2s;
        }

        #postForm .group input:focus, #postForm .group select:focus, #postForm .group textarea:focus{
            border: 1.5px solid var(--blue);
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
        }

        #submit{
            width: 100%;
            max-width: 200px;
            padding: 5px;
            background-color: var(--green);
            color: var(--white);
            border: none;
            border-radius: 5px;
            transition: 0.2s;
            cursor: pointer;
            height: 40px;
        }

        #submit:hover{
            background-color: var(--blue);
        }
        /* ## @ADD PROPERTY FORM ## */
        /* ##############################################################*/
        /* ##############################################################*/

        main .container .properties{
            display: grid;
            grid-template-columns: repeat(auto-fit, 300px);
            justify-content: center;
            grid-gap: 30px;
        }

        .properties .property{
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 5px;
        }

        .properties .property .imgBx{
            max-width: 300px;
            height: 400px;
            overflow: hidden;
            box-shadow: 3px 3px 2px rgba(0, 0, 0, 0.1);
            transition: 0.2s;
        }

        .properties .property .imgBx .type{
            position: absolute;
            color: var(--white);
            padding: 10px;
            font-weight: bold;
            font-style: italic;
        }

        .type.location{
            background: var(--green);
        }

        .type.vente{
            background-color: var(--blue);
        }

        .properties .property .imgBx:hover{
            box-shadow: 7px 7px 2px rgba(0, 0, 0, 0.3);
            border-radius: 15px 7px;
            margin-bottom: 5px;
        }

        .properties .property .imgBx img{
            width: 100%;
            object-fit: cover;
            height: 400px;

        }

        .properties .property .contentBx{
            background-color: var(--white);
            padding: 10px;
            display: none;
            flex-direction: column;
            gap: 10px;
            margin-top: -200px;
            transition: 0.3s;
        }

        .properties .property.active .contentBx{
            background-color: var(--white);
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 0;
            transition: 0.3s;
        }
        /* ## @SHOW ALL PROPERTIES ## */
        /* ##############################################################*/
        /* ##############################################################*/
        main .container #propertyBx .property{
            position: relative;
            z-index: 10;
        }

        #propertyBx{
            display: flex;
            flex-direction: column;
            gap: 2em;
        }

        #propertyBx .property{
            display: flex;
            flex-direction: column;
            gap: 1em;
            margin: auto;
            padding: 20px;
        }

        #propertyBx .property *{
            margin: 0 auto;
        }

        #propertyBx .property .imgBx{
            width: 100%;
            max-width: 700px;
            height: 400px;
            overflow: hidden;
        }

        #propertyBx .property .imgBx img{
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        #propertyBx .property .contentBx{
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 1em;
        }

        #propertyBx .property .contentBx .details,#propertyBx .property .contentBx .value,#propertyBx .property .contentBx .actions{
            width: 100%;
            max-width: 700px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            text-align: center;
            background-color: var(--white);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 2px 5px 2px rgba(0, 0, 0, 0.08);
        }

        #propertyBx .property .contentBx .actions{
            background:none;
        }

        .edit, .del, .publish{
            padding: 10px;
            text-align: center;
            max-width: 200px;
            text-decoration: none;
            color: var(--white);
            border-radius: 5px;
            background-color: var(--blue);
        }

        .edit{
            background-color: var(--green);
        }
.del{
    background-color: #f22;
}
        #propertyBx .property .contentBx .value p:nth-child(1){
            text-transform: uppercase;
        }

        #propertyBx .property .contentBx .value p:nth-child(2){
            font-size: 1.6rem;
        }

        #propertyBx .property .contentBx .informations{
            width: 100%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            text-align: center;
            background-color: var(--white);
            padding: 10px;
            border-radius: 5px 15px;
            box-shadow: 2px 5px 2px rgba(0, 0, 0, 0.03);
        }

        #propertyBx .property .contentBx .title{
            text-align: center;
            text-transform: uppercase;
        }

        #propertyBx .property .contentBx .description{
            text-align: justify;
        }

        #propertyBx .property_background_picture {
            top: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.25;
            filter: grayscale(100);
        }
        /* ## @SHOW PROPERTIE ## */
        /* ##############################################################*/
        /* ##############################################################*/

        .footer{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        /* ## @FOOTER ## */
        /* ##############################################################*/
        /* ##############################################################*/
        .error{
            background-color: #f22;
            margin: auto 1.2em;
            padding: 10px;
            text-align: center;
            height: fit-content;
            color: var(--white);
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
        }
        .success{
            background-color: green;
            margin: auto 1.2em;
            padding: 10px;
            text-align: center;
            height: fit-content;
            color: var(--white);
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
        }
        /* responsive */

        @media (max-width:991px){
            .navigation{
                left: -300px;
            }
            .navigation.active{
                width: 300px;
                left: 0;
            }
            .main{
                width: 100%;
                left: 0;
            }
            .main.active{
                left: 300px;
            }
            .cardBox{
                grid-template-columns: repeat(2,1fr);
            }
        }
        
        @media (max-width: 768px){
            .details{
                grid-template-columns: repeat(1,1fr);
            }
            .recentOrders{
                overflow-x: auto;
            }
        }

        @media (max-width: 480px){
            main{
                padding: 0;
            }

            main .container{
                padding: 20px;
            }
            #postForm .group{
                grid-template-columns: 1fr;
                grid-gap: 10px;
            }
            #postForm .group label{
                justify-content: center;
            }
            #postForm .group .error{
                text-align: center;
            }
            .toggle{
                z-index: 10001;
                transform: rotateY(180deg);
            }
            .cardBox{
                grid-template-columns: repeat(1,1fr);
            }
            .cardHeader h2{
                font-size: 20px;
            }
            .user{
                min-width: 40px;
            }
            .navigation{
                width: 100%;
                left: -100%;
                z-index: 1000;
                background-color: #162c3bff;
            }
            .navigation.active{
                width: 100%;
                left: 0;
            }
            .main.active .toggle{
                filter: invert(1);
                rotate: 180deg !important;
            }
         
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="icon"><ion-icon name="key"></ion-icon></span>
                        <span class="title">Immoplus</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/">
                        <span class="icon"><ion-icon name="time"></ion-icon></span>
                        <span class="title">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/property">
                        <span class="icon"><ion-icon name="home"></ion-icon></span>
                        <span class="title">Propriétés</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/user">
                        <span class="icon"><ion-icon name="people"></ion-icon></span>
                        <span class="title">Utilisateurs</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/maps">
                        <span class="icon"><ion-icon name="map"></ion-icon></span>
                        <span class="title">Carte</span>
                    </a>
                </li>
                <li>
                    <a href="./maps">
                        <span class="icon"><ion-icon name="send"></ion-icon></span>
                        <span class="title">Messages</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/agent">
                        <span class="icon"><ion-icon name="globe"></ion-icon></span>
                        <span class="title">Agents</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/profil">
                        <span class="icon"><ion-icon name="cog"></ion-icon></span>
                        <span class="title">Profil</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/logout">
                        <span class="icon"><ion-icon name="log-out"></ion-icon></span>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                <ion-icon name="caret-back-circle-outline"></ion-icon>
                </div>


                <div class="name">
                    <h4>Admin</h4>
                </div>

                <div class="user">
                    <img src="data:image/jpeg;base64,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" alt="">
                </div>
            </div>
            <script>
                // setInterval(function(){
                //     window.location.reload()
                // },2000)
            </script>
            <main>