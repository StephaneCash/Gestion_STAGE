<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resultats</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Filiere.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    </head>

    <style>
        table{
            margin-top: 70px;
        }
    </style>

    <body>
        <?php 
            require_once("identifier.php");
            require_once("../bd/connexion.php"); // Connexion à la BD

            $requeteResu = "SELECT * FROM resultat";

            $requeteR = $pdo->query($requeteResu);


        ?>  
        
        <?php include("menu.php") ?>
        
        <table class="table table-bordered">
            <thead >
                <tr>
                    <th>#</th>
                    <th>Noms</th>
                    <th>Filière</th>
                    <th>Fiche de cote</th>
                    <th>Entreprise</th>
                </tr>
            </thead>
            <tbody>
            <?php while($stageR=$requeteR->fetch()){?> 
                <tr>
                    <td><?php echo $stageR['id'] ?></td>
                    <td><?php echo $stageR['nom'] . " " .$stageR['postnom']. " " .$stageR['prenom'] ?></td>
                    <td><?php echo $stageR['filiere'] ?></td>
                    
                    
                    <td>
                                       <div class="form" > 
                                            <a href="<?php echo "../Images/".$stageR['result'] ?>"  download>
                                            <input class="btn btn" type="button" name="fiche" value="Télécharger" style="background:#32475c; color:white; height:33px"></a> &nbsp;
                                            <?php echo $stageR['result'] ?> 
                                       </div>
                                       </td>
                                       <td><?php echo $stageR['entreprise']?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </body>
</html>