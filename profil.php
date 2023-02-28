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