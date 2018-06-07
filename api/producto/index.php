<?php
	header('Content-Type: application/json');
	include "../../deposito.class.php";	
	/**
		 * 
		 */
	class apiProducto extends Deposito
	{
		
		public function getOneProducto($id_producto)
		{
			$sql = "SELECT * FROM producto WHERE id=:id_producto ORDER BY nombre";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_producto', $id_producto);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function getAllProducto()
		{
			$sql = "SELECT * FROM producto";
			$stmt = $this->con->query($sql);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function newProducto()
		{
			$producto = file_get_contents('php://input');
			$datos = json_decode($producto);
			$sql = "INSERT INTO producto(
									nombre,
									imagen,
									precio,
									precio_desc,
									id_marca
								) 
					VALUES(
						:nombre,
						:imagen,
						:precio,
						:precio_desc,
						:id_marca
					)";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':nombre', $datos->nombre);
			$stmt->bindParam(':imagen', $datos->imagen);
			$stmt->bindParam(':precio', $datos->precio);
			$stmt->bindParam(':precio_desc', $datos->precio_desc);
			$stmt->bindParam(':id_marca', $datos->id_marca);			
			$stmt->execute();			
			$row = $stmt->rowCount();
			if($row == 1){
				$resultado['mensaje'] = "El producto se ha insertado";
			}else{
				$resultado['mensaje'] = "No ha sido posible insertar un nuevo producto";
			}
			return $resultado;
			
		}

		public function updateProducto($id_producto)
		{
			$producto = file_get_contents('php://input');
			$datos = json_decode($producto);
			$sql = "UPDATE producto SET 
									nombre = :nombre,
									imagen = :imagen,
									precio = :precio,
									precio_desc = :precio_desc,
									id_marca = :id_marca
			
					WHERE
						id=:id_producto
			";
			$stmt = $this->con->prepare($sql);			
			$stmt->bindParam(':nombre', $datos->nombre);
			$stmt->bindParam(':imagen', $datos->imagen);
			$stmt->bindParam(':precio', $datos->precio);
			$stmt->bindParam(':precio_desc', $datos->precio_desc);
			$stmt->bindParam(':id_marca', $datos->id_marca);
			$stmt->bindParam(':id_producto', $id_producto);
			$stmt->execute();			
			$row = $stmt->rowCount();
			if($row == 1){
				$resultado['mensaje'] = "La marca se ha modificado";
			}else{
				$resultado['mensaje'] = "No ha sido posible modificar la marca";
			}
			return $resultado;
			
		}

		public function deleteProducto($id_producto)
		{
			$sql = "DELETE FROM producto WHERE id=:id_producto";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_producto', $id_producto);
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
	$deposito = new apiProducto;
	$deposito->conexion();
	switch ($metodo) {
		case 'POST':
			$result = $deposito->newProducto();
			break;
		case 'PUT':
			if (isset($_GET['id_producto'])) {
				if (is_numeric($_GET['id_producto'])) {
					$result = $deposito->updateProducto($_GET['id_producto']);
				}
			}
			break;
		case 'DELETE':
			if (isset($_GET['id_producto'])) {
				if (is_numeric($_GET['id_producto'])) {
					$result = $deposito->deleteProducto($_GET['id_producto']);
				}
			}
			break;
		default:
			if (isset($_GET['id_producto'])) {
				if (is_numeric($_GET['id_producto'])) {
					$result = $deposito->getOneProducto($_GET['id_producto']);
				}
			}else{
				$result = $deposito->getAllProducto();
			}
			break;
	}
	$json_data = json_encode($result);
	echo $json_data;
?>