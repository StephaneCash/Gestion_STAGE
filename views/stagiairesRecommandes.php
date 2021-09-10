
<?php
require_once "identifier.php";
require_once "../bd/connexion.php"; // Connexion à la BD

$nomS = isset($_GET['nomS']) ? $_GET['nomS'] : "";

$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$recupereeDataStagTraites = "SELECT count(*) countData FROM resultat"; // Recuperation data traites
//echo $recupereeDataStagTraites;

$requeDataTraites = $pdo->query($recupereeDataStagTraites);
$dataTraites = $requeDataTraites->fetch();
$nbrDataTraites = $dataTraites['countData'];

// Vérification sur le choix de niveau de filière
if ($nomS == $nomS) {
    // Exécution de la requete
    $requete = "select idS, nomS, postnomS, prenomS, nomF, sexeS, section, niveau, nomE,fiche,status
                  from filiere as f, stagiaire as s, entreprise as e
                  where f.idF = s.idF and e.idE = s.idE
                  and (nomS like '%$nomS%'  or postnomS like '%$nomS%' )
                  order by idS
                  limit $size
                  offset $offset";
    $requeteCount = "select count(*) countS from stagiaire where nomS like '%$nomS%'";
}

$resultatF = $pdo->query($requete); // Exécution de la requete

$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrFiliere = $tabCount['countS'];
$reste = $nbrFiliere % $size;

if ($reste == 0) {
    $nbrPage = $nbrFiliere / $size;
} else {
    $nbrPage = floor($nbrFiliere / $size) + 1;
}

?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion Stagiaires(Entreprise)</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Filiere.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    </head>

    <style>
        .divGeneral{
            width:100%;
            display: block;
        }
        .div1, .div2, .div3, .div4{
            height: 40px;
            width: auto;
            border-radius: 5px;
            display: inline-block;
            margin-top: -26px;
            vertical-align: top;
            margin-bottom: 20px;
            color: white;
            padding: 6px;
            font-size: 20px;
        }

        .div1{
            background-color: #2b77ba;
        }
       table thead{
           background-color:#32475c;
           color: white;
       }
       table{
           font-family: Segoe UI;
           font-size: 17px;
       }
    </style>

    <body>

        <!-- Insertion de la page menu -->
        <?php include "menu.php"?>

        <div class="container-fluid">
            <div class="row">

            <!-- Premier block composé d'entête et du corps (Côté recherche) -->

            <div class="panel panel-primary" style="margin-top: 60px;">
                <div class="panel-heading">Recherche des stagiaires... </div>
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
                            <span class="fa fa-plus-square"> </span>  Insérer les résultats du nouveau Stagiaire
                        </a>
                    </form>
                </div>
            </div>

            <!-- Deuxième block composé d'entête et du corps (Côté affichage filière) -->
            <div class="panel panel">
                <div class="panel-heading" > </div>
                <div class="panel-body">

                    <!-- Début du tableau -->

                                <div class="div1">
                                    <table>
                                        <tr>
                                            <td style="color: white; font-size: 25px;" class="td1"><?php if($nbrFiliere > 1){ echo $nbrFiliere . " reçus ";}else{ echo $nbrFiliere . ' reçu'; } ?></td>
                                        </tr>
                                    </table>
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
                                <th>Décision</th>
                            </tr>
                        </thead>
                        <tbody>

                               <!-- Instruction pour afficher le résultat ds le tableau (Partie body) -->
                               <?php while ($filiere = $resultatF->fetch()) {?>
                                   <tr>
                                        <td><?php echo $filiere['idS'] ?></td>
                                        <td><?php echo $filiere['nomS'] . ' ' . $filiere['postnomS'] ?></td>
                                        <td><?php echo $filiere['nomF'] ?></td>
                                        <td><?php echo $filiere['niveau'] . ', ' . $filiere['section'] ?></td>
                                       <td>
                                       <div class="form" >
                                            <a href="<?php echo "../Images/" . $filiere['fiche'] ?>"  download>
                                            <input class="btn btn" type="button" name="fiche" value="Télécharger" style="background:#32475c; color:white; height:33px"></a> &nbsp;
                                            <?php echo $filiere['fiche'] ?>
                                       </div>
                                       </td>
                                       
                                           <?php if ($filiere["status"] == 0) {?>
                                            <td>
                                            <a onclick="return confirm('Etes-vous sûr de vouloir accepter ce stagiaire ?')" href="../traitement/activerStagiaire.php?idS=<?php echo $filiere['idS'] ?>&status=<?php echo 2  ?>">
                                               <i class="fa fa-check" style="font-size:20px; color:green">Accepté</i>
                                            </a>&nbsp; ou &nbsp; 
                                            <a onclick="return confirm('Etes-vous sûr de vouloir rejeter ce stagiaire ?')" href="../traitement/activerStagiaire.php?idS=<?php echo $filiere['idS']?>&status=<?php echo 1  ?>">
                                               <i class="fa fa-close" style="font-size:20px; color:red"> Rejeté</i>
                                            </a>
                                            </td>
                                            
                                           <?php }?>

                                           <?php if($filiere['status'] ==2){?>
                                                <td>Approuvé</td>
                                           <?php } ?>

                                           <?php if($filiere['status'] ==1){?>
                                                <td>Rejeté</td>
                                           <?php } ?>
                                   </tr>
                               <?php }?>
                        </tbody>
                    </table>

                    <div>
                        <!-- Partie pagination -->
                        <ul class="pagination pagination-md" >
                            <?php for ($i = 1; $i <= $nbrPage; $i++) {?>
                               <li class="<?php if ($i == $page) {
                                 echo 'active';
                                    }
                                    ?>" >
                                   <a href="stagiairesRecommandes.php?page=<?php echo $i; ?>&nomS=<?php echo $nomS ?>">
                                       <?php echo $i; ?>
                                   </a>
                               </li>
                            <?php }?>
                        </ul>
                    </div>
                  </div>
            </div>
         </div>
       </div>
    </body>
</html>


