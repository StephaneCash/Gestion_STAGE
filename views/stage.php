
<?php
    require_once("identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD

    $nomPostnom=isset($_GET['nomPostnom'])?$_GET['nomPostnom']:"";
    $idfiliere=isset($_GET['idF'])?$_GET['idF']:0;
    $idEntreprise=isset($_GET['idE'])?$_GET['idE']:0;

    
    $size=isset($_GET['size'])?$_GET['size']:8;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;


    $requeteFiliere = "select * from filiere"; // Requête filière

    $requeteE = "select * from entreprise";

    if($idfiliere==0){
        $requeteStagiaire="SELECT idS, nomS, postnomS, prenomS, nomF, sexeS,status, section, niveau, nomE
                  from filiere as f, stagiaire as s, entreprise as en
                  where f.idF = s.idF and en.idE = s.idE
                  and (nomS like '%$nomPostnom%' or postnomS like '%$nomPostnom%')
                  order by idS
                  limit $size 
                  offset $offset";
        
        $requeteCount="SELECT count(*) countS from stagiaire
                       where nomS like '%$nomPostnom%' or postnomS like '%$nomPostnom%'";
    }

    /*elseif($idEntreprise !== 0 ){
        $requeteStagiaire="SELECT idS, nomS, postnomS,prenomS,nomF, sexeS, section, niveau, nomE 
        from filiere as f, stagiaire as s, entreprise as e
        where f.idF = s.idF 
        and (nomS like '%$nomPostnom%' or postnomS like '%$nomPostnom%')
        and f.idF = $idEntreprise 
        and e.idE = $idEntreprise
        order by idS
        limit $size 
        offset $offset";
        
        $requeteCount="SELECT count(*) countS from stagiaire
                       where nomS like '%$nomPostnom%' or postnomS like '%$nomPostnom%'";
    }*/
    
    else{
        $requeteStagiaire="SELECT idS, nomS, postnomS,prenomS,nomF, sexeS,status, section, niveau, nomE 
                  from filiere as f, stagiaire as s, entreprise as e
                  where f.idF = s.idF 
                  and (nomS like '%$nomPostnom%' or postnomS like '%$nomPostnom%')
                  and f.idF = $idfiliere 
                  and e.idE = $idfiliere
                  order by idS
                  limit $size 
                  offset $offset";
        
        $requeteCount="select count(*) countS from stagiaire
                  where(nomS like '%$nomPostnom%' or postnomS like '%$nomPostnom%') 
                  and idF = $idfiliere";
    }
    // Exécution des requêtes FILIERE, COMPTAGE et STAGIAIRE
                  
    $resultatFiliere=$pdo->query($requeteFiliere);
    $resultatE=$pdo->query($requeteE);
    
    $resultatStagiaire=$pdo->query($requeteStagiaire); 
    $resultatCount=$pdo->query($requeteCount);

    $tabCount=$resultatCount->fetch();
    $nbrStagiaire=$tabCount['countS'];
    $reste=$nbrStagiaire % $size; 
    
    if( $reste == 0)
        $nbrPage = $nbrStagiaire/$size;
    else
        $nbrPage=floor($nbrStagiaire/$size)+1;

?>

<! DOCTYPE HTML>    
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion Stagiaires</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Filiere.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
 
    </head>

    <style>
        
    </style>

    <body >
        
        <!-- Insertion de la page menu --> 
        <?php  include("menu.php") ?> 
          
        <!-- Centrer le contenu de la page -->
          
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-success" style="margin-top: 70px; border:none"> 
                <?php // echo $idEntreprise; ?>
                <div class="panel-heading"> Recherche des Stagiaires</div>
                <div class="panel-body" style="border : 1px solid silver;">
                                <!-- partie corps coté champ text (Taper le nom de la filière) -->
                     <form method="get" action="stage.php" class="form-inline"> 
                        <div class="form-group"> 
                            <input type="text" name="nomPostnom" placeholder="Nom et postnom" class="form-control" 
                                   value="<?php echo $nomPostnom; ?>"> 
                        </div>
                        <!-- Partie liste déroulante de niveaux de filières -->
                        <label for="idfiliere"> Filière : </label>
                        <div class="form-group"> 
                            <select name="idF" class="form-control" id="idfiliere">
                                <option value=0 > Toutes les filières </option>
                                <?php while($filiere = $resultatFiliere->fetch()){ ?>
                                     <option value="<?php echo $filiere['idF'] ?>"
                                <?php if($filiere['idF']==$idfiliere) { echo 'selected'; } ?> >
                                <?php echo $filiere['nomF'] ?> </option>   
                                <?php } ?>    
                            </select>
                        </div>

                        <label for="idfiliere"> Entreprise : </label>
                        <div class="form-group"> 
                            <select name="idE" class="form-control" id="idfiliere">
                                <option value=0 > Toutes les entreprise </option>
                                <?php while($entreprise = $resultatE->fetch()){ ?>
                                     <option value="<?php echo $entreprise['idE'] ?>"
                                <?php if($entreprise['idE']==$idEntreprise) { echo 'selected'; } ?> >
                                <?php echo $entreprise['nomE'] ?> </option>   
                                <?php } ?>    
                            </select>
                        </div>
                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn-primary" style="background : #32475c; height: 36px;border: none"> 
                            <span class="glyphicon glyphicon-search"> </span> Rechercher... 
                         </button> &nbsp; &nbsp;
                         
                         <!-- Partie pour ajout d'un nouveau inscrit -->
                         <?php if($_SESSION['user']['role'] == 'ADMIN') {?>
                            <a href="NouveauS.php">
                                <span class="glyphicon glyphicon-plus"> </span> Recommandation Stagiaire 
                            </a>    
                         <?php }?> 
                    </form>
                </div>
            </div>
            
            <!-- Deuxième block composé d'entête et du corps (Côté affichage stagiaires) -->
            <div class="panel panel-primary" style="font-family: 'Raleway', sans-serif; font-size: 16px; "> 
                <div class="panel-heading" style=" color : white; background : #32475c"><h4> Liste des Stagiaires ( <?php if($nbrStagiaire > 1){ echo $nbrStagiaire . " Stagiaires";}else{ echo $nbrStagiaire . " Stagiaire"; } ?>) </h4></div>
                <div class="panel-body">
                    
                    <!-- Début du tableau -->
                    <table class="table table-striped table-bordered">
                        <!-- Partie entête du tableau -->
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Postnom</th>
                                <th>Prénom</th>
                                <th>SEXE</th>
                                <th>Filière</th>
                                <th>Section</th>
                                <th>Niveau</th>
                                <th>Entreprise</th>
                                <th>Actions</th>
                                <th>Status</th>
                            </tr>
                        </thead>     
                        <tbody> 
                            
                               <!-- Instruction pour afficher le résultat ds le tableau (Partie body) -->
                               <?php while($stagiaire=$resultatStagiaire->fetch())
                                        {
                                            if(empty($stagiaire))
                                            {?>
                                                <tr>
                                                    <td>Aucune donnée</td>
                                                </tr>
                                            <?php    
                                            }
                                            else{?>
                                                <div class="tableau">
                                                    <tr>
                                                            <td><?php echo $stagiaire['idS'] ?></td>
                                                            <td><?php echo $stagiaire['nomS']?></td>
                                                            <td width = "13%"><?php echo $stagiaire['postnomS'] ?></td>
                                                            <td width = "13%"><?php echo $stagiaire['prenomS'] ?></td>
                                                            <td><?php echo $stagiaire['sexeS']?></td>
                                                            <td width = "23%"><?php echo $stagiaire['nomF']?></td>
                                                            <td><?php echo $stagiaire['section']?></td>
                                                            <td><?php echo $stagiaire['niveau']?></td>
                                                        <td><?php echo $stagiaire['nomE'] ?></td>
                                                        <td>
                                                            <!-- Affichges des glyphicons de rubrique 'Actions' -->
                                                            <a href="editerStagiaire.php?idS=<?php echo $stagiaire['idS'] ?>">
                                                                <span class="glyphicon glyphicon-edit "  title="Editer le stagiaire"> </span>
                                                            </a> &nbsp;
                                                            
                                                            <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce stagiaire ?')"    
                                                                href="../traitement/supprimerStagiaire.php?idS=<?php echo $stagiaire['idS'] ?>" title="Suppression de la filière">
                                                                <span class="glyphicon glyphicon-trash"> </span>
                                                            </a>
                                                        </td>
                                                        <td style="font-size: 18px; font-family:Segoe UI"> 
                                                            <?php 
                                                                if($stagiaire['status'] == 0){
                                                                    echo ' <i class="fa fa-square "  title="En attente" style="color:blue;"> En attente</i> ';
                                                                }elseif($stagiaire['status']==1){
                                                                    echo ' <i class="fa fa-close "  title="Non approuvé" style="color:red"> Non approuvé </i> ';
                                                                }elseif($stagiaire['status']==2){
                                                                    echo ' <i class="fa fa-check "  title="Approuvé" style="color:green"> Approuvé </i> ';
                                                                }
                                                             ?>
                                                        </td>
                                                    </tr>
                                                </div>
                                            <?php 
                                            }
                               }?>
                        </tbody>
                    </table>
                    <div>
                        <!-- Partie pagination -->
                        <ul class="pagination pagination-md">
                            <?php for($i=1; $i<=$nbrPage; $i++){ ?>
                               <li class="<?php if($i==$page) echo 'active' ?>" >
                                   <a href="stage.php?page=<?php echo $i ?>&nomPostnom=<?php echo $nomPostnom; ?>&idfiliere=<?php echo $idfiliere; ?>">
                                       <?php echo $i; ?>
                                   </a>
                               </li> 
                            <?php } ?>
                        </ul>
                    </div>
          
            </div>
        </div>
    </body>
</html>


