
<?php
if(isset($_COOKIE)){
    $fonction=$_COOKIE['fonction'];
}
?>

<nav>
    <a class="nav" href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
    <a class="nav" href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
    <a class="nav" href="http://localhost/projetSite_HTML/public_html/consultationCommentaire.php">Commentaire</a>
    <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
    <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
    <?php 
    if (strcmp($fonction, 'enseignant') == 0 || strcmp($fonction, 'administration') == 0) {
        echo '<a class="nav" href="http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_salaries.php">Gestion de congé</a>';
    }
    if (strcmp($fonction, 'directeur') == 0) {
        echo '<a class="nav" href="http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_directeur.php">Gestion de congé</a>';

    }
    ?>
    <a class="nav" href="http://localhost/projetSite_HTML/public_html/deconnexion.php">Déconnexion</a>

</nav>
</br></br></br>
