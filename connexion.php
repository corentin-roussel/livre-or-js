<?php
    require_once('_db/connect.php');
    require_once('User.php');
    session_start();
    
    if(isset($_SESSION['id'])) {
        header("Location: index.php");
        exit;
    }

    $user = new User($id = NULL, $login = NULL, $password = NULL);
    

    if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['password']) ) { //si le champ POST n'est pas vide
        $login = htmlspecialchars(trim($_POST['login'])); //recupération de la variable créer par extract on la trim pour enlever les espaces si il y'en a et htmlspecialchars pour des raisons de sécurités
        $password = htmlspecialchars(trim($_POST['password'])); // idem

        $user->connect($login, $password);
    }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_include/head.php' ?>
    <title>Connexion</title>
</head>
<body class="bg-img">
    <main>
        <article class="form-flex">
            <h1 class="title main-index">Connectez vous</h1>
            <form class="form" id="connexion-form" method="POST">
                <?php if(isset($err_login)) {echo $err_login;} ?>
                <label class="space" for="login">Login</label>
                <input class="space input" type="text" name ="login"  value="<?php if(isset($login)) {echo $login;} ?>" placeholder="Entrez votre login" >

                <?php if(isset($err_password)) {echo $err_password;} ?>
                <label class="space" for="password">Mot de passe</label>
                <input class="space input" type="password" name ="password"  placeholder="Entrez votre mot de passe" >


                <input class="button" type="submit" id="submitCon"  name="submit" value="Connexion">
            </form>
        </article>
    </main>
</body>
</html>

