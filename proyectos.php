<?php  
include "header.php";
include('deposito.class.php');	
$deposito = new Deposito;
$proyectos = $deposito -> getProyectos();
$productos = array();
if (isset($_GET['proyecto_id'])) {
	$productos = $deposito -> getProductosDeProyecto($proyecto_id = $_GET['proyecto_id']);			
}
/**
echo "<pre>";
print_r($proyectos);
die;*/
?>	
<section>
	<article>
		<h1>Lista de proyectos</h1>
		<div id="accordion" class="mt-3">
			<?php  
				if (isset($_GET['proyecto_id']) && !empty($productos)) {
					echo "Entra el if";
					echo "<pre>";
					print_r($proyectos);
					die;
				}else {
					echo "Empty";
				}

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

		<?php  

		?>
	</article>
</section>


<?php  
include "footer.php";
?>

