<?php  
include "header.php";
$productos = array();
if (isset($_GET['proyecto_id'])) {
	$productos = $deposito -> getProductosDeProyecto($_GET['proyecto_id']);			
}else{
	$proyectos = $deposito -> getProyectos();
}
/**
echo "<pre>";
print_r($proyectos);
die;*/
?>	
<section>
	<article>
		<?php if(isset($proyectos)): ?>
		<h1>Lista de proyectos</h1>
		<div id="accordion" class="mt-3">
			<?php				
				for ($i=0; $i < count($proyectos); $i++) { 
					$proyecto = '
						<div class="card">
							<div class="card-header p-0" id="heading_'.$proyectos[$i]['id'].'">					
								<button class="btn bg-light collapsed p-0" data-toggle="collapse" data-target="#collapse_'.$proyectos[$i]['id'].'" aria-expanded="false" aria-controls="collapse_'.$proyectos[$i]['id'].'">
									<img class="card-img-top" src="images/proyectos/'.$proyectos[$i]['imagen'].'" alt="'.$proyectos[$i]['proyecto'].'">
									<h3>'.$proyectos[$i]['proyecto'].'</h3>
								</button>					
							</div>

							<div id="collapse_'.$proyectos[$i]['id'].'" class="collapse" aria-labelledby="heading_'.$proyectos[$i]['id'].'" data-parent="#accordion">
								<div class="card-body">
									<h5 class="card-title">'.$proyectos[$i]['proyecto'].'</h5>
									<p class="card-text">'.$proyectos[$i]['descripcion'].'.</p>
									<a href="?proyecto_id='.$proyectos[$i]['id'].'"><p class="card-text"><small class="text-muted">Ver más</small></p></a>
								</div>
							</div>
						</div>
					';
					echo $proyecto;
				}

			?>			

		</div>
		<?php elseif(isset($_GET['proyecto_id'])): 			
		?>
		<h1>Productos para <?php echo $productos[0]['proyecto'] ?></h1>
		<div class="list-group">
			<?php 
				foreach ($productos as $producto) {
					echo '<a href="producto.php?id_producto='.$producto['id'].'" class="list-group-item list-group-item-action">'.ucwords($producto['nombre']).'</a>';
				}
			?>
		</div>
		<?php  
			endif;
		?>
	</article>
</section>


<?php  
include "footer.php";
?>

