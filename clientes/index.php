<?php  
	include "header.php";	
	$admin->validar(array('Cliente'));
	$id_usuario = null;
	if (isset($_SESSION['id_usuario'])) {		
		$id_usuario = $_SESSION['id_usuario'];		
	}
	$sql = "SELECT nombre, apaterno from cliente where id_usuario=".$id_usuario;
	$cliente_data = $admin->consultar($sql);
	$nombre_cliente = $cliente_data['nombre']." ".$cliente_data['apaterno'];

?>
	<main class="container no-gutters mt-3 mx-auto">
		<div class="row">
			<div class="col-md-12 mx-auto">
				<h1>Bienvenido a la tienda en linea <?php echo $nombre_cliente; ?></h1>	
			</div>
		</div>
	</main>
<?php  
	echo "<pre>";
	var_dump($_SESSION);
	echo "</pre>";
	include "footer.php";
?>