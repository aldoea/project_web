<?php  
	include "header.php";
?>
	<h1>Catalogo de productos</h1>
	<a class="btn btn-success mt-2 mb-2" role="button" href="productos.form.php">Nuevo producto</a>
	<table class="table table-striped table-dark">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Marca</th>
	      <th scope="col">Precio</th>
	      <th scope="col">Precio desc</th>
	      <th scope="col">Opciones</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php  
	  		for ($i=0; $i < count($productos); $i++) { 
	  			echo '
	  				<tr>
						<th scope="row">'.$productos[$i]['id'].'</th>
						<td>'.$productos[$i]['nombre'].'</td>
						<td>'.$productos[$i]['marca'].'</td>
						<td>'.$productos[$i]['precio'].'</td>
						<td>'.$productos[$i]['precio_desc'].'</td>	  				  
						<td>
	  				  		<a class="ml-3 text-warning" href="productos.form.php?producto_id='.$productos[$i]['id'].'">
	  				  			<i class="fas fa-pencil-alt"></i>
  				  			</a>
  				  			<a class="ml-3 text-danger" href="productos.delete.php?producto_id='.$productos[$i]['id'].'">
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