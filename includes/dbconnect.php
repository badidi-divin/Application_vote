<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=gest_stock;charset=UTF8','root','');
}
catch(PDOException $e)
{
    die('Erreur : ' . $e->getMessage());
}

