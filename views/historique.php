
<?php 
    require_once("identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    $nomS=isset($_GET['nomS'])?$_GET['nomS']:"";
    $postnomS=isset($_GET['postnomS'])?$_GET['postnomS']:"";

    $size=isset($_GET['size'])?$_GET['size']:9;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
   
    // On selectionne les données en vérifiant la condition ci-dessous
    if($postnomS==$postnomS ){
        $requete="select * from resultat where nom like '%$nomS%' or postnom like '%$postnomS%' order by id limit $size offset $offset";
        $requeteCount="select count(*) countF from resultat where nom like '%$nomS%'";
    }
                  
    $resultatF=$pdo->query($requete); // Exécution de la requete

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrFiliere=$tabCount['countF'];
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
        <title>Gestion filières</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Filiere.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    </head>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
        
        <div class="container-fluid">
            <div class="row">
       
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            
            <div class="panel panel-success" style="margin-top: 60px;"> 
                <div class="panel-heading"> Recherche des stagiaires... </div>
                <div class="panel-body">
                                <!-- partie corps coté champ text (Taper le nom de la filière) -->
                     <form method="get" action="historique.php" class="form-inline"> 
                        <div class="form-group"> 
                            <input type="search" name="nomS" placeholder="Taper le nom ou le postnom du stagiaire" class="form-control" 
                                   value="<?php echo $nomS; ?>"> 
                        </div>
            
                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn"  style="background: #32475c; color:white"> 
                            <span class="glyphicon glyphicon-search"> </span>&nbsp;&nbsp; Rechercher... 
                         </button> &nbsp; &nbsp;
                            
                    </form>
                </div>
            </div>
            
            <!-- Deuxième block composé d'entête et du corps (Côté affichage filière) -->
            <div class="panel panel-primary" style="font-family: 'Raleway', sans-serif; font-size: 16px; border: 1px solid #32475c"> 
                <div class="panel-heading" style=" background:#32475c; border:none"> Liste des Stagiaires ( <?php echo $nbrFiliere; ?> Stagiaires ) </div>
                <div class="panel-body">
                    
                    <!-- Début du tableau -->
                    <table class="table table-striped table-bordered">
                        <!-- Partie entête du tableau -->
                        <thead>
                            <tr>
                                <th style="width:auto;">Id S</th>
                                <th>Nom et Postnom</th>
                                <th>Sexe</th>
                                <th>Filière</th>
                                <th>Résultats</th>
                            </tr>
                        </thead>
                        <tbody> 
                            
                               <!-- Instruction pour afficher le résultat ds le tableau (Partie body) -->
                               <?php while($stagiaire=$resultatF->fetch()){?> 
                                   <tr>
                                        <td><?php echo $stagiaire['id'] ?></td>
                                        <td><?php echo $stagiaire['nom'] .' ' .$stagiaire['postnom'] ?></td>
                                        <td><?php echo $stagiaire['sexe'] ?></td>
                                        <td><?php echo $stagiaire['filiere']?></td>
                                       <td>
                                       <div class="form-group" > 
                                            <a href="<?php echo "../Images/".$stagiaire['result'] ?>"  look>
                                            <input class="btn btn" type="button" name="fiche" value="Voir le résultat"
                                             style="background:#32475c; color:white"></a> &nbsp;
                                             <span class="fa fa-eye"></span>
                                       </div>
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
                                   <a href="historiue.php?page=<?php echo $i; ?>&nomS=<?php echo $nomS ?>">
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


