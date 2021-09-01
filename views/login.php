
<?php
    session_start();
    if(isset($_SESSION['Erreurlogin']))
        $erreurLogin = $_SESSION['Erreurlogin'];
    else{
        $erreurLogin="";
    }
    session_destroy();
?>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Authentification</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/SeConnecter.css">
    </head>

    <body>
          
        <!-- Centrer le contenu de la page -->
        <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">  
            
            <!-- Premier block composé d'entête et du corps (Côté recherche) -->
            <div class="panel panel-primary " style="margin-top: 80px; "> 
                <div class="panel-heading" style="color : silver; background:#32475c "><h4 style="color : white" > Veuiller vous connecter en utilisant votre login et votre password </h4>   
                <span  class="glyphicon glyphicon-user" style="font-size: 50px; color:white" > </span>
                </div>
                <div class="panel-body">
                    
                    <form method="post" action="../traitement/seConnecter.php" class="form">   
                          <?php if(!empty($erreurLogin)){?>
                            <div class="alert alert-danger">
                                <?php echo $erreurLogin; ?> 
                            </div>
                         <?php } ?>
                            
                        <div class="form-group"> 
                            <label for="login">Nom d'utilisateur ou email  </label>
                        <div class="login--form__input-area input-group">
                            <span class="input-group-addon"> <span class="fa fa-user"></span></span>
                            <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" id="login"  required />
                        </div>
                            
                            <label for="pwd">Mot de passe  </label>
                        <div class="login--form__input-area input-group">
                            <span class="input-group-addon"> <span class="fa fa-lock"></span></span>
                            <input type="password" name="pwd" class="form-control" placeholder="Mot de passe" id="pwd" required />                            
                        </div>
                        </div>

                         <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn button"> 
                            <span class="glyphicon glyphicon-log-in"> </span> Se connecter
                         </button>
                    </form>
                </div>            
            </div>
        </div>
        
    </body>
</html>


