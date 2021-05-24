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

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.pp
-->
<html>
    
    <head>
        <title>Esme gestion congé</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="menu.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion des congés</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>


        <nav>
                <a href=gestionProfil.php>Gestion Profil</a>
                <a href='contact.php'>Contacts</a>
                <a href='gestionSalarié.php'>Gestion Salariés</a>
                <a href='deconnexion.php'>Déconnexion</a>
                <?php 

    if (strcmp($_SESSION['fonction'], 'enseignant') == 0 || strcmp($_SESSION['fonction'], 'administration') == 0){
        echo "<a href='consultationCommentaire_salarie.php'>Commentaire</a>";
    }
    else {
        echo "<a href='consultationCommentaire_directeur.php'>Commentaires</a>";
    }

    if (strcmp($_SESSION['fonction'], 'enseignant') == 0 || strcmp($_SESSION['fonction'], 'administration') == 0) {
        echo "<a href='gestionConges_salaries.php'>Gestion Congés</a>";
    }
    if (strcmp($_SESSION['fonction'], 'directeur') == 0) {
        echo "<a href='gestionConges_directeur.php'>Gestion Congés</a>";
    }
    echo "<a href='ajout_CV.php'>test ajout CV</a>";

                ?>
            </nav>
        </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    </body>
        </br></br><footer>
        <div class="footerinfo">
            <h5>À PROPOS DE L'ESME SUDRIA</h5>
            <p>Fondée en 1905, l’école d'ingénieurs ESME Sudria forme en 5 ans des ingénieurs pluridisciplinaires, prêts à relever les défis technologiques du XXIe siècle : la transition énergétique, les véhicules autonomes, la robotique, les réseaux intelligents, les villes connectées, la cyber sécurité, et les biotechnologies.Trois composantes font la modernité de sa pédagogie : l’importance de l’esprit d’innovation ; l’omniprésence du projet et de l’initiative ; une très large ouverture internationale, humaine et culturelle. Depuis sa création, près de 15 000 ingénieurs ont été diplômés. L'école délivre un diplôme reconnu par l'Etat et accrédité par la CTI.</p>
        </div>
        <ul>
            <li>contact@esme.fr</li>
            <li>01 56 20 62 00</li>
        </ul>
    </footer>
</html>