<?php
    require_once '_db/connect.php';
    require_once 'User.php';
    session_start();


$user = new User($id = NULL, $login = NULL, $password = NULL);
    $valid = (boolean) TRUE;

    $regex = "^\S*(?=\S{5,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^";

    if(!empty($_POST)) {
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));
        $confpassword = htmlspecialchars(trim($_POST['confpassword']));
        $oldpassword = htmlspecialchars(trim($_POST['oldpassword']));

        $user->update($login, $password, $confpassword, $oldpassword);
    }
            

//            $sessionLogin = $_SESSION['login'];
//
//             if(password_verify($oldpassword, $_SESSION['password'])) {
//
//                if($login != $_SESSION['login']) {
//                    $user = $dbcon->prepare("SELECT login FROM utilisateurs WHERE :login");
//                    $user->execute(["login" => $login]);
//                    $verif = $user->rowCount();
//
//                    if($verif > 0) {
//                        $valid = FALSE;
//                        $err_login = "Ce login est déja pris";
//                    }
//
//                }else if($login === $_SESSION['login']){
//                    $valid = FALSE;
//                    $err_login = "Le login  $login  est déja pris.";
//                }else if(grapheme_strlen($login) < 5) {
//                    $valid = FALSE;
//                    $err_login = "Le login doit contenir au minimum 5 caractéres.";
//                }
//                else if(grapheme_strlen($login) > 25) {
//                    $valid = FALSE;
//                    $err_login = "Le login doit contenir maximum 25 caractéres.";
//                }
//
//
//                if($password != $confpassword) {
//                    $valid = FALSE;
//                    $err_password = "La confirmation du mot de passe n'est pas bonne";
//                }else if($password === $confpassword) {
//                    if(preg_match($regex, $password)) {
//                        $crypt_password = password_hash($password, PASSWORD_DEFAULT);
//                    }else {
//                        $valid = FALSE;
//                        $err_password = "Le mot de passe doit contenir au moins une majuscules, une minuscules un chiffres et un caractére spéciale";
//                    }
//                }
//
//                if($valid) {
//                    $user = $dbcon->prepare("UPDATE `utilisateurs` SET (:login, :password) WHERE (:id)");
//                    $user->execute([
//                        "login" => $login,
//                        "password" => $crypt_password,
//                        "id" => $_SESSION['id']
//                    ]);
//                    header("Location: deconnexion.php");
//                }
//            }else {
//                $valid = FALSE;
//                $err_password = "L'ancien mot de passe n'est pas bon";
//            }
//        }


    if($_SESSION != NULL) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_include/head.php'; ?>
    <title>Profil</title>
</head>
<body class="bg-img">
    <header>
        <?php include '_include/header.php'?>
    </header>
    <main>
        <article class="form-flex">
            <h1 class="title main-index ">Modifier le profil de <?php if($_SESSION) {echo $_SESSION['login'];}  ?></h1>
            <form class="form" action="" method="POST">
                    <?php if(isset($err_login)) {echo '<div>' . "$err_login" . '</div>' ;} ?>
                    <label class="space" for="login">Login</label>
                    <input class="space input" type="text" name ="login" value="<?php echo $_SESSION['login']; ?>"  >
                    
                    <?php if(isset($err_password)) {echo '<div>' . "$err_password" . '</div>' ;} ?>
                    <label class="space" for="password">Nouveau mot de passe</label>
                    <input class="space input" type="password" name ="password"  placeholder="Entrez votre nouveau mdp" >
                    
                    <label class="space" for="password">Confirmation nouveau mot de passe</label>
                    <input class="space input" type="password" name ="confpassword"  placeholder="Confirmez votre nouveau mdp" >
                    
                    <label class="space" for="password">Ancien mot de passe</label>
                    <input class="space input" type="password" name ="oldpassword"  placeholder="Entrez votre ancien mdp" >


                    <input class="button" type="submit" name="modify"  value="Modification">
        </article>
    </main>
    <footer>
        <?php include '_include/footer.php'?>
    </footer>
</body>
</html>

<?php }else {
    header("Location: index.php");
} ?>