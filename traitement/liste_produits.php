<?php

    require '../includes/dbconnect.php' ;
   
   if(isset($_GET['query'])){
      
      
            $req1 = $bdd->prepare("SELECT ref_prod, designation, prix_unit, stock, unite from t_produits where designation like ? or ref_prod like ?");
            $req1->execute(array('%'.$_GET['query'].'%','%'.$_GET['query'].'%'));
           
            $html2 ='';
            if($Lignes=$req1->rowcount()>0){
              while ($row=$req1->fetch()) {
                # code..
               //$data['nom']= $row['username'];
               //$data['pwd']= $row['password'];
               $html2 .='
                        <li class="list-group-item link-class" style="margin-left:13px;border-left: 0px;border-right: 0px;padding-left: 10px;padding-top: 8px;
padding-bottom: 8px;"><img src=./img/ico_drug.png height="29" 
                        width="29" class="img-thumbnail" style="margin-right:2px;"/> <span class="text-muted">'.$row['ref_prod'].' | </span><span class="text-muted">'.$row['designation'].'</span>'.' | <span class="text-muted">'.$row['prix_unit'].' $</span>'.' | <span class="text-muted">'.$row['stock']." ".$row['unite'].'</span></li>'  
                        ;
              }
            }
            else{
                $html2 .='
                        <li class="list-group-item link-class"><img src=./img/erreur.png height="40" 
                        width="40" class="img-thumbnail" /> Aucun resultat trouvé...</li>'  
                        ;
            }
             echo $html2;
            }

     //$data1=array_unique($data);
     //echo json_encode($data1);  