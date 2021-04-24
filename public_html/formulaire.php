<!DOCTYPE html>
<?php               
    
    include_once 'database.php';
    include 'formulaire.html';
    
    $mdp=$_POST['mot_de_passe'];
    $identifiant=$_POST['login'];
    
    /*
    if (empty($mdp)) {
        echo "<script>alert(\"Mot de passe vide\")</script>";  
    }
    
    */

    $res = $database-> query("SELECT COUNT(nom) FROM pilote where nom='$identifiant';");
    $count = $res->fetchColumn();

    
    if ($count!=0) {
        echo "<script>alert(\"Mot de passe correct\")</script>";
        header("Location:http://localhost/projetSite_HTML/public_html/menu_salarie.html");
    }
    else{
        echo "<script>alert(\"Votre mot de passe est incorrect\")</script>";

    }
    
    

    
?>
