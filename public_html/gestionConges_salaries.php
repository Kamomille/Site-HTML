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
        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion des congés</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>
        <nav>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/consultationCommentaire.php">Commentaire</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/deconnexion.php">Déconnexion</a>

        </nav>
        </br>
        
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
    echo "<form method='post' action='gestionConges_salaries_validationFormulaire.php'>";
    
    if (isset($_GET['date_debut'])&&isset($_GET['date_fin'])){ 
        $date_debut=$_GET['date_debut'];
        $date_fin=$_GET['date_fin'];
        echo "<input type='date' name='date_debut'  min='2018-03-01' value='$date_debut'>"
            ."<input type='date' name='date_fin' min='2018-03-01' value='$date_fin'>";
    }
    else {
        echo "<input type='date' name='date_debut' min='2018-03-01'>"
            ."<input type='date' name='date_fin' min='2018-03-01'>";
    }
    echo "<input type='submit' name='ok' value='ok'>";

    if($connect) {
        if (isset($_GET['date_debut'])&&isset($_GET['date_fin'])){ 
            $req = "SELECT personne, id, type, date_demande, date_congé, nbJour, état FROM congé WHERE date_congé BETWEEN '$date_debut' AND '$date_fin'";
            $resultat = mysqli_query($connect, $req);
        }
        else{
            $req = 'SELECT personne, id, type, date_demande, date_congé, nbJour, état FROM congé';
            $resultat = mysqli_query($connect, $req);
        }

        if($resultat == false) echo "Echec de l'exécution de la requête";

        else{
            echo "<table border='1px solid black'>"
                . "<th><label>Id congés</label></th>"
                ."<th><label>Type de congés</label></th>"
                ."<th><label>Date demande de congés</label></th>"
                ."<th><label>Date congé</label></th>"
                ."<th><label>Nb de jour</label></th>"
                ."<th><label>Etat</label></th>";

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
        
    echo "<fieldset>"
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
                    ."<input type='radio' name='typeConges' value='CP'/>"
                    ."<label for='idRadio'>RTT</label>"
                    ."<input type='radio' name='typeConges' value='RTT'/> </br></br></td>"
            ."</tr>"
            ."<tr>"
                ."<td><label for='start'>Date de début de congé :</label></td>"
                ."<td><input type='date' id='date_congé' name='date_congé' placeholder='dd-mm-yyyy' value='2018-07-22' min='2018-01-01' max='2028-12-31' ></td>"
            ."<tr>"
            ."<tr>"
                ."<td><label for='login'>Nombre de jours de congés :</label></td>"
                ."<td><input type='text' id='nbJour' name='nbJour'></td>"
            ."<tr>"

            ."<tr>"
                ."<td><input type='submit' value='Valider' name='submit' /></td>"
            ."</tr>"    

            ."</table>"
        ."</fieldset>"
    
?>

    </body>

    </br></br><footer>
        <div class="footerinfo">
            <h5>À PROPOS DE L'ESME SUDRIA</h5>
            <p>Fondée en 1905, l’école d'ingénieurs ESME Sudria forme en 5 ans des ingénieurs pluridisciplinaires, prêts à relever les défis technologiques du XXIe siècle : la transition énergétique, les véhicules autonomes, la robotique, les réseaux intelligents, les villes connectées, la cyber sécurité, et les biotechnologies.Trois composantes font la modernité de sa pédagogie : l’importance de l’esprit d’innovation ; l’omniprésence du projet et de l’initiative ; une très large ouverture internationale, humaine et culturelle. Depuis sa création, près de 15 000 ingénieurs ont été diplômés. L'école délivre un diplôme reconnu par l'Etat et accrédité par la CTI.</p>
        </div>
        <ul>
            <li>contact@esme.fr</li>
            <li>01 56 20 62 00</li>
        </ul>
    </footer>
</html>