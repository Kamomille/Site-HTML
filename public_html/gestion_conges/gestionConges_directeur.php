
<?php
if(isset($_COOKIE)){
    $_SESSION['id']=$_COOKIE['id'];
    $_SESSION['identifiant']=$_COOKIE['identifiant'];
    $_SESSION['mdp']=$_COOKIE['mdp'];
    $_SESSION['fonction']=$_COOKIE['fonction'];
    if($_SESSION['fonction']=='directeur'){
        $_SESSION['role']='directeur';
    }
    else {
        $_SESSION['role']='salarie';
    }
}
?>

<html>
    <head>
        <title>Demande de congé</title>
        <meta charset="UTF-8">
        <meta name="Cédric Chhunon et Camille Bayon de Noyer" content="width=device-width, initial-scale=1.0">
        <link href="..\page.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <img src="..\image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion des congés</h1>  
            <img src="..\image\devise.jpg" class="devise">
        </header>
      
<?php 

//==============================================================================
//                              Tableau 1
//==============================================================================

include("..\haut_page.php");
include '..\database.php';

echo '<h1>Demande de congé en attente de validation</h1>';
echo "<form method='post' action='gestionConges_directeur_appuiBouton.php'>";
if (isset($_GET['date'])){ 
    $a=$_GET['date'];
    echo "<input type='month' name='mois' min='2018-03' value='$a'>";
}
else{echo "<input type='month' name='mois' min='2018-03'>";}

// nom colonne du tableau 
echo "<input type='submit' name='ok' value='ok'>"

    ."<table border='1px solid black'>"
    ."<th><label>Id congés</label></th>"
    ."<th><label>Id salariés</label></th>"
    ."<th><label>Type de congés</label></th>"
    ."<th><label>Date demande de congés</label></th>"
    ."<th><label>Date congé</label></th>"
    ."<th><label>Nb de jour</label></th>"
    ."<th><label>Etat</label></th>"
    ."<th colspan='2'><label>Actions possibles</label></th>";
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
    echo "<tr class='table'>" 
        ."<td class='table'><label>$id</label></td>"
        ."<td class='table'><label>$personne</label></td>"
        ."<td class='table'><label>$type</label></td>"
        ."<td class='table'><label>$date_demande</label></td>"
        ."<td class='table'><label>$date_congé</label></td>"
        ."<td class='table'><label>$nbJour</label></td>";
    if ($état == ""){
        echo "<td><label>$état</label></td>"
        . "<td><input type='submit' value='Valider le congé' name='$numBouton_validé' /></td>"
        . "<td><input type='submit' value='Refuser le congé' name='$numBouton_refuser' /></td>";
    }
    if ($état == "Refusé"){
        echo "<td bgcolor='red'><label>$état</label></td>"
        . "<td><input type='submit' value='Commenter' name='$numBouton_commentaire' /></td>"
        . "<td><label> </label></td>";
    }
    if ($état == "Validé"){
        echo "<td bgcolor='green'><label>$état</label></td>"
        . "<td><label> </label></td>"
        . "<td><label> </label></td>";
    }
    echo "</tr>";
}
   
//==============================================================================
//                              Tableau 2
//==============================================================================
       
echo '<h1>Tableau récapitulatif du nombres de jours de congé demandés</h1>';

$tab_id = array();
echo "<table border='1px solid black'>"
    ."<th><label> </label></th>";

if($connect) {
    $req="SELECT id FROM authentification
        WHERE id IN (
            SELECT personne
            FROM congé C
            JOIN authentification A ON A.id=C.personne);";
    $resultat = mysqli_prepare($connect,$req);
    mysqli_stmt_bind_result($resultat,$id);
    $var= mysqli_execute($resultat);  
    if($resultat == false) echo "Echec de l'exécution de la requête";
    else {
        while (mysqli_stmt_fetch($resultat)){
            array_push($tab_id, $id);
            echo "<th><label>$id</label></th>";
        }
    }
    mysqli_stmt_close($resultat);
}
echo "<tr  class='table'>"."<th><label>Congés payés</label></th>";
tableau_2($tab_id,'CP');
echo "</tr>"."<th><label>RTT</label></th>";
tableau_2($tab_id,'RTT');
echo "</table>";

function tableau_2($tab_id,$type_de_congé){
    include '..\database.php';
    for($i=0; $i<count($tab_id); $i++){
        $a = $tab_id[$i];
        if($connect) {
            $req="SELECT nbJour,état,type FROM congé WHERE personne = $a";
            $resultat = mysqli_prepare($connect,$req);
            mysqli_stmt_bind_result($resultat,$nbJour,$état,$type);
            $var= mysqli_execute($resultat);  
            if($resultat == false) echo "Echec de l'exécution de la requête";
            else {
                echo '<td  class="table"><label>';
                echo "<table>";
                while (mysqli_stmt_fetch($resultat)){
                    if (strcmp($type, $type_de_congé) == 0){
                        if ($état == ""){echo "<td  class='table'><label>$nbJour</label></td>";}
                        if ($état == "Refusé"){echo "<td bgcolor='red'  class='table'><label>$nbJour</label></td>";}
                        if ($état == "Validé"){echo "<td bgcolor='green'  class='table'><label>$nbJour</label></td>";}
                    }
                    else {echo "<td  class='table'><label> </label></td>";}
                }
                echo "</table>"."</label></td>";
            }
            mysqli_stmt_close($resultat);
        }
    }
    echo "</tr>";
    
    
}

/*
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
*/
?>
    <?php include("../pied_de_page.php"); ?>
    </body>
</html>