

<?php 
    require_once("identifier.php");
    require_once('../bd/connexion.php');

    $idE = isset($_GET['idE'])?$_GET['idE']:0;
    $requete = "select * from entreprise where idE=$idE";
    $resultat = $pdo->query($requete);
    $entreprise = $resultat->fetch();
    $nomE = $entreprise['nomE'];
    $adresse = $entreprise['adresseE'];
    $type =$entreprise['typeE'];
    $ville =$entreprise['ville'];
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
            <div class="panel panel-primary" style="margin-top: 80px; border: 1px solid #32475c"> 
                <div class="panel-heading" style="background : #32475c; ">Edition de la nouvelle entreprise : </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/updateEntreprise.php" class="form"> 
                        
                    <!-- BLOC contenant id, nom et niveau de la filière-->
                        <div class="form-group"> 
                            <label for="idF">id de l'entreprise : <?php echo $idE ?></label>
                            <input type="hidden" name="idE" placeholder="Taper le nom de la filière" 
                                   class="form-control" id="idF" value = "<?php echo $idE ?>"/> 
                        </div>

                        <div class="form-group"> 
                            <label for="nomE">Nom de l'entreprise'</label>
                            <input type="text" name="nomE" placeholder="Taper le nom de la filière" 
                                   class="form-control" id="nomF" value = "<?php echo $nomE ?>"/> 
                        </div>
                        
                        <div class="form-group"> 
                            <label for="adresse">Adresse de l'entreprise</label>
                            <input type="text" name="adresse" placeholder="Taper le nom de la filière" 
                                   class="form-control" id="adresse" value = "<?php echo $adresse ?>"/> 
                        </div>

                        <div class="form-group"> 
                            <label for="type">Type de l'entreprise</label>
                            <input type="text" name="type" placeholder="Taper le nom de la filière" 
                                   class="form-control" id="type" value = "<?php echo $type ?>"/> 
                        </div>

                        <div class="form-group"> 
                            <label for="ville">Ville de l'entreprise</label>
                            <input type="text" name="ville" placeholder="Taper le nom de la filière" 
                                   class="form-control" id="ville" value = "<?php echo $ville ?>"/> 
                        </div>
 
                        
                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn" style="background : #32475c; color:white"> 
                            <span class="glyphicon glyphicon-save"> </span> Enregistrer
                        </button>
                        
                    </form>
                    
                </div>            
            </div>
        </div>
        
    </body>
</html>


