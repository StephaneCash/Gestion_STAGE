<?php 
    require_once('identifier.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Home.css">
    <title>Entreprise</title>
</head>
<body>
    <?php include('menu.php') ?>

    <div class="homeEntreprise">
        <img src="../images/img.jpg"  class="img1"/>
        <p style="text-align: center; font-size: 70px; position : absolute; top : 120px; color : white">BIENVENU(E) DANS NOTRE ENTREPRISE
            NOUS SOMMES LA POUR VOUS </p>
        
        
    </div>

    <div style="border: 0px solid red; width: 20%; position : absolute; top : 350px; padding : 10px; margin-left : 490px">
        <input type="text" placeholder="Rechercher" class="form-control" />
    </div>

    <div style="border: 0px solid red; width: 50%; position : absolute; top : 350px; padding : 10px; margin-left : 790px;">
            <button type="button" class="btn btn-primary">Rechercher
                <i class="glyphicon glyphicon-search"> </i>    
            </button>
    </div>
    

    <div class="sec0">
        <div class="sec01">
            <div class="sec011">
                <img src="../images/r.jpg" />
            </div>
            
            <div class="sec012">
                <h3>Vodacom Congo </h3>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio possimus nemo cupiditate tempora 
                illum, impedit dolores dolorum qui. Officiis rem delectus reiciendis quo aliquam error dolores esse sunt mollitia aliquid!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, ea exercitationem? Corporis facilis similique porro, tenetur
            </div>
        </div>
        <div class="sec02">
            <div class="sec021">
                <img src="../images/tigo.jpg" class="imgTigo" />
            </div>
            <div class="sec022">
                <h3>Tigo </h3>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio possimus nemo cupiditate tempora 
                illum, impedit dolores dolorum qui. Officiis rem delectus reiciendis quo aliquam error dolores esse sunt mollitia aliquid!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, ea exercitationem? Corporis facilis similique porro, tenetur
            </div>
        </div>
        <div class="sec03">
            <div class="sec031">
                <img src="../images/e.gif" class="imgAddidas" />
            </div>
            <div class="sec032">
                <h3>Addidas</h3>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio possimus nemo cupiditate tempora 
                illum, impedit dolores dolorum qui. Officiis rem delectus reiciendis quo aliquam error dolores esse sunt mollitia aliquid!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, ea exercitationem? Corporis facilis similique porro, tenetur
            </div>
        </div>
    </div>

    <input type="text" placeholder="Rechercher" class="form-control" />

</body>
</html>