<?php
	header('Content-Type: application/json');
	include "../../deposito.class.php";	
	/**
		 * 
		 */
	class apiCliente extends Deposito
	{
		
		public function getOneClient($id_cliente)
		{
			$sql = "SELECT * FROM cliente WHERE id_cliente=:id_cliente ORDER BY apaterno,amaterno,nombre";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_cliente', $id_cliente);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function getAllClient()
		{
			$sql = "SELECT * FROM cliente ORDER BY apaterno,amaterno,nombre";
			$stmt = $this->con->query($sql);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function newClient()
		{
			$cliente = file_get_contents('php://input');
			$datos = json_decode($cliente);
			$sql = "INSERT INTO cliente(
									nombre,
									apaterno,
									amaterno,
									telefono,
									domicilio,
									id_usuario
								) 
					VALUES(
						:nombre,
						:apaterno,
						:amaterno,
						:telefono,
						:domicilio,
						16
					)";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':nombre', $datos->nombre);
			$stmt->bindParam(':apaterno', $datos->apaterno);
			$stmt->bindParam(':amaterno', $datos->amaterno);
			$stmt->bindParam(':telefono', $datos->telefono);
			$domicilio = $datos->domicilio->calle.' '.$datos->domicilio->numeroExterior;
			$stmt->bindParam(':domicilio', $domicilio);
			$stmt->execute();			
			$row = $stmt->rowCount();
			if($row == 1){
				$resultado['mensaje'] = "El cliente se ha insertado";
			}else{
				$resultado['mensaje'] = "No ha sido posible insertar un nuevo cliente";
			}
			return $resultado;
			
		}

		public function updateClient($id_cliente)
		{
			$cliente = file_get_contents('php://input');
			$datos = json_decode($cliente);
			$sql = "UPDATE cliente SET 
									nombre = :nombre,
									apaterno = :apaterno,
									amaterno = :amaterno,
									telefono = :telefono,
									domicilio = :domicilio,
									id_usuario= 16							
			
					WHERE
						id_cliente=:id_cliente
			";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':nombre', $datos->nombre);
			$stmt->bindParam(':apaterno', $datos->apaterno);
			$stmt->bindParam(':amaterno', $datos->amaterno);
			$stmt->bindParam(':telefono', $datos->telefono);
			$domicilio = $datos->domicilio->calle.' '.$datos->domicilio->numeroExterior;
			$stmt->bindParam(':domicilio', $domicilio);
			$stmt->bindParam(':id_cliente', $id_cliente);
			$stmt->execute();			
			$row = $stmt->rowCount();
			if($row == 1){
				$resultado['mensaje'] = "El cliente se ha modificado";
			}else{
				$resultado['mensaje'] = "No ha sido posible modificar al cliente";
			}
			return $resultado;
			
		}

		public function deleteClient($id_cliente)
		{
			$sql = "DELETE FROM cliente WHERE id_cliente=:id_cliente";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_cliente', $id_cliente);
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
	$deposito = new apiCliente;
	$deposito->conexion();
	switch ($metodo) {
		case 'POST':
			$result = $deposito->newClient();
			break;
		case 'PUT':
			if (isset($_GET['id_cliente'])) {
				if (is_numeric($_GET['id_cliente'])) {
					$result = $deposito->updateClient($_GET['id_cliente']);
				}
			}
			break;
		case 'DELETE':
			if (isset($_GET['id_cliente'])) {
				if (is_numeric($_GET['id_cliente'])) {
					$result = $deposito->deleteClient($_GET['id_cliente']);
				}
			}
			break;
		default:
			if (isset($_GET['id_cliente'])) {
				if (is_numeric($_GET['id_cliente'])) {
					$result = $deposito->getOneClient($_GET['id_cliente']);
				}
			}else{
				$result = $deposito->getAllClient();
			}
			break;
	}
	$json_data = json_encode($result);
	echo $json_data;
?>