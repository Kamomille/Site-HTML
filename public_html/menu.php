<html>
    
    <head>
        <title>Menu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="page.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Menu</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>


    <?php 
    include 'database.php';
    include("haut_page.php");

    if(isset($_COOKIE)){
        $prenom=$_COOKIE['prenom'];
        $nom=$_COOKIE['nom'];
    }
    echo '<h1>'.'Bienvenue '.$prenom.' '.$nom.'</h1>';
    include("pied_de_page.php"); ?>
    </body>
</html>