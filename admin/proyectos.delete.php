<?php  
	include "header.php";
	$admin->validar(array('Gerente'));
	$id_proyecto = null;
	if (isset($_GET['id_proyecto'])) {
		$id_proyecto = $_GET['id_proyecto'];
	}
	$sql = "DELETE FROM proyecto WHERE id=:id_proyecto";
	$stmt = $admin->con->prepare($sql);
	$stmt->bindParam(':id_proyecto', $id_proyecto);
	$stmt->execute();
	$filas_afectadas = $stmt->rowCount();
	echo "Se eliminaron ".$filas_afectadas." filas";
?>
<br/>
<a href="proyectos.php">back</a>
<?php  
	include "footer.php";	
?>