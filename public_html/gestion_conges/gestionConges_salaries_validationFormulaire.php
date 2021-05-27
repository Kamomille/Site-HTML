<?php
if(isset($_COOKIE)){
    $_SESSION['id']=$_COOKIE['id'];
    $_SESSION['identifiant']=$_COOKIE['identifiant'];
    $_SESSION['mdp']=$_COOKIE['mdp'];
    $_SESSION['fonction']=$_COOKIE['fonction'];    
}

session_start() ;
include '..\database.php';


if (isset($_POST['ok'])){ 
    $date_debut =$_POST['date_debut'];
    $date_fin =$_POST['date_fin'];
    header("Location:http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_salaries.php?date_debut=$date_debut&date_fin=$date_fin");
}

if (isset($_POST['submit'])){ 
    if($connect) {
        if (strcmp($_POST['typeConges'],'RTT') == 0) {
            $personne=$_SESSION['id'];
            $req="SELECT congesRTT FROM authentification WHERE id=$personne;";
            $resultat = mysqli_prepare($connect,$req);
            mysqli_stmt_bind_result($resultat,$congesRTT);
            $var= mysqli_execute($resultat); 
            if($resultat == false) echo "Echec de l'exécution de la requête";
            else {
                while (mysqli_stmt_fetch($resultat)){
                    if ($congesPayes < $_POST["nbJour_demande"]) {
                        echo "<script>alert(\"Votre solde est pas suffisant.\")</script>";
                    }
                    else {conge_valide();}
                }
            }
        }
        if (strcmp($_POST['typeConges'],'CP') == 0) {
            $personne=$_SESSION['id'];
            $req="SELECT congesPayes FROM authentification WHERE id=$personne;";
            $resultat = mysqli_prepare($connect,$req);
            mysqli_stmt_bind_result($resultat,$congesPayes);
            $var= mysqli_execute($resultat); 
            if($resultat == false) echo "Echec de l'exécution de la requête";
            else {
                while (mysqli_stmt_fetch($resultat)){
                    if ($congesPayes < $_POST["nbJour_demande"]) {
                        echo "<script>alert(\"Votre solde est pas suffisant.\")</script>";
                    }
                    else {conge_valide();}
                }
            }
        }
        mysqli_stmt_close($resultat);
    }
}

function conge_valide(){
 include '..\database.php';
    if($connect) {
        $personne=$_SESSION['id'];
        $date_demande=date("Y-m-d");
        $date_congé=$_POST['date_congé'];
        $nbJour=$_POST['nbJour_demande'];
        $type=$_POST['typeConges'];
        $état='';

        $req="INSERT INTO congé(id,personne,date_congé,état,date_demande,nbJour,type) VALUES(?,?,?,?,?,?,?)";
        $result = mysqli_prepare($connect,$req);
        $var= mysqli_stmt_bind_param($result,'issssis',$id,$personne,$date_congé,$état,$date_demande,$nbJour,$type);
        $var= mysqli_execute($result);
        mysqli_stmt_close($result);

        header("Location:http://localhost/projetSite_HTML/public_html/gestion_conges/gestionConges_salaries.php");  
    }
}


?>