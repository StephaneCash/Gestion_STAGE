
<?php 
    session_start();

    require_once('../bd/connexion.php');

    $login = isset($_POST['username'])?$_POST['username']:"";
    $pwd = isset($_POST['pwd'])?$_POST['pwd']:"";

    $requeteU = "select * from utilisateur where username='$login' and password='$pwd' ";
    $resultatU = $pdo->query($requeteU);

    if($user=$resultatU->fetch()){
        if($user['etat']==1){
            $_SESSION['user']=$user;
            if($_SESSION['user']['role']=='ADMIN'){
                header('location:../views/stage.php');
            }
            if($_SESSION['user']['role']=='visiteur'){
                header('location:../views/stage.php');
            }
            if($_SESSION['user']['role']=='entreprise'){
                header('location:../views/stagiairesRecommandes.php');
            }
            
        }else{
            $_SESSION['Erreurlogin']=" <strong> Erreur !! </strong> Votre compte est désactivé. <br> Veuiller contacter l'Admin";
            header('location: ../views/login.php');
        }
    }else{
        $_SESSION['Erreurlogin']=" <strong> Erreur !! </strong> Nom d'utilisateur ou mot de passe incorrect.";
        header('location: ../views/login.php');
    }
    
?>