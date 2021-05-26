 <?php
    session_start();
    include 'database.php';
    $check=false;

    if ($_POST!=NULL){
        
        foreach ($_POST as $key => $val){
            if($val=='supprimer'){
                $check=true;
            }
            break;
        }
        
        if ($check==true){
            foreach ($_POST as $key => $val){
                $req="DELETE FROM commentaire WHERE id=?";
                $res= mysqli_prepare($connect, $req);
                $var= mysqli_stmt_bind_param($res,'s', $key);
                $var= mysqli_execute($res); 
                mysqli_stmt_close($res);
            }
        }
    }
 ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="menu.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion commentaire</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>
        <nav>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/consultationCommentaire_salarie.php">Commentaire</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/deconnexion.php">Déconnexion</a>

        </nav>
        </br></br>
<?php


        $req="SELECT commentaire.id,personne,nom,prenom,identifiant,objet,message FROM commentaire JOIN authentification on authentification.id=personne ORDER BY commentaire.id DESC;";
        $result = mysqli_prepare($connect,$req);
        $var=mysqli_execute($result);
        mysqli_stmt_bind_result($result,$idCommentaire,$id,$nom,$prenom,$identifiant,$objet,$message);
 
        $res=[];
        while (mysqli_stmt_fetch($result)){
            $row=[strval($idCommentaire),strval($id),$nom,$prenom,$identifiant,$objet,$message];
            array_push($res,$row);
        }

?>
       

       <table border="1">
           <tr>
               <th>Sélection</th>
               <th>Id</th>
               <th>Prénom</th>
               <th>Nom</th>
               <th>Mail</th>
               <th>Objet</th>
               <th>Message</th>
               <th colspan="2">Opération</th>

           </tr>

               <form action="consultationCommentaire_directeur.php" method="post">
<?php
               foreach($res as $commentaire){

                    echo '<tr>';
                    echo "<td><input type='checkbox' name='$commentaire[0]' value='$commentaire[0]'</td>";
                    for($i=1;$i<sizeof($commentaire);$i++){
                        echo "<td>$commentaire[$i]</td>";
                    }
                    echo"<td><input type='submit' value='supprimer' name='$commentaire[0]'></td>";
                    echo"<td><a href='http://localhost/projetSite_HTML/public_html/contact.php?objet=$commentaire[5]' class='table'>Répondre</a></td>";
                    echo '</tr>';
               }
?>         </form> 
       </table>
            
       
    
    </br></br></br></br></br></br></br></br></br></br></br></br>
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
