
<html>
    <head>
        <title>Demande de congé</title>
        <meta charset="UTF-8">
        <meta name="Cédric Chhunon et Camille Bayon de Noyer" content="width=device-width, initial-scale=1.0">
        <link href="gestionSalarié_modifier_ajouter.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <figure>
                <img src="image\logo_esme.png"/>
            </figure>
            </br>
            Formulaire pour ajouter une demande de congé
        </header>
        <br>
        
        
  
<?php

        session_start() ;
        
        $prenom=$_SESSION['prenom'];
        $nom=$_SESSION['nom'];
        $login=$_SESSION['identifiant'];
        
        
        echo "<form method='post' action='gestionConges_salaries_validationFormulaire.php'>"
                ."<fieldset>"
                ."<legend>Demande de congé</legend>"
                ."<table>"
                ."<tr>" 
                    ."<td><label for='login'>Nom :</label></td>"
                    ."<td><label for='login'>$nom</label></td>"
                ."<tr>"
                ."<tr>"
                    ."<td><label for='login'>Prénom :</label></td>"
                    ."<td><label for='login'>$prenom</label></td>"
                ."<tr>"
                ."</tr>"
                    ."<td><label for='login'>Login :</label></td>"
                    ."<td><label for='login'>$login</label></td>"
                ."</tr>"  
                ."<tr>"
                    ."<td><label for='idRadio'>Type de congé  :</label></td>"
                    ."<td><label for='idRadio'>Congés payés</label>"
                        ."<input type='radio' name='typeConges' value='congesPaye' required/>"
                        ."<label for='idRadio'>RTT</label>"
                        ."<input type='radio' name='typeConges' value='RTT' required/> </br></br></td>"
                ."</tr>"
                ."<tr>" 
                    ."<td><label for='start'>Date de demande de congé :</label></td>"
                    ."<td><input type='date' id='date_demande' name='date_demande' placeholder='dd-mm-yyyy' value='2018-07-22' min='2018-01-01' max='2028-12-31' ></td>"
                ."<tr>"
                ."<tr>"
                    ."<td><label for='start'>Date de début de congé :</label></td>"
                    ."<td><input type='date' id='date_congé' name='date_congé' placeholder='dd-mm-yyyy' value='2018-07-22' min='2018-01-01' max='2028-12-31' ></td>"
                ."<tr>"
                ."<tr>"
                    ."<td><label for='login'>Nombre de jours de congés :</label></td>"
                    ."<td><input type='text' id='nbJour' name='nbJour' required></td>"
                ."<tr>"
                   
                ."<tr>"
                    ."<td><input type='submit' value='Valider' name='submit' /></td>"
                ."</tr>"    
                
                ."</table>"
            ."</fieldset>"
    
?>

        </body>
</html>