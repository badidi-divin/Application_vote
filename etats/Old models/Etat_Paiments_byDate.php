<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CABINET TRANSPARENCY</title>

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

        </div>
        <?php  
        if($_SESSION['dateD'] == $_SESSION['dateF']){
            
        ?>
        <h4 ><center>RELEVE COMPLET DES PAIEMENTS ENCAISSES (<?php echo $_SESSION['dateD'];?>)</center></h4>              
        <?php  
        }
        else {
            
        ?>
        <h4 ><center>RELEVE COMPLET DES PAIEMENTS ENCAISSES (<?php echo $_SESSION['dateD'].' - '.$_SESSION['dateF'];  ?>)</center></h4>
       <?php  
        }   
        ?>
        <br/><br/>
        <hr style="border-color: #0b3e6f">
        <table class="table table-bordered table-responsive">
            <thead class="bg-default-gradient">
                <tr>
                  <th>N°</th>
                  <th>N°Client</th>
                  <th>Date</th>
                  <th>Montant</th>
                  <th>Dévise</th>
                  <th>Motif paiement</th>
                  <th>Compte</th>
                </tr>
                </thead>
             <tbody>
                <?php

        require_once('../Controleur/ControleurPaiements.php');

                    $CtrlPaiements1=new ControleurPaiements();
                    $CtrlPaiements2=new ControleurPaiements();

                    $cpt1=0; 
                    $cpt2=0; 

                    if(isset($_SESSION['dateD']) || isset($_SESSION['dateF'])){

                    $CtrlPaiements1->Lister_paiementsDate($_SESSION['dateD'],$_SESSION['dateF']);
                    while($data=$CtrlPaiements1->Ligne3->fetch()) {
                        ?>
                        <tr>
                            <td><?php echo $data['NumP']; ?></td>
                            <td><?php echo $data['Num_Client']; ?></td>
                            <td><?php echo $data['DateP']; ?></td>
                            <td><?php echo $data['Montant']; ?></td>
                            <td><?php echo $data['Devise']; ?></td>
                            <td><?php echo $data['Motif']; ?></td>
                            <td><?php echo $data['Compte']; ?></td>
                            

 <!-- /.modal suppression --> 

        <!-- /.modal suppression --> 
                            
   <?php
                          if($data['Devise']=="USD"){
                            $cpt1=$cpt1+$data['Montant'];
                          }
                          else if($data['Devise']=="CFD"){
                            $cpt2=$cpt2+$data['Montant'];
                          }

                       }

                   }
              ?>
   <!-- /.modal-dialog -->               
                            
                        </tr>

                </tbody>

                <tfoot class="bg-default-gradient">
                        <tr>
                   <th rowspan="2" colspan="3"><br/><h3><b><center>TOTAL GENERAL</center></b></h3></th>
                   <th colspan="2"><h3><b>Montant en Dollar</b></h3></th>
                   <th ><h3><b><?php echo ''.number_format($cpt1,2,',','.').''; ?></b></h3></th>
                   <th ><h3><b>$</b></h3></th>
                        </tr>
                        <tr>
                   <th colspan="2"><h3><b>Montant en Franc congolais</b></h3></th>
                   <th ><h3><b><?php echo ''.number_format($cpt2,2,',','.').''; ?></b></h3></th>
                   <th ><h3><b>FC</b></h3></th>
                        </tr>
                </tfoot> 
                
              </table>

    </div>
</section>

<script src="../js/jquery.min.js" type="application/javascript"></script>
<script>
    $(function () {
        print();
    });
</script>
</body>
</html>