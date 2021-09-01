<?php 
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $nomf = isset($_POST['nomF'])?$_POST['nomF']:"";
    $niveau = isset($_POST['niveau'])?$_POST['niveau']:"";
    $section = isset($_POST['section'])?$_POST['section']:"";

    $requete = "insert into filiere(nomF, niveau, section) values(?,?,?)";
    $param = array($nomf, $niveau, $section);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($param);

    header('location: ../views/filiere.php');
?>