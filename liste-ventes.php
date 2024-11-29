<?php
session_start();

if(!isset($_SESSION['user'])){
   header('location:index.php');
}

if(isset($_GET['logout'])=="yes"){
        session_destroy();
        header("location:index.php");
    }

require('includes/dbconnect.php');

$date1=date('Y/m/d');
$date2=date('Y/m/d');
$mode_impr=1;

$critere2=" ";
$titre=" ";

if(isset($_GET['lst']) AND $_GET['lst']==1){
   $critere2=" type_vente='FACT' ";
   $titre="Factures";
}
else if(isset($_GET['lst']) AND $_GET['lst']==2){
    $critere2=" type_vente='BON' ";
    $titre="Bons de livraison";
}
else if(isset($_GET['lst']) AND $_GET['lst']==3){
    $critere2=" type_vente='PROFORMA' ";
     $titre="Proforma";
}

$req=$bdd->prepare('Select id_lgne, desi_prod, ref_cmd, client, adrs_cli, qte_achet, unite, prix_unit, devise, prix_total, SUBSTRING(t_ligne_cmd.creer_le,1,10) AS date_fact, ref_prod, type_vente from t_ligne_cmd where'.$critere2.'order by creer_le DESC');


if(isset($_POST['btn-refresh'])){
    $req=$bdd->prepare('Select id_lgne, desi_prod, ref_cmd, client, adrs_cli, qte_achet, unite, prix_unit, devise, prix_total, SUBSTRING(t_ligne_cmd.creer_le,1,10) AS date_fact, ref_prod, type_vente from t_ligne_cmd where'.$critere2.'order by creer_le DESC');
    $req->execute(array()); 
    $mode_impr=1;
}

if(isset($_POST['btn-print'])){
    if(!empty($_POST['date_debut']) AND !empty($_POST['date_fin'])){
     
    $Convert1=explode("/",$_POST['date_debut']);
    $Convert2=explode("/",$_POST['date_fin']);
    
     $date1=date($Convert1[2].'-'.$Convert1[1].'-'.$Convert1[0]);
     $date2=date($Convert2[2].'-'.$Convert2[1].'-'.$Convert2[0]); 
     header("location:etats/Etat_liste_ventes.php?date_d=".$date1."&date_f=".$date2);
 }
     
}

 $Caract=array('-',':');

if(isset($_POST['btn-rech'])){
 if(!empty($_POST['date_debut']) AND !empty($_POST['date_fin']) OR !empty($_POST['date_debut'])){
    $mode_impr=2;
		
    $Convert1=explode("/",$_POST['date_debut']);
    $Convert2=explode("/",$_POST['date_fin']);
    
     $date1=date($Convert1[2].'-'.$Convert1[1].'-'.$Convert1[0]);
     $date2=date($Convert2[2].'-'.$Convert2[1].'-'.$Convert2[0]); 

     $req=$bdd->prepare('Select * from t_ligne_cmd where SUBSTRING(t_ligne_cmd.creer_le,1,10)>=? AND SUBSTRING(t_ligne_cmd.creer_le,1,10)<=? order by creer_le DESC');
     $req->execute(array($date1,$date2));  
 }else{
  
 }
    
}else{
$req->execute(array());   
}


//$req_cat=$bdd->prepare('Select * from t_categorie');
//$req_cat->execute(array());

$menu =2;
$cpt_tot_vente =0;
$cpt_prix_U =0;
$cpt_tot_stock =0;
$cpt_tot_vente_dol=0;
$cpt_tot_vente_fc=0;

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
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>G-STOCK | Arcticles</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- x-editor CSS
		============================================ -->
    <link rel="stylesheet" href="css/editor/select2.css">
    <link rel="stylesheet" href="css/editor/datetimepicker.css">
    <link rel="stylesheet" href="css/editor/bootstrap-editable.css">
    <link rel="stylesheet" href="css/editor/x-editor-style.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="css/buttons.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="css/modals.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- forms CSS
    ============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
     <!-- select2 CSS
		============================================ -->
    <link rel="stylesheet" href="css/select2/select2.min.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- chosen CSS
		============================================ -->
    <link rel="stylesheet" href="css/chosen/bootstrap-chosen.css">
     <!-- style Alert CSS
		============================================ -->
    <link rel="stylesheet" href="css/alerts.css">

    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    
    
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
     <?php require('includes/sidebar.php'); ?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <!-- Header top-bar start-->
            <?php require('includes/header.php'); ?>
            <!-- Header top-bar end -->
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="index.html">Dashboard v.1</a></li>
                                                <li><a href="index-1.html">Dashboard v.2</a></li>
                                                <li><a href="index-3.html">Dashboard v.3</a></li>
                                                <li><a href="analytics.html">Analytics</a></li>
                                                <li><a href="widgets.html">Widgets</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="events.html">Event</a></li>
                                        <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li><a href="all-professors.html">All Professors</a>
                                                </li>
                                                <li><a href="add-professor.html">Add Professor</a>
                                                </li>
                                                <li><a href="edit-professor.html">Edit Professor</a>
                                                </li>
                                                <li><a href="professor-profile.html">Professor Profile</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demopro" href="#">Students <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demopro" class="collapse dropdown-header-top">
                                                <li><a href="all-students.html">All Students</a>
                                                </li>
                                                <li><a href="add-student.html">Add Student</a>
                                                </li>
                                                <li><a href="edit-student.html">Edit Student</a>
                                                </li>
                                                <li><a href="student-profile.html">Student Profile</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#democrou" href="#">Courses <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="democrou" class="collapse dropdown-header-top">
                                                <li><a href="all-courses.html">All Courses</a>
                                                </li>
                                                <li><a href="add-course.html">Add Course</a>
                                                </li>
                                                <li><a href="edit-course.html">Edit Course</a>
                                                </li>
                                                <li><a href="course-profile.html">Courses Info</a>
                                                </li>
                                                <li><a href="course-payment.html">Courses Payment</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demolibra" href="#">Library <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demolibra" class="collapse dropdown-header-top">
                                                <li><a href="library-assets.html">Library Assets</a>
                                                </li>
                                                <li><a href="add-library-assets.html">Add Library Asset</a>
                                                </li>
                                                <li><a href="edit-library-assets.html">Edit Library Asset</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demodepart" href="#">Departments <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demodepart" class="collapse dropdown-header-top">
                                                <li><a href="departments.html">Departments List</a>
                                                </li>
                                                <li><a href="add-department.html">Add Departments</a>
                                                </li>
                                                <li><a href="edit-department.html">Edit Departments</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demomi" href="#">Mailbox <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demomi" class="collapse dropdown-header-top">
                                                <li><a href="mailbox.html">Inbox</a>
                                                </li>
                                                <li><a href="mailbox-view.html">View Mail</a>
                                                </li>
                                                <li><a href="mailbox-compose.html">Compose Mail</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">Interface <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                                <li><a href="google-map.html">Google Map</a>
                                                </li>
                                                <li><a href="data-maps.html">Data Maps</a>
                                                </li>
                                                <li><a href="pdf-viewer.html">Pdf Viewer</a>
                                                </li>
                                                <li><a href="x-editable.html">X-Editable</a>
                                                </li>
                                                <li><a href="code-editor.html">Code Editor</a>
                                                </li>
                                                <li><a href="tree-view.html">Tree View</a>
                                                </li>
                                                <li><a href="preloader.html">Preloader</a>
                                                </li>
                                                <li><a href="images-cropper.html">Images Cropper</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Chartsmob" href="#">Charts <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Chartsmob" class="collapse dropdown-header-top">
                                                <li><a href="bar-charts.html">Bar Charts</a>
                                                </li>
                                                <li><a href="line-charts.html">Line Charts</a>
                                                </li>
                                                <li><a href="area-charts.html">Area Charts</a>
                                                </li>
                                                <li><a href="rounded-chart.html">Rounded Charts</a>
                                                </li>
                                                <li><a href="c3.html">C3 Charts</a>
                                                </li>
                                                <li><a href="sparkline.html">Sparkline Charts</a>
                                                </li>
                                                <li><a href="peity.html">Peity Charts</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Tablesmob" href="#">Tables <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Tablesmob" class="collapse dropdown-header-top">
                                                <li><a href="static-table.html">Static Table</a>
                                                </li>
                                                <li><a href="data-table.html">Data Table</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#formsmob" href="#">Forms <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="formsmob" class="collapse dropdown-header-top">
                                                <li><a href="basic-form-element.html">Basic Form Elements</a>
                                                </li>
                                                <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                                </li>
                                                <li><a href="password-meter.html">Password Meter</a>
                                                </li>
                                                <li><a href="multi-upload.html">Multi Upload</a>
                                                </li>
                                                <li><a href="tinymc.html">Text Editor</a>
                                                </li>
                                                <li><a href="dual-list-box.html">Dual List Box</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Appviewsmob" href="#">App views <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Appviewsmob" class="collapse dropdown-header-top">
                                                <li><a href="basic-form-element.html">Basic Form Elements</a>
                                                </li>
                                                <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                                </li>
                                                <li><a href="password-meter.html">Password Meter</a>
                                                </li>
                                                <li><a href="multi-upload.html">Multi Upload</a>
                                                </li>
                                                <li><a href="tinymc.html">Text Editor</a>
                                                </li>
                                                <li><a href="dual-list-box.html">Dual List Box</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Pagemob" class="collapse dropdown-header-top">
                                                <li><a href="login.html">Login</a>
                                                </li>
                                                <li><a href="register.html">Register</a>
                                                </li>
                                                <li><a href="lock.html">Lock</a>
                                                </li>
                                                <li><a href="password-recovery.html">Password Recovery</a>
                                                </li>
                                                <li><a href="404.html">404 Page</a></li>
                                                <li><a href="500.html">500 Page</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area" style="margin-left: 20px;">
                <div class="container-fluid" id="entete">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome" style="margin-bottom: -6px !important;">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="breadcome-heading">
                                            <h4>G-STOCK / Details-<?=$titre;?></h4>
                                        </div>
                                    </div>
                                    <form action="?lst=1" method="post">
                                  
                                   <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group data-custon-pick" id="data_2">
                                         <label style="color: black;font-weight: bold; text-align: center;">Du :</label>
                                        <div class="input-group date">

                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" value="<?php if(isset($_POST['date_debut'])) echo $_POST['date_debut']; else echo date('d/m/Y');?>" name="date_debut" id="date_debut" autocomplete=off required>
                                        </div>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group data-custon-pick" id="data_2">
                                         <label style="color: black; font-weight: bold;text-align: center;">Au:</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" value="<?php if(isset($_POST['date_fin'])) echo $_POST['date_fin']; else echo date('d/m/Y');?>" name="date_fin" id="date_fin" autocomplete=off required>
                                        </div>
                                        </div>
                                    </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                       <div class="modal-area-button" style="margin-top: 15px;">
                                       <!--a class="Warning Warning-color mg-b-10" href="#" data-toggle="modal" data-target="#WarningModalftblack"><i class="fa fa-plus-square"></i> Nouveau Medicament</a>
                                        <a class="Information Information-color mg-b-10" href="#" data-toggle="modal" data-target="#InformationproModalhdbgcl" style="background-color:white;color:#141F29;border: 1px solid#141F29;"><i class="fa fa-plus-square"></i> Nouvelle categorie Medicament</a-->
                                 <button type="submit" name="btn-rech" class="Primary mg-b-10 gradient-ohhappiness" href="etats/invoice.php" style=" letter-spacing: 0.1em; font-weight: 501;color:white; border: 2px solid #26B683;"><i class="fa fa-search" style="font-size: 14px;" title="Lancer une recherche."></i></button>
                                 
                                <button type="submit" name="btn-print" class="Primary mg-b-10 gradient-deepblue" href="etats/invoice.php" style=" letter-spacing: 0.1em; font-weight: 501;color:white;border: 2px solid #006DF0;" title="Lancer une impression de la liste"><i class="fa fa-print" style="font-size: 14px;"></i></button>
                                <button type="submit" name="btn-refresh" class="Primary mg-b-10 gradient-ohhappiness" href="etats/invoice.php" style=" background: linear-gradient(30deg,#E47900,#FF8800) !important;letter-spacing: 0.1em; font-weight: 501;color:white;border: 2px solid #FF8800;"><i class="fa fa-undo" style="font-size: 14px;" title="Afficher la liste complète des ventes."></i></button>
                                </div>
                               </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15" style="margin-left:20px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php 
						$param='msg'; 
						if (isset($_GET[$param])){?><input type="text" value="<?=$_GET[$param];?>" name="id_msg" id="id_msg">
                  <?php } ?>

                         <div class="main-sparkline13-hd" style="border-radius: 5px; padding: 9px 4px 1px 9px;background-color:#141F29;">
                         <h1 style="color:white;font-size: 16px !important;letter-spacing: 0.2em"><i class="fa fa-shopping-bag"></i> Liste detaillée de tout <span class="table-project-n">les</span> articles. 

                                  <a href="?lst=3" class="btn btn-danger btn-xs btn-view" data-toggle="modal" style="color:white; 
                                background-color: #141F29 ; border-color:#6CC257;padding: 7px 11px !important; font-weight: bolder; letter-spacing: 0.1em;" title="Afficher uniquement les BON DE LIVRAISON "><i class="fa fa-eye"></i> Proforma</a>

                                 <a href="?lst=2" class="btn btn-danger btn-xs btn-view" data-toggle="modal" style="color:white; 
                                background-color: #FF8800 ; border-color:#FF8800;padding: 7px 11px !important; font-weight: bolder; letter-spacing: 0.1em;" title="Afficher uniquement les BON DE LIVRAISON "><i class="fa fa-eye"></i> Bon</a>

                                 <a href="?lst=1" class="btn btn-danger btn-xs btn-view" data-toggle="modal" style="color:white; 
                                background-color: #006DF0; border-color:#006DF0;padding: 7px 11px !important; font-weight: bolder; letter-spacing: 0.1em; " title="Afficher uniquement les Factures"><i class="fa fa-eye"></i> Facture</a>


                         </h1>

                                </div>
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd" >
                              
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright .custom-datatable-overright2">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Exporter la selection</option>
											<option value="all">Exporter tout</option>
											<!--option value="selected">Export Selected</option-->
										</select>
                                  
                                    </div>
                                    
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead class="gradient-ohhappiness" style="color:white;">
                                          
                                            <tr>
                                                <th>Ref vente</th>
                                                <th>Client</th>
												<th>Produit vendu</th>
												<!--th>Fabricant</th-->
												<th>Prix unitaire</th>
												<th>Quantité vendu</th>
												<th>Total</th>
												<th>Fait le</th>
												<th>Imprimer</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											$today= date('d-m-Y');
											
											while($lignes=$req->fetch()){
											if ($lignes['devise']=='dollar'){ 
                                                $dev_symbole='$'; $devise='en dollar'; } else{  $dev_symbole='FC'; $devise='en franc'; }
                                                ?>
                                           <tr >
                                
                                             <td ><span style="font-weight: bolder;"><?=$lignes['ref_cmd'];?></span></td>

                                              <td >
                                                <span style="font-weight: bolder;"><?=$lignes['client'];?></span></td>
												<td >
												<span style="font-weight: bolder; text-align: left !important;"><?=$lignes['desi_prod'];?></span></td>
												
                                             <td>
                                                 <a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #FF8800;letter-spacing: 0.1em'><?php echo number_format($lignes['prix_unit'],1,',','.')." ".$dev_symbole; ?></span></a>
                                            </td>
												
											<td>
                                                <a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #141F29;letter-spacing: 0.1em'><center><?php echo "x".$lignes['qte_achet']; ?></center></span></a>
                                            </td>
                                            
                                             <td>
                                                 <a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #006DF0;letter-spacing: 0.1em'><?php echo number_format($lignes['prix_total'],1,',','.')." ".$dev_symbole; ?></span></a>
                                            </td>

                                              <!--td>
                                                 <a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #006DF0;letter-spacing: 0.1em'><?php echo $lignes['type_vente']; ?></span></a-->
                                            </td-->
                                            
                                            <td><?php
                                               $Convert1=explode("-",$lignes['date_fact']);
                                              //$Convert2=explode("-",$_POST['date_fin']);             
                                               $date1=$Convert1[2]."/".$Convert1[1]."/".$Convert1[0];
                                               
                                             echo $date1;?>                                       
                                            </td>
                                        

                                            <td>
                                                <?php if ($lignes['type_vente']=='PROFORMA'){ ?>
												<a href="etats/facture_pro_format.php?ref=<?=$lignes['ref_cmd'];?>" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
												background-color: #141F29; border-color:#6CC257;padding: 2px 5px !important;" title="Imprimer un PROFORMA pour l'opération n° <?=$lignes['ref_cmd']?>"><i class="fa fa-print"></i></a>

                                                 <a href="etats/bon_livraison.php?ref=<?=$lignes['ref_cmd'];?>" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
                                                background-color: #FF8800 ; border-color:#FF8800;padding: 2px 5px !important;" title="Imprimer un BON DE LIVRAISON pour l'opération n° <?=$lignes['ref_cmd']?>"><i class="fa fa-print"></i></a>

                                                 <a href="etats/facture_finale.php?ref=<?=$lignes['ref_cmd'];?>" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
                                                background-color: #006DF0; border-color:#006DF0;padding: 2px 5px !important;" title="Imprimer une Facture pour l'opération n° <?=$lignes['ref_cmd']?>"><i class="fa fa-print"></i></a>
                                                <?php } ?>

                                                <?php if ($lignes['type_vente']=='BON'){ ?>
                                                <a href="etats/bon_livraison.php?ref=<?=$lignes['ref_cmd'];?>" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
                                                background-color: #FF8800 ; border-color:#FF8800;padding: 2px 5px !important;" title="Imprimer un BON DE LIVRAISON pour l'opération n° <?=$lignes['ref_cmd']?>"><i class="fa fa-print"></i></a>

                                                 <a href="etats/facture_finale.php?ref=<?=$lignes['ref_cmd'];?>" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
                                                background-color: #006DF0; border-color:#006DF0;padding: 2px 5px !important;" title="Imprimer une Facture pour l'opération n° <?=$lignes['ref_cmd']?>"><i class="fa fa-print"></i></a>
                                                <?php } ?>

                                                <?php if ($lignes['type_vente']=='FACT'){ ?>
                                                <a href="etats/facture_finale.php?ref=<?=$lignes['ref_cmd'];?>" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
                                                background-color: #006DF0; border-color:#006DF0;padding: 2px 5px !important;" title="Imprimer une Facture pour la vente n° <?=$lignes['ref_cmd']?>"><i class="fa fa-print"></i></a>
                                                 <?php } ?>

											</td>
											
											<td>
												<a href="traitement/vente-traitement.php?op=del_vent&ref_cmd=<?=$lignes['ref_cmd'];?>" class="btn btn-danger btn-xs" style="color:white; background-color: #D80027; padding: 5px 8px !important;" title="Supprimer la vente : <?=$lignes['ref_cmd']?>" id="btn-supp-vente"><i class="fa fa-trash"></i></a>
											</td>
											
											
											</tr>

                                           <?php 
											$cpt_prix_U = $cpt_prix_U+$lignes['prix_unit'];
											$cpt_tot_stock =$cpt_tot_stock+$lignes['qte_achet'];
											$cpt_tot_vente =$cpt_tot_vente+$lignes['prix_total'];

                                             if ($lignes['devise']=='dollar'){ 
                                              $cpt_tot_vente_dol=$cpt_tot_vente_dol+$lignes['prix_total']; } 
                                              else{  $cpt_tot_vente_fc =$cpt_tot_vente_dol+$lignes['prix_total']; }
											} ?>
                                         </tbody>
                                          <tfoot style="background: linear-gradient(179deg,#00b09b ,#96c93d 73%) !important; color:white;font-size: 17px !important;text-align: center !important;">
                                            <tr>
                                                <th colspan="3" style="text-align: center;"><?php echo $cpt_tot_stock." Articles(s)"; ?></th>
												<th colspan="3" style="text-align: center;">Ventes en CDF (<?php echo number_format($cpt_tot_vente_fc,1,',','.')." FC";?>)</th>
											   <th colspan="4" style="text-align: center;">Ventes en USD (<?php echo number_format($cpt_tot_vente_dol,1,',','.')." $";?>)</th>
												</tr>
                                        </tfoot>
                                     </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table End -->
        
        
        
         <!-- Modal Violet CATEGORIE Start-->
           <div id="InformationproModalhdbgcl" class="modal modal-edu-general Customwidth-popup-WarningModal PrimaryModal-bgcolor animated zoomIn" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content" style="border: 1px solid #ffffff;">
                                   <div class="main-sparkline13-hd" style="padding: 9px 4px 1px 9px;background-color: #ffffff;">
                                    <h1 style="color:#141F29;font-size: 16px !important;"><i class="fa fa-plus-circle"></i> Ajouter <span class="table-project-n">une</span> nouvelle catégorie Médicament</h1>
                                </div>
                                
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                     <!-- FORMULAIRE AJOUT-->
                                   <div class="modal-body">                                                       
                                   <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action=" " class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 offset-4">
                                                               <label style="color: white;font-size:18px;letter-spacing:0.1em;">Saisissez la catégorie de médicament</label>
                                                                <div class="form-group">
                                                                    <input name="cat_prod" id="cat_prod" type="text" class="form-control"     value="" style="font-size:18px;">
                                                                </div>
                                                                
                                                                 <div class="modal-footer footer-modal-admin warning-md" style="padding: 20px 0px 10px 0px;">
                                        <a data-dismiss="modal" href="#" style="font-size: 16px;">Annuler</a>
                                        <a href="" id="btn-add-cat" style="font-size: 16px;">Créer la catégorie</a>
                                        </div>                                                                                                                           
                                                            </div>
                                                        </div>
                                                        
                                                  </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                       
                                    </form>                                     
                                     <!-- FORMULAIRE AJOUT-->
                                    <div class="alert alert-danger alert-mg-b alert-st-four is-no-visible" role="alert">
										<i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
										<p class="message-mg-rt message-alert-none"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
          <!-- Modal Violet prod Start-->
        
        <div class="footer-copyright-area" style="background: linear-gradient(to left,#36C21F 14%, #088D80) !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2018. BM-DESIGN Concept <a href="https://colorlib.com/wp/templates/">ben7muz@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
		============================================ -->
    <script src="js/editable/jquery.mockjax.js"></script>
    <script src="js/editable/mock-active.js"></script>
    <script src="js/editable/select2.js"></script>
    <script src="js/editable/moment.min.js"></script>
    <script src="js/editable/bootstrap-datetimepicker.js"></script>
    <script src="js/editable/bootstrap-editable.js"></script>
    <script src="js/editable/xediable-active.js"></script>
    <!-- Chart JS
		============================================ -->
    <script src="js/chart/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
    <script src="js/tawk-chat.js"></script>
    <!-- chosen JS
        ============================================ -->
    <script src="js/input-mask/jasny-bootstrap.min.js"></script>
    <!-- datapicker JS
    ============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- chosen JS
		============================================ -->
    <script src="js/chosen/chosen.jquery.js"></script>
    <script src="js/chosen/chosen-active.js"></script>
    <!-- select2 JS
		============================================ -->
    <script src="js/select2/select2.full.min.js"></script>
    <script src="js/select2/select2-active.js"></script>
    <!-- SWEET ALERTS JS
		============================================ -->
    <script src="js/alerts-boxes/sweet-alert-script.js"></script>
    <script src="js/alerts-boxes/sweetalert.min.js"></script>
    <!-- TRAITEMENT PERSONNEL
		============================================ -->
    <script src="js/app/vente-process.js"></script>
    <script src="js/app/produit-process.js"></script>
     
    
    
</body>

</html>