<?php

session_start() ;


// Vérification

function authentification(){
    include 'database.php';
    if($connect) {
        $req = 'SELECT identifiant, mdp, fonction FROM authentification';
        $resultat = mysqli_query($connect, $req);
        if($resultat == false) echo "Echec de l'exécution de la requête";

        else{
            $return = 'FAUX';
            while($ligne = mysqli_fetch_row($resultat)){
                if ($_SESSION['mdp']==$ligne[1] && $_SESSION['identifiant']==$ligne[0]){
                    if (strcmp($_SESSION['role'], 'Directeur') == 0 && $ligne[2] == "directeur"){
                        break;
                    }
                    if (strcmp($_SESSION['role'], 'Salarié') == 0 && $ligne[2] == "enseignant" || $ligne[2] == "administration"){
                        break;
                    }
                    else {
                        echo "<script>alert(\"incorrect\")</script>";
                    }
                }
            }
        }
    }
    return $return;
}

// menu

if (strcmp(authentification(), 'FAUX') != 0) {
    echo "<html>";
    echo "<table>";
    echo "<tr>";
        echo "<td><a href=gestionProfil.php>Gestion Profil</a></td>";
        echo "<td><a href='contact.php'>Contacts</a></td>";
        echo "<td><a href='gestionSalarié.php'>Gestion Salariés</a></td>";
        echo "<td><a href='consultationCommentaires.php'>Consultation commentaire</a></td>";
        if (strcmp(authentification(), 'salarié') == 0) {
            echo "<td><a href='gestionConges_salaries.php'>Gestion Congés</a></td>";
        }
        if (strcmp(authentification(), 'directeur') == 0) {
            echo "<td><a href='gestionConges_directeur.php'>Gestion Congés</a></td>";
        }
    echo "</tr>";

    echo "</table><html>";
}
 else {
    header("Location:http://localhost/projetSite_HTML/public_html/authentification.php");
}
?>