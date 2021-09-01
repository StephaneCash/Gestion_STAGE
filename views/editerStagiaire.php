
<?php 
    require_once("identifier.php");
    require_once('../bd/connexion.php');

    $idStagiaire = isset($_GET['idS'])?$_GET['idS']:0;
    $requeteS = "select * from stagiaire where idS=$idStagiaire";
    $resultatS = $pdo->query($requeteS);
    $stagiaire = $resultatS->fetch();
    
    $filiereL = "select section, niveau from filiere";
    $resulF =  $pdo->query($filiereL);
    $fil = $resulF->fetch();

    $nomS = $stagiaire['nomS'];
    $postnomS = $stagiaire['postnomS'];
    $prenomS = $stagiaire['prenomS'];
    $section = $fil['section'];
    $niveau = $fil['niveau'];
    $sexeS = $stagiaire['sexeS'];
    $photo = $stagiaire['fiche'];
    $idFiliere = $stagiaire['idF'];

    $requeteF = "select * from filiere";
    $resultatF = $pdo->query($requeteF);

    $requeteE = "select * from entreprise";
    $resultatE = $pdo->query($requeteE);
    
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editer inscrit</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
        <div class="container">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->   
            <div class="panel panel-primary" style="margin-top: 90px;"> 
                <div class="panel-heading"><h4>Edition stagiaire : </h4> </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/updateStagiaire.php" class="form" enctype="multipart/form-data"> 
                        
                    <!-- BLOC contenant id, nom et niveau de la filière-->
                        <div class="form-group"> 
                            <label for="idI">id : <?php echo $idStagiaire ?></label>
                            <input type="hidden" name="idS" class="form-control" id="idS" value = "<?php echo $idStagiaire ?>"/> 
                        </div>
                        
                        <!-- Partie NOM -->
                        <div class="form-group"> 
                            <label for="nomF">Nom : </label>
                            <input type="text" name="nomS" class="form-control" id="nomS" value = "<?php echo $nomS ?>"/> 
                        </div>

                        <!-- Partie POSTNOM -->
                        <div class="form-group"> 
                            <label for="nomF">Postnom : </label>
                            <input type="text" name="postnomS" class="form-control" id="postnomS" value = "<?php echo $postnomS ?>"/> 
                        </div>

                         <!-- Partie PRENOM -->
                         <div class="form-group"> 
                            <label for="nomF">Postnom : </label>
                            <input type="text" name="prenomS" class="form-control" id="prenomS" value = "<?php echo $prenomS ?>"/> 
                        </div>

                        <!-- Partie SEXE -->
                        <div class="form-group"> 
                            <label for="sexe ">Sexe : </label>
                            <div class="form-check">
                                <label class="form-check-label"><input type="radio" class="form-check-input" name="sexe" value = "F"
                                <?php if($sexeS === "F") echo "checked" ?>/> F </label>
                                <label class="form-check-label"><input type="radio" class="form-check-input" name="sexe" value = "M"
                                <?php if($sexeS === "M") echo "checked" ?>/> M </label>
                            </div>
                        </div>

                        <!-- Partie liste déroulante de niveaux de filières -->
                        <label for="filiere"> Filière : </label>
                        <div class="form-group"> 
                             <select name="filiere" class="form-control" id="filiere">
                                   <?php while($filiere = $resultatF->fetch()) { ?>
                                        <option value=" <?php echo $filiere['idF']; ?> "
                                            <?php if ($idFiliere === $filiere['idF'] ) echo "selected" ; ?>>
                                            <?php echo $filiere['nomF']; ?>
                                        </option>
                                   <?php } ?>                 
                             </select>      
                        </div>

                        <label for="filiere">Entreprise : </label>
                        <div class="form-group"> 
                             <select name="idE" class="form-control" id="idE">
                                   <?php while($entreprise = $resultatE->fetch()) { ?>
                                        <option value=" <?php echo $entreprise['idE']; ?> "
                                            <?php if ($entreprise === $filiere['idE'] ) echo "selected" ; ?>>
                                            <?php echo $entreprise['nomE']; ?>
                                        </option>
                                   <?php } ?>                 
                             </select>      
                        </div>
                        
                        <!-- Partie liste déroulante de niveaux de filières -->
                        <label for="niveau"> niveau : </label>
                        <div class="form-group"> 
                             <select name="niveau" class="form-control" id="niveau">
                                <option value="Licence" <?php if($niveau=="Licence") echo "selected" ?>>Licence</option>
                                <option value="Graduat" <?php if($niveau=="Graduat") echo "selected" ?>>Graduat</option>
                                <option value="LMD" <?php if($niveau=="LMD") echo "selected" ?>>LMD</option>
                            </select>      
                        </div>
                        
                        <!-- Partie liste déroulante de sections de filières -->
                        <label for="section"> Section : </label>
                        <div class="form-group"> 
                             <select name="section" class="form-control" id="section">
                             <option value="Informatique" <?php if($section=="Informatique") echo "selected" ?>>Informatique</option>
                                <option value="Electricité" <?php if($section=="Electricité") echo "selected" ?>>Electricité</option>
                                <option value="Mécanique" <?php if($section=="Mécanique") echo "selected" ?>>Mécanique</option>
                            </select>      
                        </div>
                        

                        <!-- Partie fiche -->
                        <div class="form-group"> 
                            <label for="fiche">Fiche : </label>
                            <input type="file" name="fiche" /> 
                        </div>

                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn-success"> 
                            <span class="glyphicon glyphicon-save"> </span> Enregistrer
                        </button>
                        
                    </form>
                    
                </div>            
            </div>
        </div>
        
    </body>
</html>


