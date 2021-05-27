<?php
include 'database.php';
session_start();
?>
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
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
        if ($_GET['id']!=0 && $_GET['id']!=NULL){
           $id=intval($_GET['id']);
           $req="SELECT nom,prenom,nationalite,adresse,age,sexe,situationFamiliale,tel,contrat,contratDuree_mois,id,identifiant,mdp,fonction FROM authentification where id=?;";
           $res= mysqli_prepare($connect, $req);
           $var= mysqli_stmt_bind_param($res,'i',$id);
           $var= mysqli_execute($res); 
           $var = mysqli_stmt_bind_result($res,$nom,$prenom,$nationalite,$adresse,$age,$sexe,$situationFamiliale,$tel,$contrat,$contratDuree_mois,$id,$identifiant,$mdp,$fonction);
           mysqli_stmt_fetch($res);
           mysqli_stmt_close($res);
           $adresse= explode(",", $adresse);
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="gestionSalarié_modifier_ajouter.css">
    </head>
    <body>
        <?php include("haut_page.php");?>
        
        <form method='post' action='gestionSalarié_vérification.php' enctype = "multipart/form-data">
            <div class="CV">
                 <h2>CV</h2>
                 <label ><strong>Ajouter un CV</strong> </label>
                 <input type = "file" name = "CV"  />
                 <br><br> 
            </div>
            
            <div class='EtatCivil'>
               <h2>Etat civil</h2>
                
                <label><strong>Nom</strong> </label>
                <input type='text' name='nom' id='idtextnom' placeholder='Mon nom' value=<?php echo $nom; ?> required>
                </br><label for='idLine'>___________________________________________________________</label>
                
                <br><br>
                
                <label><strong>Prénom</strong> </label>
                <input type='text' name='prenom' id='idtextprénom' placeholder='Mon prénom' value=<?php echo $prenom; ?> required>
                </br><label for='idLine'>___________________________________________________________</label>
                
                <br><br>    
                
                <label><strong>Nationalité</strong> </label>
                <input type='text' name='nationalite' id='idnationalité' placeholder='Ma nationalité' value=<?php echo $nationalite; ?> >
                </br><label for='idLine'>___________________________________________________________</label>
                
                
                <br><br> 
                    
                <label ><strong>Age</strong> </label>
                <input type='text' name='age' id='idage' placeholder='Mon age' value=<?php echo $age; ?> >  
                </br><label for='idLine'>___________________________________________________________</label>
                
                <br><br> 
                
                <label for='idsexe' ><strong>sexe</strong> </label>
                <input type='radio' name='sexe' value='homme' <?php if ($sexe=="homme")echo "checked"; ?> />
                <label for='idsexe'>homme </label>
                <input type='radio' name='sexe' value='femme' <?php if ($sexe=="femme")echo "checked"; ?> />
                <label for='idsexe'>femme </label> 
                <input type='radio' name='sexe' value='autre' <?php if ($sexe=="autre")echo "checked"; ?> />
                <label for='idsexe'>autre</label>
                
                <br><br>
                
                <label><strong>situation familiale</strong></label>
                <select name='situationFamiliale' value=<?php echo $situationFamiliale; ?> >
                    <option value=''></option>
                    <option value='pacsé'>pacsé</option>
                    <option value='marié'>marié</option>
                    <option value='célibataire'>célibataire</option>
                    <option value='divorcé'>divorcé</option>
                </select>
                
                <br><br>
                
            </div>
            
            <div class='Contact'>
                <h2>Contact</h2>
                
                <label for='idtéléphone'><strong>Téléphone</strong> </label>
                <input type='phone' name='telephone' id='idTéléphone' placeholder='Mon numéro de téléphone' value=<?php echo $tel; ?> required>
                </br><label for='idLine'>___________________________________________________________</label>

                <br><br>   

                <label><strong>Adresse postale</strong> </label>
                </br></br><label><strong>Code postale</strong> </label>
                <input type='text' name='codePostal' placeholder='94200' value=<?php echo $adresse[0]; ?>  >  
                </br><label for='idLine'>___________________________________________________________</label>
                </br><label><strong>Ville</strong> </label>
                <input type='text' name='Ville' placeholder='Ivry' value=<?php echo $adresse[1]; ?>  >  
                </br><label for='idLine'>___________________________________________________________</label>
                </br><label><strong>Rue</strong> </label>
                <input type='text' name='Rue' placeholder='18 rue Molière' value=<?php echo $adresse[2]; ?>  >  
                </br><label for='idLine'>___________________________________________________________</label>
                
                <br><br>
                
                
            </div>
         <div class='Fonction'>
                <h2>Fonction</h2>
                
                <label id=contrat ><strong>Type de contrat : </strong> </label>
                <?php if($contrat=="CDD") {
                        echo "<input type='text' name='contrat' value=$contrat  readonly>";
                        echo '<label id=contrat ><strong>Durée du contrat en mois : </strong> </label>';
                        echo "<input type='text' name='contratDuree_mois' value=$contratDuree_mois  readonly>"  ;
                        echo '</br><label id=contrat ><strong>Poste : </strong> </label>';
                        echo $fonction ;

                    }
                ?> 
        
                <br><br>    
            </div>

         <div class='Identifiants'>
                <h2>Identifiants de connexion</h2>
                
                <label id=identifiant ><strong>Id : </strong> </label>
                <?php 
                    echo "<input type='text' name='id' value=$id  readonly>";
                    echo '</br></br><label ><strong>Identifiant : </strong> </label>';                    
                    echo "<input type='text' name='identifiant' value=$identifiant  readonly>";
                    echo '</br></br><label><strong>Mot de passe : </strong> </label>';
                    echo "<input type='text' name='mdp' placeholder='mot de passe' value=$mdp>";
                    echo "</br><label for='idLine'>___________________________________________________________</label>";
                ?> 
        
                <br><br>    
            </div>
            
            <div>
                <input type='submit' name=<?php echo $id; ?>  id='idsubmit' class='submit'/>
            </div>
        </form>
    </body>
</html>
