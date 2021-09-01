

<?php 
    //  require_once("../views/identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    // Verification des données 

    $nomS = isset($_POST['nomS'])?$_POST['nomS']:"";
    $postnomS = isset($_POST['postnomS'])?$_POST['postnomS']:"";
    $prenomS = isset($_POST['prenomS'])?$_POST['prenomS']:"";
    $sexe = isset($_POST['sexeS'])?$_POST['sexeS']:"";
    $filiere = isset($_POST['filiere'])?$_POST['filiere']:"";
    $entreprise = isset($_POST['entreprise'])?$_POST['entreprise']:"";

    $fiche = isset($_FILES['fiche']['name'])?$_FILES['fiche']['name']:"";
    $imageTem = $_FILES['fiche']['tmp_name'];
    move_uploaded_file($imageTem,"../Images/".$fiche); 

    $requeteS = "insert into resultat(nom, postnom,prenom, sexe,filiere, entreprise, result) values(?,?,?,?,?,?,?)";

    $param = array($nomS, $postnomS, $prenomS,$sexe, $filiere, $entreprise, $fiche);
    $resultat = $pdo->prepare($requeteS);
    $resultat->execute($param);

    header('location: ../views/stagiairesRecommandes.php');

?>