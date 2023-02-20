<?php
    include '_db/connect.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_include/head.php' ?>
    <script src="_js/script.js" defer></script>
    <title>Accueil</title>
</head>
<body class="bg-img">
    <header>
        <?php include '_include/header.php'; ?>
    </header>
    <main>
        <article class="main-index">
            <h1 class="title">Bonjour <?php if(isset($_SESSION['id'])) {echo $_SESSION['login'];} else{ echo "tout le monde";}  // affichage conditionnelle si il y a quelqeuchose dans session['id'] affiche $_SESSION['login'] sinon affiche tout le monde?>,<br/> et bienvenue sur le livre d'or.</h1>
        </article>
        <div id="place">

        </div>
    </main>
    <footer>
        <?php include '_include/footer.php'; ?>
    </footer>
</body>
</html>