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
            margin-top: 20px;
            font-family: 'Segoe UI';
            font-size: 16px;
        }

        table thead{
            background-color:#32475c;
            color: white;
        }
    </style>

    <body>
        <?php
        require_once "identifier.php";
        require_once "../bd/connexion.php"; // Connexion à la BD

        $requeteResu = "SELECT * FROM resultat";

        $requeteR = $pdo->query($requeteResu);

        ?>

        <?php include "menu.php"?>

        <h3 style="margin-top: 60px;">RESULATS STAGIAIRES</h3>

        <table class="table table-bordered table-striped">
            <thead >
                <tr>
                    <th>#</th>
                    <th>Noms</th>
                    <th>Sexe</th>
                    <th>Filière</th>
                    <th>Entreprise</th>
                    <th>Fiche de cote</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($stageR = $requeteR->fetch()) {?>
                <tr>
                    <td><?php echo $stageR['id'] ?></td>
                    <td><?php echo $stageR['nom'] . " " . $stageR['postnom'] . " " . $stageR['prenom'] ?></td>
                    <td><?php echo $stageR['sexe'] ?>
                    <td><?php echo $stageR['filiere'] ?></td>
                    <td><?php echo $stageR['entreprise'] ?></td>

                    <td>
                        <div class="form" >
                            <a href="<?php echo "../Images/" . $stageR['result'] ?>"  download>
                            <input class="btn btn" type="button" name="fiche" value="Télécharger" style="background:#32475c; color:white; height:33px"></a> &nbsp;
                            <?php echo $stageR['result'] ?>
                        </div>
                    </td>
                    <td style="width:150px"><i class="fa fa-print"><span style="font-size: 16px; font-family:Segoe UI"> Imprimer</span></i></td>

                </tr>
            <?php }?>
            </tbody>
        </table>
    </body>
</html>