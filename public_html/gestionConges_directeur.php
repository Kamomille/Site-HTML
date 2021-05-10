
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
            Demande de congé en attente de validation
        </header>
        <br>
        
      
<?php 

include 'database.php';

if($connect) {
    $req = 'SELECT id, personne, type, date_demande, date_congé, nbJour, état FROM congé';
    $resultat = mysqli_query($connect, $req);
    if($resultat == false) echo "Echec de l'exécution de la requête";
    
    else{      
       
        echo "<form method='post' action='gestionConges_directeur_appuiBouton.php'>";
        if (isset($_GET['date'])){ 
            $a=$_GET['date'];
            echo "<input type='month' name='mois' min='2018-03' value='$a'>";
        }
        else{echo "<input type='month' name='mois' min='2018-03'>";}

        // nom colonne du tableau 
        echo "<input type='submit' name='ok' value='ok'>"

            ."<table border='1px solid black'>"
            ."<td><label>Id congés</label></td>"
            ."<td><label>Id salariés</label></td>"
            ."<td><label>Type de congés</label></td>"
            ."<td><label>Date demande de congés</label></td>"
            ."<td><label>Date congé</label></td>"
            ."<td><label>Nb de jour</label></td>"
            ."<td><label>Etat</label></td>"
            ."<td colspan='2'><label>Actions possibles</label></td>";

        $compt = 0;

        while($ligne = mysqli_fetch_row($resultat)){
            $compt += 1;
            $numBouton_validé = "valider_" . "$compt";
            $numBouton_refuser = "refuser_" . "$compt";
            $numBouton_commentaire  = "commentaire_" . "$compt";

            $date1 = date_parse($ligne[3]);

            if (isset($_GET['date'])){ 
                $date2 = date_parse($_GET['date']);
                if ($date1['month'] == $date2['month']){tableau($ligne, $numBouton_validé, $numBouton_refuser, $numBouton_commentaire);}}
            else {tableau($ligne, $numBouton_validé, $numBouton_refuser, $numBouton_commentaire);}
        
        } 
        echo "</table>".'<br>'.'<br>'.'<br>'.'<br>';
    }
}

function tableau($ligne, $numBouton_validé, $numBouton_refuser, $numBouton_commentaire) {
    echo "<tr>" 
        ."<td><label>$ligne[0]</label></td>"
        ."<td><label>$ligne[1]</label></td>"
        ."<td><label>$ligne[2]</label></td>"
        ."<td><label>$ligne[3]</label></td>"
        ."<td><label>$ligne[4]</label></td>"
        ."<td><label>$ligne[5]</label></td>";
    if ($ligne[6] == ""){
        echo "<td><label>$ligne[6]</label></td>"
        . "<td><input type='submit' value='Valider le congé' name='$numBouton_validé' /></td>"
        . "<td><input type='submit' value='Refuser le congé' name='$numBouton_refuser' /></td>";
    }
    if ($ligne[6] == "Refusé"){
        echo "<td bgcolor='red'><label>$ligne[6]</label></td>"
        . "<td><input type='submit' value='Commenter' name='$numBouton_commentaire' /></td>";
    }
    if ($ligne[6] == "Validé"){
        echo "<td bgcolor='green'><label>$ligne[6]</label></td>";
    }
    echo "</tr>";
}

       
// Tableau 2 ------------------------------------------------------------------------------

echo '<br>'.'<br>'.'Tableau inutil mais demandé a la question 5.4.'.'<br>'.'<br>';

if($connect) {
    $req = 'SELECT id, personne, date_congé, état, date_demande, nbJour FROM congé';
    //$req2 = 'SELECT id, congésPayés, congésRTT FROM authentification';
    
    $resultat = mysqli_query($connect, $req);
    if($resultat == false) echo "Echec de l'exécution de la requête";
    
    else{
        
        
    
    echo "<form method='post' action='gestionConges_directeur_appuiBouton.php'>"
        ."<table border='1px solid black'>"
        ."<td><label> </label></td>";
            
    
    while($ligne = mysqli_fetch_row($resultat)){
         echo "<td><label>Id $ligne[1]</label></td>";
    }
   
    echo "<tr>"
        ."<td><label>Congés payés</label></td>"
        ."<td><label>Nombres congés</label></td>"
    ."</tr>"
    ."<tr>"
        ."<td><label>RTT</label></td>"
        ."<td><label>Nombres congés</label></td>"
        ."<td><label>Nombres congés</label></td>"
    ."</tr>";
        
    echo "</table>".'<br>'.'<br>'.'<br>'.'<br>';
        
    }
}

mysqli_close($connect);


?>
        </body>
</html>