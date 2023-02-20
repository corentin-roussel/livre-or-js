<article>
    <nav class="nav"> <!-- bar de navigation a affichage conditionnelle  accueil afficher en permanence-->
                    <a class="link" href="index.php">Accueil</a>
        <?php if(!isset($_SESSION['login'])) {   ?>   <!-- si il n'ya pas d'id de session afficher inscription plus conenxion-->
                    <a class="link" id="inscription">Inscription</a>
                    <a class="link" id="connexion">Connexion</a>
                    <a class="link" href="livre-or.php">Livre d'or</a>
        <?php   }else{?>                                        <!-- sinon afficher accueil profil et deconnexion-->
                    <a class="link" href="profil.php">Profil</a>
                    <a class="link" href="livre-or.php">Livre d'or</a>
                    <a class="link" href="deconnexion.php">Se déconnecter</a>
        <?php } ?>
    </nav>
</article>