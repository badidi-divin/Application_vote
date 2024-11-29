<?php
require('../includes/dbconnect.php');

$date1=date('Y-m-d');
$date2=date('Y-m-d');

$mode_impr=1;

 if(isset($_GET['date_d']) AND isset($_GET['date_f'])){
$date1=$_GET['date_d'];
$date2=$_GET['date_f'];  


 }

  $req=$bdd->prepare('Select * from t_ligne_cmd where SUBSTRING(t_ligne_cmd.creer_le,1,10)>=? AND SUBSTRING(t_ligne_cmd.creer_le,1,10)<=? order by creer_le DESC');
  $req->execute(array($date1,$date2));

$menu =2;
$cpt_tot_vente =0;
$cpt_prix_U =0;
$cpt_tot_stock =0;
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
</head>

<body style="font-family: RolandBecker-Light, sans-serif">  
<section class="invoice">
    <div class="col-md-7 col-md-offset-3">
        <div class="row">
           <div class="float-left"> <h5 class="text-dark mb-1">MIRA-PHARMA</h5>
                                    <img src="../img/logo_Ph.jpg" width=80px height=60px></div>
           <div class="float-right" style="float: right;">  <b>Date : </b> <?php echo date('d-m-Y');?></div>
                               
       <hr>
        </div>
        <?php  
        if($date1 == $date2){
            
        ?>
        <h4 ><center>RAPPORT DETAILLE DES VENTES DU : (<?php echo $date1?>)</center></h4>              
        <?php  
        }
        else {
            
        ?>
        <h4 ><center>RAPPORT DETAILLE DES VENTES DU : (<?php echo $date1.' AU : '.$date1;?>)</center></h4>
       <?php  
        }   
        ?>
        <hr style="border-color: #0b3e6f">
        <table class="table table-bordered table-responsive">
            <thead class="bg-default-gradient">
                <tr>
                  <th style="text-align: center;">#</th>
                  <th style="text-align: center;">Ref vente</th>
                  <th style="text-align: center;">Produit vendu</th>
                  <th style="text-align: center;">Prix unitaire</th>
                  <th style="text-align: center;">Quantité vendu</th>
                  <th style="text-align: center;">Total</th>
                  <th style="text-align: center;">Fait le</th>
                  </tr>
                </thead>
             <tbody>
                 <?php 
                      $today= date('d-m-Y');
                      $i=1;
                      while($lignes=$req->fetch()){
                      
                      ?>    
                                           <tr >
                                              <td style="text-align: center;"><?=$i;?></td>

                                              <td style="font-weight: bolder !important;"><?=$lignes['ref_cmd'];?></td>
                                              <td style="text-align: center;">
                                              <?=$lignes['desi_prod'];?></td>
                        
                                             <td style="text-align: center;">
                                                <?php echo $lignes['prix_unit'].' FC'; ?>
                                            </td>
                        
                                            <td style="text-align: center;">
                                                <?php echo "x".$lignes['qte_achet']; ?></a>
                                            </td>
                                            
                                             <td style="text-align: center;"><?php echo $lignes['prix_total'].' FC';?>
                                            </td>
                                            
                                            <td style="text-align: center;"><?php echo $lignes['creer_le'];?>                                       
                                            </td>                    
                      
                                       </tr>

                                           <?php 
                                            $cpt_prix_U = $cpt_prix_U+$lignes['prix_unit'];
                                            $cpt_tot_stock =$cpt_tot_stock+$lignes['qte_achet'];
                                            $cpt_tot_vente =$cpt_tot_vente+$lignes['prix_total'];
                                           } ?>
                                         </tbody>
                                          <tfoot style="background: linear-gradient(179deg,#00b09b ,#96c93d 73%) !important; color:white;font-size: 15px !important;text-align: center !important;">
                                            <tr>
                                                <th colspan="2" style="text-align: center;"><?php echo $cpt_tot_stock." Produit(s)"; ?>)</th>
                                                  <th colspan="3" style="text-align: center; font-weight: bold;">Total P.U (<?php echo number_format($cpt_prix_U,0,',','.')." FC";?>)</th>
                                                   <th colspan="3" style="text-align: center;font-weight: bold;">Total General (<?php echo number_format($cpt_tot_vente,0,',','.')." FC";?>)</th>
                                                  </tr>
                                        </tfoot>
                
                                   </table>

                                    <a class="Primary mg-b-10" href="../liste-ventes.php" style="background:#6a11cb;background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;background: linear-gradient(45deg, #6a11cb ,#2575fc) !important; padding:10px; border-radius:5px;color:white;margin:0 auto;" title="Lancer l'impression" id="btn-print"><i class="fa fa-print"></i> Imprimer</a>

    </div>

</section>
 
<script src="../js/jquery.min.js" type="application/javascript"></script>
<script>
  $('#btn-print').click(function(){
    print();
  })
       </script>
</body>
</html>