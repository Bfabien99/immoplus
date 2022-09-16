<?php include_once('../_includes/functions.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
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

        #postForm .group .error{
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

        .footer{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        /* ## @FOOTER ## */
        /* ##############################################################*/
        /* ##############################################################*/
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
                        <span class="icon"><i>&copy;</i></span>
                        <span class="title">Brznd Name</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/">
                        <span class="icon"><i>&af;</i></span>
                        <span class="title">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/property">
                        <span class="icon"><i>&copysr;</i></span>
                        <span class="title">Propriétés</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/user">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Utilisateurs</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/maps">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Carte</span>
                    </a>
                </li>
                <li>
                    <a href="./maps">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Messages</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/agent">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Agents</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/profil">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Profil</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/admin/logout">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i>&leftarrow;</i>
                </div>


                <div class="name">
                    <h4>Admin</h4>
                </div>

                <div class="user">
                    <img src="./pexels-expect-best-323780.jpg" alt="">
                </div>
            </div>
            <main>