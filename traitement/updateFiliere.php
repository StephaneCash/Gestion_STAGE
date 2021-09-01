<?php 
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idf = isset($_POST['idF'])?$_POST['idF']:0;
    $nomf = isset($_POST['nomF'])?$_POST['nomF']:"";
    $niveau = isset($_POST['niveau'])?$_POST['niveau']:"";
    $section = isset($_POST['section'])?$_POST['section']:"";

    $requete = "update filiere set nomF=?, niveau=?, section=? where idF=?";
    $param = array($nomf, $niveau, $section, $idf);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($param);

    header('location: ../views/filiere.php');
?>