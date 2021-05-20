<?php

include 'database.php';

        
if ($_POST['ok']){ 
    $date =$_POST['mois'];
    header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php?date=$date");
}

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
                if (isset($_POST['mois'])){
                    $date =$_POST['mois'];
                    header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php?date=$date");}
                else {header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php");}
                break;
            }
            
            // ------------------ Refuser un congé --------------------------
            
            if (isset($_POST[$numBouton_refuser])){
                $req = "update congé set état = 'Refusé' where id = $compt";
                $resultat = mysqli_query($connect, $req);
                if (isset($_POST['mois'])){
                    $date =$_POST['mois'];
                    header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php?date=$date");}
                else {header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php");}
                break;
            }
            
            // ------------------ Commenter --------------------------
            
            if (isset($_POST[$numBouton_commentaire])){
                header("Location:http://localhost/projetSite_HTML/public_html/contact.php?obj");
                break;
            }
        }
    }
}

mysqli_close($connect);





?>

