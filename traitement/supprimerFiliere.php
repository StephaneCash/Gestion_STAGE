<?php 
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idf = isset($_GET['idF'])?$_GET['idF']:0;

    $requeteIns = "select count(*) countInscrit from stagiaire where idF = $idf";
    $resultatIns = $pdo->query($requeteIns);
    $tabCountIns = $resultatIns->fetch();
    $nbrInscr = $tabCountIns['CountInscrit'];
    
    if ($nbrInsr == 0){
        $requete = "delete from filiere where idF=?";
        $param = array($idf);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($param);
        header('location: ../views/filiere.php');
    }else{
        $msg = "Suppression impossible...";
        header('location: alerte.php?message = $msg');
    }
?>