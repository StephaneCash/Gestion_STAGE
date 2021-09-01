<?php 
    require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $nomE = isset($_POST['nomE'])?$_POST['nomE']:"";
    $adresse =isset($_POST['adresse'])?$_POST['adresse']:"";
    $type =isset($_POST['type'])?$_POST['type']:"";
    $ville =isset($_POST['ville'])?$_POST['ville']:"";

    $requete = "insert into entreprise(nomE, adresseE, typeE, ville) values(?,?,?,?)";
    $param = array($nomE, $adresse, $type, $ville);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($param);

    header('location: ../views/entreprise.php');
    
?>

