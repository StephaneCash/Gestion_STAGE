<?php 
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idE = isset($_POST['idE'])?$_POST['idE']:0;
    $nomE = isset($_POST['nomE'])?$_POST['nomE']:"";
    $adresseE = isset($_POST['adresse'])?$_POST['adresse']:"";
    $type = isset($_POST['type'])?$_POST['type']:"";
    $ville = isset($_POST['ville'])?$_POST['ville']:"";

    $requete = "update entreprise set nomE=?, adresseE=?, typeE=?, ville=? where idE=?";
    $param = array($nomE, $adresseE, $type, $ville, $idE);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($param);

    header('location: ../views/entreprise.php');
?>