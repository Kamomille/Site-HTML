<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
session_start() ;
if(isset($_COOKIE)){
    $_SESSION['id']=$_COOKIE['id'];
    $_SESSION['identifiant']=$_COOKIE['identifiant'];
    $_SESSION['mdp']=$_COOKIE['mdp'];
    $_SESSION['fonction']=$_COOKIE['fonction'];  
    $_SESSION['nom']=$_COOKIE['nom'];
    $_SESSION['prenom']=$_COOKIE['prenom'];
}
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="gestionSalarié_modifier_ajouter.css">
    </head>
    <body>

        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Contact</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>
        <nav>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/consultationCommentaire_salarie.php">Commentaire</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/deconnexion.php">Déconnexion</a>

        </nav>
        <br>
        <!-- -------------------------Formulaire---------------------------- -->
        <form action='contact_envoie.php' method="post">
            <div class="Contact">
                <label><strong>Nouveau message</strong></label>

                <br><br>

                <label><strong>Auteur</strong> </label>
                <?php echo $_SESSION['nom'].' '.$_SESSION['prenom'] ?>
                </br><label>___________________________________________________________</label>

                <br><br>
                
                <label><strong>Mail</strong> </label>
                <?php echo $_SESSION['identifiant'] ?>
                </br><label>___________________________________________________________</label>

                <br><br>

                <label><strong>Objet</strong> </label>
                <input type="text" name="objet"  placeholder="Objet" value="
                        <?php if (isset($_GET['obj'])){echo 'Commentaire demande de congé';}elseif ($_GET!=null) echo "RE: ".$_GET['objet']?>" required/>
                </br><label>___________________________________________________________</label>

                <br><br>

                <label><strong>Message</strong> </label><br>
                <textarea name="message" placeholder="Mon message" required></textarea>

            </div>
            <div>
                <input type="submit" name="Envoyer" id="idsubmit" class="submit"/>
            </div>
        </form>
    </body>
</html>
