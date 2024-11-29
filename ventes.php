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
$req=$bdd->prepare('Select * from vue_facture');
$req->execute(array());


$req_cat=$bdd->prepare('Select * from t_categorie');
$req_cat->execute(array());

$menu =2;
$total_fact =0;
$reduc ='';
$mont_verse ='';
$i =1;
$cpt_qte=0;

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
    <title>G-STOCK | Opération</title>
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
    <!-- touchspin CSS
		============================================ -->
    <link rel="stylesheet" href="css/touchspin/jquery.bootstrap-touchspin.min.css">
    
    
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

<?php if (!isset($_GET['taux_change'])){ ?>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2" style="margin-top: 38px; margin-bottom: 38px;">
                        <div class="product-payment-inner-st" style="border-top: 6px solid #2FBA2E;">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="" style="color: #2FBA2E;"><a href="#description" style="font-size:1.8em">Nouvelle Opération : Etape 1</a></li>
                                <!--li><a href="#reviews"> Acount Information</a></li-->
                                <!--li><a href="#INFORMATION">Social Information</a></li-->
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad addcoursepro">
                                                    <form action="ventes.php" class="dropzone dropzone-custom needsclick addcourse dz-clickable" id="demo1-upload" novalidate>
                                                        <div class="row">

                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="border-right: 1px double #758A6B; ">
                                                             <h4 style="border-radius: 5px; padding: 7px 4px 7px 8px;background-color:#141F29; color: white;font-size:1.0em;letter-spacing: 0.1em">Information Client</h4>
                                                                <hr style="border-right: 1px double #758A6B;" />

                                                                <div class="form-group">
                                                                    <label style="color: #909090;">Client (*)</label>
                                                                    <input name="client" id="client" type="text" class="form-control" placeholder="Nom du client (Personne ou Société )" value="Non defini" style="font-size:14px;font-size: 16px;color:#626970 !important;border-radius: 3px;">
                                                                </div>
                                                                <!--div class="form-group">
                                                                    <label style="color: #909090;">Nom du client (*)</label>
                                                                    <input name="nom_cli" id="nom_cli" type="text" class="form-control hasDatepicker" placeholder="Nom du client">
                                                                </div-->
                                                                <div class="form-group">
                                                                    <label style="color: #909090;">Adresse client (*)</label>
                                                                    <input name="adrs_cli" id="adrs_cli" type="text" class="form-control" placeholder="Adresse complète" value="Non defini" style="font-size:14px;font-size: 16px;color:#626970 !important;border-radius: 3px;">
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <h4 style="border-radius: 5px; padding: 7px 4px 7px 8px;background-color:#FF8800; color: white; font-size:1.0em;letter-spacing: 0.1em">Informations Montetaire</h4>
                                                                <hr style="border-right: 1px double #758A6B;"/>
                                                                <div class="form-group res-mg-t-15">
                                                                    <label style="color: #909090;letter-spacing: 0.1em">Taux de Change</label>

                                                                   <input class="touchspin1" type="text" name="taux_change" id="taux_change" style="display: block;color:#626970;font-size: 18px;text-align: center;" value="2000" >
                                                                </div>
                                                                <!--div class="form-group">
                                                                    <textarea name="description" placeholder="Description"></textarea>
                                                                </div-->
                                                                <div class="form-group">
                                                                    <label style="font-size:14px;font-size: 16px;color:#626970 !important;border-radius: 3px; letter-spacing: 0.1em">Devise de la vente</label>
                                                                   
                                                                    <select name="devise" id="devise" class="form-control valid">
                                                                            <!--option value="none" selected="" disabled="">Select city</option-->
                                                                            <option value="dollar" selected="">Dollar</option>
                                                                            <option value="CDF">Franc Congolais</option>
                                                                        </select>
                                                                
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <hr/>
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress" >
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light gradient-ohhappiness" style="font-size: 14px; font-weight: bolder!important;letter-spacing: 0.1em !important; color: white; border-color: #6CC257;">Valider</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--div class="product-tab-list tab-pane fade" id="reviews">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="devit-card-custom">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Email">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" placeholder="Phone">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password" class="form-control" placeholder="Password">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password" class="form-control" placeholder="Confirm Password">
                                                            </div>
                                                            <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="devit-card-custom">
                                                            <div class="form-group">
                                                                <input type="url" class="form-control" placeholder="Facebook URL">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="url" class="form-control" placeholder="Twitter URL">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="url" class="form-control" placeholder="Google Plus">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="url" class="form-control" placeholder="Linkedin URL">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div-->
                            </div>
                        </div>
                    </div>
<?php } ?>

<?php if (isset($_GET['taux_change'])){ ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="">
                            <div class="breadcome-list single-page-breadcome" style="margin-bottom: -6px !important; padding-bottom: 0px!important; border-top: 6px solid #2FBA2E;">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                         <div class="modal-area-button">
                                         <a class="Danger danger-color" 
                                          id="btn_retour" href="ventes.php" title ="Revenir au formulaire Infos clients et Infos Monetaires." style="font-weight: bold; color:white;letter-spacing: 0.1em; padding: 6px 12px !important;margin: 0px -2px !important;" ><i class="fa fa-arrow-left"></i> Retour à l'etape 1</a>
                                        
                                            <h4 style="margin-top: 7px;">G-STOCK / Opération</h4>
                                        </div>
                                              <hr>
                                    </div>

                                    <form action="traitement/vente-traitement.php" method="POST">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="txt_ref" id="txt_ref">
                                         <input type="text" name="txt_prix" id="txt_prix">
                                         <input type="text" name="txt_qte" id="txt_qte">

                                         <input type="text" name="txt_client" id="txt_client" value="<?php if (isset($_GET['client'])){echo $_GET['client']; } ?>">
                                         <input type="text" name="txt_adrs" id="txt_adrs" value="<?php if (isset($_GET['adrs_cli'])){echo $_GET['adrs_cli']; } ?>">
                                         <input type="text" name="txt_devise" id="txt_devise" value="<?php if (isset($_GET['devise'])){echo $_GET['devise']; } ?>">
                                         <input type="text" name="txt_taux" id="txt_taux" value="<?php if (isset($_GET['taux_change'])){echo $_GET['taux_change']; } ?>">
                                         
                                         <div class="form-group col-lg-6">
                                            <input name="search" id="search" type="text" class="form-control" placeholder="Tapez le nom du produit à acheter" style="font-size:14px;font-size: 16px;color:#626970 !important;border-radius: 3px;" autocomplet=off>
                                        </div>
                                        
                                        <div class="form-group col-lg-2">
                                            <input name="qte_vend" id="qte_vend" type="number" class="form-control" placeholder="Quantité" style="font-size:14px;font-size: 16px;color:#626970 !important;border-radius: 3px;" value="1" min="1">
                                        </div>
                                            
                                    <div class="modal-area-button col-lg-4" style="margin-top: -11px;">
                                        <a class="Primary mg-b-10 gradient-ohhappiness" href="#" data-toggle="modal" id="btn-add-to-list" style="font-size: 16px; font-weight: bolder!important;letter-spacing: 0.1em !important;" title="Ajouter l'article dont le nom est repris ci-haut à la facture."><i class="fa fa-plus"></i> Ajouter</a>                           
                                      </div>
                   
                                        
                                        <ul class="list-group col-lg-11" id="result" style="position: absolute;z-index: 1000;margin-top: 45px;padding-left:-1px !important;"></ul>
                                    
                                      </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15" style="margin-left: 19px !important;" id="#bloc">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
  
                 <?php 
						$param='msg'; 
						if (isset($_GET[$param])){?><input type="text" value="<?=$_GET[$param];?>" name="id_msg" id="id_msg">
                  <?php } ?>

                         <div class="main-sparkline13-hd" style="border-radius: 5px; padding: 9px 4px 1px 9px;background-color:#141F29;">
                           <h4 style="border-radius: 5px; padding: 7px 4px 7px 8px;background-color:#FF8800; color: white; font-size:1.0em;letter-spacing: 0.1em">Details | Client :  <?php if (isset($_GET['client'])){ echo $_GET['client']; } ?>, Taux : <?php if (isset($_GET['taux_change'])){ echo $_GET['taux_change']; } ?>, Devise : <?php if (isset($_GET['devise'])){ echo $_GET['devise']; } ?></h4>  
                         <h1 style="color:white;font-size: 16px !important; letter-spacing: 0.2em"><i class="fa fa-database"></i> Liste <span class="table-project-n">des</span> articles concernés par l'achat</h1>
                                </div>
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd" >
                              
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                         
                                      <div class="modal-area-button col-lg-4" style="margin-top: -11px;">
                                        <a class="Primary mg-b-10 " href="traitement/vente-traitement.php?op=clean_caddie" data-toggle="modal" data-target="#PrimaryModalftblack" style="font-size: 14px; background-color: #FF8800!important; font-weight: bolder; letter-spacing: 0.1em;" id="btn-clean-panier"><i class="fa fa-warning" style="font-size: 14px; font-weight: bolder!important;letter-spacing: 0.1em;" title="Ajouter le produit dont le nom est repris ci-haut à l'ordonnance." ></i> Annuler la vente</a>              
                                      </div>
                                                                                
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-pagination-switch="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead class="gradient-ohhappiness">
                                          
                                            <tr>
                                                <th>Nom du Produit</th>
												<th>Prix unitaire</th>
												<th>Quantité à acheter</th>
                                                <th>Unité</th>
												<th>Prix total</th>
												<th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											$today= date('d-m-Y');
                                             $dev_symbole="";
                                             $devise="";
											while($lignes=$req->fetch()){
                                                $dev_symbole="";
                                                $devise="";
                                                if ($lignes['devise']=='dollar'){ 
                                                $dev_symbole='$'; $devise='en dollar'; } else{  $dev_symbole='FC'; $devise='en franc'; } 

											?>    
                                           <tr class="col-panier">
                                             <td><span style="font-weight: bolder;"><?=$lignes['desi_prod'];?></td>
                                              <td><span style="font-weight: bolder;"><?=number_format($lignes['prix_unit'],1,',','.')." ".$dev_symbole;?></td>
                                             <td>
                                             <form action="traitement/vente-traitement.php" method="post">
												<input type="hidden" value="<?=$lignes['id_pn'];?>" name="id_pan" id="id_pan">
												
												<input name="qte_achet" id="qte_achet" type="number" class="form-control valid" placeholder="Quantité en stock" min=0 max='10000' value="<?=$lignes['qte_achet'];?>" readonly style="width:76px !important; display:inline-block;" autocomplet=off>
												
												<!--button type="submit" name="btn-stock" id=""  class="btn btn-md btn-stock" style="background-color: #36C21F; display: inline;padding: 5px;" title="M.A.J Stock : <?=$lignes['desi_prod'];?>"><i class="fa fa-undo"></i></button-->
												<!--a href="traitement/produit-traitement.php?pr_id=<?//=md5($lignes['id']);?>" id="btn-stock"></i></a--> 
												</form>    
												</td>
                                        <td><span style="font-weight: bolder;"><?=$lignes['unite'];?></td>

                                            <td><span style="font-weight: bolder;"><?=number_format($lignes['total_qte'],1,',','.')." ".$dev_symbole;?></td>
                                             <td>
                                             <div class="modal-area-button">
                                             <a class="Danger danger-color btn-supp" href="traitement/vente-traitement.php?del_prd=<?=$lignes['id_pn']?>&prd=<?=$lignes['desi_prod']?>" data-toggle="modal" data-target="#DangerModalftblack" title ="Supprimer ce produit de la liste." style="font-weight: bold; color:white;letter-spacing: 0.1em; padding: 6px 12px !important;"><i class="fa fa-trash"></i></a>
                                             </div>
                                             </td>
                                           </tr>
                                                   
                                           <?php
											$cpt_qte++;
											$total_fact +=$lignes['total_qte']; ;
											$mont_verse = 50;
											
											}
											
										    ?>
                                         </tbody>
                                          <tfoot style="background-color: #36c21f; color:white;font-size: 17px !important;text-align: center !important;">
                                            <!--tr>
                                                <th colspan="5" style="text-align: center;">Total Produits en stock (<?php //echo $cpt_tot_stock." Médicaments"; ?>)</th>
												<th colspan="4" style="text-align: center;">Total Prix achats (<?php //echo number_format($cpt_prix_A,0,',','.')." FC";?>)</th>
												<th colspan="4" style="text-align: center;">Total prix unitaires (<?php //echo number_format($cpt_prix_U,0,',','.')." FC";?>)</th>
                                            </tr-->
                                        </tfoot>
                                     </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					   <div class="pricing-table pricing-table-color" style="width: 112% !important;margin-left: -35px;">
						 <div class="card gradient-ohhappiness" style="border-radius: 0rem !important">
						  <div class="card-body text-center" style="margin: -8px;">

                               

							 <div class="price-title text-white">DETAILS</div>
				                <ul class="list-group list-group-flush">
					            <li class="list-group-item" style="letter-spacing: 0.2em"><b>Total</b> (actuel)</li>
						        </ul>
							   <h3 class="price text-white" style="font-size: 2.4em !important;margin-top: -18px; border-bottom: 1px solid #93D673; padding-bottom: 6px;"><small class="currency text-white" style="font-size: 0.6em !important;"> <?php echo $dev_symbole; ?>  
                                </small><?php echo number_format($total_fact,1,',','.');?>
							   <input type="hidden" name="total_fac" id="total_fac" value="<?php if (isset($total_fact)) echo $total_fact; else echo '0';?>"> </h3>
							   <ul class="list-group list-group-flush">
								   <li class="list-group-item" style="letter-spacing: 0.2em"><b>Montant versé</b> (<?php echo $devise; ?>)</li>
								     
                                       <div class="touchspin-inner">
                                           <input class="touchspin2" type="text" name="mont_verse" id="mont_verse" style="display: block;color:#626970;font-size: 15px;text-align: center;" value="<?=$total_fact;?>" value="0.5">
                                        </div>
                                      
                                                             
								  <li class="list-group-item" style="letter-spacing: 0.2em"><b>Reduction</b> (%<?php //echo $devise; ?>)</li>
								  <div class="touchspin-inner">
                                           <input class="touchspin2" type="text" name="reduc" id="reduc" style="display: block;color:#626970;font-size: 18px;text-align: center;" value="0" max="5" value="0.5">
                                        </div>
                                    
							  </ul>
                            <div class="modal-area-button">                                                 
                            <a class="btn btn-link text-success bg-white my-3 btn-round" href="#" data-toggle="modal" data-target="#WarningModalhdbgcl" style="font-size: 18px;" id="" ><i class="fa fa-shopping-cart" style="font-size: 20px"></i> VALIDER</a>   </div>
							  <!--a href="#" class="btn btn-link text-success bg-white my-3 btn-round" style="font-size: 18px;" id="btn-add-vente" ><i class="fa fa-shopping-cart" style="font-size: 20px" ></i> VENDRE</a-->
						
						 </div>
					   </div>
                 </div>
    




                  
                </div>
            </div>
              <?php  } ?>   
        </div>
        <!-- Static Table End -->


 <div id="WarningModalhdbgcl" class="modal modal-edu-general Customwidth-popup-WarningModal fade" role="dialog">
                            <div class="modal-dialog" style="width: 26%;">
                                <div class="modal-content">
                                    <div class="modal-header header-color-modal bg-color-3" style="padding: 20px 28px -1px 10px !important;">
                                        <h5 class="modal-title" style="color: white;font-size: 1.1em;font-weight: bold;"><i class="fa fa-print"></i> Réglages & Impression</h5>
                                        <div class="modal-close-area modal-close-df">
                                            <a class="close" data-dismiss="modal" href="#" style="margin-top:-53px"><i class="fa fa-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="modal-body" style="padding: 12px 70px !important; margin: 0Px -15px !important;">
                                        <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                                        <h6>Quel type de document est-ce?</h6>

                                         <select name="report_type" id="report_type" class="form-control valid" style="font-weight: bold; letter-spacing: 0.1em; text-align:center;font-size: 1.2em;">
                                                                            <!--option value="none" selected="" disabled="">Select city</option-->
                                                                            <h2>
                                                                            <option value="PROFORMA" selected="">PROFORMA (dévis)</option>
                                                                            <option value="BON">BON DE LIVRAISON</option>
                                                                            <option value="FACT">FACTURE</option>
                                                                            <!--option value="BON_FACT">BON+FACTURE</option--></h2>
                                        </select>
                                        <!--p>The Modal plugin is a dialog box/popup window that is displayed on top of the current page</p-->
                                                                         <div class="i-checks pull-left" style="margin:15px 0px;">
                                                                                <label class="">

                                                                                    <input type="checkbox" value="" checked="" id="print" style="position: absolute; opacity: 0;">Lancer l'impression </label>
                                                                            </div>
                                                                       
                                        
                                    </div>
                                     <br><hr>
                                    <div class="modal-footer warning-md">
                                        <a data-dismiss="modal" href="#">Annuler</a>
                                        <a href="#" id="btn-add-vente" style="margin-right: 49px;">Terminer</a>
                                    </div>
                                </div>
                            </div>
                        </div>

        
        <div class="footer-copyright-area" style="background: linear-gradient(to left,#36C21F 14%, #088D80) !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2020. BM-DESIGN Concept <a href="https://colorlib.com/wp/templates/">ben7muz@gmail.com</a></p>
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
    <!-- touchspin JS
		============================================ -->
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/touchspin/touchspin-active.js"></script>
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
    <script>
 $(document).ready(function(){
	// $.ajaxSetup({ cache: false });
	 $('#search').keyup(function(){
	  $('#result').html('');
	  $('#state').val('');
	  var searchField = $('#search').val();
	  var expression = new RegExp(searchField, "i");
	  $.get('traitement/liste_produits.php?query='+searchField, {} , function(data) {
		   $("#result").html(data);
	 });

	   $('#result').on('click', 'li', function() {
		var click_text = $(this).text().split('|');	
		$('#search').val($.trim(click_text[1]));
		$('#txt_ref').val($.trim(click_text[0]));
		
		//var click_text2 = $.trim(click_text[3]).split(' ');	
		$('#txt_qte').val($.trim(click_text[3]));
        var click_text3 = $.trim(click_text[2]).split(' ');
        $('#txt_prix').val($.trim(click_text3[0]));
		$("#result").html('');
		});
	  });
 });
</script>
    
</body>

</html>