
<?php 
    require_once("identifier.php");
    require_once("../bd/connexion.php"); // Connexion à la BD
    
    $nomS=isset($_GET['nomS'])?$_GET['nomS']:"";

    $size=isset($_GET['size'])?$_GET['size']:4;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
   
    // Vérification sur le choix de niveau de filière
    if($nomS==$nomS){
    // Exécution de la requete
        $requete = "select idS, nomS, postnomS, prenomS, nomF, sexeS, section, niveau, nomE,fiche
                  from filiere as f, stagiaire as s, entreprise as e
                  where f.idF = s.idF and e.idE = s.idE
                  and (nomS like '%$nomS%'  or postnomS like '%$nomS%' )
                  order by idS
                  limit $size 
                  offset $offset";
        $requeteCount="select count(*) countS from stagiaire where nomS like '%$nomS%'";
    }
                  
    $resultatF=$pdo->query($requete); // Exécution de la requete

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrFiliere=$tabCount['countS'];
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
        <title>Gestion Stagiaires(Entreprise)</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Filiere.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css"
    </head>

    <style>
        .divGeneral{
            width:100%;
            display: block;
        }
        .div1, .div2, .div3, .div4{
            height: 100px;
            width: 17%;
            border-radius: 5px;
            display: inline-block;
            margin-top: 8px;
            margin-right: 20px;
            vertical-align: top;
            margin-bottom: 20px;
            color: white;
            padding: 10px;
            font-size: 20px;
        }

        .div1{
            background-color: #2b77ba;
        }
        .div2{
            background-color: #54a958;
        }
        .div3{
            background-color: #f6ad47;
        }
        .div4{
            background-color: #e45f4b;
        }
        .td1{
            font-size: 40px;
            color: white;
            float: right;
            position: relative;
        }

        table tr td{
            height:-1px !important;
            padding: -45;
        }
    </style>

    <body>
        
        <!-- Insertion de la page menu -->
        <?php include("menu.php") ?> 
        
        <div class="container-fluid">
            <div class="row">
          
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            
            <div class="panel panel-primary" style="margin-top: 60px;"> 
                <div class="panel-heading"><h5 style="font-size:18px"> Recherche des stagiaires...</h5> </div>
                <div class="panel-body">
                                <!-- partie corps coté champ text (Taper le nom de la filière) -->
                     <form method="get" action="stagiairesRecommandes.php" class="form-inline"> 
                        <div class="form-group"> 
                            <input type="search" name="nomS" placeholder="Taper le nom du stagiaire" class="form-control" 
                                   value="<?php echo $nomS; ?>"> 
                        </div>
                    
                         <!-- Bouton de recherche -->
                         &nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn"  style="background: #32475c; color:white; width: 13% !important"> 
                            &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-search"> </span>&nbsp;&nbsp; Rechercher... 
                         </button>

                         <a href="ResultatStagiaire.php" style='float : right; border : 1px solid black; height : 40px; padding: 10px;color:white;width: 25%; text-align:center; border-radius : 4px; background: #32475c'>   
                            <span class="glyphicon glyphicon-plus"> </span>  Insérer les résultats du nouveau Stagiaire
                        </a>
                    </form>     
                </div>
            </div>
            
            <!-- Deuxième block composé d'entête et du corps (Côté affichage filière) -->
            <div class="panel panel" style="font-family: 'Raleway', sans-serif; font-size: 16px; border: 1px solid blue"> 
                <div class="panel-heading" > </div>
                <div class="panel-body">
                    
                    <!-- Début du tableau -->

                    <h3 style="margin-top: -10px"><i class="fa fa-table"></i> Tableau de Bord </h3>
                            
                            <div class="divGeneral">
                                <div class="div1">
                                    <table>
                                        <tr>
                                            <td><i style="font-size:60px; color:white" class="fa fa-graduation-cap"></i></td><td></td>
                                            <td></td><td></td><td></td><td></td><td></td><td></td>
                                            <td class="td1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nbrFiliere; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:white; text-align:center; min-width:120px !important">Stagiaires reçus</td>
                                        </tr>
                                    </table>
                                </div>  
                                <div class="div2">
                                    <table>
                                            <tr>
                                                <td><i style="font-size:60px; color:white" class="fa fa-user"></i></td><td></td>
                                                <td></td><td></td><td></td><td></td><td></td><td></td>
                                                <td class="td1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3</td>
                                            </tr>
                                            <tr>
                                                <td style="color:white; text-align:center">Traités</td>
                                            </tr>
                                    </table>
                                </div> 
                                <div class="div3">
                                    <table>
                                            <tr>
                                                <td><i style="font-size:60px; color:white" class="fa fa-history"></i></td><td></td>
                                                <td></td><td></td><td></td><td></td><td></td><td></td>
                                                <td class="td1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</td>
                                            </tr>
                                            <tr>
                                                <td style="color:white; text-align:center">History</td>
                                           </tr>
                                    </table>
                                </div>
                                <div class="div4">
                                    <table>
                                            <tr>
                                                <td><i style="font-size:60px; color:white" class="fa fa-close"></i></td><td></td>
                                                <td></td><td></td><td></td><td></td><td></td><td></td>
                                                <td class="td1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4</td>
                                            </tr>
                                            <tr>
                                                <td style="color:white; text-align:center; min-width:120px !important">Non traités</td>
                                           </tr>
                                    </table>
                                </div>
                            </div>

                    <table class="table table-striped table-bordered">
                        <!-- Partie entête du tableau -->
                        <thead>
                            <tr>
                                <th style="width:auto;">Id Stagiaire</th>
                                <th>Nom et Postnom</th>
                                <th>Faculté</th>
                                <th>Niveau et Section</th>
                                <th>Fiche</th>
                            </tr>
                        </thead>
                        <tbody> 
                            
                               <!-- Instruction pour afficher le résultat ds le tableau (Partie body) -->
                               <?php while($filiere=$resultatF->fetch()){?> 
                                   <tr>
                                        <td><?php echo $filiere['idS'] ?></td>
                                        <td><?php echo $filiere['nomS'] .' ' .$filiere['postnomS']?></td>
                                        <td><?php echo $filiere['nomF'] ?></td>
                                        <td><?php echo $filiere['niveau'] .', '.$filiere['section']?></td>
                                       <td>
                                       <div class="form" > 
                                            <a href="<?php echo "../Images/".$filiere['fiche'] ?>"  download>
                                            <input class="btn btn" type="button" name="fiche" value="Télécharger" style="background:#32475c; color:white; height:33px"></a> &nbsp;
                                            <?php echo $filiere['fiche'] ?> 
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
                                   <a href="stagiairesRecommandes.php?page=<?php echo $i; ?>&nomS=<?php echo $nomS ?>">
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


