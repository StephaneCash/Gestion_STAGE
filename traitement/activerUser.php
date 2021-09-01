
<?php 
 session_start();
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idU = isset($_GET['idU'])?$_GET['idU']:0;
    $etat = isset($_GET['etat'])?$_GET['etat']:0;
    
    if($etat == 1)
        $newEtat = 0;
    else
        $newEtat = 1;

    $requete = "update utilisateur set etat=? where idU=?";
    $param = array($newEtat, $idU);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($param);

    header('location: ../views/users.php');
?>