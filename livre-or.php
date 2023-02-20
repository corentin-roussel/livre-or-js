<?php
    include '_db/connect.php';
    session_start();

    if(isset($_POST['connexion'])) {
        header('Location: index.php');
    }else if(isset($_POST['poster'])) {
        header('Location: commentaire.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '_include/head.php' ?>
    <title>Livre d'or</title>
</head>
<body class="bg-img">
    <header>
        <?php include '_include/header.php'?>
    </header>
    <main>
        <article class="main-index">
            <h1 class="title main-index">Livre d'or</h1>
        </article>
        <article class="flex-table">
            <?php

                // requête pour tout sélectionner dans la table utilisateurs
                $req =  $dbcon->query("SELECT * FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY date DESC");
                $req_user = $req->fetchAll(PDO::FETCH_ASSOC);
 
    
                
                
                if($_SESSION != NULL) { // si la session n'est pas égale a null affichage conditionnelle d'un bouton poster qui emmene sur la page commentaires
                    echo'<form class="comm" method="post">
                            <input class="button" type="submit" value="Poster" name="poster">
                        </form>';
                }else {
                    echo'<form class="comm" method="post">
                            <input class="button" type="submit" value="Connexion" name="connexion">
                        </form>';
                }

                foreach($req_user as $key => $values) { // pour le tableau de la requête en key => values pour pouvoir afficher les valeurs  de date login et commentaires
                    

                    $dateDB = (date_create($values['date']));
                    $date = date_format($dateDB, 'm/d/Y H:i');

                    echo'<section class="comm">
                            <p id="title-comment">Fait le ' . $date  . ' par ' . $values['login'] . '</p><br/>'. '<p id="comment">' . $values['commentaire'] . '</p><hr/>
                        </section>';
                }


            ?>
        </article>
    </main>
    <footer>
        <?php include '_include/footer.php' ?>
    </footer>
</body>
</html>
