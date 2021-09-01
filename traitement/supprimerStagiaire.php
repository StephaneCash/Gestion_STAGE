<?php 
   // require_once("identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idS = isset($_GET['idS'])?$_GET['idS']:0;

    $requete = "delete from stagiaire where idS=?";
    $param = array($idS);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($param);

    header('location: ../views/stage.php');
?>