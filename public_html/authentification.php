<!DOCTYPE html>
<?php               

    include_once 'database.php';
    include 'authentification.html';
    
    $mdp=$_POST['mot_de_passe'];
    $identifiant=$_POST['login'];
    $idRadio=$_POST['idRadio'];
    
    /*
    if (empty($mdp)) {
        echo "<script>alert(\"Mot de passe vide\")</script>";  
    }
    
    */
    $res = mysqli_query($connect,"SELECT * FROM authentification where (identifiant='$identifiant' AND mdp='$mdp');");
    $res = mysqli_fetch_all($res);
    $count=sizeof($res);
    
    if ($count!=0) {
        session_start();
        $_SESSION['id']=$res[0][0];
        $_SESSION['identifiant']=$res[0][1]; 
        $_SESSION['mdp']=$res[0][2] ;
        $_SESSION['nom']=$res[0][3] ;
        $_SESSION['prenom']=$res[0][4]; 
        $_SESSION['mail']=$res[0][5] ;
        $_SESSION['tel']=$res[0][6] ;
        $_SESSION['contrat']=$res[0][7]; 
        $_SESSION['situationFamiliale']=$res[0][8] ;
        $_SESSION['adresse']=$res[0][9] ;
        $_SESSION['age']=$res[0][10] ;
        $_SESSION['fonction']=$res[0][11];
        $_SESSION['role']=$idRadio;
        header("Location:http://localhost/projetSite_HTML/public_html/menu.php");
        
        
    }
    else{
        echo "<script>alert(\"Votre mot de passe est incorrect\")</script>";

    }
    
    

    
?>
