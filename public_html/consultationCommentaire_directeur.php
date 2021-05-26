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
        <link href="page.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion commentaire</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>
       
<?php
    include("haut_page.php");

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
            
    <?php include("pied_de_page.php"); ?>
    </body>
</html>