
<?php

$bdd = new PDO('mysql:host=localhost; dbname=gest_stock', 'root', '');
$cours_id=$_GET['id'];
$pdfname= $bdd->prepare("Select * from archives where id=?");
$pdfname->execute(array($cours_id));
$donnee = $pdfname->fetch();
$pdf=$donnee['name'];

$file= "upload/$pdf";
$filename= "$pdf";
header('Content-type: application/pdf');
header('Content-Disposition: inline; filname="'.$filename.'"');
readfile($file);

?>

<html>
<head>
<title><?php echo $cours_id; ?></title>
    <head/>
<html/>