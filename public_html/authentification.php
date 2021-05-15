<!DOCTYPE html>
<?php               

    include_once 'database.php';
    
    if(isset($_COOKIE['id'])){
        header("Location:http://localhost/projetSite_HTML/public_html/menu.php"); 
    }
    if(isset($_POST['login'])){
        $saisie_mdp=$_POST['mot_de_passe'];
        $saisie_identifiant=$_POST['login'];
        $saisie_idRadio=$_POST['idRadio'];

        if (strcmp(authentification($saisie_mdp,$saisie_identifiant), 'FAUX') != 0) {
            setcookie("identifiant",$_SESSION['identifiant'],time()+3600*24*2);
            setcookie("role",$_SESSION['role'],time()+3600*24*2);
            setcookie("id",$_SESSION['id'],time()+3600*24*2);
            header("Location:http://localhost/projetSite_HTML/public_html/menu.php");  
        }
        else{
            echo "<script>alert(\"Incorrect\")</script>";
        }        
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
                if (strcmp($_POST['idRadio'], 'Directeur') == 0 && strcmp($fonction, "directeur")==0){
                    $return='Directeur';
                    setcookie("mdp",$mdp,time()+3600*24*2);
                    break;
                }
                if (strcmp($_POST['idRadio'], 'Salarié') == 0 && strcmp($fonction, "enseignant")==0){
                    $return='Salarié';
                    setcookie("mdp",$mdp,time()+3600*24*2);
                    break;
                }
                if (strcmp($_POST['idRadio'], 'Salarié') == 0 && strcmp($fonction,"administration")==0){
                    $return='Salarié';
                    setcookie("mdp",$mdp,time()+3600*24*2);
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

<html>
    <head>
        <title>Bienvenue à l'esme</title>
        <meta charset="UTF-8">
        <meta name="Cédric Chhunon et Camille Bayon de Noyer" content="width=device-width, initial-scale=1.0">
        <link href="formulaire.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <figure>
                <img src="image\logo_esme.png"/>
            </figure>
            </br>
            Formulaire d'identification
        </header>
        <br>
        <!-- -------------------------Formulaire---------------------------- -->
        
        <form method="post" action="authentification.php">
       
        <fieldset>
                <legend> Authentification </legend> 
                <table>
                <tr>
                    <td><label for="idRadio">Profil :</label></td>
                    <td><label for="idRadio">Salarié</label>
                        <input type="radio" name="idRadio" id="idRadio" value="Salarié" required/>
                        <label for="idRadio2">Directeur</label>
                        <input type="radio" name="idRadio" id="idRadio2" value="Directeur" required/> </br></br></td>
                </tr>
                <tr> 
                    <td><label for="login">Login :</label></td>
                    <td><input type="text" id="fname" name="login" required></td>
                <tr>
                </tr>
                    <td><label for="mdp">Mot de passe :</label></td>
                    <td><input type="password" name="mot_de_passe" required/></td>
                   
                </tr>      
                <tr>
                    <td><input type="submit" value="Valider" name="submit" /></td>
                </tr>    
                
                </table>
            </fieldset>
    </body>
</html>