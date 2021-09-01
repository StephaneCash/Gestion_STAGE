

<?php 
      require_once("identifier.php");
      require_once("../bd/connexion.php"); // Connexion à la BD

      $requeteS = "select * from stagiaire";
      $resultatS = $pdo->query($requeteS);
      $stagiaire = $resultatS->fetch();
      
      $requeteE = "select * from entreprise";
      $resultatE=$pdo->query($requeteE);
        
      $requeteF = "select * from filiere";
      $resultatF = $pdo->query($requeteF);

      $filiere = $resultatF->fetch();
      $idFiliere = $filiere['idF'];

      $entreprise = $resultatE->fetch();
      $idEntreprise = $entreprise['idE'];

      $sexe = $stagiaire['sexeS'];
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouveau Stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
        <div class="container">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-primary" style="margin-top: 100px;"> 
                <div class="panel-heading" style=" color : #f6f6f6; background : #32475c"><h4> Saisir les données du nouveau Stagiaire :</h4> </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/insertNouveauResultat.php" class="form" enctype="multipart/form-data">  
                        <div class="form-group"> 
                            <label for="nomS">Nom : </label>
                            <input type="text" name="nomS" placeholder="Taper le nom" class="form-control" id="nomS"  required />
                            
                            <label for="Postnom">Postnom : </label>
                            <input type="text" name="postnomS" placeholder="Taper le postnom" class="form-control" id="Postnom" required /> 
                            
                            <label for="Prenom">Prénom : </label>
                            <input type="text" name="prenomS" placeholder="Taper le prénom" class="form-control" id="Prenom" required /> 
                        
                            <div class="form-group"> 
                            <label for="sexe">Sexe : </label>
                            <div class="form-check">
                                <label class="form-check-label"><input type="radio" class="form-check-input" name="sexeS" value = "F"
                                <?php if($sexe === "F") echo "checked" ?>/> F </label>
                                <label class="form-check-label"><input type="radio" class="form-check-input" name="sexeS" value = "M"
                                <?php if($sexe === "M") echo "checked" ?>/> M </label>
                            </div>
                        </div>
                        
                        <label for="entreprise"> Entreprise : </label>
                        <div class="form-group"> 
                             <input type="text" name="entreprise" placeholder="Taper le nom de l'entreprise" class="form-control"/>     
                        </div>
                        
                        <label for="section"> Filiere : </label>
                        <div class="form-group"> 
                            <input type="text" name="filiere" placeholder="Taper le nom de la filière" class="form-control" />
                        </div>
                        
                        <!-- Insérer le fichier de cotes -->
                        <div class="form-group">Insérer le fichier de cotes : <br><br>
                            <input type="file" name="fiche" value="fiche">
                        </div>

                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn" style="background : #32475c; margin-left:0px; color:white;"> 
                            <span class="glyphicon glyphicon-save"> </span> Enregistrer
                         </button>
                    </form>
                </div>            
            </div>
        </div>
        
    </body>
</html>


