
<?php 
 session_start();
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idS = isset($_GET['idS'])?$_GET['idS']:0;
    $status = isset($_GET['status'])?$_GET['status']:0;

    echo "Id : " . $idS . " le status : " .$status ; 
    
    if($status == 2)
        $newEtat = 2;
    else
        $newEtat = 1;

    $requete = "update stagiaire set status=? where idS=?";
    $param = array($newEtat, $idS);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($param);

    header('location: ../views/stagiairesRecommandes.php');

    
?>