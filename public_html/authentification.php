<!DOCTYPE html>
<?php               

    include_once 'database.php';
    include 'authentification.html';
    
    $saisie_mdp=$_POST['mot_de_passe'];
    $saisie_identifiant=$_POST['login'];
    $saisie_idRadio=$_POST['idRadio'];
    
    if (strcmp(authentification($saisie_mdp,$saisie_identifiant), 'FAUX') != 0) {

        header("Location:http://localhost/projetSite_HTML/public_html/menu.php");  
    }
    else{
        echo "<script>alert(\"Incorrect\")</script>";

    }
    
    
    
function authentification($saisie_mdp,$saisie_identifiant){
    include 'database.php';
    if($connect) {
        $req = 'SELECT id,identifiant, mdp, fonction FROM authentification WHERE (identifiant=? AND mdp=?);';
        $result = mysqli_prepare($connect,$req);
        $var= mysqli_stmt_bind_param($result,'ss',$saisie_identifiant,$saisie_mdp);
        $var=mysqli_execute($result);
        mysqli_stmt_bind_result($result,$id,$identifiant,$mdp,$fonction);
        $return = 'FAUX';
        
        while (mysqli_stmt_fetch($result)){
            if ($saisie_mdp==$mdp && $saisie_identifiant==$identifiant){
                echo "$id,$identifiant,$mdp,$fonction";
                echo $saisie_mdp;
                echo "$fonction";
                if (strcmp($_POST['idRadio'], 'Directeur') == 0 && strcmp($fonction, "directeur")==0){
                    $return='Directeur';
                    break;
                }
                if (strcmp($_POST['idRadio'], 'Salarié') == 0 && strcmp($fonction, "enseignant")==0){
                    $return='Salarié';
                    break;
                }
                if (strcmp($_POST['idRadio'], 'Salarié') == 0 && strcmp($fonction,"administration")==0){
                    $return='Salarié';
                    break;
                }

            }

        }
        if($return!='FAUX'){
            session_start();
            $_SESSION['id']=$id;
            $_SESSION['identifiant']=$identifiant;
            $_SESSION['role']=$return;
            $_SESSION['fonction']=$fonction;
            mysqli_stmt_close($result);
            mysqli_close($connect);            
        }

    }

    return $return;
}

    
?>
