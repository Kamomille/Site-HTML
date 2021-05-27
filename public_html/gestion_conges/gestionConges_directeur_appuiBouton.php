<?php

include '..\database.php';

        
if (isset($_POST['ok'])){ 
    $date =$_POST['mois'];
    header("Location:http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_directeur.php?date=$date");
}

if($connect) {
    
    $req = 'SELECT id,personne FROM congé';
    $resultat = mysqli_query($connect, $req);
    if($resultat == false) echo "Echec de l'exécution de la requête";
   
    else{
        $compt = 0;
        
        while($ligne =mysqli_fetch_row($resultat)){
            
            $compt += 1;
            $numBouton_validé = "valider_" . "$compt";
            $numBouton_refuser = "refuser_" . "$compt";
            $numBouton_commentaire = "commentaire_" . "$compt";
            
            
            // ------------------ Valider un congé --------------------------
            
            if (isset($_POST[$numBouton_validé])){ 
                $req = "update congé set état = 'Validé' where id = $compt";
                $resultat = mysqli_query($connect, $req);
                reperage($compt);
                /*
                if (isset($_POST['mois'])){
                    $date =$_POST['mois'];
                    header("Location:http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_directeur.php?date=$date");
                    }
                else {header("Location:http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_directeur.php");}
                break;
                 
                 */
            }
            
            // ------------------ Refuser un congé --------------------------
            
            if (isset($_POST[$numBouton_refuser])){
                $req = "update congé set état = 'Refusé' where id = $compt";
                $resultat = mysqli_query($connect, $req);
                if (isset($_POST['mois'])){
                    $date =$_POST['mois'];
                    header("Location:http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_directeur.php?date=$date");}
                else {header("Location:http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_directeur.php");}
                break;
            }
            
            // ------------------ Commenter --------------------------
            
            if (isset($_POST[$numBouton_commentaire])){
                header("Location:http://localhost/projetSite_HTML/public_html/contact.php?id='$ligne[1]'&obj");
                break;
            }
        }
    }
}

mysqli_close($connect);


function reperage($id_conge){
    include '..\database.php';
    if($connect) {
        $req="SELECT personne,nbJour,type FROM congé WHERE id=$id_conge;";
        $resultat = mysqli_prepare($connect,$req);
        mysqli_stmt_bind_result($resultat,$personne,$nbJour,$type);
        $var= mysqli_execute($resultat);
        if($resultat == false) echo "Echec de l'exécution de la requête";
        else {
            while (mysqli_stmt_fetch($resultat)){
                echo $personne;
            }
        }
        mysqli_stmt_close($resultat);  
    }
    include '..\database.php';
    if($connect) {
        $req="SELECT congesRTT,congesPayes FROM authentification WHERE id=$personne;";
        $resultat = mysqli_prepare($connect,$req);
        mysqli_stmt_bind_result($resultat,$congesRTT,$congesPayes);
        $var= mysqli_execute($resultat);
        if($resultat == false) echo "Echec de l'exécution de la requête";
        else {
            while (mysqli_stmt_fetch($resultat)){
                echo $personne;
            }
        }
        mysqli_stmt_close($resultat);  
    }
    include '..\database.php';
    if($connect) {
        
        if (strcmp($type,'CP') == 0){
            
            $new = $congesPayes - $nbJour;
            $req = "update authentification set congesPayes=$new  where id=$personne";
            $resultat = mysqli_query($connect, $req);
        }
    }
    if($connect) {
        if (strcmp($type,'RTT') == 0){
            $new = $congesRTT - $nbJour;

            $req = "update authentification set congesRTT=$new  where id=$personne";
            $resultat = mysqli_query($connect, $req);
        }
    }
}
            /*
            $new = $nbJour - $congesPayes;
            $req="UPDATE authentification SET $congesPayes=$new  WHERE id=$personne;";
            $res= mysqli_prepare($connect, $req);
            $var= mysqli_stmt_bind_param($res,'i',$congesPayes);
            $var= mysqli_execute($res);
            mysqli_stmt_close($res); */

?>