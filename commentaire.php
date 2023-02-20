<?php 
    include '_db/connect.php';
    session_start();
    
    $valid = TRUE;

    if(!empty($_POST)) {
        extract($_POST);

        if(isset($_POST['submit'])) {
            $comment = htmlspecialchars(trim($comment));
            $sessionId = $_SESSION['id'];
            $date = date("Y-m-d H:i:s");

            if(empty($comment)) {
                $valid = FALSE;
                $err_comment = "Le champ de commentaire ne peut pas être vide";
            }

            if($valid) {
                $req = $dbcon->prepare("INSERT INTO commentaires (`commentaire`,`id_utilisateur`, `date`) VALUES (:comment, :sessionId, :date)");
                $req->execute([
                    "comment" => $comment,
                    "sessionId" => $sessionId,
                    "date" => $date]);


                header("Location: livre-or.php");
            }
        }
    }

    if($_SESSION != NULL) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '_include/head.php'; ?>
    <title>Commentaire</title>
</head>
<body class="bg-img">
    <header>
        <?php require_once '_include/header.php'; ?>
    </header>
    <main>
    <article class="form-flex">
            <h1 class="title main-index">Laissez un commentaire</h1>
            <form class="form" action="" method="POST">
                <label for="comment">Le commentaire c'est par ici &#8595;</label>
                
                <textarea rows="10" cols="100" class="comment"  name="comment"></textarea>
                <?php if(isset($err_comment)) {echo $err_comment;} ?>

                <input class="button" type="submit"  name="submit" value="Envoyer">
            </form>
        </article>
    </main>
    <footer>
    <?php require_once '_include/footer.php'; ?>
    </footer>
</body>
</html>

<?php } else {
            header("Location: index.php");
} 
?>