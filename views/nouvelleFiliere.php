
<?php require_once('identifier.php'); ?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
        <div class="container">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-primary" style="margin-top: 100px; border : 1px solid #32475c"> 
                <div class="panel-heading" style="background:#32475c"> Saisir les données pour la nouvelle filière : </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/insertFiliere.php" class="form"> 
                        <div class="form-group"> 
                            <label for="nomF">Nom de la filière</label>
                            <input type="text" name="nomF" placeholder="Taper le nom de la filière" class="form-control" id="nomF"  required/> 
                        </div>
                        
                        <!-- Partie liste déroulante de niveaux de filières -->
                        <label for="niveau"> Niveau : </label>
                        <div class="form-group"> 
                            <select name="niveau" class="form-control" id="niveau">
                                <option value="all">Tous les niveaux</option>
                                <option value="Licence">Licence</option>
                                <option value="Graduat">Graduat</option>
                                <option value="LMD" selected>LMD</option>
                            </select>
                        </div>
                        
                        <label for="niveau"> Section : </label>
                        <div class="form-group"> 
                            <select name="section" class="form-control" id="niveau">
                                <option value="Informatique">Informatique</option>
                                <option value="Electricité">Electricité</option>
                                <option value="Mécanique" selected>Mécanique</option>
                            </select>
                        </div>
                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn" style="background : #32475c; margin-left:0px; color : white"> 
                            <span class="glyphicon glyphicon-save"> </span> Enregistrer
                         </button>
                    </form>
                </div>            
            </div>
        </div>
        
    </body>
</html>


