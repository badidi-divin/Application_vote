<?php
session_start();
$ref_cmd='';

if(!$_SESSION['user'])
{
    header('Location:index.php');
}

if(isset($_GET['logout'])=="yes"){
        session_destroy();
        header("location:index.php");
    }

require('../includes/dbconnect.php');
if(isset($_GET['ref'])){
$ref_cmd=$_GET['ref'];
$req=$bdd->prepare('Select * from t_ligne_cmd where ref_cmd=? order by creer_le');
$req->execute(array($ref_cmd));

}

$menu =1;
$cpt_tot_vente =0;
$cpt_reduc =0;
$cpt_mont_vers =0;
$cpt_mont_rend =0;

if(!isset($_SESSION['user'])){
   header('location:index.php');
}

try {
    $Refprod= "GEI-" .rand(100000, 99999);
}

catch (Exception $e) {

}

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
    <title>G-PHARMA/ PRINT</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper" >
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
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
        <div class="dashboard-wrapper" style= "margin-left: 210px !important; margin-right: 210px !important;">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!--div class="page-header">
                                <h2 class="pageheader-title">E-commerce Product Invoice </h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-coommerce</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Product Invoice</li>
                                        </ol>
                                    </nav>
                                </div-->
                            </div>
                        </div-->
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="offset-xl-2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header p-4">
                                     <a class="pt-2 d-inline-block" href="index.html">Concept</a>
                                   
                                    <div class="float-right"> <h3 class="mb-0">FACTURE n°<small> <?php echo $ref_cmd;?></small></h3>
                                    Date:  <?php echo date('d-m-Y');?></div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">De:</h5>                                            
                                            <h3 class="text-dark mb-1">Logo</h3>
                                             <!--img src="../img/logo_Ph.jpg" width=115px height=100px-->
                                            <!--div>2546 Penn Street</div>
                                            <div>Sikeston, MO 63801</div>
                                            <div>Email: info@gerald.com.pl</div>
                                            <div>Phone: +573-282-9117</div-->
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">à:</h5>
                                            <h3 class="text-dark mb-1">Client</h3>                                            
                                            <!--div>478 Collins Avenue</div>
                                            <div>Canal Winchester, OH 43110</div>
                                            <div>Email: info@anthonyk.com</div>
                                            <div>Phone: +614-837-8483</div-->
                                        </div>
                                    </div>
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>Libellé produit</th>
                                                    <th class="right">Prix</th>
                                                    <th class="center">Quantité </th>
                                                    <th class="right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
												$i=1;
												while($lignes=$req->fetch()){ ?>
                                                <tr>
                                                    <td class="center"><?=$i;?></td>
                                                    <td class="left strong"><?=$lignes['desi_prod'];?></td>
                                                    <td class="left"><?=$lignes['prix_unit'];?></td>
                                                    <td class="right"><?="X".$lignes['qte_achet'];?></td>
                                                    <td class="center"><?php echo number_format($lignes['prix_total'],0,',','.')." FC";?></td>
                                                </tr>
                                                <?php 
													$i++;
													$cpt_tot_vente =$lignes['total_fact'];
													$cpt_reduc =$lignes['reduct'];
													$cpt_mont_vers =$lignes['mont_verse'];
													$cpt_mont_rend =$lignes['mont_rendu'];
													
												 } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-sm-6">
                                        </div>
                                        <div class="col-lg-5 col-sm-6 ml-auto">
                                            <table class="table table-clear">
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Reduction :</strong>
                                                        </td>
                                                        <td class="right"><?php echo number_format($cpt_reduc,0,',','.')." FC";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Montant versé :</strong>
                                                        </td>
                                                        <td class="right"><?php echo number_format($cpt_mont_vers,0,',','.')." FC";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Reste :</strong>
                                                        </td>
                                                        <td class="right"><?php echo number_format($cpt_mont_rend,0,',','.')." FC";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Total :</strong>
                                                        </td>
                                                        <td class="right">
                                                            <strong class="text-dark"><?php echo number_format($cpt_tot_vente,0,',','.')." FC";?></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                  <tr> <td colspan="4"><p class="mb-0">Bonne Guérison !!</p></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <p class="mb-0">2020, République démocratique du congo.</p>
                                    <a class="Primary mg-b-10" href="../liste-ventes.php" style="background:#6a11cb;background: -webkit-linear-gradient(45deg, #6a11cb, #2575fc) !important;background: linear-gradient(45deg, #6a11cb ,#2575fc) !important; padding:10px; border-radius:5px;color:white;float:right;" title="Lancer l'impression" id="btn-print"><i class="fa fa-print"></i> Imprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <!--div class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                Copyright © 2020 Concept. Tous droits reservés. BM-DESIGN <a href="https://colorlib.com/wp/">ben7muz@gmail.com</a>.
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div-->
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