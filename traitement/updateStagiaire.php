<?php
    
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $idS = isset($_POST['idS'])?$_POST['idS']:0;
    $nomS = isset($_POST['nomS'])?$_POST['nomS']:"";
    $postnomS = isset($_POST['postnomS'])?$_POST['postnomS']:"";
    $prenomS = isset($_POST['prenomS'])?$_POST['prenomS']:"";
    $niveau = isset($_POST['niveau'])?$_POST['niveau']:"";
    $section = isset($_POST['section'])?$_POST['section']:"";
    $sexeS = isset($_POST['sexe'])?$_POST['sexe']:"";
    $idE = $_POST['idE'];
    $filiere = isset($_POST['filiere'])?$_POST['filiere']:1;

 
        $niv = "update filiere set niveau=?, section=? where idF=?";
        $co = array($niveau, $section, $filiere);
        $rep = $pdo->prepare($niv);
        $rep->execute($co);
    
    
        $requete = "update stagiaire set nomS=?, postnomS=?, prenomS=?, sexeS=?, idF=?, idE=? where idS=?";
        $param = array($nomS, $postnomS, $prenomS,$sexeS,$filiere,$idE, $idS);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($param);
     
        header('location: ../views/stage.php'); 
        //echo $idE    
      
?>