<?php 
    // chemin vers le fichier database.php
    require_once __DIR__ . '../../../config.php'; 
    require_once BASE_PATH . '/Migration/database.php';
    require_once BASE_PATH . '/View/visiteur/include/composant.php';    


   
    class Utilisateur{
        public $id;
        public $nom;
        public $prenom;
        public $mail;
        public $password;
        public $role;

        public function __construct($nom = '', $prenom = '', $mail = '', $password = '', $role = 'user') {
            $this->nom = htmlspecialchars(trim($nom));
            $this->prenom = htmlspecialchars(trim($prenom));
            $this->mail = htmlspecialchars(trim($mail));
            $this->password = htmlspecialchars(trim($password));
            $this->role = htmlspecialchars(trim($role));
        }
// fonction pour l inscrption de l utilisateur
         public function ajouter(){
            if(isset($_POST['inscription'])){
                $this->nom = $_POST['nom'];
                $this->prenom = $_POST['prenom'];
                $this->mail = $_POST['mail'];
                $this->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $this->role = isset($_POST['role'])  ? $_POST['role'] : 'user';

                // verififions que l utilisateur n'existe pas deja
                $pdo = Database::getInstance();
                $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
                $stmt->bindParam(':mail', $this->mail);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                if($user) {
                    $message = "L'utilisateur avec l'email ( ".$user->mail." )  existe déjà.";
                     if($this->role = 1 || $this->role = 2 ){
                         header("Location:../../View/admin/utilisateur/ajouter.php"); 
                         session_start();
                         $_SESSION['message'] = $message;
                         return $_SESSION['message'];   
                    }else{
                        header("Location:../../View/visiteur/inscription.php"); 
                         session_start();
                         $_SESSION['message'] = $message;
                         return $_SESSION['message'];   
                    }
                   
                }

                // verification du nombre d'utilisateurs
                $stmt = $pdo->prepare("SELECT * FROM utilisateurs");
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(count($users) > 20) {
                    if($this->role == 1 || $this->role == 2 ){
                         $message = "La limite d'utilisateur a été atteinte  (".count($users).")  veuillez augmenter la limite du nombre d utilisateurs.";
                         header("Location:../../View/admin/utilisateur/ajouter.php"); 
                         session_start();
                         $_SESSION['message'] = $message;
                         return $_SESSION['message'];   
                    }else{
                         $message = "La limite d'utilisateur a été atteinte, revenez plus tard.";
                        header("Location:../../View/visiteur/index.php");
                        session_start();
                        $_SESSION['message'] = $message;
                        return $_SESSION['message']; // Limit reached
                        exit();
                    }
                   
                }
                // validation des champs
                else if(!empty($this->nom) && strlen($this->nom) >= 3 && 
                   !empty($this->prenom) && strlen($this->prenom) >= 3 && 
                   !empty($this->mail) && filter_var($this->mail, FILTER_VALIDATE_EMAIL) && 
                   !empty($this->password) && strlen($this->password) >= 6) {
                    $pdo = Database::getInstance();
                    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, mail, password, role) VALUES (:nom, :prenom, :mail, :password, :role)");
                    $stmt->bindParam(':nom', $this->nom);
                    $stmt->bindParam(':prenom', $this->prenom);
                    $stmt->bindParam(':mail', $this->mail);
                    $stmt->bindParam(':password', $this->password);
                    $stmt->bindParam(':role', $this->role);
                    $stmt->execute();
                    if($this->role == 1 || $this->role == 2 ){
                        $message = "Utilisateur ajoute avec success" ;
                        header("Location:../../View/admin/utilisateur/afficher.php");
                        session_start();
                        $_SESSION['message'] = $message ;
                        return $_SESSION['message'];
                    }
                    $message = "Inscription réussie.";
                    header("Location:../../View/visiteur/connexion.php"); 
                    session_start();
                    $_SESSION['message'] = $message;
                     return $_SESSION['message']; // User added successfully
                    exit();
                } else {
                    $message = "Quelque chose a mal tourné. Inscription échouée. Veuillez réessayer.";
                     if($this->role = 1 || $this->role = 2 ){
                        header("Location:../../View/admin/utilisateur/ajouter.php");
                        session_start(); 
                        $_SESSION['message'] = $message;
                        return $_SESSION['message']; // Validation failed
                    }
                    
                }
            }
          
        }

        // fonction pour connecter l'utilisateur

        public function connecter() {
            if(isset($_POST['connexion'])) {
                $this->mail = trim(htmlspecialchars($_POST['mail']));
                $this->password = trim(htmlspecialchars($_POST['password']));
                $se_souvenir = isset($_POST['se_souvenir']) ? $_POST['se_souvenir'] : '';

                // validation des champs
                if(!empty($this->mail) && filter_var($this->mail, FILTER_VALIDATE_EMAIL) && 
                   !empty($this->password) && strlen($this->password) >= 6) {
                    $pdo = Database::getInstance();
                    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
                    $stmt->bindParam(':mail', $this->mail);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_OBJ);

                    if($user && password_verify($this->password, $user->password)) {
                        // Si l'utilisateur a coché "Se souvenir de moi", on crée un cookie
                        session_start();
                         $_SESSION['username'] = $user->nom;
                         // var_dump($_SESSION);die();
                        if($se_souvenir == 1 ){
                            // On crée un cookie pour se souvenir de l'utilisateur pour un mois
                            setcookie("utilisateur", $user->mail, time() + 111600, "/");
                            setcookie("password_utilisateur",$this->password, time() + 111600, "/") ;
                        }
                        $message = "Bienvenue  ".$user->nom;
                        $_SESSION['message'] = $message;
                        header("Location:../../View/admin/index.php");
                        exit();
                        return $_SESSION['message']; 
                    } else {
                        $message = "Identifiants incorrects. Veuillez réessayer.";
                        header("Location:../../View/visiteur/connexion.php");
                        session_start();
                        $_SESSION['message'] = $message;
                        return $_SESSION['message']; 
                    }
                } else {
                    $message = "Veuillez remplir tous les champs correctement.";
                    header("Location:../../View/visiteur/connexion.php");
                    session_start();
                    $_SESSION['message'] = $message;
                    return $_SESSION['message']; // Validation failed
                }
            }
        }

        // fonction pour deconnecter l'utilisateur
        public function deconnecter() {
            session_start();
            session_unset();
            session_destroy();
            setcookie("utilisateur", "", time() - 111600, "/");
            setcookie("password_utilisateur", "", time() - 111600, "/");
            header("Location:../../View/visiteur/connexion.php");
            exit();
        }

        // fonction pour afficher les utilisateurs
        public static function afficherUtilisateurs() {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs");
            $stmt->execute();
            $utilisateurs = $stmt->fetchAll(PDO::FETCH_OBJ);
            // comptons le nombre de contributeurs
            $pdo2 = Database::getInstance();
            $stmt2 = $pdo->prepare("SELECT COUNT(*) as count FROM utilisateurs WHERE role = 'user'");
            $stmt2->execute();
            $contributeurs = $stmt2->fetch(PDO::FETCH_OBJ);
            return [
                 'contributeurs' => $contributeurs,
                 'utilisateurs' => $utilisateurs
            ];
        }

        // fonction pour afficher un utilisateur par son id
        public static function afficherUtilisateurParId($id) {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $utilisateur = $stmt->fetch(PDO::FETCH_OBJ);
            return $utilisateur;
        }

        // fonction pour modifier un utilisateur
        public function modifier($id) {
           
            $this->nom = htmlspecialchars(trim($_POST['nom']));
            $this->prenom = htmlspecialchars(trim($_POST['prenom']));
            $this->mail = htmlspecialchars(trim($_POST['mail']));
            $this->password = htmlspecialchars(trim($_POST['password']));
            $this->role = htmlspecialchars(trim($_POST['role']));
            
            if(empty($this->nom) || empty($this->prenom) || empty($this->mail) || empty($this->password)) {
                $message = "Veuillez remplir tous les champs.";
                header("Location:../../View/admin/utilisateur/modifier.php?modifier=$id"); 
                session_start();
                $_SESSION['message'] = $message;
                return $_SESSION['message'];
            }

            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, mail = :mail, role = :role, password = :password WHERE id = :id");
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':prenom', $this->prenom);
            $stmt->bindParam(':mail', $this->mail);
            $stmt->bindParam(':role', $this->role);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $message = "Utilisateur modifié avec succès.";
            if($this->role == 1 || $this->role == 2 ){
                session_start();
                $_SESSION['message'] = $message;
                header("Location:../../View/admin/utilisateur/afficher.php"); 
                return $_SESSION['message'];
            }

        }

        // fonction pour supprimer un utilisateur
        public static function supprimer($id) {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $message = "Utilisateur supprimé avec succès.";
            session_start();
            $_SESSION['message'] = $message;
            header("Location:../../View/admin/utilisateur/afficher.php");
            exit();
            return $_SESSION['message']; 
        }
        


    }


?>