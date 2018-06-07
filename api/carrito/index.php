<?php
	header('Content-Type: application/json');
	include "../../deposito.class.php";	
	/**
		 * 
		 */
	class apiCarrito extends Deposito
	{
		
		public function getOneCarrito($id_producto)
		{
			$resultado = array();
			if(in_array($id_producto, array_column($_SESSION['carrito'], 'id_producto'))) {
				$key = array_search($id_producto, array_column($_SESSION['carrito'], 'id_producto'));
				$resultado = $_SESSION['carrito'][$key];
			}
			return $resultado;
		}

		public function getAllCarrito()
		{
			if (isset($_SESSION['carrito'])) {
				return $_SESSION['carrito'];
			}else{
				return array();
			}
		}

		public function addToCarrito()
		{
			$carrito = file_get_contents('php://input');
			$datos = json_decode($carrito);			
			$id_producto = $datos->id_producto;
			$cantidad = $datos->cantidad;
			if (!isset($_SESSION['carrito'])) {
				$_SESSION['carrito'] = array();
			}
			$carrito_compare = $_SESSION['carrito'];
			$datos = array('id_producto'=>$id_producto, 'cantidad'=>$cantidad);
			if(in_array($id_producto, array_column($_SESSION['carrito'], 'id_producto'))) {
				$key = array_search($id_producto, array_column($_SESSION['carrito'], 'id_producto'));
				$_SESSION['carrito'][$key]['cantidad'] += $cantidad;
			}else{
				array_push($_SESSION['carrito'], $datos);
			}
			if ($_SESSION['carrito'] === $carrito_compare) {
				$resultado['mensaje'] = "No ha sido posible agregar producto al carrito";
				$resultado['carrito'] = $_SESSION['carrito'];
			}else{
				$resultado['mensaje'] = "Se ha agregado el producto al carrito exitosamente";
				$resultado['carrito'] = $_SESSION['carrito'];
			}
			return $resultado;
		}

		public function updateCarritoCantidad($id_producto)
		{
			$producto = file_get_contents('php://input');
			$datos = json_decode($producto);
			$cantidad = $datos->cantidad;
			if(in_array($id_producto, array_column($_SESSION['carrito'], 'id_producto'))) {
				$key = array_search($id_producto, array_column($_SESSION['carrito'], 'id_producto'));
				$_SESSION['carrito'][$key]['cantidad'] = $cantidad;
				$resultado['mensaje'] = "Se ha modificado la cantidad del producto en el carrito exitosamente";
			}
			return $resultado;
		}

		public function deleteOneCarrito($id_producto)
		{
			if(in_array($id_producto, array_column($_SESSION['carrito'], 'id_producto'))) {
				$key = array_search($id_producto, array_column($_SESSION['carrito'], 'id_producto'));
				unset($_SESSION['carrito'][$key]);
				$resultado['mensaje'] = "El registro se ha eliminado";
			}else{
				$resultado['mensaje'] = "El ID no existe";
			}
			return $resultado;
		}

		public function dropCarrito()
		{
			if (isset($_SESSION['carrito'])) {
				unset($_SESSION['carrito']);
				$resultado['mensaje'] = "El carrito se ha eliminado";
			}else{
				$resultado['mensaje'] = "El carrito no pudo ser eliminado";
			}
			return $resultado;
		}

		public function comprarCarrito()
		{
			if (isset($_SESSION['carrito'])) {
				if (sizeof($_SESSION['carrito']) > 0) {
					$request_data = file_get_contents('php://input');
					$datos = json_decode($request_data);
					$this->con->beginTransaction();
					try {
						$sql = "SELECT id_cliente FROM cliente WHERE id_usuario=:id_usuario";
						$stmt = $this->con->prepare($sql);
						$id_usuario = $datos->id_usuario;
						$stmt->bindParam(':id_usuario', $id_usuario);
						$stmt->execute();
						$expected_data = $stmt->fetchObject();
						$id_cliente = $expected_data->id_cliente;
						$sql = "INSERT INTO carrito(id_cliente, fecha, estatus) VALUES(:id_cliente, now(), 1)";
						$stmt = $this->con->prepare($sql);
						$stmt->bindParam(':id_cliente', $id_cliente);
						$stmt->execute();
						$id_carrito = $this->con->lastInsertId();
						foreach ($_SESSION['carrito'] as $key => $value) {
							$id_producto = $_SESSION['carrito'][$key]['id_producto'];
							$cantidad = $_SESSION['carrito'][$key]['cantidad'];
							$sql = "SELECT * FROM producto WHERE id = :id";
							$stmt = $this->con->prepare($sql);
							$stmt->bindParam(':id', $id_producto);
							$stmt->execute();
							$datos = $stmt->fetchObject();
							$precio_final = 0;
							$precio_final = !is_null($datos->precio_desc) ? $datos->precio_desc : $datos->precio;
							$sql = "INSERT INTO carrito_detalle VALUES(:id_carrito, :id_producto, :cantidad, :precio_final)";
							$stmt = $this->con->prepare($sql);
							$stmt->bindParam(':id_carrito', $id_carrito);
							$stmt->bindParam(':id_producto', $id_producto);
							$stmt->bindParam(':cantidad', $cantidad);
							$stmt->bindParam(':precio_final', $precio_final);
							$stmt->execute();							
						}
						$this->con->commit();
						unset($_SESSION['carrito']);
						$resultado['mensaje'] = "Se ha realizado la compra exitosamente";						
					} catch (Exception $e) {
						$this->con->rollBack();
						$resultado['mensaje'] = "Error al realizar la compra";
					}					
				}
			}else{
				$resultado['mensaje'] = "No se puede realizar la compra";
			}
			return $resultado;
		} // END comprarCarrito
	}	
	$metodo = $_SERVER['REQUEST_METHOD'];
	$deposito = new apiCarrito;
	$deposito->conexion();
	switch ($metodo) {
		case 'POST':
			if (isset($_GET['comprar'])) {
				if (is_numeric($_GET['comprar'])) {
					if ($_GET['comprar'] == 1) {
						$result = $deposito->comprarCarrito();
						break;
					}
				}
			}
			$result = $deposito->addToCarrito();
			break;
		case 'PUT':
			if (isset($_GET['id_producto'])) {
				if (is_numeric($_GET['id_producto'])) {
					$result = $deposito->updateCarritoCantidad($_GET['id_producto']);
				}
			}
			break;
		case 'DELETE':
			if (isset($_GET['id_producto'])) {
				if (is_numeric($_GET['id_producto'])) {
					$result = $deposito->deleteOneCarrito($_GET['id_producto']);
				}
			}else{
				$result = $deposito->dropCarrito();
			}
			break;
		default:
			if (isset($_GET['id_producto'])) {
				if (is_numeric($_GET['id_producto'])) {
					$result = $deposito->getOneCarrito($_GET['id_producto']);
				}
			}else{
				$result = $deposito->getAllCarrito();
			}
			break;
	}
	$json_data = json_encode($result);
	echo $json_data;
?>