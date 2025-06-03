<?php 
    
    include_once '../../Migration/database.php';
    include_once '../../View/visiteur/include/composant.php';
   
    class Utilisateur{
        public $id;
        public $nom;
        public $prenom;
        public $mail;
        public $password;
        public $role;

        public function __construct($nom, $prenom, $mail, $password, $role = 'user') {
            $this->nom = htmlspecialchars(trim($nom));
            $this->prenom = htmlspecialchars(trim($prenom));
            $this->mail = htmlspecialchars(trim($mail));
            $this->password = password_hash(htmlspecialchars(trim($password)), PASSWORD_DEFAULT);
            $this->role = htmlspecialchars(trim($role));
        }

         public function ajouter(){
            if(isset($_POST['inscription'])){
                $this->nom = $_POST['nom'];
                $this->prenom = $_POST['prenom'];
                $this->mail = $_POST['mail'];
                $this->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $this->role = 'user';

                // verififions que l utilisateur n'existe pas deja
                $pdo = Database::getInstance();
                $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
                $stmt->bindParam(':mail', $this->mail);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                if($user) {
                    $message = "L'utilisateur avec l'email ( ".$user->mail." )  existe déjà.";
                    return alert($message,'danger'); // User already exists
                }

                // verification du nombre d'utilisateurs
                $stmt = $pdo->prepare("SELECT * FROM utilisateurs");
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(count($users) > 20) {
                    $message = "La limite d'utilisateur a été atteinte, revenez plus tard.";
                    header("Location:../../View/visiteur/index.php");
                    session_start();
                    $_SESSION['message'] = $message;
                    return $_SESSION['message']; // Limit reached
                    exit();
                }
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
                    $message = "Inscription réussie.";
                    header("Location:../../View/visiteur/connexion.php"); 
                    session_start();
                    $_SESSION['message'] = $message;
                     return $_SESSION['message']; // User added successfully
                    exit();
                } else {
                    $message = "Quelque chose a mal tourné. Inscription échouée. Veuillez réessayer.";
                    header("Location:../../View/visiteur/inscription.php");
                    session_start(); 
                    $_SESSION['message'] = $message;
                    return $_SESSION['message']; // Validation failed
                }
            }
          
        }



    }

  

?>