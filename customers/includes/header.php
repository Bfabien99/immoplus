<?php
session_start();
include_once('../_includes/functions.php'); ?>
<?php include_once('../class/Properties.php'); ?>
<?php include_once('../class/Users.php'); ?>
<?php
$users = new Users();
if (!empty($_SESSION['immoplus_userPseudo'])) {
    $user = $users->getUserByPseudo($_SESSION['immoplus_userPseudo']);
    if (!$user) {
        header('location:/immoplus/login');
    }
} else {
    header('location:/immoplus/login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://kit.fontawesome.com/1f88d87af5.js" crossorigin="anonymous"></script> -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title>Users</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600;800;900&family=Rajdhani&family=Roboto:wght@100;300;400;500;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Rajdhani', serif;
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

        .navigation {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            background-color: #287bff;
        }

        .navigation ul {
            display: flex;
            justify-content: space-around;
            gap: 0.5em;
            list-style: none;
            width: 70%;
        }

        .navigation ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            transition: all 0.2s;
        }

        .navigation ul li a:hover {
            text-decoration: underline;
            color: #ccc;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            max-width: 300px;
        }

        .container {
            position: relative;
            width: 100%;
        }

        .name {
            position: relative;
            width: 400px;
            margin: 0 10px;
            font-size: 1.1rem;
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

        main {
            padding: 30px 20px;
            background-color: var(--grey);
            min-height: 85vh;
            display: flex;
            flex-direction: column;
        }

        .cardBox {
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 30px;
        }

        .cardBox .card {
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

        .cardBox .card .numbers {
            position: relative;
            font-weight: bold;
            font-size: 2.5rem;
            color: var(--blue);
        }

        .cardBox .card .cardName {
            color: var(--black2);
            font-size: 1.1em;
            margin-top: 5px;
        }

        .cardBox .card .iconBx {
            font-size: 3.5em;
            color: var(--green);
        }

        .cardBox .card:hover {
            background-color: var(--green);
        }

        .cardBox .card:hover .numbers,
        .cardBox .card:hover .cardName,
        .cardBox .card:hover .iconBx {
            color: var(--white);
        }

        .details {
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-gap: 30px;
            /* margin-top: 10px; */
        }

        .recentOrders,
        .recentCustomers {
            position: relative;
            display: grid;
            min-height: 200px;
            background-color: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
        }

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cardHeader h2 {
            font-weight: 600;
            color: var(--green);
            text-transform: capitalize;
        }

        .btn {
            position: relative;
            padding: 5px 10px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
            max-width: 200px;
            text-align: center;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .details table thead td {
            font-weight: 600;
        }

        .details .recentOrders table tr {
            color: var(--black1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .details .recentOrders table tr:last-child {
            border-bottom: none;
        }

        .details .recentOrders table tbody tr:hover,
        .recentCustomers table tr:hover {
            background: var(--blue);
            color: var(--white);
        }

        .details .recentOrders table tr td:last-child {
            text-align: end;
        }

        .details .recentOrders table tr td:nth-child(2) {
            text-align: center;
        }

        .details .recentOrders table tr td:nth-child(3) {
            text-align: center;
        }

        .details .recentOrders table tr td:nth-child(4) {
            text-align: center;
        }

        .details .recentOrders table tr td,
        .details .recentCustomers table tr td {
            padding: 12px 10px;
        }

        .status.attente {
            padding: 2px 4px;
            background-color: #f9ca3f;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .status.confirmer {
            padding: 2px 4px;
            background-color: #8de02c;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        .recentCustomers .imgBx {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }

        .recentCustomers .imgBx img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recentCustomers table tr td h4 {
            font-size: 16px;
            font-weight: bold;
            line-height: 1.2em;
        }

        .recentCustomers table tr td span {
            font-size: 14px;
            color: var(--black2);
        }

        .recentCustomers table tr:hover span {
            color: var(--white);
        }


        /* ## @DASHBOARD ## */
        /* ##############################################################*/
        /* ##############################################################*/
        #map {
            width: 100%;
            height: 80vh;
            background-color: var(--black2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f22;
        }

        main .container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        #postForm {
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

        #postForm .group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }

        #postForm .group label {
            font-weight: bold;
            font-size: 1rem;
            padding: 5px 0;
            border-top: 1px solid var(--green);
            display: flex;
            align-items: center;
            margin-right: 2em;
            text-transform: uppercase;
        }

        #postForm .group input {
            font-style: italic;
            height: 40px;
            text-transform: capitalize;
        }

        #postForm .group input,
        #postForm .group select,
        #postForm .group textarea {
            padding: 5px;
            outline: none;
            border: 1px solid var(--green);
            background-color: var(--white);
            text-align: justify;
            border-radius: 5px;
            transition: 0.2s;
        }

        #postForm .group input:focus,
        #postForm .group select:focus,
        #postForm .group textarea:focus {
            border: 1.5px solid var(--blue);
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
        }

        #submit {
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

        #submit:hover {
            background-color: var(--blue);
        }

        /* ## @ADD PROPERTY FORM ## */
        /* ##############################################################*/
        /* ##############################################################*/

        main .container .properties {
            display: grid;
            grid-template-columns: repeat(auto-fit, 300px);
            justify-content: center;
            grid-gap: 30px;
        }

        .properties .property {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 5px;
        }

        .properties .property .imgBx {
            max-width: 300px;
            height: 400px;
            overflow: hidden;
            box-shadow: 3px 3px 2px rgba(0, 0, 0, 0.1);
            transition: 0.2s;
        }

        .properties .property .imgBx .type,
        .properties .property .imgBx .status {
            position: absolute;
            color: var(--white);
            padding: 10px;
            font-weight: bold;
            font-style: italic;
        }

        .type.location {
            background: var(--green);
        }

        .type.vente {
            background-color: var(--blue);
        }

        .properties .property .imgBx .status {
            right: 0px;
        }

        .properties .property .imgBx:hover {
            box-shadow: 7px 7px 2px rgba(0, 0, 0, 0.3);
            border-radius: 15px 7px;
            margin-bottom: 5px;
        }

        .properties .property .imgBx img {
            width: 100%;
            object-fit: cover;
            height: 400px;

        }

        .properties .property .contentBx {
            background-color: var(--white);
            padding: 10px;
            display: none;
            flex-direction: column;
            gap: 10px;
            margin-top: -200px;
            transition: 0.3s;
        }

        .properties .property.active .contentBx {
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
        main .container #propertyBx .property {
            position: relative;
            z-index: 10;
        }

        #propertyBx {
            display: flex;
            flex-direction: column;
            gap: 2em;
        }

        #propertyBx .property {
            display: flex;
            flex-direction: column;
            gap: 1em;
            margin: auto;
            padding: 20px;
        }

        #propertyBx .property * {
            margin: 0 auto;
        }

        #propertyBx .property .imgBx {
            width: 100%;
            max-width: 700px;
            height: 400px;
            overflow: hidden;
        }

        #propertyBx .property .imgBx img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        #propertyBx .property .contentBx {
            display: flex;
            flex-direction: column;
            padding: 10px;
            gap: 1em;
        }

        #propertyBx .property .contentBx .details,
        #propertyBx .property .contentBx .value,
        #propertyBx .property .contentBx .actions {
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

        #propertyBx .property .contentBx .actions {
            background: none;
        }

        .edit,
        .del {
            padding: 10px;
            text-align: center;
            max-width: 200px;
            text-decoration: none;
            color: var(--white);
            border-radius: 5px;
            background-color: var(--blue);
        }

        .edit {
            background-color: var(--green);
        }

        .del {
            background-color: #f22;
        }

        #propertyBx .property .contentBx .value p:nth-child(1) {
            text-transform: uppercase;
        }

        #propertyBx .property .contentBx .value p:nth-child(2) {
            font-size: 1.6rem;
        }

        #propertyBx .property .contentBx .informations {
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

        #propertyBx .property .contentBx .title {
            text-align: center;
            text-transform: uppercase;
        }

        #propertyBx .property .contentBx .description {
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

        footer {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* ## @FOOTER ## */
        /* ##############################################################*/
        /* ##############################################################*/
        .error {
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

        .success {
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

        /* responsive */

        @media (max-width:991px) {
            .cardBox {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .details {
                grid-template-columns: repeat(1, 1fr);
            }

        }

        @media (max-width: 480px) {
            main {
                padding: 0;
            }

            main .container {
                padding: 20px;
            }

            #postForm .group {
                grid-template-columns: 1fr;
                grid-gap: 10px;
            }

            #postForm .group label {
                justify-content: center;
            }

            #postForm .group .error {
                text-align: center;
            }

            .cardBox {
                grid-template-columns: repeat(1, 1fr);
            }

            .cardHeader h2 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="navigation">
            <div class="topbar">
                <div class="user">
                    <img src="" alt="">
                </div>
                <div class="name">
                    <h4><?php echo $user['fullname']; ?></h4>
                </div>
            </div>
            <ul>
                <li>
                    <a href="/immoplus/">
                        <span class="icon">
                            <ion-icon name="key"></ion-icon>
                        </span>
                        <span class="title">Immoplus</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/customers/">
                        <span class="icon">
                            <ion-icon name="time"></ion-icon>
                        </span>
                        <span class="title">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/customers/property">
                        <span class="icon">
                            <ion-icon name="home"></ion-icon>
                        </span>
                        <span class="title">Propriétés</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/customers//maps">
                        <span class="icon">
                            <ion-icon name="send"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="/immoplus/customers/profil">
                        <span class="icon">
                            <ion-icon name="cog"></ion-icon>
                        </span>
                        <span class="title">Profil</span>
                    </a>
                </li>
                <li>
                    <a href="/immoplus/customers/logout">
                        <span class="icon">
                            <ion-icon name="log-out"></ion-icon>
                        </span>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <main>