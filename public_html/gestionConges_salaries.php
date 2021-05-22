<?php 
session_start() ;
if(isset($_COOKIE)){
    $login=$_COOKIE['identifiant'];
    $id=$_COOKIE['id'];
    $nom=$_COOKIE['nom'];
    $prenom=$_COOKIE['prenom'];
}
?>
<html>
    <head>
        <title>Demande de congé</title>
        <meta charset="UTF-8">
        <meta name="Cédric Chhunon et Camille Bayon de Noyer" content="width=device-width, initial-scale=1.0">
        <link href="gestionSalarié_modifier_ajouter.css" rel="stylesheet" type="text/css">
        <link href="page.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/consultationCommentaire_salarie.php">Commentaire</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/index.html">Déconnexion</a>

        </nav>
        <header>
            <figure>
                <img src="image\logo_esme.png"/>
            </figure>
            </br>
        </header>
        
<?php


    include 'database.php';

// ------------------------- Nombre de jours restant ---------------------------------
    
    if($connect) {
        $req = 'SELECT id, congesRTT, congesPayes FROM authentification';
        $resultat = mysqli_query($connect, $req);
        if($resultat == false) echo "Echec de l'exécution de la requête";
        else{
            while($ligne = mysqli_fetch_row($resultat)){
                if ($_SESSION['id'] == $ligne[0]){
                    echo 'Nombre de RTT restant : '.$ligne[1].'<br>';
                    echo 'Nombre de congés payés restant : '.$ligne[2].'<br>';
                }
            }
        }  
    }
$date_demande=date("Y-m-d");
    
// ------------------------- Historique des demandes de congés ---------------------------------

    echo '<br>'.'<br>'.'<br>'.'Historique de vos demandes de congés'.'<br>'.'<br>';

    if($connect) {
        $req = 'SELECT personne, id, type, date_demande, date_congé, nbJour, état FROM congé';
        $resultat = mysqli_query($connect, $req);
        if($resultat == false) echo "Echec de l'exécution de la requête";

        else{
            echo "<table border='1px solid black'>"
                . "<td><label>Id congés</label></td>"
                ."<td><label>Type de congés</label></td>"
                ."<td><label>Date demande de congés</label></td>"
                ."<td><label>Date congé</label></td>"
                ."<td><label>Nb de jour</label></td>"
                ."<td><label>Etat</label></td>";

            while($ligne = mysqli_fetch_row($resultat)){
                if ($id == $ligne[0]){
                    echo "<tr>" 
                        ."<td><label>$ligne[1]</label></td>"
                        ."<td><label>$ligne[2]</label></td>"
                        ."<td><label>$ligne[3]</label></td>"
                        ."<td><label>$ligne[4]</label></td>"
                        ."<td><label>$ligne[5]</label></td>"
                        ."<td><label>$ligne[6]</label></td>";
                }
            }
            echo "</tr>"."</table>".'<br>'.'<br>'.'<br>'.'<br>';

        }

    }

        
// ----------------- Formulaire demande de congé ---------------------------------
        
    echo 'Formulaire pour ajouter une demande de congé'.'<br>'.'<br>';
        
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
                    ."<input type='radio' name='typeConges' value='CP' required/>"
                    ."<label for='idRadio'>RTT</label>"
                    ."<input type='radio' name='typeConges' value='RTT' required/> </br></br></td>"
            ."</tr>"
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