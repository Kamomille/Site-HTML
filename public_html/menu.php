<?php

session_start() ;
if(isset($_COOKIE)){
    $_SESSION['id']=$_COOKIE['id'];
    $_SESSION['identifiant']=$_COOKIE['identifiant'];
    $_SESSION['mdp']=$_COOKIE['mdp'];
    $_SESSION['role']=$_COOKIE['role'];
    $_SESSION['fonction']=$_COOKIE['fonction'];    
}
 else {
     header("Location:http://localhost/projetSite_HTML/public_html/index.html"); 
}

echo "<html>";
echo "<table>";
echo "<tr>";
    echo "<td><a href=gestionProfil.php>Gestion Profil</a></td>";
    echo "<td><a href='contact.php'>Contacts</a></td>";
    echo "<td><a href='gestionSalarié.php'>Gestion Salariés</a></td>";
    echo "<td><a href='deconnexion.php'>Déconnexion</a></td>";
    if ($_SESSION['role']=="Salarié"){
        echo "<td><a href='consultationCommentaire_salarie.php'>Consultation commentaire</a></td>";
    }
    else {
        echo "<td><a href='consultationCommentaire_directeur.php'>Consultation commentaire</a></td>";
    }

    if (strcmp($_SESSION['role'], 'Salarié') == 0) {
        echo "<td><a href='gestionConges_salaries.php'>Gestion Congés</a></td>";
    }
    if (strcmp($_SESSION['role'], 'Directeur') == 0) {
        echo "<td><a href='gestionConges_directeur.php'>Gestion Congés</a></td>";
    }
echo "</tr>";

echo "</table><html>";

?>