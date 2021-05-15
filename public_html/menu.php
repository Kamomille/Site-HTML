<?php

session_start() ;


echo "<html>";
echo "<table>";
echo "<tr>";
    echo "<td><a href=gestionProfil.php>Gestion Profil</a></td>";
    echo "<td><a href='contact.php'>Contacts</a></td>";
    echo "<td><a href='gestionSalarié.php'>Gestion Salariés</a></td>";
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