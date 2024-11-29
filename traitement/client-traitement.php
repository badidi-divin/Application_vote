<?php 
session_start();

 require '../includes/dbconnect.php' ;

try {
    $Refprod= "ART-" .rand(100, 999);
}

catch (Exception $e) {

}

 $idart="";
   
if(isset($_GET['op']) AND $_GET['op']=="add_cat"){
	
	$bd_cat_prod= htmlspecialchars(trim($_GET['cat_prod']));
	
	$req1=$bdd->prepare('select * from t_categorie where lib_cat=?');
    $req1->execute(array($bd_cat_prod));
	if($count=$req1->rowcount()<=0){
		$date_ajout=date('d-m-Y H:i:s');
		$req=$bdd->prepare("INSERT INTO t_categorie SET lib_cat=?");
		$req->execute(array($bd_cat_prod));

		$json['message']="OK";	
		$json['prod_cat']=$bd_cat_prod;
	}
	else{
		$json['message']="error";	
	}
}
if(isset($_GET['op']) and $_GET['op']=="add"){
	
	$bd_client= htmlspecialchars(trim($_GET['client']));
    $bd_n_cli= htmlspecialchars(trim($_GET['n_cli']));
	$bd_adrs_cli= htmlspecialchars(trim($_GET['adrs_cli']));
	
	$req1=$bdd->prepare('select client from t_produits where client=?');
    $req1->execute(array($bd_client));
	if($count=$req1->rowcount()<=0){
		$date_ajout=date('d-m-Y H:i:s');
		$user=$_SESSION['user'];
		$req=$bdd->prepare("INSERT INTO t_client SET client=?, nom_client=?,adrs=?,user_id=?,etat=?");
		$req->execute(array($bd_client,$bd_n_cli,$bd_adrs_cli,$user,"1"));

		$json['message']="OK";	
		$json['prod_info']="CLient Ajouté : ".strtoupper($bd_client)." Adresse : ".strtoupper($bd_adrs_cli); 
		$json['new_ref']=$Refprod;
	}
	else{
		$json['message']="error";	
		$json['new_ref']=$Refprod;
	}
}

if(isset($_GET['op']) and $_GET['op']=="edit"){
	
	$bd_ref_prod= htmlspecialchars(trim($_GET['ref_prod']));
    $bd_desi= htmlspecialchars(trim($_GET['desi']));
	$bd_descrip= htmlspecialchars(trim($_GET['descrip']));
	//$bd_dci= htmlspecialchars(trim($_GET['dci']));
	//$bd_fab_prod= htmlspecialchars(trim($_GET['fab_prod']));
	$bd_prix_achat= htmlspecialchars(trim($_GET['prix_achat']));
	$bd_prix_unit= htmlspecialchars(trim($_GET['prix_unit']));
	$bd_qte_stock= htmlspecialchars(trim($_GET['qte_stock']));
	$bd_date_prod= htmlspecialchars(trim($_GET['date_prod']));
	//$bd_date_expi= htmlspecialchars(trim($_GET['date_expi']));
	$bd_categ= htmlspecialchars(trim($_GET['categ']));
	
		$date_ajout=date('d-m-Y H:i:s');
		$req=$bdd->prepare("UPDATE t_produits SET ref_prod=?, designation=?,Descript=?,prix_gros=?,prix_unit=?,stock=?,date_prod=?,Lib_cat=?, date_creat=? where ref_prod=?");
		$req->execute(array($bd_ref_prod,$bd_desi,$bd_descrip,$bd_prix_achat,$bd_prix_unit,$bd_qte_stock,$bd_date_prod,$bd_categ,$date_ajout,$bd_ref_prod));

		$json['message']="OK";	
		$json['prod_info']="Réf prod : ".$bd_ref_prod." | Medicament : ".strtoupper($bd_desi)." | Stock : "
		.$bd_qte_stock." | Prix gros : ".$bd_prix_achat." Fc | Prix unitaire : ".$bd_prix_unit." Fc | Categorie : ".$bd_categ; 
}

if(isset($_POST['qte_stock'])){
	
	$bd_id_prod=$_POST['id_prod'];
	$bd_stock=$_POST['qte_stock'];
	$req=$bdd->prepare("Update t_produits SET stock=? where id=?");
	$req->execute(array($bd_stock,$bd_id_prod));
	
	header('location:../medicaments.php?msg=1');
}



if(isset($_GET['id']) && isset($_SESSION['user'])){
    
     $client= $_SESSION['user'];
     $idart= $_GET['id'];
	 $Qte="1";
	 $tags=$_GET['tags'];
	 $idcat=$_GET['idcat'];

	 $query1=$bdd->prepare('select * from shop_panier where article=? and client=?');
     $query1->execute(array($idart,$client));
	 
	 if($Ligne=$query1->fetch()){
	 $idpn=$Ligne['id'];	 
	 $QTE2=$Ligne['quantite'];
	 $SQTE=$Qte+$QTE2;
	 $query2=$bdd->prepare('Update shop_panier set quantite=? where id=?');
     $query2->execute(array($SQTE, $idpn));
     $json['message']="OK";
	 /*if($idcat==2){
	 header("Location:wenze.php?id=".$idcat."&idscat=".$tags.""); 
	  }else{ 	 header("Location:wenze-autres.php?id=".$idcat."&idscat=".$tags.""); }*/
	 }
	 else{
	 $query3=$bdd->prepare('INSERT INTO shop_panier (client,article,quantite) VALUES (?,?,?)');
     $query3->execute(array($client,$idart,$Qte));
	 $json['message']="OK";
     /*if($idcat==2){
	  header("Location:wenze.php?id=".$idcat."&idscat=".$tags.""); 
	  }else{ header("Location:wenze-autres.php?id=".$idcat."&idscat=".$tags.""); }*/
	 }

	 $query1=$bdd->prepare('select sum(quantite) as total_prod from shop_panier where client=?');
     $query1->execute(array($client));
     $CptPanier=$query1->fetch()['total_prod'];
     
     if($CptPanier<10)
     $json["total_panier"]='0'.$CptPanier;
     else
     $json["total_panier"]=$CptPanier;
}
else{
   //$json['message'] = "error";
}

if(isset($_GET['spr_prd'])){

	 $idpn=$_GET['spr_prd'];
	 $query3=$bdd->prepare("UPDATE t_client SET etat=0 where id_cli=?");
     $query3->execute(array($idpn));
    /* if(isset($_SESSION['user'])){

		   $id= $_SESSION['user'];
		   $req1 = $bdd->prepare("SELECT * FROM vue_panier where client=?");
		   $req1->execute(array($id));
		   $i=1;
		   $cpt=0;

		   $col=0;
		   $rows='';
           header("location:panier.php?id=1?#corp");
		   /*while($data=$req1->fetch()) {

		   	$img=$data['image'];
		   	$id_pan=$data['id'];

			    $row="<tr><td class='product-thumbnail'><a href='#'><img src='images/wenze/w_produits/$img.jpg' alt='product img'/></a></td><td class='product-remove'><center><a class='btn-s uppercase btn btn-danger with-ico border-2 toggle-lyrics btn_supp' title='Supprimer ce produit de votre panier' style='border:2px solid #D50C0D;' href='panier-traitement.php?del=$id_pan'>X</a></td></tr>";
			     
			    $rows=$rows.$row;
                $json['tot']=$data['total_ttc'];
			    $i++;
			    $cpt=$cpt+$data['total_ttc'];
              
           }*/
	
	  // $json['table_panier']=$rows;
       $json['message']="OK";
	   $json['client']=$_GET['desi'];
}

if(isset($_GET['del_cat'])){

	 $idcat=$_GET['del_cat'];
	 $query1=$bdd->prepare("DELETE FROM t_produits WHERE Lib_cat=?");
     $query1->execute(array($idcat));

	 $query2=$bdd->prepare("DELETE FROM t_categorie WHERE lib_cat=?");
     $query2->execute(array($idcat));

       $json['message']="OK";
	   $json['nom_cat']=$_GET['del_cat'];
}

if(isset($_GET['op']) AND $_GET['op']==md5('submit')){
    
    $data['caddie']=$_POST['panier']['qte'];
    $data['prod']=$_POST['produits']['ids'];

    $client= $_SESSION['user'];
    $i=1;
    $Qte=0;
    $id_prod=0;

    foreach ($data['prod'] as $qte) {
        $id_prod=(int)$data['prod'][$qte];
            echo "PROD : ".$data['prod'][$qte]."<br/>";
            if($i<=sizeof($_POST['panier']['qte'])) {
            echo "COL : ".(int)$_POST['panier']['qte'][$i]."<br/>";
            $Qte=(int)$_POST['panier']['qte'][$i];
            }
        $Uptdate_cmd=$bdd->prepare("UPDATE shop_panier SET quantite=? where article=? AND client=?");
        $Uptdate_cmd->execute(array($Qte,$id_prod,$client));
      $i++;
     } 
    header("location:panier.php?id=".md5('1')."?#corp");
}


echo json_encode($json);
 ?>

	 