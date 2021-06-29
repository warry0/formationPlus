<?php
    try 
    {
        $bdd = new PDO('mysql:host=localhost;dbname=formationplus;charset=utf8', 'root', '');
    } 
    catch (Exception $e) 
    {
        die('Erreur : ' . $e->getMessage());
    }

    $idStudent = $_POST['student'];
    $convention = $bdd->query('SELECT etudiants.nom , etudiants.prenom, conventions.nom as conventionName, conventions.id as idConvention , conventions.nbHeur
        FROM etudiants, conventions
        WHERE etudiants.id_convention = conventions.id && etudiants.id = ' . $idStudent);
        
    $idConvention = null;
    $prenom = null;
    $nomConvention = null;
    $nomEtudiant = null;
    $nbHeure = null;

    while ($donnees = $convention->fetch()) 
    {
        $idConvention = $donnees['idConvention'];
        $prenom = $donnees['prenom'];
        $nomConvention = $donnees['conventionName'];
        $nomEtudiant = $donnees['nom'];
        $nbHeure = $donnees['nbHeur'];
    }
?>
    <form method="post" action="AjoutAttestation.php">
        Convention: <input type="text" name="convention" value=" <?=$nomConvention?>" disabled="disabled" />

        <p>Mail :</p>
        <textarea name="content" id="generate" cols="70" rows="14">
    <?="Bonjour " . $nomEtudiant . " " . $prenom . ",
Vous avez suivi " . $nbHeure . " heures de formation chez FormationPlus.
Pouvez-vous nous retourner ce mail avec la pièce jointe signée.

Cordialement,
FormationPlus"
?>
        </textarea>

        <input type="hidden" name="idStudent" value="<?=$idStudent?>" />
        <input type="hidden" name="idConvention" value="<?=$idConvention?>" />
        <button type="submit">Enregistrer</button>

    </form>
