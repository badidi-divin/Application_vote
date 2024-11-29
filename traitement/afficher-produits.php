<?php 
    require('../includes/dbconnect.php');
    $req=$bdd->prepare('Select * from t_produits');
    $req->execute(array());
      while($lignes=$req->fetch()){?>
               <tr>
					<td><?=$lignes['ref_prod'];?></td>
					<td><?=$lignes['designation'];?></td>
					<td><?=$lignes['fabricant'];?></td>
					<td><?=$lignes['frm_dos'];?></td>
					<td><?=$lignes['dci'];?></td>
					<td>
                    <a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #FF8800;'><?php echo $lignes['prix_gros'].' FC'; ?></span></a>
                </td>
                <td>
                     <a><span class='badge bg-success' style='font-size: 0.9em; padding: 6px 12px 6px 12px ; background-color: #FF8800;'><?php echo $lignes['prix_unit'].' FC'; ?></span></a>
                </td>
                 
					<td>
					<form action="traitement/produit-traitement.php" method="post">
					<input type="hidden" value="<?=$lignes['id'];?>" name="id_prod" id="id_prod">
					
					<input name="qte_stock" id="qte_stock" type="number" class="form-control valid" placeholder="Quantité en stock" min=1 value="<?=$lignes['stock'];?>" style="width:76px !important; display:inline;">
					
					<button type="submit" name="btn-stock" id=""  class="btn btn-stock" style="background-color: #36C21F;" title="M.A.J Stock : <?=$lignes['designation'];?>"><i class="fa fa-undo"></i></button>
					<!--a href="traitement/produit-traitement.php?pr_id=<?//=md5($lignes['id']);?>" id="btn-stock"></i></a--> 
					</form>    
					</td>
					<td><?=$lignes['Lib_cat'];?></td>
					<td><?=$lignes['date_creat'];?></td>
					<td><?=$lignes['date_prod'];?></td>
					<td><?=$lignes['date_expirat'];?></td>
					<td>
					<a href="traitement/produit-traitement.php?spr_prd=<?=$lignes['id'];?>&desi=<?=$lignes['designation'];?>" class="btn btn-danger btn-xs btn-supp" data-toggle="modal" style="color:white; background-color: #D80027" title="Supprimer le produit : <?=$lignes['designation']?>"><i class="fa fa-trash"></i></a>
					
					<a href="#SupNumero18" class="btn btn-danger btn-xs" data-toggle="modal" style="color:white; 
					background-color: #006DF0; border-color:#006DF0" title="Imprimer la liste des medicaments."><i class="fa fa-print"></i></a>
					</td>
				</tr>
          <?php  } ?>

