<!DOCTYPE html>
<?php               

    include_once 'database.php';
    include 'authentification.html';
    
    $mdp=$_POST['mot_de_passe'];
    $identifiant=$_POST['login'];
    
    /*
    if (empty($mdp)) {
        echo "<script>alert(\"Mot de passe vide\")</script>";  
    }
    
    */

    $res = $database-> query("SELECT * FROM authentification where (identifiant='$identifiant' AND mdp='$mdp');");
    $res =$res->fetchall();
    $count=sizeof($res); 
    
    if ($count!=0) {
        session_start();
        $_SESSION['id']=$res[0]['id'];
        $_SESSION['identifiant']=$res[0]['identifiant']; 
        $_SESSION['mdp']=$res[0]['mdp'] ;
        $_SESSION['nom']=$res[0]['nom'] ;
        $_SESSION['prenom']=$res[0]['prenom']; 
        $_SESSION['mail']=$res[0]['mail'] ;
        $_SESSION['tel']=$res[0]['tel'] ;
        $_SESSION['contrat']=$res[0]['contrat']; 
        $_SESSION['situationFamiliale']=$res[0]['situationFamillial'] ;
        $_SESSION['adresse']=$res[0]['adresse'] ;
        $_SESSION['age']=$res[0]['age'] ;
        echo $_SESSION['situationFamiliale'];
        header("Location:http://localhost/projetSite_HTML/public_html/gestionProfil.php");
        
        
    }
    else{
        echo "<script>alert(\"Votre mot de passe est incorrect\")</script>";

    }
    
    

    
?>
