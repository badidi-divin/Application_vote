<?php
if (!(date('d-m-Y') == '04-02-2021')){
require('../includes/dbconnect.php');
require('../functions/function_convert.php');

$date1=date('Y-m-d');
$date2=date('Y-m-d');
$ref_cmd='';
$mode_impr=1;

 if(isset($_GET['ref'])){
     $ref_cmd=$_GET['ref'];   

 }

 $vue_ventes_par_ref="Select t_ligne_cmd.id_lgne,t_ligne_cmd.desi_prod, t_ligne_cmd.ref_cmd, t_ligne_cmd.client, t_ligne_cmd.adrs_cli,t_ligne_cmd.qte_achet,t_ligne_cmd.unite, t_ligne_cmd.prix_unit, t_ligne_cmd.devise, t_ligne_cmd.prix_total,t_ligne_cmd.creer_le, SUBSTRING(t_ligne_cmd.creer_le,1,10) AS date_fact, t_ligne_cmd.ref_prod, t_produits.ref_prod as prod_ref_prod, t_produits.Descript as descrip from t_ligne_cmd, t_produits where t_ligne_cmd.ref_prod=t_produits.ref_prod AND t_ligne_cmd.ref_cmd=? order by t_ligne_cmd.creer_le DESC";
  
  $req=$bdd->prepare($vue_ventes_par_ref);
  $req->execute(array($ref_cmd));

  $req2=$bdd->prepare($vue_ventes_par_ref);
  $req2->execute(array($ref_cmd));

$ligne='';
$dev_symbole1='';
$dev_symbole2='';
$devise1='';
$client='';
$adrs='';

$menu =2;
$cpt_tot_vente =0;
$cpt_prix_U =0;
$cpt_tot_stock =0;
 $cpt_tot_vente_dol=0;
  $cpt_tot_vente_fc=0;
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ets BAHEYKE</title>

    <link rel="icon" type="image/png" href="../assets/dist/img/©OLC 2014.jpg">
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="{{ asset('md/images/favicon/mstile-144x144.png') }}">

    <!-- Custome CSS-->
    <link href="../print/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../print/menu.css" rel="stylesheet" type="text/css" />
    <link href="../print/print.css" rel="stylesheet" type="text/css" media="print"/>
    <link href="../print/core.css" rel="stylesheet" type="text/css" />
    <link href="../print/components.css" rel="stylesheet" type="text/css" />
    <link href="../print/icons.css" rel="stylesheet" type="text/css" />
    <link href="../print/pages.css" rel="stylesheet" type="text/css" />
    <link href="../print/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../print/custom_print.css" rel="stylesheet" type="text/css" />
</head>

<body style="font-family: RolandBecker-Light, sans-serif; line-height: 1.2;">  
<section class="invoice">
    <div class="col-md-7 col-md-offset-3">
        <div class="row">
           <div class="float-left" style="margin-bottom: 140px; margin-left: 26px !important;"> <!--h5 class="text-dark mb-1">MIRA-PHARMA</h5-->
                                    <!--img src="../img/entete.jpg"--></div>
                               
       <!--hr style="border: 2px double #1A1B17;"-->
        <div class="float-right" style="float: right; margin-bottom:11%; font-size:1.0em;">  <b>Kinshasa le : </b> <?php echo date('d-m-Y');?></div>
        </div>
        <br>
            <?php if($ligne=$req->fetch()){

               $Convert1=explode("-",$ligne['date_fact']);
              //$Convert2=explode("-",$_POST['date_fin']);             
               $date1=$Convert1[1]."/".$Convert1[0];

                $client=$ligne['client'];
                $adrs=$ligne['adrs_cli'];
                 if ($ligne['devise']=='dollar'){ 
                            $dev_symbole1='USD'; $devise1='Dollars Américains';$dev_symbole2='$'; } 
                            else{  $dev_symbole1='CFD'; $devise1='Francs Congolais'; $dev_symbole2='FC';}
                }
                 ?>            
           <h5 class="text-dark mb-1" style="text-align: center;font-size:1.2em; letter-spacing: 0.1em;">PROFORMA N° 
            <?php echo '00'.$ligne['id_lgne']."/".$date1;?> <hr style="margin-top:8px;margin-bottom: 0px;"></h5>    
        
        <br>
         <div class="float-left" style="float: left;">  
          Client : <b> <?=$client;?></b><br>
          Adresse : <u> <?=$adrs;?></u>
          </div>

         <br><br><br>
        <table class="table table-bordered table-responsive-sm">
            <thead class="bg-default-gradient">
                <tr >
                  <th style="text-align: center;font-size:1.0em;">N°</th>
                  <th style="text-align: center; font-size:1.0em;">DESIGNATION</th>
                  <th style="text-align: center; font-size:1.0em;">CODE</th>
                  <th style="text-align: center; font-size:1.0em;">DESCRIPTIONS</th>
                  <th style="text-align: center; font-size:1.0em;">QTE</th>
                  <th style="text-align: center; font-size:1.0em;">UNITE</th>
                  <th style="text-align: center; font-size:1.0em;">P.U (<?=$dev_symbole1;?>)</th>
                  <th style="text-align: center; font-size:1.0em;">P.T (<?=$dev_symbole1;?>)</th>
                  <!--th style="text-align: center; font-size:0.9em;">DATE : HEURE</th-->
                  <!--th style="text-align: center;">Fait le</th-->
                  </tr>

             <tbody>
                 <?php 
                      $today= date('d-m-Y');
                      $i=0;
                     while($lignes=$req2->fetch()){
                        $i++;
                        if ($lignes['devise']=='dollar'){ 
                            $dev_symbole='$'; $devise='en dollar'; } 
                            else{  $dev_symbole='FC'; $devise='en franc'; }
                              ?>
                                           <tr >
                                           
                                            <td ><span style="text-align: center;"><center><?php
                                              if($i <'10'){echo  '0'.$i;} else{echo  $i;}?></td>
                          
                                            <td > <span style="font-weight: bolder;"><?=$lignes['desi_prod'];?></span></td>
                                            <td ><span style=""><center><?=$lignes['ref_prod'];?></span></td>
                                            <td ><span style=""><?=$lignes['descrip'];?></span></td>

                                            <td><center><?php echo $lignes['qte_achet']; ?></center></td>
                                            <td><center><?php echo $lignes['unite']; ?></td>

                                            <td><?php echo number_format($lignes['prix_unit'],1,',','.')." ".$dev_symbole; ?></td>
                                            
                                             <td>
                                                 <a><span style='font-size: 0.9em; padding: 6px 12px 6px 12px ; letter-spacing: 0.1em'><?php echo number_format($lignes['prix_total'],1,',','.')." ".$dev_symbole; ?></span></a>
                                            </td>
                                            
                                            <!--td><?php echo $lignes['creer_le'];?>                                       
                                            </td-->
                                       
                                            </tr>

                                           <?php 
                                            $cpt_prix_U = $cpt_prix_U+$lignes['prix_unit'];
                                            $cpt_tot_stock =$cpt_tot_stock+$lignes['qte_achet'];
                                        
                                              $cpt_tot_vente_dol=$cpt_tot_vente_dol+$lignes['prix_total'];  
                                               $cpt_tot_vente_fc =$cpt_tot_vente_dol+$lignes['prix_total'];
                                            
                                            } ?>
                                         </tbody>
                                          <tfoot style="background: linear-gradient(179deg,#00b09b ,#96c93d 73%) !important; color:white;font-size: 10px !important;text-align: center !important;">
                                            <tr >
                                                <th colspan="3"  style="text-align: center;"></th>
                                                  <th colspan="4" style="font-size:0.9em;text-align: left; font-weight: bold; letter-spacing: 0.1em;">NOMBRE TOTAL ARTICLE(S)</th>
                                                   <th colspan="2" style="text-align: right;font-weight:bold; font-size:0.9em;"><?php echo $cpt_tot_stock." Article (s)"; ?></th>
                                                  </tr>

                                                  <!--tr>
                                                      <th colspan="3" style="text-align: center;"> </th>
                                                    <th colspan="4" style="font-size:1.0em;text-align: left; font-weight: bold; letter-spacing: 0.1em; ">MOTANT TOTAL DES VENTES EN (CDF)</th>
                                                     <th colspan="2" style="text-align: right;font-weight:bold; font-size:1.0em;"><?php echo number_format($cpt_tot_vente_fc,0,',','.')." FC";?></th>
                                                  </tr-->

                                                  <tr>
                                                    
                                                     <th colspan="3" style="text-align: center;"></th>
                                                    <th colspan="4" style="font-size:0.9em;text-align: left; font-weight: bold; letter-spacing: 0.1em;">MOTANT TOTAL A PAYER EN (<?=$dev_symbole1;?>)</th>
                                                     <th colspan="2" style="text-align: right;font-weight: bold;letter-spacing: 0.1em; font-size:0.9em;"><?php echo number_format($cpt_tot_vente_dol,1,',','.')." ".$dev_symbole2;?></th>

                                                  </tr>
                                        </tfoot>
                
                                   </table>
                                  
                                 <div class="float-left" style="float: left; margin-bottom: 23px;">  
                                  Nous disons : <b> <?php echo $devise1; chifre_en_lettre($cpt_tot_vente_dol, $devise1='', $devise2='');?></b>
                                  </div><br><br><br>

                      <div class="float-right" style="float: right; line-height: 2.7; font-size: 0.8em;margin-bottom: 13%;">  
                       <b> VALIDITE</b>            : 7 JOURS<br>
                       <b>TERMES DE PAIEMENT</b>   : A FIXER APRES DISCUSSION AVEC CLIENT<br>
                       <b>DELAI DE LIVRAISON</b>   : A FIXER APRES DISCUSSION AVEC CLIENT<br>
                      </div>
                              
                                                                    

    </div>

</section>

                               <footer> 
                                  <!--img src="../img/pied.jpg" style="margin-left: 25px !important;"--> <br>
                                    <!--a class="Primary mg-b-10" href="../liste-ventes.php" style="background:#6a11cb;background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;background: linear-gradient(45deg, #6a11cb ,#2575fc) !important; padding:10px; border-radius:5px;color:white;margin:0 auto;" title="Lancer l'impression" id="btn-print"><i class="fa fa-print"></i> Imprimer</a-->
                                </footer>
 
<script src="../js/jquery.min.js" type="application/javascript"></script>
<script>
     print();
 // $('#btn-print').click(function(){
 
  //})
       </script>
</body>
</html>
<?php 
}
else{
  echo "<body><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><hr/><hr/><h1 style='color:red;'><center>"."OUPS! Période d'essai de 30 jours atteinte, veuillez acheter votre produit."."</center></h1><hr/><hr/></body>";
}
?>