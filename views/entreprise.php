
<?php 
    require_once("identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    $nomE=isset($_GET['nomE'])?$_GET['nomE']:"";

    $size=isset($_GET['size'])?$_GET['size']:9;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
   
    // Vérification sur le choix de niveau de filière
    if($nomE==$nomE){
        $requete="select * from entreprise where nomE like '%$nomE%' order by idE limit $size offset $offset";
        $requeteCount="select count(*) countE from entreprise where nomE like '%$nomE%'";
    }
                  
    $resultatF=$pdo->query($requete); // Exécution de la requete

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrFiliere=$tabCount['countE'];
    $reste=$nbrFiliere % $size;
    
    if( $reste == 0)
        $nbrPage = $nbrFiliere/$size;
    else
        $nbrPage=floor($nbrFiliere/$size)+1;
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion Entreprise</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Entreprise.css">
    </head>

    <body>
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
        
        <div class="container-fluid">
            <div class="row">
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-success" style="margin-top: 67px;"> 
                <div class="panel-heading">  Recherche d'entreprise... </div>
                <div class="panel-body">
                                <!-- partie corps coté champ text (Taper le nom de la filière) -->
                     <form method="get" action="entreprise.php" class="form-inline"> 
                        <div class="form-group"> 
                            <input type="search" name="nomE" placeholder="Taper le nom de l'entreprise" class="form-control" 
                                   value="<?php echo $nomE; ?>" style="width:110%"> 
                        </div>
                        
                         <!-- Bouton de recherche -->&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn"  style="background: #32475c; color:white"> 
                            <span class="glyphicon glyphicon-search"> </span>&nbsp;&nbsp; Rechercher... 
                         </button> &nbsp; &nbsp;
                         
                         <!-- Partie pour ajout d'une nouvelle filière -->
                         <a href="nouvelleEntreprise.php">
                             <span class="glyphicon glyphicon-plus"> </span>Nouvelle Entreprise
                         </a>     
                    </form>
                </div>
            </div>
            
            <!-- Deuxième block composé d'entête et du corps (Côté affichage filière) -->
            <div class="panel panel-primary" style="font-family: 'Raleway', sans-serif; font-size: 16px; border: 1px solid #32475c"> 
                <div class="panel-heading" style=" background:#32475c; border:none"> Liste des entreprises ( <?php echo $nbrFiliere; ?> Entreprises ) </div>
                <div class="panel-body">
                    
                    <!-- Début du tableau -->
                    <table class="table table-striped table-bordered">
                        <!-- Partie entête du tableau -->
                        <thead>
                            <tr>
                                <th style="width:auto;">Id Entreprise</th>
                                <th>Nom Entreprise</th>
                                <th>Adresse</th>
                                <th>Type</th>
                                <th>Ville</th>
                                <th>Opérations</th>
                            </tr>
                        </thead>
                        <tbody> 
                            
                               <!-- Instruction pour afficher le résultat ds le tableau (Partie body) -->
                               <?php while($entreprise=$resultatF->fetch()){?> 
                                   <tr>
                                        <td><?php echo $entreprise['idE'] ?></td>
                                        <td><?php echo $entreprise['nomE']?></td>
                                        <td><?php echo $entreprise['adresseE'] ?></td>
                                        <td><?php echo $entreprise['typeE']?></td>
                                        <td><?php echo $entreprise['ville']?></td>
                                       <td>
                                           <!-- Affichges des glyphicons de rubrique 'Actions' -->
                                           <a href="editerEntreprise.php?idE=<?php echo $entreprise['idE'] ?>">
                                               <span class="glyphicon glyphicon-edit "> </span>
                                           </a> &nbsp;
                                           
                                           <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cette entreprise ?')" href="../traitement/supprimerEntreprise.php?idE=<?php echo $entreprise['idE'] ?>">
                                               <span class="glyphicon glyphicon-trash"> </span>
                                           </a>
                                       </td>
                                        
                                   </tr>
                               <?php }?>
                        </tbody>
                    </table>
                    <div>
                        <!-- Partie pagination -->
                        <ul class="pagination pagination-md" >
                            <?php for($i=1; $i<=$nbrPage; $i++){ ?>
                               <li class="<?php if($i==$page) echo 'active' ?>" >
                                   <a href="entreprise.php?page=<?php echo $i; ?>&nomE=<?php echo $nomE ?>">
                                       <?php echo $i; ?>
                                   </a>
                               </li> 
                            <?php } ?>
                        </ul>
                    </div>
                  </div>
            </div>
         </div>
       </div>
    </body>
</html>


