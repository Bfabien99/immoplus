<?php include_once('../_includes/functions.php'); ?>
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
            min-height: 90vh;
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
            font-weight: 500;
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

        .recentOrders{
            position: relative;
            display: grid;
            min-height: 500px;
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
                    <a href="./">
                        <span class="icon"><i>&af;</i></span>
                        <span class="title">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="./property">
                        <span class="icon"><i>&copysr;</i></span>
                        <span class="title">Propriétés</span>
                    </a>
                </li>
                <li>
                    <a href="./user">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Utilisateurs</span>
                    </a>
                </li>
                <li>
                    <a href="./maps">
                        <span class="icon"><i>&circlearrowleft;</i></span>
                        <span class="title">Carte</span>
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