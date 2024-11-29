<?php

$req_cat=$bdd->prepare('Select sum(stock) as stock from t_produits where etat=1');
$req_cat->execute(array());
$nbre_prod=$req_cat->fetch()['stock'];

$count_vente=$bdd->prepare('Select sum(qte_achet) as ventes from t_ligne_cmd ');
$count_vente->execute(array());
$ventes=$count_vente->fetch()['ventes'];

$count_data=$bdd->prepare('Select count(id) as nbre_arch from archives ');
$count_data->execute(array());
$fichier=$count_data->fetch()['nbre_arch'];

$count_data=$bdd->prepare('Select count(id) as nbre_arch from archives ');
$count_data->execute(array());
$fichier=$count_data->fetch()['nbre_arch'];
?>
<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><!--img class="main-logo" src="img/logo/logo.png" alt="" /--></a>
                <strong><a href="index.html"><img src="img/logo/logosn.png" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li <?php if($menu=='0') echo "class='active'";?>>
                            <a class="has-arrow" href="tableau_bord.php">
                                   <span class="educate-icon educate-home icon-wrap"></span>
                                   <span class="mini-click-non">Tableau de bord</span>
                                </a>
                            <!--ul class="submenu-angle" aria-expanded="true">
                                <li><a title="Dashboard v.1" href="index.html"><span class="mini-sub-pro">Dashboard v.1</span></a></li>
                                <li><a title="Dashboard v.2" href="index-1.html"><span class="mini-sub-pro">Dashboard v.2</span></a></li>
                                <li><a title="Dashboard v.3" href="index-2.html"><span class="mini-sub-pro">Dashboard v.3</span></a></li>
                                <li><a title="Analytics" href="analytics.html"><span class="mini-sub-pro">Analytics</span></a></li>
                                <li><a title="Widgets" href="widgets.html"><span class="mini-sub-pro">Widgets</span></a></li>
                            </ul-->
                        </li>
                        <li <?php if($menu=='1') echo "class='active'";?>>
                            <a title="Landing Page" href="medicaments.php" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Articles</span><small class="badge float-right badge-warning"><?php if (isset($nbre_prod)) echo $nbre_prod; else echo '00'?></small></a>
                        </li>
						
						 <li <?php if($menu=='6') echo "class='active'";?>>
                            <a title="Landing Page" href="clients.php" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Clients</span><!--small class="badge float-right badge-warning"><?php if (isset($nbre_prod)) echo $nbre_prod; else echo '00'?></small--></a>
                        </li>
                       
                        <li <?php if($menu=='2') echo "class='active'";?>>
                            <a class="has-arrow" href="ventes.php" aria-expanded="false"><span class="educate-icon educate-form icon-wrap"></span> <span class="mini-click-non">Ventes</span><small class="badge float-right badge-warning" style="background-color:#006DF0;"><?php if (isset($ventes)) echo $ventes; else echo '00'?></small></a>
                            <ul class="submenu-angle form-mini-nb-dp" aria-expanded="false">
                                 <!--li><a title="Basic Form Elements" href="ventes.php"><span class="mini-sub-pro">Nouveau dévis</span></a></li-->
                                <li><a title="Basic Form Elements" href="ventes.php"><span class="mini-sub-pro">Nouvelle opération</span></a></li>
                                <li><a title="Advance Form Elements" href="liste-ventes.php?lst=1"><span class="mini-sub-pro">Details des opérations</span></a></li>

                            </ul>
                        </li>

                           <li <?php if($menu=='3') echo "class='active'";?>>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="educate-icon educate-charts icon-wrap"></span> <span class="mini-click-non">Rapports</span></a>
                            <ul class="submenu-angle chart-mini-nb-dp" aria-expanded="false">
                                <li><a title="Advance Form Elements" href="liste-grouper-ventes.php"><span class="mini-sub-pro">Etat Périodiques</span></a></li>
                            </ul>
                        </li-->

                         <!--li <?php if($menu=='4') echo "class='active'";?>>
                            <a class="has-arrow" href="all-professors.html" aria-expanded="false"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Médicaments</span><small class="badge float-right badge-warning">00</small></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Professors" href="all-professors.html"><span class="mini-sub-pro">All Professors</span></a></li>
                                <li><a title="Add Professor" href="add-professor.html"><span class="mini-sub-pro">Add Professor</span></a></li>
                                <li><a title="Edit Professor" href="edit-professor.html"><span class="mini-sub-pro">Edit Professor</span></a></li>
                                <li><a title="Professor Profile" href="professor-profile.html"><span class="mini-sub-pro">Professor Profile</span></a></li>
                            </ul>
                        </li-->
                        <li <?php if($menu=='5') echo "class='active'";?>>
                            <a title="Landing Page" href="archives.php" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Archives</span><small class="badge float-right badge-danger"><?php if (isset($fichier)) echo $fichier; else echo '00'?></small></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>