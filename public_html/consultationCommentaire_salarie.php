 <?php
    session_start();
    include 'database.php';
    $check=false;

    if ($_POST!=NULL){
        $id=$_POST['id']; 
        foreach ($_POST as $key => $val){
            if($val=='supprimer'){
                $check=true;
            }
            break;
        }
        
        if ($check=true){
            foreach ($_POST as $key => $val){
                //mysqli_query($connect,"DELETE FROM commentaire WHERE id=$key");
                $req="DELETE FROM commentaire WHERE id=?";
                $result = mysqli_prepare($connect,$req);
                $var= mysqli_bind_param($result,'i',$key);
                $var=mysqli_execute($result);
                
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
    </head>
    <body>
        <?php
               
        
        $req="SELECT commentaire.id,personne,nom,prenom,identifiant,objet,message FROM commentaire JOIN authentification on authentification.id=personne WHERE authentification.id=? ORDER BY commentaire.id DESC;";
        $result = mysqli_prepare($connect,$req);
        $id=$_SESSION['id'];
        $var= mysqli_stmt_bind_param($result,'i',$id);
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
                    <th>Supprimer</th>
                    <th>Répondre</th>
                </tr>

                <form action="consultationCommentaire_salarie.php" method="post">
<?php 
                    foreach($res as $commentaire){

                        echo '<tr>';
                        echo "<td><input type='checkbox' name='$commentaire[0]' value='$commentaire[0]'</td>";
                            for($i=1;$i<sizeof($commentaire);$i++){
                                echo "<td>$commentaire[$i]</td>";
                            }
                            echo"<td><input type='submit' value='supprimer' name='$commentaire[0]'></td>";
                            echo"<td><input type='submit' value='répondre' name='$commentaire[0]'></td>";
                        echo '</tr>';
                }
?>
                </table>
            </form>
        
    </body>
</html>
