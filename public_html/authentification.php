<!DOCTYPE html>
<?php               

    include_once 'database.php';
    include 'authentification.html';
    
    $mdp=$_POST['mot_de_passe'];
    $identifiant=$_POST['login'];
    $idRadio=$_POST['idRadio'];
    

    $res = mysqli_query($connect,"SELECT * FROM authentification where (identifiant='$identifiant' AND mdp='$mdp');");
    $res = mysqli_fetch_all($res);
    $count=sizeof($res);
    
    if ($count!=0 && strcmp(authentification($mdp,$identifiant), 'FAUX') != 0) {
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
        echo "<script>alert(\"Incorrect\")</script>";

    }
    
    
    
function authentification($mdp,$identifiant){
    include 'database.php';
    if($connect) {
        $req = 'SELECT identifiant, mdp, fonction FROM authentification';
        $resultat = mysqli_query($connect, $req);
        if($resultat == false) echo "Echec de l'exécution de la requête";

        else{
            $return = 'FAUX';
            while($ligne = mysqli_fetch_row($resultat)){
                if ($mdp==$ligne[1] && $identifiant==$ligne[0]){
                    if (strcmp($_POST['idRadio'], 'Directeur') == 0 && strcmp($ligne[2], "directeur")==0){
                        $return='directeur';
                        break;
                    }
                    if (strcmp($_POST['idRadio'], 'Salarié') == 0 && strcmp($ligne[2], "enseignant")==0){
                        $return='salarié';
                        break;
                    }
                    if (strcmp($_POST['idRadio'], 'Salarié') == 0 && strcmp($ligne[2],"administration")==0){
                        $return='salarié';
                        break;
                    }
                }
            }
        }
    }
    return $return;
}

    
?>
