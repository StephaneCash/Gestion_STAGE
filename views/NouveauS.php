

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

    <style>

    
        .nom, .postnom{
          width: 20% !important;
          display: inline-block;
          vertical-align: top;
          padding: 10px;
          border-radius: 5px;
          border: 1px solid silver;
          margin-right: 10px;
        }
        label{
          color: gray;  
        }

        .form-control{
          width: 20% !important;
        }

        .prenom, .filiere{
          border: 1px solid red;
          display: inline-block;
          width: 12px;
        }
  

    </style>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
        <div class="container">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-primary" style="margin-top: 100px;"> 
                <div class="panel-heading" style=" color : #f6f6f6; background : #32475c"><h4> <i class="glyphicon glyphicon-user"></i> Saisir les données du nouveau Stagiaire :</h4> </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/insertNouveauStagiaire.php" class="form" enctype="multipart/form-data">  
                        <div class="form-group "> 
                            <label for="nomS">Nom : </label> <label for="Postnom">Postnom : </label> <label for="Postnom">Prénom : </label><label for="filiere"> Filiere : </label>  <br>
                            <input type="text" name="nomS" placeholder="Taper le nom" class="nom" id="nomS"  required />
                            
                            
                            <input type="text" name="postnomS" placeholder="Taper le postnom" class="postnom" id="Postnom" required /> 
                            
                            
                            <input type="text" name="prenomS" placeholder="Taper le prénom" class="prenom" id="Prenom" required /> 


                            <div class="form-group"> 
                                 <select name="idF" class="filiere" id="filiere">
                                       <?php while($filiere = $resultatF->fetch()) { ?>
                                            <option value=" <?php echo $filiere['idF']; ?> "
                                                <?php if ($idFiliere === $filiere['idF'] ) echo "selected" ; ?>>
                                                <?php echo $filiere['nomF']; ?>
                                            </option>
                                       <?php } ?>                 
                                 </select>      
                            </div>
                        
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
                             <select name="idE" class="form-control" id="entreprise">
                                   <?php while($entreprise = $resultatE->fetch()){ ?>
                                            <option value=" <?php echo $entreprise['idE']; ?> "
                                                <?php if ($idEntreprise === $entreprise['idE'] ) echo "selected" ; ?>>
                                                <?php echo $entreprise['nomE']; ?>
                                            </option>
                                        
                                    <?php } ?>
                                   ?>                
                             </select>      
                        </div>
                        </div>

                        
                        <!-- Partie liste déroulante de niveaux de filières -->
                        <label for="niveau"> Niveau : </label>
                        <div class="form-group"> 
                            <select name="niveau" class="form-control" id="niveau">
                                <option value="Licence">Licence</option>
                                <option value="Graduat">Graduat</option>
                                <option value="LMD" selected>LMD</option>
                            </select>
                        </div>
                        
                        <label for="section"> Section : </label>
                        <div class="form-group"> 
                            <select name="section" class="form-control" id="section">
                                <option value="Informatique">Informatique</option>
                                <option value="Electricité">Electricité</option>
                                <option value="Mécanique" selected>Mécanique</option>
                            </select>
                        </div>
                        
                        <!-- Insérer le fichier de cotes -->
                        <div class="form-group">Insérer le fichier de cotes : <br><br>
                            <input type="file" name="fiche" value="fiche">
                        </div>

                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn" style="background : #32475c; margin-left:0px; color:white"> 
                            <span class="glyphicon glyphicon-save"> </span> Enregistrer
                         </button>
                    </form>
                </div>            
            </div>
        </div>
        
    </body>
</html>


