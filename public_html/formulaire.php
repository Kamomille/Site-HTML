<!DOCTYPE html>

<!-- -------------------------php---------------------------- -->
    <?php

        
    if (empty($_POST['mot_de_passe'])) {
        echo "<script>alert(\"Mot de passe vide\")</script>";  
    }
        
    if (isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] ==  "pinpin") {
        //echo "<script>alert(\"Mot de passe correct\")</script>";
        header("Location:http://localhost/projetSite_HTML/public_html/menu_salarie.html");
        
    }
    else{
        echo "<script>alert(\"Votre mot de passe est incorrect\")</script>";
    }
    
    ?>

<html>
         <!-- ------------------En tete----------------------------------- -->
    <head>
        <title>Bienvenue à l'esme</title>
        <meta charset="UTF-8">
        <meta name="Cédric Chhunon et Camille Bayon de Noyer" content="width=device-width, initial-scale=1.0">
        <link href="newcss.css" rel="stylesheet" type="text/css">
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
        
        <form method="post">
       
        <fieldset>
                <legend> Authentification </legend> 
                <table>
                <tr>
                    <td><label for="idRadio">Profil :</label></td>
                    <td><label for="idRadio">Salarié</label>
                        <input type="radio" name="RadioBouton" id="idRadio" value="valeurRadio" required/>
                        <label for="idRadio2">Directeur</label>
                        <input type="radio" name="RadioBouton" id="idRadio2" value="valeurRadio2" required/> </br></br></td>
                </tr>
                <tr> 
                    <td><label for="login">Login :</label></td>
                    <td><input type="text" id="fname" name="login" required></td>
                <tr>
                </tr>
                    <td><label for="mot de passe">Mot de passe :</label></td>
                    <td><input type="password" name="mot_de_passe" required/></td>
                   
                    
                </tr>
                </tr>
                    <td> </td>
                    <td><input type="submit" value="Valider" /></td>
                </tr>    
                
                </table>
            </fieldset>
    </body>
</html>

