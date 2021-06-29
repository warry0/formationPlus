<?php 
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=formationplus;charset=utf8', 'root', '');
    } 
    catch(Exception $e) 
    {
        die('Erreur : '.$e->getMessage());
    } 
?>


<form method="post" action="Envoie.php">
    <div>Etudiant :</div>

<?php 
   
    $listEtudiants = $bdd->query('SELECT j.id, j.nom, j.prenom,  p.nom as conventionName FROM etudiants as j 
    INNER JOIN conventions as p ON j.id_convention = p.id');
    $convention = $bdd->query('SELECT * FROM conventions');

     echo '<select name="student" >';
     while ($donnees = $listEtudiants->fetch())
     {
?>
    <option value="<?= $donnees['id']?>"><?= $donnees['nom'] . " " .$donnees['prenom']?></option>
<?php 
    
     }

    echo '</select>';
    echo '<input type="submit" value="envoyer" >';

    $listEtudiants->closeCursor();
?>
</form>