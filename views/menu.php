
<?php
    
    if(!isset($_SESSION['user']))
        header('location : login.php');    
?>

<style>
    .navbar{
        min-height: 80px;
        font-size: 18px;
        padding: 10px;
        color:white !important;
    }
</style>
 
<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container-fluid">
        <div class="navbar-header">
        <?php if($_SESSION['user']['role'] == 'ADMIN' || $_SESSION['user']['role'] == 'visiteur') {?>
            <a href="stage.php" class="navbar-brand" title="Gestion de toutes les filières de l'ISPT-KIN">
                <span class="glyphicon glyphicon-home small"> </span> 
                Gestion Stage
            </a>
        <?php }?>
        </div>
        
            <ul class="nav navbar-nav menu">
            <?php if($_SESSION['user']['role'] == 'ADMIN' || $_SESSION['user']['role'] == 'visiteur') {?>
                <li><a href="filiere.php" title ="Filières(Options)" >Filières</a></li>
            <?php }?>

            <?php if($_SESSION['user']['role'] == 'ADMIN' || $_SESSION['user']['role'] == 'visiteur') {?>
                <li><a href="stage.php" title="Gestion de stagiaires">Stagiaires</a></li>
            <?php }?>

            <?php if($_SESSION['user']['role'] == 'ADMIN' || $_SESSION['user']['role'] == 'visiteur') {?>
                <li><a href="entreprise.php" title="Entreprise">Entreprises</a></li>
            <?php }?>

            <?php if($_SESSION['user']['role'] == 'ADMIN' || $_SESSION['user']['role'] == 'visiteur') {?>
                <li><a href="Resultat.php" title="Résultats Stagiaires">Résultats Stagiaires</a></li>
            <?php }?>

            <?php if($_SESSION['user']['role'] == 'ADMIN') {?>
                <li><a href="users.php" title="Users ">Utilisateurs</a></li>
            <?php }?>

            <?php if($_SESSION['user']['role'] == 'entreprise') {?>
                <li><a href="stagiairesRecommandes.php" title="Users "><span class="glyphicon glyphicon-home "> </span> Home</a></li> 
            <?php }?>

            <?php if($_SESSION['user']['role'] == 'entreprise') {?>
                <li><a href="stagiairesRecommandes.php" title="Users " active>Stagiaires_Recommandés</a></li> 
            <?php }?>

            <?php if($_SESSION['user']['role']== 'entreprise') {?>
                <li><a href="historique.php" title="Historique Stagiaires " active>Historique</a></li></li>
            <?php }?>
        
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" title ="User"><i class='glyphicon glyphicon-user '></i><?php echo ' '. $_SESSION['user']['username']?></a></li>
                <li><a href="../traitement/seDeconnecter.php" title="Déconnexion"><i class='glyphicon glyphicon-log-out '></i> Déconnexion</a></li>
            </ul>
    </div>
</nav>
