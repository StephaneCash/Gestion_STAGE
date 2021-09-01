
<?php 
    require_once("identifier.php");
    require_once('../bd/connexion.php');

    $idf = isset($_GET['idF'])?$_GET['idF']:0;
    $requete = "select * from filiere where idF=$idf";
    $resultat = $pdo->query($requete);
    $filiere = $resultat->fetch();
    $nomf = $filiere['nomF'];
    $niveau = $filiere['niveau'];
    $section =$filiere['section'];
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editer filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
        <div class="container">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-primary" style="margin-top: 80px;"> 
                <div class="panel-heading">Edition de la nouvelle filière : </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/updateFiliere.php" class="form"> 
                        
                    <!-- BLOC contenant id, nom et niveau de la filière-->
                        <div class="form-group"> 
                            <label for="idF">id de la filière : <?php echo $idf ?></label>
                            <input type="hidden" name="idF" placeholder="Taper le nom de la filière" 
                                   class="form-control" id="idF" value = "<?php echo $idf ?>"/> 
                        </div>
                        
                        <div class="form-group"> 
                            <label for="nomF">Nom de la filière</label>
                            <input type="text" name="nomF" placeholder="Taper le nom de la filière" 
                                   class="form-control" id="nomF" value = "<?php echo $nomf ?>"/> 
                        </div>
                        
                        <!-- Partie liste déroulante de niveaux de filières -->
                        <label for="niveau"> Niveau : </label>
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


