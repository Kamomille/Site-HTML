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
        <nav>
            <a href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a href="http://localhost/projetSite_HTML/public_html/consultationCommentaire.php">Commentaire</a>
            <a href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <a href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>
            <a href="http://localhost/projetSite_HTML/public_html/index.html">Déconnexion</a>

        </nav>

 <?php       
        if ($_GET['id']!=0 && $_GET['id']!=NULL){
           $id=intval($_GET['id']);
           $req="SELECT identifiant,nom,prenom,nationalite,adresse,age,sexe,situationFamiliale,tel,contrat,contratDuree_mois,CV,id FROM authentification where id=?;";
           $res= mysqli_prepare($connect, $req);
           $var= mysqli_stmt_bind_param($res,'i',$id);
           $var= mysqli_execute($res); 
           $var = mysqli_stmt_bind_result($res,$identifiant,$nom,$prenom,$nationalite,$adresse,$age,$sexe,$situationFamiliale,$tel,$contrat,$contratDuree_mois,$CV,$id);
           mysqli_stmt_fetch($res);
           mysqli_stmt_close($res);
           $adresse= explode(",", $adresse);
        }
        $_FILES['image']['name']=$CV;
?>
        
        <form method='post' action='gestionSalarié_vérification.php'>
            <div class="CV">
                 <h2>CV</h2>
                 <label ><strong>Ajouter un CV</strong> </label>
                 <input type = "file" name = "image" />
                 <input type='text' value=<?php echo $CV; ?>>
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

                <label for='idtéléphone'><strong>Adresse mail</strong> </label>
                <input type='text' name='identifiant' placeholder='cedric.chhuon@esme.fr' value=<?php echo $identifiant; ?> required>
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
                <label><strong>Contrat</strong></label>
                <br><br>
                
                
                <label id=contrat ><strong>Type de contrat</strong> </label>
                
                <input type="radio" name="contrat" value="CDD" <?php if($contrat=="CDD") echo 'checked'; ?>  required/>
                <label>CDD </label>
                <input type="radio" name="contrat" value="CDI" <?php if($contrat=="CDI") echo 'checked'; ?> required/>
                <label>CDI </label></br></br>
                </br></br>
                <label id=contrat ><strong>Durée du contrat en mois(0 si CDI)</strong> </label>
                <input type='text' name='contratDuree_mois' id='idcontrat' placeholder='Durée du contrat' value="<?php echo $contratDuree_mois;?>" required >
                </br><label for='idLine'>___________________________________________________________</label>
        
                <br><br>
                
                
            </div>
            <div>

                <input type='submit' name=<?php echo $id; ?>  id='idsubmit' class='submit'/>
            </div>
        </form>
        
        
        
    </body>
</html>
