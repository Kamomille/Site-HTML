<?php

session_start() ;
if(isset($_COOKIE)){
    $_SESSION['id']=$_COOKIE['id'];
    $_SESSION['identifiant']=$_COOKIE['identifiant'];
    $_SESSION['mdp']=$_COOKIE['mdp'];
    $_SESSION['fonction']=$_COOKIE['fonction'];
    if($_SESSION['fonction']=='directeur'){
        $_SESSION['role']='directeur';
    }
    else {
        $_SESSION['role']='salarie';
    }
}
 else {
     header("Location:http://localhost/projetSite_HTML/public_html/index.html"); 
}

?>

<html>
    
    <head>
        <title>Esme gestion congé</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="page.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion des congés</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>


    <?php include("haut_page.php");

    if (strcmp($_SESSION['fonction'], 'enseignant') == 0 || strcmp($_SESSION['fonction'], 'administration') == 0){
        echo "<a class='nav' href='consultationCommentaire.php'>Commentaire</a>";
    }
    else {
        echo "<a class='nav' href='consultationCommentaire.php'>Commentaires</a>";
    }

    if (strcmp($_SESSION['fonction'], 'enseignant') == 0 || strcmp($_SESSION['fonction'], 'administration') == 0) {
        echo "<a class='nav' href='gestionConges_salaries.php'>Gestion Congés</a>";
    }
    if (strcmp($_SESSION['fonction'], 'directeur') == 0) {
        echo "<a class='nav' href='gestionConges_directeur.php'>Gestion Congés</a>";
    }
    echo "<a class='nav' href='ajout_CV.php'>test ajout CV</a>";

                ?>
            </nav>

    <?php include("pied_de_page.php"); ?>
    </body>
</html>