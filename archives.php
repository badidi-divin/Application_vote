<?php
session_start();

if(!$_SESSION['user'])
{
    header('Location:index.php');
}

if(isset($_GET['logout'])=="yes"){
        session_destroy();
        header("location:index.php");
}

require('includes/dbconnect.php');
include 'includes/taille.php';

if(isset($_GET['update_user'])=="yes"){
 $req=$bdd->prepare('Update t_user Set nom_ut=?, pass=?');
 $req->execute(array('MIRA-PHARMA01','123MIRA'));
 header("location:medicaments.php");
}


if (!empty($_FILES))
{
    $file_name = $_FILES['fichier']['name'];
    $file_extension = strrchr($file_name, ".");

    $file_tmp_name = $_FILES['fichier']['tmp_name'];
    $file_dest = 'upload/'.$file_name;

    $taille_max = 800000000;
    $taille_fichier= $_FILES['fichier']['size'];

    $extensions_autorisees = array('.pdf', '.PDF', '.docx', '.DOCX');

    if (in_array($file_extension, $extensions_autorisees))
    {
        if (move_uploaded_file($file_tmp_name, $file_dest))
        {
			$date_ajout=date('Y-m-d H:i:s');
            $query = $bdd->prepare('INSERT INTO archives(name, fichier_url,Categorie,creer_le) VALUES (?,?,?,?)');
            $query->execute(array($file_name, $file_dest,htmlspecialchars($_POST['NomCat']),$date_ajout));
            $message = "<div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Fichier envoyé avec succès comme taille $taille_fichier</div>";
        }

        else
        {
            $message = "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Une erreur est survenue lors de l'envoi du fichier </div>";
        }

        if($taille_fichier>$taille_max)
        {
            $message ="<div class='alert alert-danger alert-dismissible'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Taille superieur à 8 Mo, fichier trop grand </div>";
        }

    }

    else
    {
        $message = "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Seuls les fichiers PDF et DOCX sont autorisés </div>";
    }
}




$req=$bdd->prepare('Select * from archives order by creer_le DESC');
$req->execute(array());

$menu =1;
$cpt_prix_A =0;
$cpt_prix_U =0;
$cpt_tot_stock =0;

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
    <title>G-STOCK | PRODUIT</title>
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
            <div class="breadcome-area" style="margin-left: 19px !important;">
                <div class="container-fluid" id="entete">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome" style="margin-bottom: -6px !important;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="breadcome-heading">
                                            <h3>G-STOCK/Archives</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                       <div class="modal-area-button">
                               <a class="Warning Warning-color mg-b-10" href="#" data-toggle="modal" data-target="#WarningModalftblack" style="font-weight: bolder; letter-spacing: 0.1em;"><i class="fa fa-plus-square"></i> Nouvelle Archive</a>
                                <!--a class="Information Information-color mg-b-10" href="#" data-toggle="modal" data-target="#InformationproModalhdbgcl" style="background-color:white;color:#141F29;border: 1px solid#141F29;"><i class="fa fa-plus-square"></i> Nouvelle categorie</a-->
                                <!--a class="Primary mg-b-10" href="#" data-toggle="modal" data-target="#PrimaryModalblbgpro"><i class="fa fa-print"></i> Lancer une impression</a-->
                                
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15" style="margin-left: 19px !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  
                  <?php 
						$param='msg'; 
						if (isset($_GET[$param])){?><input type="text" value="<?=$_GET[$param];?>" name="id_msg" id="id_msg">
                  <?php } ?>

                         <div class="main-sparkline13-hd" style="border-radius: 5px; padding: 9px 4px 1px 9px;background-color:#141F29;">
                         <h1 style="color:white;font-size: 16px !important;letter-spacing: 0.2em"><i class="fa fa-product-hunt"></i> Liste <span class="table-project-n">des</span> fichiers</h1>
                                </div>
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd" >
                              
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
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
                                                <th><i class="fa fa-id-card"></i> N° </th>
												<th><i class="fa fa-file-pdf-o"></i>  Nom du fichier</th>
												<!--th>Fabricant</th-->
												<th><i class="fa fa-file-archive-o"></i>  Taille</th>
												<!--th>Dci</th-->
												<!--th><i class="fa fa-file-pdf-o"></i>  Catégorie</th-->
												<th><i class="fa fa-calendar"></i> Créé le</th>
												<th><i class="fa fa-spinner"></i>  Action</th>

                                            </tr>
                                        </thead>
                                        <tbody style="font-weight: 500">
                                            <?php 
											$today= date('d-m-Y');
											$cpt_size=0;
                                            $k=0;
											while($lignes=$req->fetch()){
                                                $k++;
											/*$date_expi=$lignes['creer_le'];
											$Convert=explode("/",$date_expi);
                                            $Final_Date=date($Convert[0].'-'.$Convert[1].'-'.$Convert[2]);*/
											?>    
                                           <tr >
                                              <td><center><?=$k;?></center></td>
												<td style="font-weight: bolder; text-align: left !important;" ><span style="font-weight: bolder; letter-spacing: 0.1em;"><?=$lignes['name'];?></td>
												<!--td><?=$lignes['fabricant'];?></td-->
												<!--td><?=$lignes['frm_dos'];?></td>
												<!--td><?=$lignes['dci'];?></td-->
												<td>
                                                <center><a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #141F29;'><?php
                                            $nom=$lignes['name'];
                                            $filename= "upload/$nom";
                                            if(strrchr(file_on_ko(filesize($filename)),'.')){
                                                $myArray= filesize($filename);
                                                $size=$myArray;
                                                //echo $size.' Ko';

                                                if($size<1000000){
                                                $myArray= explode('.',file_on_ko(filesize($filename)));
                                                $size=$myArray[0]+1;
                                                echo $size.' Ko';
                                                 }
                                                else if($size>=1000000){
                                                $myArray= explode('.',file_on_ko(filesize($filename)));
                                                $size=$myArray[0]+1;
                                                echo $size.' Mo';
                                                 }
                                            }
                                                                                       
                                            ?></span></a>
                                            </td>
                                            <!--td>
                                                 <a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #FF8800;'><?php echo $lignes['prix_unit'].' FC'; ?></span></a>
                                            </td-->
                                               <td><?=$lignes['creer_le'];?></td>
												<td>
												<center>
												<a href="display.php?id=<?php echo $lignes['id']; ?>" target="_blank" class="btn btn-danger btn-xs" style="color:white; 
												background-color: #006DF0; border-color:#006DF0;padding: 3px 8px !important;" title="Lancer la lecture du fichier."><i class="fa fa-eye"></i></a>
												
												<a href="archives-del.php?id=<?php echo $lignes['id']; ?>&chemin=<?php echo $lignes['fichier_url']; ?>" class="btn btn-danger btn-xs " onclick="return(confim('Etes-vous sûr de vouloir supprimer le fichier?'))" style="color:white; background-color: #D80027; padding: 3px 8px !important;" title="Supprimer le fichier : <?=$lignes['name']?>"><i class="fa fa-trash"></i></a>
												</td>
											</tr>

                            <!-- MODAL MODIFIER Produit
                           ============================================ -->
                                 <div id="edit<?php echo $lignes['id'];?>" class="modal modal-edu-general Customwidth-popup-WarningModal  animated zoomIn" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="border: 1px solid #FF8800; background: #141F29;">
                                               <div class="main-sparkline13-hd" style="padding: 9px 4px 1px 9px;background-color: #FF8800;">
                                                <h1 style="color:white;font-size: 16px !important;"><i class="fa fa-pencil-square"></i> Modification <span class="table-project-n">du</span> produit(<?=$lignes['Lib_cat'];?> : <?=$lignes['designation'];?>)</h1>
                                            </div>
                                
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                
                                   <div class="modal-body">                                                       
                                   <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action=" " class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                                <div class="form-group">
                                                                    <input name="ref_prod" id="ref_prod2" type="text" class="form-control" value="<?=$lignes['ref_prod'];?>" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input name="desi"id="desi2" type="text" class="form-control" placeholder="Nom du produit(*)" value="<?=$lignes['designation'];?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="frm_dos"id="frm_dose2" type="text" class="form-control" placeholder="Dosage(*)" value="<?=$lignes['frm_dos'];?>">
                                                                </div>
                                                               <div class="form-group">
                                                                    <input name="dci"id="dci2" type="text" class="form-control" placeholder="DCI du produit(*)">
                                                                </div>
                                                            </div>
                                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                                
                                                                <div class="form-group">
                                                                    <input name="fab_prod" id="fab_prod2" type="text" class="form-control" placeholder="Fabriqué par" value="<?=$lignes['fabricant'];?>">
                                                                </div>
                                                          
                                                                 <div class="form-group state-success">
                                                                   <label style="color: white;">Prix d'achat (en FC)*</label>
                                                                    <input name="prix_achat" id="prix_achat2" type="number" class="form-control valid" placeholder="Prix d'achat" min=100 value="100" value="<?=$lignes['prix_gros'];?>">
                                                                </div>
                                                                
                                                                <div class="form-group state-success">
                                                                    <label style="color: white;">Prix unitaire (en FC)*</label>
                                                                    <input name="prix_unit" id="prix_unit2"  type="number" class="form-control valid" placeholder="Prix unitaire" min=100 value="100" value="<?=$lignes['prix_unit'];?>">
                                                                </div>
                                                                
                                                                <div class="form-group state-success">
                                                                   <label style="color: white;">Quantite en stock</label>
                                                                    <input name="qte_stock" id="qte_stock2"  type="number" class="form-control valid" placeholder="Quantité" min=1 max=10000 value="<?=$lignes['stock'];?>">
                                                                </div>                                                           
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                               
                                                                <div class="form-group">
                                                                    <div class="form-group data-custon-pick" id="data_1">
                                                                     <label style="color: white;">Date de fabrication</label>
                                                                    <div class="input-group date">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input type="text" class="form-control" value="<?=$lignes['date_prod'];?>"" name="date_prod" id="date_prod2" required>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <div class="form-group data-custon-pick" id="data_2">
                                                                     <label style="color: white;">Date d'expiration</label>
                                                                    <div class="input-group date">
                                                                       
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input type="text" class="form-control" value="<?=$lignes['date_expirat'];?>" name="date_expi" id="date_expi2" required>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            
                                                          <div class="form-group">
                                                             <div class="chosen-select-single mg-b-20" id="divcat">
                                                                
                                                               <label style="color: white;">Choisir Catégorie</label>
                                                               
                                                                <select data-placeholder="Choose a Country..." class="chosen-select" tabindex="-1" name="13" id="categ2">
                                                                <?php $req_cat2=$bdd->prepare('Select lib_cat from t_categorie');
                                                                $req_cat2->execute(array());
                                                                $taille= $req_cat2->rowcount();?>
                                                                 <option value="<?=$lignes['Lib_cat'];?>"><?=$lignes['Lib_cat'];?></option>
                                                                <?php for($i=0;$i<=$taille;$i++){
                                                                    $ligne3=$req_cat2->fetch(); ?>
                                                                     <?php 
                                                                 if ($ligne3['lib_cat']!=$lignes['Lib_cat']) {
                                                                    echo '<option value='.$ligne3['lib_cat'].'>'.$ligne3['lib_cat'].'</option>';
                                                                 }
                                                               } ?>
                                                                    </select>
                                                               
                                                                 </div>
                                                                <!--div class="modal-area-button">
                                                                <a class="Information Information-color mg-b-10" href="#" data-toggle="modal" data-target="#InformationproModalhdbgcl" style="background-color:#FF8800;border: 1px solid#141F29;margin-top: -14px;font-weight: bold;"><i class="fa fa-plus-square"></i> Nouvelle categorie Medicament</a></div-->
                                                              
                                                             </div>      
                                                                                                                                                                                           
                                                            </div>
                                                        </div>
                                                        
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                                      <div class="modal-footer footer-modal-admin warning-md" style="padding: 0px 0px 15px 0px;">
                                        <a data-dismiss="modal" href="#" style="background-color: #F80 !important;">Annuler</a>
                                        <a href="" id="btn-edit-prod" style="background-color: #F80 !important;">Modifier le produit</a>
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
                                            <!-- (END)MODAL MODIFIER Produits
                                                  ============================================ -->



                                           <?php 
										    $cpt_size=$cpt_size+$size;
											$cpt_tot_stock =$cpt_tot_stock+1;
											} ?>
                                         </tbody>
                                          <tfoot style="background: linear-gradient(179deg,#00b09b ,#96c93d 80%) !important; color:white;font-size: 17px !important;text-align: center !important;">
                                            <tr>
                                                <th colspan="2" style="text-align: center;">(<?php echo $cpt_tot_stock." Fichiers"; ?>)</th>
												<th colspan="2" style="text-align: center;">(<?php echo $cpt_size." Ko "; ?>)</th>
												<th style="text-align: center;"></th>
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
        
        <!-- Modal Ajout prod Start-->
					<div id="WarningModalftblack" class="modal modal-edu-general Customwidth-popup-WarningModal PrimaryModal-bgcolor animated zoomIn" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content" style="border: 1px solid #36C21F;">
                                   <div class="main-sparkline13-hd" style="padding: 9px 4px 1px 9px;background-color: #36C21F;">
                                    <h1 style="color:white;font-size: 16px !important;"><i class="fa fa-plus-circle"></i> Ajouter <span class="table-project-n">un nouveau</span> Produit</h1>
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
                                                    <form method="post" action="" enctype="multipart/form-data" class="dropzone dropzone-custom needsclick add-professors">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-2" style="background-color: #101010;   border-radius: 10px;padding:     padding: 18px 18px 0px 18px;">

                                                               <label style="color: white;font-size:18px;letter-spacing:0.1em;">Choisir un Fichier</label>
                                                                <div class="form-group">
                                                                    <input name="fichier" id="" type="file" class="form-control"     value="" style="font-size:18px;">
                                                                </div>
                                                                
                                                                <label style="color: white;font-size:18px;letter-spacing:0.1em;">Choisir Catégorie du fichier</label>
                                                               
                                                                <select data-placeholder="Choose a Country..." class="chosen-select" tabindex="-1" name="NomCat" id="">
                                                                     <?php
																$req_cat3=$bdd->prepare('Select * from 	t_cat_cours');
																$req_cat3->execute(array())
																	   ;?>
                                                                <?php while($ligne3=$req_cat3->fetch()){?>
                                                                <option value="<?=$ligne3['designation'];?>"><?=$ligne3['designation'];?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                
                                                                
                                                              <div class="modal-footer footer-modal-admin warning-md" style="margin-top:15px;"> 
                                                                <button name="Envoyer"  id="" style="font-size: 16px;"><i class="fa fa-plus"></i>
 Créer</button>
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
        <!-- Modal Ajout prod End-->
        
         <!-- Modal Violet CATEGORIE Start-->
           <div id="InformationproModalhdbgcl" class="modal modal-edu-general Customwidth-popup-WarningModal PrimaryModal-bgcolor animated zoomIn" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content" style="border: 1px solid #ffffff;">
                                   <div class="main-sparkline13-hd" style="padding: 9px 4px 1px 9px;background-color: #ffffff;">
                                    <h1 style="color:#141F29;font-size: 16px !important;"><i class="fa fa-plus-circle"></i> Ajouter <span class="table-project-n">une</span> nouvelle catégorie Produits</h1>
                                </div>
                                
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                     <!-- FORMULAIRE AJOUT-->
                                   <div class="modal-body" style="padding: 10px 70px !important;">                                                       
                                   <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action=" " class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-2" style="background-color: #101010;   border-radius: 10px;padding:     padding: 18px 18px 0px 18px;">

                                                               <label style="color: white;font-size:18px;letter-spacing:0.1em;">Creer une Categorie</label>
                                                                <div class="form-group">
                                                                    <input name="cat_prod" id="cat_prod" type="text" class="form-control"     value="" style="font-size:18px;">
                                                                </div>
                                                              <div class="modal-footer footer-modal-admin warning-md"> 
                                                                <a href="" id="btn-add-cat" style="font-size: 16px;"><i class="fa fa-plus"></i>
 Créer</a>
                                                                </div>                                                                                           
                                                            </div>

                                                             <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-2" style="background-color: #101010;   border-radius: 10px;padding: 18px 18px 0px 18px; margin-top:13px;">
                                                               
                                                                <div class="form-group">
                                                             <div class="chosen-select-single mg-b-20" id="divcat">
                                                              <label style="color: white;font-size:18px;letter-spacing:0.1em;">Supprimer une Categorie</label>
                                                               
                                                                <select data-placeholder="Choose a Country..." class="chosen-select" tabindex="-1" name="categ" id="cat_id">
                                                                     <?php
                                                                    $req_cat3=$bdd->prepare('Select * from 	t_cat_cours');
                                                                    $req_cat3->execute(array())
                                                                           ;?>
                                                                <?php while($ligne3=$req_cat3->fetch()){?>
                                                                <option value="<?=$ligne3['lib_cat'];?>"><?=$ligne3['lib_cat'];?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                               
                                                                 </div>
                                                              <div class="modal-footer footer-modal-admin warning-md"> 
                                                                <a href="#" style="font-size: 16px; background-color: #D80027 !important;" id="btn-supp-cat"><i class="fa fa-trash"></i> Supprimer</a>
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
                        </div></div>
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
    <script src="js/app/produit-process.js"></script>
    
    
</body>

</html>