
<?php
    require_once("identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD

    $login=isset($_GET['login'])?$_GET['login']:"";

    $size=isset($_GET['size'])?$_GET['size']:3;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
    $requeteUser="select   * from utilisateur where username like '%$login%'";
    $requeteCount="select count(*) countUser from utilisateur";
     
    // Exécution des requêtes 
                  
    $resultatUser=$pdo->query($requeteUser);
    $resultatCount=$pdo->query($requeteCount);

    $tabCount=$resultatCount->fetch();
    $nbrUser=$tabCount['countUser'];
    $reste=$nbrUser % $size; 
    
    if( $reste == 0)
        $nbrPage = $nbrUser/$size;
    else
        $nbrPage=floor($nbrUser/$size)+1;

?>

<! DOCTYPE HTML>  
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des utilisateurs</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>

    <style>
        
    </style>
                    
    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
        <div class="container">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-success" style="margin-top: 100px;"> 
                <div class="panel-heading"> Recherche des utilisateurs</div>
                <div class="panel-body">
                                <!-- partie corps coté champ text (Taper le nom de la filière) -->
                     <form method="get" action="users.php" class="form-inline"> 
                        <div class="form-group"> 
                            <input type="text" name="login" placeholder="Login" class="form-control" 
                                   value="<?php echo $login; ?>"> 
                        </div>
                        
                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn" style="background:#32475c; color:white"> 
                            <span class="glyphicon glyphicon-search"> </span> Rechercher... 
                         </button> &nbsp; &nbsp;
                    </form>
                </div>
            </div>
            
            <!-- Deuxième block composé d'entête et du corps (Côté affichage inscrit) -->
            <div class="panel panel-primary" style="font-family: 'Raleway', sans-serif; font-size: 16px; border: 1px solid #32475c"> 
                <div class="panel-heading"style="background:#32475c"> Liste des utilisateurs ( <?php echo $nbrUser; ?> utilisateurs ) </div>
                <div class="panel-body">
                    
                    <!-- Début du tableau -->
                    <table class="table table-striped table-bordered">
                        <!-- Partie entête du tableau -->
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>login</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>     
                        <tbody> 
                            
                               <!-- Instruction pour afficher le résultat ds le tableau (Partie body) -->
                               <?php while($user=$resultatUser->fetch()){?> 
                               <div class="tableau">
                                   <tr class="<?php echo $user['etat']==1?'success':'danger' ?>">
                                        <td><?php echo $user['idU'] ?></td>
                                        <td><?php echo $user['username']?></td>
                                        <td><?php echo $user['email']?></td>
                                        <td><?php echo $user['role']?></td>
                                        <td>
                                           <!-- Affichges des glyphicons de rubrique 'Actions' -->
                                           <a href="editerUser.php?idU=<?php echo $user['idU'] ?>">
                                               <span class="glyphicon glyphicon-edit "  title="Editer cet utilisateur"> </span>
                                           </a> &nbsp;
                                           
                                           <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?')"    
                                              href="SupprimerUser.php?idU=<?php echo $user['idU'] ?>" title="Suppression de l'utilisateur">
                                               <span class="glyphicon glyphicon-trash"> </span>
                                           </a> &nbsp;

                                           <a href="../traitement/activerUser.php?idU=<?php echo $user['idU'] ?>&etat=<?php echo $user['etat'] ?>">
                                           
                                           <?php 
                                                if($user['etat']==0)
                                                    echo ' <span class="glyphicon glyphicon-remove "  title="Désactivé"> </span> ';
                                                else
                                                    echo ' <span class="glyphicon glyphicon-ok "  title="Activé"> </span> ';
                                           ?>
                                           </a>
                                       </td>
                                        
                                   </tr>
                                   </div>
                               <?php }?>
                        </tbody>
                    </table>
                    <div>
                        <!-- Partie pagination -->
                        <ul class="pagination pagination-md">
                            <?php for($i=1; $i<=$nbrPage; $i++){ ?>
                               <li class="<?php if($i==$page) echo 'active' ?>" >
                                   <a href="utilisateurs.php?page=<?php echo $i ?>&login=<?php echo $login; ?>">
                                       <?php echo $i; ?>
                                   </a>
                               </li> 
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


