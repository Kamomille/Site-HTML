<?php

include 'database.php';

echo $_POST['mois'];

if($connect) {
    
    $req = 'SELECT id FROM congé';
    $resultat = mysqli_query($connect, $req);
    if($resultat == false) echo "Echec de l'exécution de la requête";

    else{
        $compt = 0;
        while($ligne = mysqli_fetch_row($resultat)){
            $compt += 1;
            $numBouton_validé = "valider_" . "$compt";
            $numBouton_refuser = "refuser_" . "$compt";
            $numBouton_commentaire = "commentaire_" . "$compt";
            
            
            // ------------------ Valider un congé --------------------------
            
            if (isset($_POST[$numBouton_validé])){ 
                $req = "update congé set état = 'Validé' where id = $compt";
                $resultat = mysqli_query($connect, $req);
                header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php");
                break;
            }
            
            // ------------------ Refuser un congé --------------------------
            
            if (isset($_POST[$numBouton_refuser])){
                $req = "update congé set état = 'Refusé' where id = $compt";
                $resultat = mysqli_query($connect, $req);
                header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php");
                break;
            }
            
            // ------------------ Commenter --------------------------
            
            if (isset($_POST[$numBouton_commentaire])){
                echo 'vous avez appuyé sur le bouton '.$numBouton_commentaire;
                break;
            }
        }
    }
}

mysqli_close($connect);





?>

