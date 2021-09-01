<?php 
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idE = isset($_GET['idE'])?$_GET['idE']:0;

    $requeteIns = "select count(*) countInscrit from stagiaire where idF = $idE";
    $resultatIns = $pdo->query($requeteIns);
    $tabCountIns = $resultatIns->fetch();
    $nbrInscr = $tabCountIns['CountInscrit'];
    
    if ($nbrInsr == 0){
        $requete = "delete from entreprise where idE=?";
        $param = array($idE);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($param);
        header('location: ../views/entreprise.php');
    }else{
        $msg = "Suppression impossible...";
        header('location: alerte.php?message = $msg');
    }
?>