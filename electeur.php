<?php
session_start();

require_once('bdd/connexion.php');
require_once('./model/select-electeur.php');


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Application de vote| ISPT-KIN</title>
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
   
       <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header" style="margin-top: 10px;">
                <a href="#"><img class="main-logo" src="img/ispts.gif" alt="" width="50px" height="70px" /></a>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <?php require_once('menu.php') ?>
            </div>
        </nav>
    </div>
    <!-- End Header menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="#"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="educate-icon educate-nav"></i>
                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                               
                                                <li class="nav-item">
                                                    <a href="logout.php" onclick="return confirm('Etes-vous sûre de vouloir vous déconnecter?...?');"  class="nav-link dropdown-toggle">
                                                            <span class="admin-name"><?= $_SESSION['username'] ?></span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                            <li class="active">
                                                <a class="has-arrow" href="rapport.php">
                                                       <span class="mini-click-non">Rapport</span>
                                                    </a>
                                            </li>
                                            <li class="active">
                                                <a class="has-arrow" href="electeur.php">
                                                       <span class="mini-click-non">Electeur</span>
                                                    </a>
                                            </li>
                                            <li>
                                                <a title="Landing Page" href="candidat.php" aria-expanded="false"> <span class="mini-click-non">Candidat</span></a>
                                            </li>
                                            <li>
                                                <a class="has-arrow" href="vote.php" aria-expanded="false"> <span class="mini-click-non">Vote</span></a>
                                            </li>
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
                                            <h3>Liste des Electeurs</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                       <div class="modal-area-button">
                               <a class="Warning Warning-color mg-b-10" href="#" data-toggle="modal" data-target="#WarningModalftblack" style="font-weight: bolder; letter-spacing: 0.1em;"><i class="fa fa-plus-square"></i> Ajouter</a>
                                
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
                         <h1 style="color:white;font-size: 16px !important;letter-spacing: 0.2em"><i class="fa fa-product-hunt"></i> Liste <span class="table-project-n">des</span> Electeurs</h1>
                                </div>
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd" >
                              
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">                          
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead class="gradient-ohhappiness" style="color:white;">
                                          
                                            <tr>
                                               <th>Code Etudiant</th>
                                                <th>Nom Complet</th>
                                                <th>Option</th>
                                                <th>Promotion</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $today= date('d-m-Y');
                                            $k=0;
                                            while($lignes=$req->fetch()){
                                            ?>    
                                           <tr >
                                             <td><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #141F29;'><?=$k;?></span></td>
                                             
                                              <td><?=$lignes['code_etudiant'];?></td>
                                                <td> <span style="font-weight: bolder;"><?=$lignes['nom_complet'];?></td>
                                                <td><span style="font-weight: bolder;"><?=$lignes['option'];?></td>
                                                <td><span style="font-weight: bolder;"><?=$lignes['promotion'];?></td>                                            
                                                <td>

                                                <a href="#edit<?php echo $lignes['id_cli']; ?>" data-toggle="modal" title="Modifier le produit : <?=$lignes['designation']?>">
                                                    <button type='button' class='btn btn-default btn-md' style="background-color: #FF8800; padding: 5px 8px !important; color: white; border: 2px solid #FF8800;"><i
                                                    class='fa fa-pencil-square' aria-hidden='true'></i>
                                                    </button>
                                                </a>    
                                                <a href="traitement/client-traitement.php?spr_prd=<?=$lignes['id_cli'];?>&desi=<?=$lignes['client'];?>" class="btn btn-danger btn-xs btn-supp" data-toggle="modal" style="color:white; background-color: #D80027; padding: 3px 8px !important;" title="Supprimer le client : <?=$lignes['client']?>"><i class="fa fa-trash"></i></a>
                                                
                                                <a href="#SupNumero18" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
                                                background-color: #006DF0; border-color:#006DF0;padding: 3px 8px !important;" title="Imprimer la liste des medicaments."><i class="fa fa-print"></i></a>
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
                                
                                   <div class="modal-body" style="padding: 15px 70px;">                                                       
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
                                                                   <label style="color: white;">Désignation(*)</label>
                                                                    <input name="desi"id="desi2" type="text" class="form-control" placeholder="Nom du produit(*)" value="<?=$lignes['designation'];?>">
                                                                </div>
                                                              
                                                               <div class="form-group">
                                                                   
                                                                   <label style="color: white;">Description</label>
                                                                    
                                                                    <textarea cols="" name="descrip2" id="descrip2" placeholder="Description" ><?=$lignes['Descript'];?></textarea>
                                                                    
                                                                </div>
                                                            </div>
                                                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                                                                                         
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
                                                                    <div class="form-group data-custon-pick" id="data_2">
                                                                     <label style="color: white;">Date de livraison</label>
                                                                    <div class="input-group date">
                                                                       
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input type="text" class="form-control" value="<?=$lignes['date_prod'];?>" name="date_prod" id="date_prod2" required>
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
                                                    <hr/>     
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <div class="modal-footer footer-modal-admin warning-md" style="padding: 0px 0px 15px 0px;">
                                        <a data-dismiss="modal" href="#" style="background-color: #F80 !important;">Annuler</a>
                                        <a href="" class="btn-edit-prod" style="background-color: #F80 !important;">Modifier le produit</a>
                                     </div>
                                                       
                                    </form>                                     
                                     <!-- FORMULAIRE AJOUT-->
                                    <div class="alert alert-danger alert-mg-b alert-st-four is-no-visible" role="alert" style="margin: 21px;">
                                        <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-none" aria-hidden="true"></i>
                                        <p class="message-mg-rt message-alert-none"></p>
                                    </div>
                                </div>
                            </div>
                                            </div>
                                            <!-- (END)MODAL MODIFIER Produits
                                                  ============================================ -->



                                           <?php 
                                            /*$cpt_prix_A = $cpt_prix_A+$lignes['prix_gros'];
                                            $cpt_prix_U = $cpt_prix_U+$lignes['prix_unit'];
                                            $cpt_tot_stock =$cpt_tot_stock+$lignes['stock'];*/
                                            } ?>
                                         </tbody>
                                          <tfoot style="background: linear-gradient(179deg,#00b09b ,#96c93d 80%) !important; color:white;font-size: 17px !important;text-align: center !important;">
                                            <!--tr>
                                                <th colspan="4" style="text-align: center;">Total stock (<?php echo $cpt_tot_stock." Produits"; ?>)</th>
                                                <th colspan="4" style="text-align: center;">Total P.A (<?php echo number_format($cpt_prix_A,0,',','.')." FC";?>)</th>
                                                <th colspan="4" style="text-align: center;">Total P.U (<?php echo number_format($cpt_prix_U,0,',','.')." FC";?>)</th>
                                            </tr-->
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
                                    <h1 style="color:white;font-size: 16px !important;"><i class="fa fa-plus-circle"></i><span class="table-project-n"> Nouveau</span> client</h1>
                                </div>
                                
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                     <!-- FORMULAIRE AJOUT-->
                                   <div class="modal-body" style="padding: 15px 70px;">                                                       
                                   <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-offset-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action=" " class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-4 col-sm-4 col-xs-6">                      
                                                                <div class="form-group">
                                                                   
                                                                   <label style="color: white;">Client(*)</label>
                                                                    <input name="client"id="client" type="text" class="form-control" placeholder="Client(*)">
                                                                </div>
                                                                
                                                                 <div class="form-group">
                                                                   
                                                                   <label style="color: white;">Nom Client(*)</label>
                                                                    <input name="n_cli"id="n_cli" type="text" class="form-control" placeholder="Nom client(*)">
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                   
                                                                   <label style="color: white; text-align: Left;">Adresse (*)</label>
                                                                    
                                                                    <input class="form-control" name="adrs_cli" id="adrs_cli" placeholder="Adresse du client">
                                                                    
                                                                </div>
                                                                <!--div class="form-group">
                                                                    <input name="frm_dos"id="frm_dose" type="text" class="form-control" placeholder="Dosage(*)">
                                                                </div-->
                                                               <!--div class="form-group">
                                                                    <input name="dci"id="dci" type="text" class="form-control" placeholder="DCI du produit(*)">
                                                                </div-->
                                                                <hr>
                                                            </div>
                                                                                           
                                                        </div>
                                                        
                                                  </div>
                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                      
                                                      

                                                      <div class="modal-footer footer-modal-admin warning-md" style="padding: 0px 0px 15px 0px;">
                                        <a data-dismiss="modal" href="#">Annuler</a>
                                        <a href="" id="btn-add-cli">Ajouter client</a>
                                        </div>
                                                       
                                    </form>                                     
                                     <!-- FORMULAIRE AJOUT-->
                                    <div class="alert alert-danger alert-mg-b alert-st-four is-no-visible" role="alert" style="margin: 21px;">
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
                                                                    $req_cat3=$bdd->prepare('Select * from t_categorie');
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
    <script src="js/app/client-process.js"></script>
    
    
</body>

</html>