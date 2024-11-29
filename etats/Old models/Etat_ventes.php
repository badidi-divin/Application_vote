<?php 
require('../includes/dbconnect.php');

$date1="";
$date2="";

 if(isset($_GET['date_d']) AND isset($_GET['date_f'])){
$date1=$_GET['date_d'];
$date2=$_GET['date_f'];	 

}

$req=$bdd->prepare("select `gest_stock`.`t_produits`.`ref_prod` AS `ref_prod`,`gest_stock`.`t_ligne_cmd`.`desi_prod` AS `desi_prod`,`gest_stock`.`t_produits`.`prix_unit` AS `prix_unit`,`gest_stock`.`t_produits`.`stock` AS `stock`,sum(`gest_stock`.`t_ligne_cmd`.`qte_achet`) AS `total_qte`,(`gest_stock`.`t_produits`.`prix_unit` * sum(`gest_stock`.`t_ligne_cmd`.`qte_achet`)) AS `Prix_total`,`gest_stock`.`t_ligne_cmd`.`creer_le` AS `creer_le` from (`gest_stock`.`t_ligne_cmd` join `gest_stock`.`t_produits`) where (`gest_stock`.`t_produits`.`ref_prod` = `gest_stock`.`t_ligne_cmd`.`ref_prod`) AND SUBSTRING(t_ligne_cmd.creer_le,1,10)>=? AND SUBSTRING(t_ligne_cmd.creer_le,1,10)<=? group by `gest_stock`.`t_ligne_cmd`.`ref_prod` order by `gest_stock`.`t_ligne_cmd`.`desi_prod`");
$req->execute(array($date1, $date2));	


$menu =2;
$cpt_tot_vente =0;
$cpt_prix_U =0;
$cpt_tot_stock =0;


?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <title>G-stock | IMPRESSION</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <!--div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <!--div class="dashboard-header">
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <!--div class="nav-left-sidebar sidebar-dark">
           
        </div-->
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper" style="margin-right: 181px;
    margin-left: 20px;">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                   <div class="card-footer bg-white">
                                   
                                    <a class="Primary mg-b-10" href="../liste-ventes.php" style="background:#6a11cb;background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;background: linear-gradient(45deg, #6a11cb ,#2575fc) !important; padding:10px; border-radius:5px;color:white; margin-left:50%; font-size: 20px;" title="Lancer l'impression" id="btn-print"><i class="fa fa-print"></i> Imprimer</a>
                     </div>
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <!--div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">E-commerce Product Invoice </h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-coommerce</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Product Invoice</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div-->
                    <!-- ============================================================== -->
                    <!-- end pageheader  -offset-xl-2->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card" style="width: 160%;margin-left: -1px;">
                                <div class="card-header">
                                    <!--h3 class="text-dark mb-1">MIRA-stock<</div>/h3-->
                                 <center>   <img src="../img/entete.jpg" ></center>
                                    <!--div class="float-right"> <h3 class="mb-0">Date</h3>
                                    Date: 3 Dec, 2020</div-->
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-12 ">
                                            <?php if($date1==$date2){        ?>                            
                                           <h2 class="text-dark mb-1">RAPPORT PERIODIQUE DES VENTES DU : <?=$date1;?> </h2>
                                          <?php  }else{?>
                                            <h2 class="text-dark mb-1">RAPPORT JOURNALIER DES VENTES DU : <?=$date1;?> AU : <?=$date2;?></h2>
                                            <?php }?>
                                            <!--div>2546 Penn Street</div>
                                            <div>Sikeston, MO 63801</div>
                                            <div>Email: info@gerald.com.pl</div>
                                            <div>Phone: +573-282-9117</div-->
                                        </div>
                                        
                                    </div>
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">
                                            <thead>
                                                 <tr>
                                                    <th>Ref prod</th>
													<th>Nom du Produit vendu</th>
													<th>Prix unitaire</th>
													<th>Quantité total vendu</th>
													<th>Quantité restante </th>
													<th>Montant total vendu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
											$today= date('d-m-Y');
											
											while($lignes=$req->fetch()){ ?>
											
                                                <tr>
												    <td class="right"><?=$lignes['desi_prod'];?></td>
                                                    <td class="center"><?=$lignes['desi_prod'];?></td>
                                                    <td class="left strong"><?=$lignes['prix_unit']." FC";?></td>
                                                    <td class="left"><?="x".$lignes['total_qte']." Produits";?></td>
                                                    <td class="right"><?=$lignes['stock']." FC";?></td>
                                                    <td class="center"><?=$lignes['Prix_total']." FC";?></td>
                                                </tr>
                                               
                                                <?php 
											$cpt_prix_U = $cpt_prix_U+$lignes['total_qte'];
											$cpt_tot_stock =$cpt_tot_stock+$lignes['stock'];
											$cpt_tot_vente =$cpt_tot_vente+$lignes['Prix_total'];
											} ?>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-5">
                                        </div>
                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table class="table table-clear">
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Produits vendu(s)</strong>
                                                        </td>
                                                        <td class="right">(<?=$cpt_prix_U;?>)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Produits(s) restant(s)</strong>
                                                        </td>
                                                        <td class="right">(<?=$cpt_tot_stock;?>)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Total ventes</strong>
                                                        </td>
                                                        <td class="right">(<?=$cpt_tot_vente." FC";?>)</td>
                                                    </tr>
                                                  </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <p class="mb-0">2020, République démocratique du congo.</p>
                                    <a class="Primary mg-b-10" href="../liste-ventes.php" style="background:#6a11cb;background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;background: linear-gradient(45deg, #6a11cb ,#2575fc) !important; padding:10px; border-radius:5px;color:white; margin-left:50%; font-size: 20px;" title="Lancer l'impression" id="btn-print"><i class="fa fa-print"></i> Imprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <div class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <!--div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                Copyright © 2020 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                            </div-->
                            <!--div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div-->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- end wrapper  -->
            <!-- ============================================================== -->
        </div>
    </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
        <!-- jquery 3.3.1 -->
        <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <!-- bootstap bundle js -->
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <!-- slimscroll js -->
        <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
        <!-- main js -->
        <script src="../assets/libs/js/main-js.js"></script>
        <script>
        $('#btn-print').click(function(){
			print();
		})
		</script>
</body>
 
</html>