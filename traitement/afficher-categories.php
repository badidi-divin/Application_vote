<?php
 require('../includes/dbconnect.php');
$req_cat=$bdd->prepare('Select * from t_categorie');
$req_cat->execute(array());?>

	<?php while($ligne2=$req_cat->fetch()){?>
	<option value="<?=$ligne2['lib_cat'];?>"><?=$ligne2['lib_cat'];?></option>
			<?php } ?>                                 
