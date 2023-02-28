<?php
    require_once('_db/connect.php');
    require_once('User.php');
    session_start();

    $user = new User($id = NULL, $login = NULL, $password = NULL);

    if(isset($_SESSION['id'])) { //si on a quelquechose dans $_SESSION['id']
        header("Location: index.php");// redirige vers index.php
        exit;
    }

    $valid = (boolean) TRUE; //initialisation d'un booleen

    $regex = "^\S*(?=\S{5,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^"; //intialisation de la regex

    if(!empty($_POST) && !empty($_POST['password']) && !empty($_POST['login'])) { // si il ya quelquechose dans pose

        $login = htmlspecialchars(trim($_POST['login'])); //on récupere la variable récuperer par extract $login et on lui réassigne le même nom,
        $password = htmlspecialchars(trim($_POST['password'])); //on utilise la fonction trim pour supprimer les espaces de part et d'autres et on utilise la
        $confpassword = htmlspecialchars(trim($_POST['confpassword'])); // fonction html special chars qui permet de  convertir les carctéres spéciaux en entités html

        if ($password === $confpassword) {
            if ($user->checkpassword($password) === TRUE) {
                $crypt_mdp = password_hash($password, PASSWORD_DEFAULT);

                $user->register($login, $crypt_mdp);
            } else {
                $err_password = "Le mot de passe doit contenir minimum 5 caractéres, 1 caractére spéciales, 1 chiffre, 1majuscule et 1 minuscule";
            }
        } else {
            $err_password = "Le mot de passe et la confirmation du mot de passe ne sont pas identiques";
        }
    }else if(empty($_POST['password']) || empty($_POST['login']))
    {
        $err_login = "Veuillez renseignez tout les champs";
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '_include/head.php' ?>
    <title>Inscription</title>
</head>
<body class="bg-img">
    <main>
        <article class="form-flex">
            <h1 class="title main-index">Inscrivez-vous</h1>
            <form class="form" id="register" method="POST">

                <?php if(isset($err_login)) {echo '<div>' . "$err_login" . '</div>' ;} //affichage du message d'erreur si il y'en a une?>
                <label class="space" for="login">Login</label>
                <input class="space input" type="text" name ="login" value="<?php if(isset($login)) {echo "$login";} // si on écrit quelquechose dans le champ et que l'on se trompe le login reste afficher ?>" placeholder="Entrez votre login" required>


                <?php if(isset($err_password)) {echo '<div>' . "$err_password" . '</div>' ;} //affichage du message d'erreur si il y'en a une?>
                <label class="space" for="password">Mot de passe</label>
                <input class="space input" type="password" name ="password" placeholder="Entrez votre mot de passe" required>
                <small>Le mot de passe doit contenir minimum 5 caractéres, 1 majuscules, 1 minuscules, 1 caractére spéciale et 1 chiffre</small>

                <label class="space" for="confpassword">Confirmation mot de passe</label>
                <input class="space input" type="password" name ="confpassword"  value="" placeholder="Confirmez votre mot de passe" required>

                <input class="button" type="submit" name="submit" id="submitReg"  value="Inscription">
            </form>
        </article>
    </main>
</body>
</html>