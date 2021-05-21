
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
            Demande de congé en attente de validation
        </header>
        <br>
        
      
<?php 

//==============================================================================
//                              Tableau 1
//==============================================================================

include 'database.php';

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

if($connect) {
    
    $req="SELECT id,personne,type,date_demande,date_congé,nbJour,état FROM congé;";
    $resultat = mysqli_prepare($connect,$req);
    mysqli_stmt_bind_result($resultat,$id,$personne,$type,$date_demande,$date_congé,$nbJour,$état);
    $var= mysqli_execute($resultat);
    if($resultat == false) echo "Echec de l'exécution de la requête";
    else {
        while ( mysqli_stmt_fetch($resultat)){
            $compt += 1;
            $numBouton_validé = "valider_" . "$compt";
            $numBouton_refuser = "refuser_" . "$compt";
            $numBouton_commentaire  = "commentaire_" . "$compt";
            $date1 = date_parse($date_demande);
            if (isset($_GET['date'])){
                $date2 = date_parse($_GET['date']);
                if ($date1['month'] == $date2['month'] || $_GET['date']==""){tableau($id,$personne,$type,$date_demande,$date_congé,$nbJour,$état, $numBouton_validé, $numBouton_refuser, $numBouton_commentaire);}}
            else {tableau($id,$personne,$type,$date_demande,$date_congé,$nbJour,$état, $numBouton_validé, $numBouton_refuser, $numBouton_commentaire);}
        } 
        echo "</table>".'<br>'.'<br>'.'<br>'.'<br>';
    }
    mysqli_stmt_close($resultat);
}

function tableau($id,$personne,$type,$date_demande,$date_congé,$nbJour,$état, $numBouton_validé, $numBouton_refuser, $numBouton_commentaire) {
    echo "<tr>" 
        ."<td><label>$id</label></td>"
        ."<td><label>$personne</label></td>"
        ."<td><label>$type</label></td>"
        ."<td><label>$date_demande</label></td>"
        ."<td><label>$date_congé</label></td>"
        ."<td><label>$nbJour</label></td>";
    if ($état == ""){
        echo "<td><label>$état</label></td>"
        . "<td><input type='submit' value='Valider le congé' name='$numBouton_validé' /></td>"
        . "<td><input type='submit' value='Refuser le congé' name='$numBouton_refuser' /></td>";
    }
    if ($état == "Refusé"){
        echo "<td bgcolor='red'><label>$état</label></td>"
        . "<td><input type='submit' value='Commenter' name='$numBouton_commentaire' /></td>";
    }
    if ($état == "Validé"){
        echo "<td bgcolor='green'><label>$état</label></td>";
    }
    echo "</tr>";
}
   
//==============================================================================
//                              Tableau 2
//==============================================================================
       
echo '<br>'.'<br>'.'Tableau récapitulatif du nombres de jours de congé demandés'.'<br>'.'<br>';

// remplissage des la liste personne -------------------------------------------
if($connect) {
    $req="SELECT id FROM authentification";
    $resultat = mysqli_prepare($connect,$req);
    mysqli_stmt_bind_result($resultat,$id);
    $var= mysqli_execute($resultat);  
    if($resultat == false) echo "Echec de l'exécution de la requête";
    else {
        $compt = 0;
        while (mysqli_stmt_fetch($resultat)){
            $tab[$compt][0]=$id;
            $compt += 1;
        }
    }
    mysqli_stmt_close($resultat);
}
          
// association des personnes et de leur identifiant de congé -------------------
if($connect) {
    $req="SELECT id, personne FROM congé;";
    $resultat = mysqli_prepare($connect,$req);
    mysqli_stmt_bind_result($resultat,$id, $personne);
    $var= mysqli_execute($resultat);
    if($resultat == false) echo "Echec de l'exécution de la requête";
    else {
        while ( mysqli_stmt_fetch($resultat)){
            for($i=0; $i<count($tab); $i++){
                if (strcmp($personne, $tab[$i][0]) == 0){
                    array_push($tab[$i], $id);
                }
            }
        }
    }
    mysqli_stmt_close($resultat);
}

// met en place la ligne avec les identifiants ---------------------------------
echo "<table border='1px solid black'>"
    ."<td><label> </label></td>";
for($i=0; $i<count($tab); $i++){
    if (count($tab[$i]) > 1){ //= le perso à fait au moins 1 demande
        $a=$tab[$i][0];
        echo "<td><label>$a</label></td>";
    }
}
echo "</tr>";

// met en place la ligne congé payés -------------------------------------------
echo "<td><label>Congés payés</label></td>";
for($i=0; $i<count($tab); $i++){
    if (count($tab[$i]) > 1){
        tableau_2($i,$tab,'CP');
    }
}
echo "</tr>";
// met en place la ligne RTT ---------------------------------------------------
echo "<td><label>RTT</label></td>";
for($i=0; $i<count($tab); $i++){
    if (count($tab[$i]) > 1){
        tableau_2($i,$tab,'RTT');
    }
}
echo "</tr></table>".'<br>'.'<br>'.'<br>'.'<br>';

// remplissage du nb de congés -------------------------------------------------

function tableau_2($i,$tab,$type_congé){
    include 'database.php';
    
    if($connect) {
        $a=$tab[$i][0];
        if (strcmp($type_congé, "CP") == 0){$req="SELECT nbJour,état FROM congé WHERE personne=$a AND type='CP';";}
        else{$req="SELECT nbJour,état FROM congé WHERE personne=$a AND type='RTT';";}
        $resultat = mysqli_prepare($connect,$req);
        mysqli_stmt_bind_result($resultat,$nbJour,$état);
        $var= mysqli_execute($resultat);  
        
        if($resultat == false) echo "Echec de l'exécution de la requête";
        else {
            $j=0;
            $tabTemporaire = array();
            while (mysqli_stmt_fetch($resultat)){
                $tabTemporaire[$j][0]=$a;
                $tabTemporaire[$j][1]=$nbJour;
                $tabTemporaire[$j][2]=$état;
                $j+=1;
            }
            if (count($tabTemporaire)==1){
                if (strcmp($tabTemporaire[0][2], "Refusé") == 0){echo "<td bgcolor='red'><label>$nbJour</label></td>";}
                elseif (strcmp($tabTemporaire[0][2], "Validé") == 0){echo "<td bgcolor='green'><label>$nbJour</label></td>";}
                elseif (strcmp($tabTemporaire[0][2], "") == 0){echo "<td><label>$nbJour</label></td>";}
                else{echo "<td><label> </label></td>";}
            }
            else{
                echo "<td><table>";
                for($j=0; $j<count($tabTemporaire); $j++){
                    $a=$tabTemporaire[$j][1];
                    if (strcmp($tabTemporaire[$j][2], "Refusé") == 0){echo "<td bgcolor='red'><label>$a</label></td>";}
                    elseif (strcmp($tabTemporaire[$j][2], "Validé") == 0){echo "<td bgcolor='green'><label>$a</label></td>";}
                    elseif (strcmp($tabTemporaire[$j][2], "") == 0){echo "<td border='1px><label>$a</label></td>";}
                    else{echo "<td><label> </label></td>";}
                }
                echo "</table></td>";
            }
        }
        mysqli_stmt_close($resultat);
    }
}

?>
        </body>
</html>