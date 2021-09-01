
<?php 
    require_once("identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    $nomf=isset($_GET['nomF'])?$_GET['nomF']:"";
    $niveau=isset($_GET['niveau'])?$_GET['niveau']:"all";

    $size=isset($_GET['size'])?$_GET['size']:9;
    $page=isset($_GET['page'])?$_GET['page']:1;

    $offset=($page-1)*$size;
   
    // Vérification sur le choix de niveau de filière
    if($niveau=="all"){
        $requete="select * from filiere where nomF like '%$nomf%' order by idF limit $size offset $offset";
        $requeteCount="select count(*) countF from filiere where nomF like '%$nomf%'";
    }else{
        $requete="select * from filiere where nomF like '%$nomf%' and niveau= '$niveau' order by idF limit $size";
        // die($requete);
        $requeteCount="select count(*) countF from filiere where nomF like '%$nomf%' and niveau= '$niveau'"; 
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
    </head>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
        
        <div class="container-fluid">
            <div class="row">
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-success" style="margin-top: 67px;"> 
                <div class="panel-heading"> Recherche des filières... </div>
                <div class="panel-body">
                                <!-- partie corps coté champ text (Taper le nom de la filière) -->
                     <form method="get" action="filiere.php" class="form-inline"> 
                        <div class="form-group"> 
                            <input type="search" name="nomF" placeholder="Taper le nom de la filière" class="form-control" 
                                   value="<?php echo $nomf; ?>"> 
                        </div>
                        <!-- Partie liste déroulante de niveaux de filières -->
                        <label for="niveau"> Niveau : </label>
                        <div class="form-group"> 
                            <select name="niveau" class="form-control" id="niveau">
                                <option value="all" <?php echo "selected" ; ?>>Tous les niveaux</option>
                                <option value="Licence" <?php if($niveau==="Licence") echo "selected" ?>>Licence</option>
                                <option value="Graduat" <?php if($niveau==="Graduat") echo "selected" ?>>Graduat</option>
                                <option value="Lmd" <?php if($niveau==="Lmd") echo "selected" ?>>LMD</option>
                            </select>
                        </div>
                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn"  style="background: #32475c; color:white"> 
                            <span class="glyphicon glyphicon-search"> </span>&nbsp;&nbsp; Rechercher... 
                         </button> &nbsp; &nbsp;
                         
                         <!-- Partie pour ajout d'une nouvelle filière -->
                         <a href="nouvelleFiliere.php">
                             <span class="glyphicon glyphicon-plus"> </span>Nouvelle filière
                         </a>     
                    </form>
                </div>
            </div>
            
            <!-- Deuxième block composé d'entête et du corps (Côté affichage filière) -->
            <div class="panel panel-primary" style="font-family: 'Raleway', sans-serif; font-size: 16px; border: 1px solid #32475c"> 
                <div class="panel-heading" style=" background:#32475c; border:none"> Liste des filières ( <?php echo $nbrFiliere; ?> Filières ) </div>
                <div class="panel-body">
                    
                    <!-- Début du tableau -->
                    <table class="table table-striped table-bordered">
                        <!-- Partie entête du tableau -->
                        <thead>
                            <tr>
                                <th style="width:auto;">Id filiddddère</th>
                                <th>Nom filière</th>
                                <th>Niveau</th>
                                <th>Section</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> 
                            
                               <!-- Instruction pour afficher le résultat ds le tableau (Partie body) -->
                               <?php while($filiere=$resultatF->fetch()){?> 
                                   <tr>
                                        <td><?php echo $filiere['idF'] ?></td>
                                        <td><?php echo $filiere['nomF']?></td>
                                        <td><?php echo $filiere['niveau'] ?></td>
                                        <td><?php echo $filiere['section']?></td>
                                       <td>
                                          

                                        <?php if($_SESSION['user']['role'] == 'ADMIN' || $_SESSION['user']['login'] == 'ADMIN') {?>
                                                 <!-- Affichges des glyphicons de rubrique 'Actions' -->
                                                <a href="editerFiliere.php?idF=<?php echo $filiere['idF'] ?>">
                                                    <span class="glyphicon glyphicon-edit "> </span>
                                                </a> &nbsp;

                                                <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cette filière ?')" href="../traitement/supprimerFiliere.php?idF=<?php echo $filiere['idF'] ?>">
                                                    <span class="glyphicon glyphicon-trash"> </span>
                                                </a>
                                           <?php }?>
                                           
                                           
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
                                   <a href="filiere.php?page=<?php echo $i; ?>&nomF=<?php echo $nomf ?>&niveau=<?php echo $niveau ?>">
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


