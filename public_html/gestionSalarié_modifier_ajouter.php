<?php 
    include 'database.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
       
$erreur="";
foreach($_GET as $key =>$val){
    if ($val=="erreur") $erreur=$erreur.$key."," ;
}
if ($erreur!=""){
    $erreur=substr($erreur,0,-1);
    echo "<script>alert(\"Les champs $erreur sont incorrectes\")</script>";
}    
?>



<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="gestionSalarié_modifier_ajouter.css">
    </head>
    <body>

 <?php       
        if ($_GET['id']!=0 && $_GET['id']!=NULL){
           $id=intval($_GET['id']);
           $req="SELECT nom,prenom,nationalite,adresse,age,sexe,situationFamiliale,tel,contrat,contratDuree_mois,id FROM authentification where id=?;";
           $res= mysqli_prepare($connect, $req);
           $var= mysqli_stmt_bind_param($res,'i',$id);
           $var= mysqli_execute($res); 
           $var = mysqli_stmt_bind_result($res,$nom,$prenom,$nationalite,$adresse,$age,$sexe,$situationFamiliale,$tel,$contrat,$contratDuree_mois,$id);
           mysqli_stmt_fetch($res);
           mysqli_stmt_close($res);
           $adresse= explode(",", $adresse);
        
        echo "<form method='post' action='gestionSalarié_vérification.php'>"
            ."<div class='EtatCivil'>"
               ." <h2>Etat civil</h2>"
                
                ."<label><strong>Nom</strong> </label>"
                ."<input type='text' name='nom' id='idtextnom' placeholder='Mon nom' value=$nom required>"
                ."</br><label for='idLine'>___________________________________________________________</label>"
                
                ."<br><br>"
                
                ."<label><strong>Prénom</strong> </label>"
                ."<input type='text' name='prenom' id='idtextprénom' placeholder='Mon prénom' value=$prenom required>"
                ."</br><label for='idLine'>___________________________________________________________</label>"
                
                ."<br><br>"    
                
                ."<label><strong>Nationalité</strong> </label>"
                ."<input type='text' name='nationalite' id='idnationalité' placeholder='Ma nationalité' value=$nationalite >"
                ."</br><label for='idLine'>___________________________________________________________</label>"
                
                
                .'<br><br>' 
                    
                ."<label ><strong>Age</strong> </label>"
                ."<input type='text' name='age' id='idage' placeholder='Mon age' value=$age >"  
                ."</br><label for='idLine'>___________________________________________________________</label>"
                
                .'<br><br>' 
                
                ."<label for='idsexe' ><strong>sexe</strong> </label>"
                ."<input type='radio' name='sexe' value=$sexe />"
                ."<label for='idsexe'>homme </label>"
                ."<input type='radio' name='sexe' value='femme' />"
                ."<label for='idsexe'>femme </label>"
                ."<input type='radio' name='sexe' value='autre'checked/>"
                ."<label for='idsexe'>autre</label>"
                
                .'<br><br>'
                
                ."<label><strong>situation familiale</strong></label>"
                ."<select name='situationFamiliale' value=$situationFamiliale >"
                    ."<option value=''></option>"
                    ."<option value='pacsé'>pacsé</option>"
                    ."<option value='marié'>marié</option>"
                    ."<option value='célibataire'>célibataire</option>"
                    ."<option value='divorcé'>divorcé</option>"
                ."</select>"
                
                ."<br><br>"
                
            .'</div>'
            
            ."<div class='Contact'>"
                ."<h2>Contact</h2>"
                
                ."<label for='idtéléphone'><strong>Téléphone</strong> </label>"
                ."<input type='phone' name='telephone' id='idTéléphone' placeholder='Mon numéro de téléphone' value=$tel required>"
                ."</br><label for='idLine'>___________________________________________________________</label>"

                ."<br><br>"   

                ."<label><strong>Adresse postale</strong> </label>"
                ."</br></br><label><strong>Code postale</strong> </label>"
                ."<input type='text' name='codePostal' placeholder='94200' value=$adresse[0]  >"  
                ."</br><label for='idLine'>___________________________________________________________</label>"
                ."</br><label><strong>Ville</strong> </label>"
                ."<input type='text' name='Ville' placeholder='Ivry' value=$adresse[1]  >"  
                ."</br><label for='idLine'>___________________________________________________________</label>"
                ."</br><label><strong>Rue</strong> </label>"
                ."<input type='text' name='Rue' placeholder='18 rue Molière' value=$adresse[2]  >"  
                ."</br><label for='idLine'>___________________________________________________________</label>"
                
                ."<br><br>"
                
                
            .'</div>'
         ."<div class='Fonction'>"
                ."<h2>Fonction</h2>"
                ."<label><strong>Contrat</strong></label>"
                ."<br><br>"
                

                .'<label id=contrat ><strong>Type de contrat</strong> </label>'
                .'<input type="radio" name="contrat" value="CDD" />'
                .'<label for="idsexe">CDD </label>'
                .'<input type="radio" name="contrat" value="CDI" />'
                .'<label for="idsexe">CDI </label></br></br>'
                .'</br></br>'
                .'<label id=contrat ><strong>Durée du contrat en mois(0 si CDI)</strong> </label>'
                ."<input type='text' name='contratDuree_mois' id='idcontrat' placeholder='Durée du contrat' value='$contratDuree_mois' >"
                ."</br><label for='idLine'>___________________________________________________________</label>"
        
                ."<br><br>"
                
                
            .'</div>'
            .'<div>'

                ."<input type='submit' name='$id'  id='idsubmit' class='submit'/>"
            .'</div>'
        .'</form>';
        
        }
        else{
            
       
        echo '<form method="post" action="gestionSalarié_vérification.php">'
            .'<div class="EtatCivil">'
               .' <h2>Etat civil</h2>'
                
                .'<label ><strong>Nom</strong> </label>'
                .'<input type="text" name="nom" id="idtextnom" placeholder="Mon nom" required/>'
                .'</br><label for="idLine">___________________________________________________________</label>'
                
                .'<br><br>'
                
                .'<label ><strong>Prénom</strong> </label>'
                .'<input type="text" name="prenom" id="idtextnom" placeholder="Mon prénom" required/>  '
                .'</br><label for="idLine">___________________________________________________________</label>'
                
                .'<br><br>'    
                
                .'<label ><strong>Nationalité</strong> </label>'
                .'<input type="text" name="nationalite" id="idnationalité" placeholder="Ma nationalité" />'
                .'</br><label for="idLine">___________________________________________________________</label>'
                
                .'<br><br>'     
                    
                .'<label ><strong>Age</strong> </label>'
                .'<input type="text" name="age" id="idage" placeholder="Mon age" />'  
                .'</br><label for="idLine">___________________________________________________________</label>'
                
                ."<br><br>"   
                
                .'<label for="idsexe" ><strong>sexe</strong> </label>'
                .'<input type="radio" name="sexe" value="homme" />'
                .'<label for="idsexe">homme </label>'
                .'<input type="radio" name="sexe" value="femme" />'
                .'<label for="idsexe">femme </label>'
                ."<input type='radio' name='sexe' value='autre' checked/>"
                ."<label for='idsexe'>autre</label>"
                
                ."<br><br>"
                
                .'<label><strong>situation familiale</strong></label>'
                .'<select name="situationFamiliale" >'
                    ."<option value=''></option>"
                    .'<option value="pacsé">pacsé</option>'
                    .'<option value="marié">marié</option>'
                    .'<option value="célibataire">célibataire</option>'
                    .'<option value="divorcé">divorcé</option>'
                .'</select>'
                
                .'<br><br>'
                
            ."</div>"
            
            .'<div class="Contact">'
                .'<h2>Contact</h2>'

                
                .'<label for="idAdresse" ><strong>Adresse</strong></label>'
                .'<input type="text" name="adresse" id="idAdresse" placeholder="Mon adresse" />'
                .'</br><label for="idLine">___________________________________________________________</label>'
                
                ."<br><br>"
                
                .'<label for="idtéléphone"><strong>Téléphone</strong> </label>'
                .'<input type="text" name="telephone" id="idTéléphone" placeholder="Mon numéro de téléphone" required/>'
                .'</br><label for="idLine">___________________________________________________________</label>'
                
                .'<br><br>'
                
                
            ."</div>"
         .'<div class="Fonction">'
                .'<h2>Fonction</h2>'
                .'<label><strong>Contrat</strong></label>'
                .'<br><br>'
                
                .'<label for="idcontrat" ><strong>Type de contrat</strong> </label>'
                .'<input type="text" name="contrat" id="idcontrat" placeholder="Mon contrat" />'
                .'<input type="text" name="contratDurée_mois" id="idcontrat" placeholder="Durée du contrat" />'
                .'</br><label for="idLine">___________________________________________________________</label>'
                
                .'<br><br>'
                
                .'<label for="idfonction"><strong>Fonction :</strong> </label>'
                .'<input type="radio" name="fonction" value="enseignant"  required/>  '
                .'<label for="idfonction">Enseignant </label>'
                .'<input type="radio" name="fonction" value="administration"  />'
                .'<label for="idfonction">Personnel administratif</label>'
                
                .'<br><br>'
                
                .'<label for="idembauche"><strong>Date d\'embauche</strong></label>'
                .'<input type="date" name="embauche" id="idembauche"/>'   
                
                .'<br><br>'
                
                
            ."</div>"
            ."<div>"

                .'<input type="submit" name="Envoyer" id="idsubmit" class="submit"/>'
            ."</div>"
        ."</form>";
        
        }
        ?>
    </body>
</html>
