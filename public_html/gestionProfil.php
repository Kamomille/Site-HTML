<?php 
session_start() ;
include 'database.php';


$req="SELECT * FROM authentification WHERE id=?;";
$result = mysqli_prepare($connect,$req);
$id=$_SESSION['id'];
$var= mysqli_stmt_bind_param($result,'i', $id);
$var=mysqli_execute($result);
mysqli_stmt_bind_result($result,$id,$identifiant,$mdp,$nom,$prenom,$tel,$contrat,$situationFamiliale,$adresse,$age,$fonction,$embauche,$congesRTT,$congesPayes,$contratDuree_mois,$nationalite,$sexe);


while (mysqli_stmt_fetch($result)){
   $res=[strval($id),$identifiant,$mdp,$nom,$prenom,strval($age),$nationalite,$sexe,$situationFamiliale,$adresse,$tel,$contrat,strval($contratDuree_mois),$fonction,$embauche,strval($congesRTT),strval($congesPayes)];
}

$entete=["Id : ","Identifiant : ","Mot de passe : ","Nom : ","Prénom : ","Age : ","nationalite : ","sexe","Situation familiale : ","Adresse postale : ","Téléphone : ","Contrat : ","Durée du contrat en mois : ","Fonction : ","Date d'embauche : ","congés RTT : ","congés Payés : "];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="gestionProfil.css"> -->
    </head>
    <body>
        <header>
            <img src="image\Esme_logo.png" class="esme">
            <h1 class="titre">Gestion de congé</h1>
        </header>
        <nav>
            <a class='nav' href="contact.html">Contactez-nous</a>
            <a class="nav" href="particulier.html">Particuliers</a> 
        </nav>
        <div class="mainLayout">
            <h1><?php echo $nom." ".$prenom ?>- Informations personnelles</h1>
            <table class="infoPerso">
                <tr>
                    <td><h1>Identifiant</h1>   </td>
                </tr>
             
<?php           
            for($i=0;$i<=2;$i++){
                echo '<tr>';
                echo "<td>$entete[$i]</td>";
                echo "<td>$res[$i]</td>";
                echo '</tr>';                
            }
       
?>
                </br></br>
                <tr>
                    <td><h1>Etat civil</h1>   </td>
                </tr>
             
<?php           
            for($i=3;$i<=8;$i++){
                echo '<tr>';
                echo "<td>$entete[$i]</td>";
                echo "<td>$res[$i]</td>";
                echo '</tr>';                
            }
       
?>

               </br></br>
                <tr>
                    <td><h1>Contact</h1>   </td>
                </tr>
             
<?php           
            for($i=9;$i<=10;$i++){
                echo '<tr>';
                echo "<td>$entete[$i]</td>";
                echo "<td>$res[$i]</td>";
                echo '</tr>';                
            }
       
?>


               </br></br>
                <tr>
                    <td><h1>Contrat</h1>   </td>
                </tr>
             
<?php           
            for($i=11;$i<=14;$i++){
                echo '<tr>';
                echo "<td>$entete[$i]</td>";
                echo "<td>$res[$i]</td>";
                echo '</tr>';                
            }
       
?>

               </br></br>
                <tr>
                    <td><h1>Congés</h1>   </td>
                </tr>
             
<?php           
            for($i=15;$i<=16;$i++){
                echo '<tr>';
                echo "<td>$entete[$i]</td>";
                echo "<td>$res[$i]</td>";
                echo '</tr>';                
            }
       
?>                    
                   <?php 
                   
                   echo "<td><a href=\"http://localhost/projetSite_HTML/public_html/gestionProfil_formulaire.php?id=$id\" >Modifier ses informations</a></td>"; ?>

                </tr>
            </table>
        </div>
                


        
        <div>
            
        </div>
    </body>
</html>
