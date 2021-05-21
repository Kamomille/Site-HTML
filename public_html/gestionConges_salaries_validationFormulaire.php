<?php
if(isset($_COOKIE)){
    $_SESSION['id']=$_COOKIE['id'];
    $_SESSION['identifiant']=$_COOKIE['identifiant'];
    $_SESSION['mdp']=$_COOKIE['mdp'];
    $_SESSION['fonction']=$_COOKIE['fonction'];    
}

session_start() ;
include 'database.php';


if($connect) {
    $personne=$_SESSION['id'];
    
    $req="SELECT congesPayes,congesRTT FROM authentification WHERE id=3;";
    $resultat = mysqli_prepare($connect,$req);
    mysqli_stmt_bind_result($resultat,$congesPayes,$congesRTT);
    $var= mysqli_execute($resultat);  

    if($resultat == false) echo "Echec de l'exécution de la requête";
    else {
        while (mysqli_stmt_fetch($resultat)){
            if ($congesPayes <= $_POST["nbJour"]) {
                echo "<script>alert(\"Votre solde est pas suffisant.\")</script>";
                //header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php");
            }
            else {conge_valide();}
        }
    }
    mysqli_stmt_close($resultat);
}

function conge_valide(){
 include 'database.php';
    if($connect) {
        $personne=$_SESSION['id'];
        $date_demande=date("Y-m-d");
        $date_congé=$_POST['date_congé'];
        $nbJour=$_POST['nbJour'];
        $type=$_POST['typeConges'];
        $état='';
        $destinataire='patron';

        $req="INSERT INTO congé(id,personne,date_congé,état,date_demande,nbJour,type,destinataire) VALUES(?,?,?,?,?,?,?,?)";
        $result = mysqli_prepare($connect,$req);
        $var= mysqli_stmt_bind_param($result,'issssiss',$id,$personne,$date_congé,$état,$date_demande,$nbJour,$type,$destinataire);
        $var= mysqli_execute($result);
        mysqli_stmt_close($result);

        header("Location:http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php");  
    }
}


?>