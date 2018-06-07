<?php  
	include "header.php";
	$marcas = $admin -> getMarcas();
?>
	<h1>Catalogo de marcas</h1>
	<a class="btn btn-success mt-2 mb-2" role="button" href="marcas.form.php">Nueva marca</a>
	<table class="table table-striped table-dark">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Marca</th>	      	      
	      <th scope="col">Imagen</th>	      	      
	      <th scope="col">Opciones</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php  
	  		for ($i=0; $i < count($marcas); $i++) { 
	  			echo '
	  				<tr>
						<th scope="row">'.$marcas[$i]['id'].'</th>
						<td>'.$marcas[$i]['marca'].'</td>			
						<td>'.$marcas[$i]['imagen'].'</td>	  				  
						<td>
	  				  		<a class="ml-3 text-warning" href="marcas.form_update.php?id_marca='.$marcas[$i]['id'].'">
	  				  			<i class="fas fa-pencil-alt"></i>
  				  			</a>
  				  			<a class="ml-3 text-danger" href="marcas.delete.php?id_marca='.$marcas[$i]['id'].'">
	  				  			<i class="fas fa-trash-alt"></i>
  				  			</a>
		  				</td>	  				  
	  				</tr>
	  			';
	  		}
	  	?>
	    	    
	  </tbody>
	</table>

<?php  
	include "footer.php";
?>