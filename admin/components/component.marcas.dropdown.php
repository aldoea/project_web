<?php
	$marcas=$admin->getMarcas();
	echo '<select required="true" class="form-control" name="marca">';
	foreach ($marcas as $marca) {
		if (isset($id_marca)) {
			if ($id_marca == $marca['id']) {
				echo '<option selected value="'.$marca['id'].'">'.$marca["marca"].'</option>';
			}else{
				echo '<option value="'.$marca['id'].'">'.$marca["marca"].'</option>';
			}			
		}else{
			echo '<option value="'.$marca['id'].'">'.$marca["marca"].'</option>';
		}		
	}	
	echo '</select>';	
?>