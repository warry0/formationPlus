<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=formationplus;charset=utf8', 'root', '');
} 
catch(Exception $e) 
{
    die('Erreur : '.$e->getMessage());
}

 $message = $_POST['content'];
 $idConvention = $_POST['idConvention'];
 $idEtudiant = $_POST['idStudent'];

 $sql = "INSERT INTO attestations (id_etudiant, id_convention, content) VALUES(:idStu, :idconv, :content)";
 $result = $bdd->prepare($sql);
 $result->execute(array(
    ':idStu' => $idEtudiant,
    ':idconv' => $idConvention,
    ':content' => $message,
    
 ));
 $result->closeCursor();

 echo 'Attestation enregistrer dans la base de donnée.';
