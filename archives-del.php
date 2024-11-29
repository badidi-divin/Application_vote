<?php
session_start();

if(!$_SESSION['user'])
{
    header('Location:index.php');
}


require('includes/dbconnect.php');
include 'includes/taille.php';

if(isset($_GET['id']) AND isset($_GET['chemin'])){
    $id=$_GET['id'];
    $lien=$_GET['chemin'];

    $query = $bdd->prepare('DELETE FROM archives where fichier_url=?');
    $query->execute(array($lien));

    @unlink($lien);

     header('Location:archives.php');
}
