<?php
require('../includes/dbconnect.php');

$date1=date('Y-m-d');
$date2=date('Y-m-d');

$mode_impr=1;

 if(isset($_GET['date_d']) AND isset($_GET['date_f'])){
     $date1=$_GET['date_d'];
     $date2=$_GET['date_f'];
    
    

 }

  $req=$bdd->prepare("Select t_ligne_cmd.desi_prod, t_ligne_cmd.ref_cmd, t_ligne_cmd.qte_achet,t_ligne_cmd.unite, t_ligne_cmd.prix_unit, t_ligne_cmd.devise, t_ligne_cmd.prix_total,t_ligne_cmd.creer_le, t_ligne_cmd.ref_prod, t_produits.ref_prod as prod_ref_prod, t_produits.Descript as descrip from t_ligne_cmd, t_produits where t_ligne_cmd.ref_prod=t_produits.ref_prod AND SUBSTRING(t_ligne_cmd.creer_le,1,10)>=? AND SUBSTRING(t_ligne_cmd.creer_le,1,10)<=? order by desi_prod DESC");
  $req->execute(array($date1,$date2));

    $Convert1=explode("-",$_GET['date_d']);
    $Convert2=explode("-",$_GET['date_f']);
    
     $date1=date($Convert1[2].'-'.$Convert1[1].'-'.$Convert1[0]);
     $date2=date($Convert2[2].'-'.$Convert2[1].'-'.$Convert2[0]); 


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
    <title>G-STOCK/IMPRESSION</title>

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
           <div class="float-left" style="margin-bottom: -10px; margin-left: 26px !important;"> <!--h5 class="text-dark mb-1">MIRA-PHARMA</h5-->
                                    <img src="../img/entete.jpg" ></div>
                               
       <hr style="border: 2px double #1A1B17;">
        <div class="float-right" style="float: right; margin-bottom:10px; font-size:0.9em;">  <b>Kinshasa le : </b> <?php echo date('d-m-Y');?></div>
        </div>
        <br>
        <?php if($date1==$date2){        ?>                            
               <h5 class="text-dark mb-1" style="text-align: center;font-size:1.3em;">RAPPORT JOURNALIER DES VENTES (<?=$date1;?>) <hr style="margin-top:8px;"></h5>
              <?php  }else{?>
                <h5 class="text-dark mb-1" style="text-align: center;font-size:1.3em;">RAPPORT PERIODIQUE DES VENTES DU <?=$date1;?> AU <?=$date2;?> <hr style="margin-top:8px;"></h5>
        <?php }?>

        
        
       
        <table class="table table-bordered table-responsive-sm">
            <thead class="bg-default-gradient">
                <tr >
                  <th rowspan=3 style="text-align: center;font-size:0.8em;">N°</th>
                  <th style="text-align: center; font-size:0.8m;">DESIGNATION</th>
                  <th style="text-align: center; font-size:0.8em;">CODE</th>
                  <th style="text-align: center; font-size:0.8em;">DESCRIPTIONS</th>
                  <th style="text-align: center; font-size:0.8em;">QTE</th>
                  <th style="text-align: center; font-size:0.8em;">UNITE</th>
                  <th style="text-align: center; font-size:0.8em;">P.U (USD)</th>
                  <th style="text-align: center; font-size:0.8em;">P.T (USD)</th>
                  <th style="text-align: center; font-size:0.8em;">DATE:HEURE</th>
                  <!--th style="text-align: center;">Fait le</th-->
                  </tr>

             <tbody>
                 <?php 
                      $today= date('d-m-Y');
                      $i=0;
                     while($lignes=$req->fetch()){
                        $i++;
                        if ($lignes['devise']=='dollar'){ 
                            $dev_symbole='$'; $devise='en dollar'; } 
                            else{  $dev_symbole='FC'; $devise='en franc'; }
                              ?>
                                           <tr >
                                           
                                            <td ><span style="text-align: center;"><?=$i;?></td>
                          
                                            <td > <span style="font-weight: bolder;"><?=$lignes['desi_prod'];?></span></td>
                                            <td ><span style=""><?=$lignes['ref_cmd'];?></span></td>
                                            <td ><span style=""><?=$lignes['descrip'];?></span></td>

                                            <td><?php echo "x ".$lignes['qte_achet']; ?></td>
                                            <td><?php echo $lignes['unite']; ?></td>

                                            <td><?php echo number_format($lignes['prix_unit'],0,',','.')." ".$dev_symbole; ?></td>
                                            
                                             <td>
                                                 <a><span style='font-size: 0.9em; padding: 6px 12px 6px 12px ; letter-spacing: 0.1em'><?php echo number_format($lignes['prix_total'],0,',','.')." ".$dev_symbole; ?></span></a>
                                            </td>
                                            
                                            <td><?php echo $lignes['creer_le'];?>                                       
                                            </td>
                                       
                                            </tr>

                                           <?php 
                                            $cpt_prix_U = $cpt_prix_U+$lignes['prix_unit'];
                                            $cpt_tot_stock =$cpt_tot_stock+$lignes['qte_achet'];
                                         if ($lignes['devise']=='dollar'){ 
                                              $cpt_tot_vente_dol=$cpt_tot_vente_dol+$lignes['prix_total']; } 
                                              else{  $cpt_tot_vente_fc =$cpt_tot_vente_dol+$lignes['prix_total']; }
                                            ;
                                            } ?>
                                         </tbody>
                                          <tfoot style="background: linear-gradient(179deg,#00b09b ,#96c93d 73%) !important; color:white;font-size: 10px !important;text-align: center !important;">
                                            <tr >
                                                <th colspan="4"  style="text-align: center;"></th>
                                                  <th colspan="3" style="font-size:0.8em;text-align: left; font-weight: bold; letter-spacing: 0.1em;">NOMBRE TOTAL DU STOCK</th>
                                                   <th colspan="2" style="text-align: right;font-weight: bold;"><?php echo $cpt_tot_stock." Article (s)"; ?></th>
                                                  </tr>

                                                  <tr>
                                                      <th colspan="4" style="text-align: center;"> </th>
                                                    <th colspan="3" style="font-size:0.8em;text-align: left; font-weight: bold; letter-spacing: 0.1em;">MOTANT TOTAL DES VENTES EN (CDF)</th>
                                                     <th colspan="2" style="text-align: right;font-weight: bold;"><?php echo number_format($cpt_tot_vente_fc,0,',','.')." FC";?></th>
                                                  </tr>

                                                  <tr>
                                                    
                                                     <th colspan="4" style="text-align: center;"></th>
                                                    <th colspan="3" style="font-size:0.8em;text-align: left; font-weight: bold; letter-spacing: 0.1em;">MOTANT TOTAL DES VENTES EN (USD)</th>
                                                     <th colspan="2" style="text-align: right;font-weight: bold;letter-spacing: 0.1em;"><?php echo number_format($cpt_tot_vente_dol,0,',','.')." $";?></th>

                                                  </tr>
                                        </tfoot>
                
                                   </table>
                                  
                                 <div class="float-left" style="float: left; margin-bottom: 23px;">  
                                  Nous disons : <b> <?php echo "Dollars Americain";?></b><br><br><br>
                                  </div>
                              
                                                                    

    </div>

</section>

                               <footer> 
                                  <img src="../img/pied.jpg" style="margin-left: 25px !important;"> <br>
                                    <a class="Primary mg-b-10" href="../liste-ventes.php" style="background:#6a11cb;background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;background: linear-gradient(45deg, #6a11cb ,#2575fc) !important; padding:10px; border-radius:5px;color:white;margin:0 auto;" title="Lancer l'impression" id="btn-print"><i class="fa fa-print"></i> Imprimer</a>
                                </footer>
 
<script src="../js/jquery.min.js" type="application/javascript"></script>
<script>
  $('#btn-print').click(function(){
    print();
  })
       </script>
</body>
</html>