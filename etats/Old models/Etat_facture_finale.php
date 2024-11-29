<?php
require('../includes/dbconnect.php');

$date1=date('Y-m-d');
$date2=date('Y-m-d');
$ref_cmd="";
$mode_impr=1;

 if(isset($_GET['ref'])){
     $ref_cmd=$_GET['ref'];   
 }

 $vue_ventes_par_ref="Select t_ligne_cmd.id_lgne,t_ligne_cmd.desi_prod, t_ligne_cmd.ref_cmd, t_ligne_cmd.client, t_ligne_cmd.adrs_cli,t_ligne_cmd.qte_achet,t_ligne_cmd.unite, t_ligne_cmd.prix_unit, t_ligne_cmd.devise, t_ligne_cmd.prix_total,t_ligne_cmd.creer_le, t_ligne_cmd.ref_prod, t_produits.ref_prod as prod_ref_prod, t_produits.Descript as descrip from t_ligne_cmd, t_produits where t_ligne_cmd.ref_prod=t_produits.ref_prod AND t_ligne_cmd.ref_cmd=? order by t_ligne_cmd.creer_le DESC";
  
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
    <title>G-PHARMA/IMPRESSION</title>

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
           <div class="float-left" style="margin-bottom: -15px;"> <!--h5 class="text-dark mb-1">MIRA-PHARMA</h5-->
                                    <img src="../img/entete.jpg" ></div>
                               
       <hr style="border: 2px double black;">
        <div class="float-right" style="float: right;">  <b>Kinshasa le : </b> <?php echo date('d-m-Y');?></div>
        </div>
        <br>
         <?php if($ligne=$req->fetch()){
                $client=$ligne['client'];
                $adrs=$ligne['adrs_cli'];
                 if ($ligne['devise']=='dollar'){ 
                            $dev_symbole1='USD'; $devise1='Dollars Américain';$dev_symbole2='$'; } 
                            else{  $dev_symbole1='CFD'; $devise1='Francs Congolais'; $dev_symbole2='FC';}
                }
                 ?>       
        <h5 ><u><center>FACTURE N°    <?php echo '00'.$ligne['id_lgne']."/". $dev_symbole1."/".date('d-m-Y');?> <hr style="margin-top:8px;margin-bottom: 0px;"></center></u></h5>              
        <?php  
        /*}
        else {*/
            
        ?>
       <?php  
        //}   
        ?>
         <br>
         <div class="float-left" style="float: left;">  
          Client : <b> <?php echo  $client;?></b><br>
          Adresse : <u> <?php echo $adrs;?></u>
          </div>

         <br><br><br>
       
        <table class="table table-bordered table-responsive-sm">
            <thead class="bg-default-gradient">
                <tr>
                  <th style="text-align: center;">N°</th>
                  <th style="text-align: center;">Désignation</th>
                  <th style="text-align: center;">Unité</th>
                  <th style="text-align: center;">Qtés</th>
                  <th style="text-align: center;">P.U($)</th>
                  <th style="text-align: center;">P.T($)</th>
                  <!--th style="text-align: center;">Fait le</th-->
                  </tr>
                </thead>
             <tbody>
                 <?php 
                      $today= date('d-m-Y');
                      $i=0;
                      while($lignes=$req->fetch()){
                       $i++;
                      ?>    
                                           <tr >
                                              <td style="text-align: center;"><?=$i;?></td>

                                              
                                              <td style="text-align: center;">
                                              <?=$lignes['desi_prod'];?></td>

                                              <td style="font-weight: bolder !important;"><?=$lignes['ref_cmd'];?></td>
                        
                                             <td style="text-align: center;">
                                                <?php echo $lignes['prix_unit'].' FC'; ?>
                                            </td>
                        
                                            <td style="text-align: center;">
                                                <?php echo "x".$lignes['qte_achet']; ?></a>
                                            </td>
                                            
                                             <td style="text-align: center;"><?php echo $lignes['prix_total'].' FC';?>
                                            </td>
                                            
                                            <!--td style="text-align: center;"><?php echo $lignes['creer_le'];?>                                       
                                            </td-->                    
                      
                                       </tr>

                                           <?php 
                                            $cpt_prix_U = $cpt_prix_U+$lignes['prix_unit'];
                                            $cpt_tot_stock =$cpt_tot_stock+$lignes['qte_achet'];
                                            $cpt_tot_vente =$cpt_tot_vente+$lignes['prix_total'];
                                           } ?>
                                         </tbody>
                                          <tfoot style="background: linear-gradient(179deg,#00b09b ,#96c93d 73%) !important; color:white;font-size: 10px !important;text-align: center !important;">
                                            <tr>
                                                <th colspan="2" style="text-align: center;"><?php echo $cpt_tot_stock." Produit(s)"; ?>)</th>
                                                  <th colspan="3" style="text-align: center; font-weight: bold;">Total P.U (<?php echo number_format($cpt_prix_U,0,',','.')." FC";?>)</th>
                                                   <th colspan="3" style="text-align: center;font-weight: bold;">Total General (<?php echo number_format($cpt_tot_vente,0,',','.')." FC";?>)</th>
                                                  </tr>
                                        </tfoot>
                
                                   </table>
                                  
                                 <div class="float-left" style="float: left; margin-bottom: 25px;">  
                                  Nous disons : <b> <?php echo "Dollars Americain";?></b><br><br><br>
                                  </div>
                              
                                                                    

    </div>

</section>

                               <footer> 
                                  <img src="../img/pied.jpg" > <br>
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