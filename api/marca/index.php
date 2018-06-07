<?php
	header('Content-Type: application/json');
	include "../../deposito.class.php";	
	/**
		 * 
		 */
	class apiMarca extends Deposito
	{
		
		public function getOneMarca($id_marca)
		{
			$sql = "SELECT * FROM marca WHERE id=:id_marca ORDER BY marca";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_marca', $id_marca);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function getAllMarca()
		{
			$sql = "SELECT * FROM marca ORDER BY marca";
			$stmt = $this->con->query($sql);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function newMarca()
		{
			$marca = file_get_contents('php://input');
			$datos = json_decode($marca);
			$sql = "INSERT INTO marca(
									marca,
									imagen									
								) 
					VALUES(
						:marca,
						:imagen						
					)";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':marca', $datos->marca);
			$stmt->bindParam(':imagen', $datos->imagen);			
			$stmt->execute();			
			$row = $stmt->rowCount();
			if($row == 1){
				$resultado['mensaje'] = "La marca se ha insertado";
			}else{
				$resultado['mensaje'] = "No ha sido posible insertar una nueva marca";
			}
			return $resultado;
			
		}

		public function updateMarca($id_marca)
		{
			$cliente = file_get_contents('php://input');
			$datos = json_decode($cliente);
			$sql = "UPDATE marca SET 
									marca = :marca,
									imagen = :imagen
			
					WHERE
						id=:id_marca
			";
			$stmt = $this->con->prepare($sql);			
			$stmt->bindParam(':marca', $datos->marca);
			$stmt->bindParam(':imagen', $datos->imagen);
			$stmt->bindParam(':id_marca', $id_marca);
			$stmt->execute();			
			$row = $stmt->rowCount();
			if($row == 1){
				$resultado['mensaje'] = "La marca se ha modificado";
			}else{
				$resultado['mensaje'] = "No ha sido posible modificar la marca";
			}
			return $resultado;
			
		}

		public function deleteMarca($id_marca)
		{
			$sql = "DELETE FROM marca WHERE id=:id_marca";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_marca', $id_marca);
			$stmt->execute();
			$row = $stmt->rowCount();
			if($row == 1){
				$resultado['mensaje'] = "El registro se ha eliminado";
			}else{
				$resultado['mensaje'] = "El ID no existe";
			}
			return $resultado;
		}
	}	
	$metodo = $_SERVER['REQUEST_METHOD'];
	$deposito = new apiMarca;
	$deposito->conexion();
	switch ($metodo) {
		case 'POST':
			$result = $deposito->newMarca();
			break;
		case 'PUT':
			if (isset($_GET['id_marca'])) {
				if (is_numeric($_GET['id_marca'])) {
					$result = $deposito->updateMarca($_GET['id_marca']);
				}
			}
			break;
		case 'DELETE':
			if (isset($_GET['id_marca'])) {
				if (is_numeric($_GET['id_marca'])) {
					$result = $deposito->deleteMarca($_GET['id_marca']);
				}
			}
			break;
		default:
			if (isset($_GET['id_marca'])) {
				if (is_numeric($_GET['id_marca'])) {
					$result = $deposito->getOneMarca($_GET['id_marca']);
				}
			}else{
				$result = $deposito->getAllMarca();
			}
			break;
	}
	$json_data = json_encode($result);
	echo $json_data;
?>