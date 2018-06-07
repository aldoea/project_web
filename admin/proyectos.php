<?php  
	include "header.php";
	$proyectos = $admin->getAllProyectos();
?>
	<h1>Catalogo de proyectos</h1>
	<a class="btn btn-success mt-2 mb-2" role="button" href="proyectos.form.php">Nuevo Proyecto</a>
	<table class="table table-striped table-dark">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Proyecto</th>	      	      
	      <th scope="col">Fecha</th>	      	      
	      <th scope="col">Descripcion</th>	      	      
	      <th scope="col">Imagen</th>	      	      
	      <th scope="col">Opciones</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php  
	  		foreach ($proyectos as $proyecto) {
	  			echo '
	  				<tr>
						<th scope="row">'.$proyecto['id'].'</th>
						<td>'.$proyecto['proyecto'].'</td>			
						<td>'.$proyecto['fecha'].'</td>
						<td>'.$proyecto['descripcion'].'</td>
						<td>'.$proyecto['imagen'].'</td>
						<td>
	  				  		<a class="ml-3 text-warning" href="proyectos.form_update.php?id_proyecto='.$proyecto['id'].'">
	  				  			<i class="fas fa-pencil-alt"></i>
  				  			</a>
  				  			<a class="ml-3 text-danger" href="proyectos.delete.php?id_proyecto='.$proyecto['id'].'">
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