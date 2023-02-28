<?php
    class User {
        private $connect;
        private $id = NULL;
        public $login = NULL;
        public $password = NULL;
        public $err_login;
        public $err_password;

        public function __construct($id, $login, $password) {
            $this->connect = new PDO('mysql:host=localhost;dbname=livreorjs', 'root', '');

            $this->id = $id;
            $this->login = $login;
            $this->password = $password;
        }

        public function checkpassword ($password) {
            $regex = "^\S*(?=\S{5,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^";
            $valid = FALSE;

            if(preg_match($regex, $password)) { 
                $valid = TRUE; 
            }
            return $valid;
        }

        public function register($login, $password) {
            $valid = TRUE;

            if(empty($login)){
                $valid = FALSE;
                $this->err_login = "Le login ne peut pas être vide";
            }
            else if(grapheme_strlen($login) < 5) { 
                $valid = FALSE; 
                $this->err_login = "Le login ne doit pas contenir moins de 5 caractéres";
            }
            else if(grapheme_strlen($login) > 25) { 
                $valid = FALSE;
                $this->err_login = "Le login ne doit pas contenir plus de 25 caractéres";
            }
            else {
                $user = $this->connect->prepare("SELECT login FROM utilisateurs WHERE login = ?"); 
                $user->execute([$login]);
                $verif = $user->rowCount(); 

                
                if($verif > 0) { 
                    $valid = FALSE;
                    $this->err_login = "Le login est déja pris";
                }
            }

            
            if($valid) { 
                $req = $this->connect->prepare ("INSERT INTO `utilisateurs` (`login`, `password`) VALUES (?, ?)");
                $req->execute(array($login, $password));
                header("location: connexion.php");

            }
        }

        public function connect($login, $password) {
            $user = $this->connect->prepare("SELECT * FROM utilisateurs WHERE login = ?"); 
            $user->execute([$login]);
            $verif = $user->rowCount(); 


            if($verif == 1) {
                $info = $user->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password, $info['password'])) {


                    $_SESSION['id'] = $info['id'];
                    $_SESSION['login'] = $info['login'];
                    $_SESSION['password'] = $info['password'];


                }else {
                    $this->err_password = "L'identifiant ou le mot de passe est incorrect";
                }
            }else {
                $this->err_password = "L'identifiant ou le mot de passe est incorrect";
            }

        }

        public function update($login, $password, $confpassword, $oldpassword) {
            $valid = TRUE;
            
            $sessionLogin = $_SESSION['login'];

            if(password_verify($oldpassword, $_SESSION['password'])) {

                if($login != $_SESSION['login']) {
                    $user = $this->connect->prepare("SELECT * FROM utilisateurs WHERE login = ?"); 
                    $user->execute([$login]);
                    $verif = $user->rowCount(); 

                    if($verif > 0) {
                        $valid = FALSE;
                        $this->err_login = "Ce login est déja pris";
                    }

                }else if($login === $_SESSION['login']) {
                    $valid = FALSE;
                    $err_login = "Le login $login est déja pris.";
                }else if(grapheme_strlen($login) < 5) { 
                    $valid = FALSE;
                    $err_login = "Le login doit contenir au minimum 5 caractéres.";
                }
                else if(grapheme_strlen($login) > 25) { 
                    $valid = FALSE; 
                    $err_login = "Le login doit contenir maximum 25 caractéres."; 
                }


                if($password != $confpassword) {
                    $valid = FALSE;
                    $this->err_password = "La confirmation du mot de passe n'est pas bonne";
                    
                }else if($this->checkpassword($password)) {
                    $crypt_password = password_hash($password, PASSWORD_DEFAULT);
                }else {
                    $valid = FALSE;
                    $this->err_password = "Le mot de passe doit contenir cinq carcatéres minimum avec au moins une majuscule, une minuscule, un chiffre et un caractére spéciale";
                }

                if($valid) {
                    $req = $this->connect->prepare("UPDATE utilisateurs SET login = ?, password = ? WHERE login = ?");
                    $change = $req->execute(array($login, $crypt_password, $sessionLogin));

                    $this->disconnect();
                }
                

            }else {
                $valid = FALSE;
                $this->err_password = "L'ancien mot de passe n'est pas correct";
            }

            
        }

        public static function disconnect(){
            session_unset();
            session_destroy();
            header("location: index.php");
        }

        public function getErrorLogin() {
            return $this->err_login;
        }
        
        public function getErrorPassword() {
            return $this->err_password;
        }
    }
    //$user = new User($id = NULL, $login = NULL, $password = NULL);
?>