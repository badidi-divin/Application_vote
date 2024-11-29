<?php 
session_start();

 require '../includes/dbconnect.php' ;

try {
    $Refprod= "GEI-" .rand(1000, 9999);
}

catch (Exception $e) {

}

try {
    $Refcmd= "CMDE-" .rand(1000, 9999);
}

catch (Exception $e) {

}

 $idart="";
  
if(isset($_GET['op']) AND $_GET['op']=="add_vente"){
	
	/*$req0=$bdd->prepare('select * from t_ligne_cmd where ref_cmd=?');
    $req0->execute(array($Refcmd));
	$ligne1=$req0->rowcount();*/
	$req1="";
	

    $req1=$bdd->prepare('select * from t_panier');
    $req1->execute(array());

	while($lignes=$req1->fetch()){
	$bd_mont_vers= htmlspecialchars(trim($_GET['mont_vers']));
	$bd_report_type=htmlspecialchars(trim($_GET['report_type']));
	$bd_reduc= htmlspecialchars(trim($_GET['reduc']));
    $bd_total_fac= htmlspecialchars(trim($_GET['total_fac']));
	$bd_nom_prod= htmlspecialchars(trim($lignes['desi_prod']));
	$bd_prix_prod= htmlspecialchars(trim($lignes['prix_unit']));
	$bd_ref_prod= htmlspecialchars(trim($lignes['ref_prod']));
	$bd_qte_achet=htmlspecialchars(trim($lignes['qte_achet']));
	$bd_client=htmlspecialchars(trim($lignes['client']));
	$bd_adrs_cli=htmlspecialchars(trim($lignes['adrs_cli']));
	$bd_devise=htmlspecialchars(trim($lignes['devise']));
	$bd_unite=htmlspecialchars(trim($lignes['unite']));
    $bd_old_stock=htmlspecialchars(trim($lignes['stock_prod']));

	$bd_mont_rend=$bd_mont_vers - $bd_total_fac;
	$bd_prix_tot= (double)$bd_qte_achet * (double)$bd_prix_prod;
	$bd_new_stock = $bd_old_stock - $bd_qte_achet;
		
	$bd_pan=htmlspecialchars(trim($lignes['id_pn']));

		$date_ajout=date('Y-m-d H:i:s');
		$bd_user=$_SESSION['user'];

    if (($bd_report_type=='FACT')) {
    	# code...
  
		$req_modif=$bdd->prepare("UPDATE t_produits SET stock=?, date_creat=? where ref_prod=?");
        $req_modif->execute(array($bd_new_stock,$date_ajout,$bd_ref_prod));
		
    }
		$req=$bdd->prepare("INSERT INTO t_ligne_cmd SET ref_cmd=?,ref_prod=?,desi_prod=?,prix_unit=?,qte_achet=?,prix_total=?,reduct=?,mont_verse=?,mont_rendu=?,total_fact=?,creer_le=?,client=?,adrs_cli=?,devise=?,unite=?,type_vente=?,user_name=?");
		$req->execute(array($Refcmd,$bd_ref_prod,$bd_nom_prod,$bd_prix_prod,$bd_qte_achet,$bd_prix_tot,
							$bd_reduc,$bd_mont_vers,$bd_mont_rend,$bd_total_fac,$date_ajout,$bd_client,$bd_adrs_cli,$bd_devise,$bd_unite,$bd_report_type,$bd_user));
        
		$req=$bdd->prepare("DELETE from t_panier where id_pn=?");
		$req->execute(array($bd_pan));
	}
		
    
		$json['message']="OK";	
		$json['Total_achat']=number_format( $bd_total_fac,1,',','.');
	    $json['Ref_cmd']=$Refcmd;

}


if(isset($_GET['op']) AND $_GET['op']=="add_panier"){

	$bd_nom_prod= htmlspecialchars(trim($_GET['nom_prod']));
	$bd_prix_prod= htmlspecialchars(trim($_GET['prix_prod']));
	$bd_ref_prod= htmlspecialchars(trim($_GET['ref_prod']));
	$bd_qte_achet= htmlspecialchars(trim($_GET['qte_vend']));
	$bd_qte_stock=htmlspecialchars(trim($_GET['txt_qte']));

	$bd_txt_client=htmlspecialchars(trim($_GET['txt_client']));
	$bd_txt_adrs=htmlspecialchars(trim($_GET['txt_adrs']));
	$bd_txt_devise=htmlspecialchars(trim($_GET['txt_devise']));
	$bd_unite_vend=htmlspecialchars(trim($_GET['unite_vend']));


	$req1=$bdd->prepare('select * from t_panier where ref_prod=?');
    $req1->execute(array($bd_ref_prod));
	if($count=$req1->rowcount()<=0){
		$date_ajout=date('d-m-Y H:i:s');
		$req=$bdd->prepare("INSERT INTO t_panier SET ref_prod=?,desi_prod=?,prix_unit=?,qte_achet=?,stock_prod=?, client=?,adrs_cli=?,devise=?,unite=?");
		$req->execute(array($bd_ref_prod,$bd_nom_prod,$bd_prix_prod,$bd_qte_achet,$bd_qte_stock,$bd_txt_client,$bd_txt_adrs,$bd_txt_devise,$bd_unite_vend));

		$json['message']="OK";	
		$json['nom_prod']=$bd_nom_prod;
	}
	else{
		$json['message']="error";	
	}
}

if(isset($_GET['op']) and $_GET['op']=="add"){
	
	$bd_ref_prod= htmlspecialchars(trim($_GET['ref_prod']));
    $bd_desi= htmlspecialchars(trim($_GET['desi']));
	$bd_frm_dose= htmlspecialchars(trim($_GET['frm_dose']));
	$bd_dci= htmlspecialchars(trim($_GET['dci']));
	$bd_fab_prod= htmlspecialchars(trim($_GET['fab_prod']));
	$bd_prix_achat= htmlspecialchars(trim($_GET['prix_achat']));
	$bd_prix_unit= htmlspecialchars(trim($_GET['prix_unit']));
	$bd_qte_stock= htmlspecialchars(trim($_GET['qte_stock']));
	$bd_date_prod= htmlspecialchars(trim($_GET['date_prod']));
	$bd_date_expi= htmlspecialchars(trim($_GET['date_expi']));
	$bd_categ= htmlspecialchars(trim($_GET['categ']));
	
	$req1=$bdd->prepare('select frm_dos from t_produits where ref_prod=?');
    $req1->execute(array($bd_ref_prod));
	if($count=$req1->rowcount()<=0){
		$date_ajout=date('d-m-Y H:i:s');
		$req=$bdd->prepare("INSERT INTO t_produits SET ref_prod=?, designation=?,dci=?,frm_dos=?,prix_gros=?,prix_unit=?,stock=?,date_prod=?,date_expirat=?,fabricant=?,date_creat=?,Lib_cat=?");
		$req->execute(array($bd_ref_prod,$bd_desi,$bd_dci,$bd_frm_dose,$bd_prix_achat,$bd_prix_unit,$bd_qte_stock,$bd_date_prod,$bd_date_expi,$bd_fab_prod,$date_ajout,$bd_categ));

		$json['message']="OK";	
		$json['prod_info']="Référence : ".$bd_ref_prod."| Medicament : ".strtoupper($bd_desi); 
		$json['new_ref']=$Refprod;
	}
	else{
		$json['message']="error";	
		$json['new_ref']=$Refprod;
	}
}

if(isset($_POST['qte_achet'])){
	$msg='';
	$bd_id_pn=$_POST['id_pan'];
	$bd_qte_achet=$_POST['qte_achet'];
	
	$req1=$bdd->prepare('select stock_prod from t_panier where id_pn=?');
    $req1->execute(array($bd_id_pn));
	$bd_stock=$req1->fetch()['stock_prod'];
	
	if($bd_qte_achet <=$bd_stock){
	$msg=1;
	$req=$bdd->prepare("Update t_panier SET qte_achet=? where id_pn=?");
	$req->execute(array($bd_qte_achet,$bd_id_pn));
		}else{$msg='0'.'|'.$bd_stock;}
	
	header('location:../ventes.php?msg='.$msg);
}

if(isset($_GET['op']) AND $_GET['op']=='clean_caddie'){
	
	$req=$bdd->prepare("Delete from t_panier");
	$req->execute(array());
	$json['message']="OK";
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

if(isset($_GET['del_prd'])){

	 $idpn=$_GET['del_prd'];
	 $query3=$bdd->prepare("DELETE FROM t_panier WHERE id_pn=?");
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
	   $json['nom_prod']=$_GET['prd'];
}

if(isset($_GET['op']) AND $_GET['op']=='del_vent'){

	 $idpn=$_GET['ref_cmd'];
	 $query3=$bdd->prepare("DELETE FROM t_ligne_cmd WHERE ref_cmd=?");
     $query3->execute(array($idpn));
 
	  // $json['table_panier']=$rows;
       $json['message']="OK";
	   $json['ref_cmd']=$_GET['ref_cmd'];
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

	 