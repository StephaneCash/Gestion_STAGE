
<?php require_once('identifier.php'); ?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle Entreprise</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
        <div class="container">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-primary" style="margin-top: 80px; border: 1px solid #32475c "> 
                <div class="panel-heading" style="background:#32475c; "> Saisir les données pour la nouvelle entreprise : </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/insertEntreprise.php" class="form"> 

                        <div class="form-group"> 
                            <label for="nomE">Nom de l'entreprise : </label>
                            <input type="text" name="nomE" placeholder="Taper le nom de l'entreprise" class="form-control" id="nomE" /> 
                        </div>
                        <div class="form-group"> 
                            <label for="adresse">Adresse de l'entreprise</label>
                            <input type="text" name="adresse" placeholder="Taper l'adresse de l'entreprise" class="form-control" id="adresse" /> 
                        </div>
                        
                        <!-- Partie liste déroulante de niveaux de filières -->
                       <div class="form-group"> 
                            <label for="type">Type : </label>
                            <input type="text" name="type" placeholder="Taper le type de l'entreprise" class="form-control" id="type" /> 
                        </div>
                       
                        <div class="form-group"> 
                            <label for="ville">Nom de la Ville : </label>
                            <input type="text" name="ville" placeholder="Taper le nom de la ville" class="form-control" id="ville" /> 
                        </div>

                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn" style="background:#32475c; color:white; margin-left:0px"> 
                            <span class="glyphicon glyphicon-save"> </span> Enregistrer
                         </button>
                    </form>
                </div>            
            </div>
        </div>
        
    </body>
</html>


