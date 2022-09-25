<?php
session_start();
include_once('_includes/functions.php');
include_once('class/Users.php');
$users = new Users();
$errors = false;

if (isset($_POST['login'])) {
    if (empty(escape($_POST['identifiant']))) {
        $errors['identifiant'] = "<p class='error'>Votre pseudo est obligatoire</p>";
    } else {
        $identifiant = $_POST['identifiant'];
    }

    if (empty(escape($_POST['password']))) {
        $errors['password'] = "<p class='error'>Le mot de passe est obligatoire</p>";
    }else {
        $password = md5($_POST['password']);
    }

    if (!$errors) {
        if ($users->adminLogin($identifiant, $password)) {
            $user = $users->adminLogin($identifiant, $password);
            $_SESSION['immoplus_adminPseudo'] = $user['pseudo'];
            header('location:/immoplus/admin');
        } elseif ($users->usersLogin($identifiant, $password)) {
            $user = $users->usersLogin($identifiant, $password);
            $_SESSION['immoplus_userPseudo'] = $user['pseudo'];
            header('location:/immoplus/customers');
        }else{
            $errors['result'] = "<p class='error'>Utilisateur inconnu</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se Connecter</title>
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
            width: 100%;
            max-width: 800px;
        }

        #postForm {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 30px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
        }

        #postForm .group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }

        #postForm .group label {
            font-weight: bold;
            font-size: 1rem;
            padding: 5px 0;
            border-top: 1px solid #444;
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

        .radio p {
            display: flex;
            text-align: center;
            align-items: center;
            gap: 0.2em;
        }

        #postForm .group input,
        #postForm .group textarea {
            padding: 5px;
            outline: none;
            border: 1px solid #444;
            background-color: #fff;
            text-align: justify;
            border-radius: 5px;
            transition: 0.2s;
        }

        #postForm .group input:focus,
        #postForm .group textarea:focus {
            border: 1.5px solid #fc8d59;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
        }

        #submit {
            width: 100%;
            max-width: 200px;
            padding: 5px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: 0.2s;
            cursor: pointer;
            height: 40px;
        }

        #submit:hover {
            background-color: #fc8d59;
        }

        .error {
            background-color: #f22;
            margin: auto 1.2em;
            padding: 10px;
            text-align: center;
            height: fit-content;
            width: fit-content;
            color: #fff;
            letter-spacing: 2px;
            text-align: justify;
            font-weight: bold;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
        }
        .back{
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
        @media (max-width: 650px) {
            .container {
                padding: 0 20px;
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
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="heading">Connexion</h1>
        <p class="urgent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat inventore eum doloremque dolores praesentium a nulla minima hic omnis. Amet.</p>
        <div class="contentBx">
        <?php echo $errors['result'] ?? ""?>
            <form action="" method="post" id="postForm">
                <div class="group">
                    <label for="identifiant">Pseudonyme</label>
                    <input type="text" name="identifiant">
                    <?php echo $errors['identifiant'] ?? ""?>
                </div>
                <div class="group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password"> 
                    <?php echo $errors['password'] ?? ""?>
                </div>
                <input type="submit" value="Se connecter" name="login" id="submit">
            </form>
            <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? "/immoplus/property"?>" class="back">Retour</a>
        </div>
    </div>
</body>
<script>
    var pass = document.querySelector('#password');
    pass.addEventListener('dblclick', function(){
        if(pass.getAttribute('type') == 'password'){
            pass.setAttribute('type','text')
        }else{
            pass.setAttribute('type','password')
        }
    })
</script>
</html>