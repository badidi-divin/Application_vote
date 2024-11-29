<?php 

session_start();

$connexion = new PDO("mysql:host=localhost;dbname=gest_stock;","root","");

$json = array('error'=> true);
$User=htmlspecialchars(trim($_GET['User']));
$Pwd=htmlspecialchars((trim($_GET['Pwd'])));

 $verif=$connexion->prepare("SELECT * FROM t_user WHERE nom_ut=? AND pass=?");
 $verif->execute(array($User,$Pwd)); 

$compte=$verif->rowCount();
$af_user=$verif->fetch();

	if(!$compte==0)
	{
        $json['message'] = "OK";
        $_SESSION['id']=$af_user['id_cmd'];
        $_SESSION['user']=$af_user['nom_ut'];
        $json['user']=$af_user['nom_ut'];
	}
	else{
		$json['error']= false;
		$json['message']="Cette utilisateur n'existe pas dans la base de donnée.";
	}


echo json_encode($json);	
?>