<?php
session_start() ;
include 'database.php';

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

$req="SELECT * FROM authentification WHERE id=?;";
$result = mysqli_prepare($connect,$req);
$id=$_SESSION['id'];
$var= mysqli_stmt_bind_param($result,'i', $id);
$var=mysqli_execute($result);
mysqli_stmt_bind_result($result,$id,$identifiant,$mdp,$nom,$prenom,$tel,$contrat,$situationFamiliale,$adresse,$age,$fonction,$embauche,$congesRTT,$congesPayes,$contratDuree_mois,$nationalite,$sexe,$CV);


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
        <link href="page.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion de profil</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>
        <nav>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/consultationCommentaire.php">Commentaire</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <?php 
            if (strcmp($_SESSION['fonction'], 'enseignant') == 0 || strcmp($_SESSION['fonction'], 'administration') == 0) {
                echo '<a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>';
            }
            if (strcmp($_SESSION['fonction'], 'directeur') == 0) {
                echo '<a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionConges_directeur.php">Gestion de congé</a>';
               
            }
            ?>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/deconnexion.php">Déconnexion</a>

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
