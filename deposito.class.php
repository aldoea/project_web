<?php 
	session_start();
	/**
	* Clase principal del sistema Deposito del Hogar
	*/	
	class Deposito
	{
		/*		
			
		*/		
		var $con = null;// VARIABLE GLOBAL DE CONEXIÓN A BD
		/************************************************************
		* METODO: ESTABLECE CONEXIÓN A UNA BASE DE DATOS USANDO PDO Y ASIGNA LA CONEXION A UNA VARIBALE GLOBAL
		************************************************************/		
		public function conexion(){
			$user = 'root';
			$password = '';
			$server = 'localhost';
			$bd = 'depot';
							# DSN 									
			$mbd = new PDO('mysql:host='.$server.';dbname='.$bd, $user, $password);
			$this->con=$mbd;
		} # END conexion()

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR TODOS LOS PRODUCTOS EN LA BASE DE DATOS		
		* @return $productos 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getProductos()
		{
			$this->conexion();
			$sql = "SELECT 
						producto.id, 
						producto.nombre, 
						producto.imagen, 
						producto.precio, 
						producto.precio_desc, 
						producto.id_marca, 
						marca.marca 
					FROM 
						producto INNER JOIN marca 
					ON 
						producto.id_marca = marca.id 
					ORDER BY 
						producto.nombre;";
			$stmt = $this->con->query($sql);
			$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $productos;
		} # END getProductos

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR TODOS LOS PRODUCTOS SIMILARES A UNA CADENA DE TEXTO EN LA BASE DE DATOS
		* @param  $item 	string 	CADENA DE TEXTO A BUSCAR
		* @return $products 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function searchProductos($item)
		{
			$item = "%".$item."%";
			$sql = "SELECT producto.*, marca.marca FROM producto INNER JOIN marca ON producto.id_marca = marca.id WHERE nombre LIKE :item ORDER BY id";
			$this->conexion();
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':item', $item);
			$stmt->execute();
			$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $products;
		}

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR SOLO UN PRODUCTO SEGUN SU ID EN LA BASE DE DATOS
		* @param  $id_producto 		integer ID QUE SE DESEA ENCONTRAR 		
		* @return $producto 		array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getProductoById($id_producto){
			$this->conexion();
			$sql = "SELECT * FROM producto WHERE id=:id_producto";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_producto', $id_producto);
			$stmt->execute();
			$producto = $stmt->fetchObject();
			return $producto;
		}

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA TODAS LAS MARCAS SEGUN SU MARCA
		* @param  $id_marca 		integer ID QUE SE DESEA ENCONTRAR 		
		* @return $producto 		array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getProductosByIdMarca($id_marca)
		{
			$this->conexion();
			$sql = "SELECT 
						producto.id, 
						producto.nombre, 
						producto.imagen, 
						producto.precio, 
						producto.precio_desc, 
						producto.id_marca,
                        marca.id AS id_marca,
						marca.marca 
					FROM 
						producto INNER JOIN marca 
					ON 
						producto.id_marca = marca.id 
                    WHERE 
                    	id_marca = :id_marca
					ORDER BY 
						producto.nombre";
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_marca', $id_marca);
			$stmt->execute();
			$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $productos;
		}
		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR TODOS LAS MARCAS EN LA BASE DE DATOS		
		* @return $marcas 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getMarcas()
		{
			$sql = "SELECT * FROM marca";
			$this->conexion();
			$stmt = $this->con->query($sql);
			$marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $marcas;
		} # END getMarcas

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR TODOS LAS MARCAS EN LA BASE DE DATOS		
		* @return $marcas 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		
		public function getMarcasById($id_marca)
		{
			$sql = "SELECT * FROM marca WHERE id=:id_marca";
			$this->conexion();
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_marca', $id_marca);
			$stmt->execute();
			$marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $marcas;
		} # END getMarcasById

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR TODOS LAS MARCAS CONTANDO LOS PRODUCTOS DISPONIBLES DE ESA MARCA LA BASE DE DATOS		
		* @return $marcas 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getMarcasCountProducts()
		{
			$sql = "SELECT m.*, count(p.id) AS cantidad FROM marca AS m INNER JOIN producto p ON m.id = p.id_marca GROUP BY m.id;";
			$this->conexion();
			$stmt = $this->con->query($sql);
			$marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $marcas;
		}
		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR UNA PUBLICIDAD EN LA BASE DE DATOS DE MANERA ALEATORIA
		* @return $publicidad 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getPublicidad()
		{
			$publicidad = array();
			$this -> conexion();
			$sql = "SELECT * FROM publicidad WHERE fecha >= now() order by rand() limit 1";
			if ($resultado = $this->con->query($sql)) {
				while ($datos = $resultado -> fetchObject()) {
					$publicidad = array('id' => $datos ->id, 'publicidad' => $datos->publicidad, 'imagen' => $datos->imagen, 'fecha' => $datos->fecha);
				}
				return $publicidad;
			}
		} # END getPublicidad

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR TODOS LOS PROYECTOS VIGENTES EN LA BASE DE DATOS	
		* @return $proyectos 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getProyectos()
		{
			$proyectos = array();
			$this -> conexion();
			$sql = "SELECT * FROM proyecto WHERE fecha >= now()";
			if ($resultado = $this->con->query($sql)) {
				while ($datos = $resultado -> fetchObject()) {
					array_push($proyectos, (array)$datos);
				}				
				return $proyectos;
			}
		} # END getProyectos

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR UN PROYECTO SEGUN SU ID EN LA BASE DE DATOS JUNTO CON SUS PRODUCTOS NECESARIOS
		* @param  $id_proyecto 		integer ID QUE SE DESEA ENCONTRAR 		
		* @return $productos 		array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getProductosDeProyecto($id_proyecto)
		{					
			$sql = "SELECT p.id, p.nombre, pro.proyecto FROM producto p INNER JOIN producto_proyecto pp ON p.id=pp.id_producto INNER JOIN proyecto pro ON pp.id_proyecto=pro.id WHERE pro.id=:id_proyecto";
			$this -> conexion();
			$stmt = $this->con->prepare($sql);
			$stmt->bindParam(':id_proyecto', $id_proyecto);
			$stmt->execute();
			$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $productos;
		} # END getPRoductosDeProyecto

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA POR TODOS LOS PROYECTOS EN LA BASE DE DATOS, INCLUYEENDO LOS CADUCOS
		* @return $proyectos 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function getAllProyectos()
		{
			$sql = "SELECT * FROM proyecto";
			$this -> conexion();
			$stmt = $this->con->query($sql);						
			$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $proyectos;
		}

		/************************************************************
		* METODO: ELIMINA UN PRODUCTO DE LA BASE DE DATOS POR SU ID
		* @param  $id_producto 		integer ID QUE SE DESEA ENCONTRAR
		* @return $stmt 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function deleteProducto($id_producto)
		{
			if (is_numeric($id_producto)) {
				$sql = "DELETE FROM producto WHERE producto.id=:id_producto";
				$this->conexion();
				$stmt = $this->con->prepare($sql);
				$stmt->bindParam(':id_producto', $id_producto);
				return $stmt->execute();
			}
			return 0;
		} # END deleteProducto
		
		/************************************************************
		* METODO: OBTIENE EL ID DE CLIENTE EN FUNCION DEL ID DE USUARIO EN SESIO		
		* @return $id_cliente 	integer 	ID DE CLIENTE OBTENIDO
		************************************************************/
		public function getClienteId()
		{
			if ($_SESSION['validado']) {
				$sql = "SELECT id_cliente FROM cliente WHERE id_usuario=:id_usuario";
				$stmt = $this->con->prepare($sql);
				$id_usuario = $_SESSION['id_usuario'];
				$stmt->bindParam(':id_usuario', $id_usuario);
				$stmt->execute();
				$resultado = $stmt->fetchObject();
				$id_cliente = $resultado->id_cliente;
				return $id_cliente;				
			}else{
				return null;
			}
		}

		/************************************************************
		* METODO: REGRESA EL RESULTADO DE UNA CONSULTA A LA BASE DE DATOS
		* @param  $sql 			string 	CONSULTA A SER REALIZADA
		* @return $resultado 	array 	RESULTADOS OBTENIDOS DE LA CONSULTA
		************************************************************/
		public function consultar($sql)
		{
			$this->conexion();
			$resultado = $this->con->query($sql);
			if ($resultado) {
				return $resultado->fetch(PDO::FETCH_ASSOC);
			}else{
				return null;
			}
		}

		/************************************************************
			   ____  _____ ____ ____ ___ ___  _   _ 
			  / ___|| ____/ ___/ ___|_ _/ _ \| \ | |
			  \___ \|  _| \___ \___ \| | | | |  \| |
			   ___) | |___ ___) |__) | | |_| | |\  |
			  |____/|_____|____/____/___\___/|_| \_|
			                                        
		************************************************************/

		/************************************************************
		* METODO: INICIA UNA NUEVA SESION
		* @param  $email				string 	EMAIL DEL CLIENTE
		* @param  $contrasena			string 	CONTRASEÑA DEL CLIENTE
		* @return null 					null 	IMPRIME UN MENSAJE O REDIRECCIONA
		************************************************************/
		public function login($email, $contrasena, $admin = null)
		{
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$contrasena = md5($contrasena);
				$sql = "SELECT id_usuario,email from usuario where email=:email and contrasena=:contrasena";
				$this->conexion();
				$stmt = $this->con->prepare($sql);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":contrasena",$contrasena);
				$stmt->execute();
				$user = $stmt->fetchObject();
				if (isset($user->email)) {
					$_SESSION['validado'] = true;
					$_SESSION['email'] = $email;
					$_SESSION['id_usuario'] = $user->id_usuario;
					$sql = "SELECT id_rol, rol from vwroles where email=:email";
					$stmt = $this->con->prepare($sql);
					$stmt->bindParam(":email", $email);
					$stmt->execute();
					$_SESSION['roles'] = [];
					while($roles = $stmt->fetch(PDO::FETCH_ASSOC)){
						array_push($_SESSION['roles'], $roles);
					}
					if (!$admin) {
						header("Location: perfil.php");
					}else{
						header("Location: index.php");
					}
				}else{
					$this->logout();
					die("Credenciales invalidas, verifique los datos ingresados e intente nuevamente");			
				}				
			}else{
				die("Se necesita un email electrónico");
			}
		} # END login

		/************************************************************
		* METODO: CIERRA UNA SESION
		* @return null 	null 	REDIRECCIONA A HOME
		************************************************************/
		public function logout()
		{
			foreach ($_SESSION as $key => $value) {
				if($key != 'carrito'){
					unset($_SESSION[$key]);
				}
			}
			header('Location: login.php');
		} # END logout

		/************************************************************
		* METODO: VERIFICA LOS PERMISOS SEGUN LOS ROLES DEL USUARIO ACTIVO
		* @param  $roles 	array 	CONTIENE LOS ROLES A VALIDAR
		* @return null 		null 	REDIRECCIONA SI NO SE CUENTAN CON LOS PERMISOS
		************************************************************/
		public function validar($roles)
		{
			 if (isset($_SESSION)) {
			 	if (isset($_SESSION['validado'])) {
				 	if ($_SESSION['validado']) {
				 		$roles_usuario = $_SESSION['roles'];
				 		$aceptado = false;
				 		foreach ($roles_usuario as $rol_usuario) {
					 		if (in_array($rol_usuario['rol'], $roles)) {
					 			$aceptado = true;
					 		}			 			
				 		}
				 		if (!$aceptado) {
				 			header("Location: login.php");
				 		}			 		
				 	}else{
				 		$this->logout();
				 		header("Location: login.php");	
				 	}
			 	}else{
			 		header("Location: login.php");
			 	}
			 }else{
			 	$this->logout();
			 	header("Location: login.php");
			 }
		} # END validar
		
		/************************************************************
			 ____  ____   ___  _____ ___ _     _____ 
			|  _ \|  _ \ / _ \|  ___|_ _| |   | ____|
			| |_) | |_) | | | | |_   | || |   |  _|  
			|  __/|  _ <| |_| |  _|  | || |___| |___ 
			|_|   |_| \_\\___/|_|   |___|_____|_____|

		************************************************************/
		
		/************************************************************
		* METODO: ACTUALIZA LA INFORMACION DE PERFIL
		* @param  $nombre 	string 	CONTIENE EL NOMBRE DE USUARIO
		* @param  $apaterno 	string 	CONTIENE EL APELLIDO PATERNO DE USUARIO
		* @param  $amaterno 	string 	CONTIENE EL APELLIDO MATERNO DE USUARIO
		* @param  $domicilio 	string 	CONTIENE EL domicilio DE USUARIO
		* @param  $new_email 	string 	CONTIENE EL NUEVO CORREO DE USUARIO
		* @param  $old_email 	string 	CONTIENE EL VIEJO CORREO DE USUARIO
		* @param  $id_usuario 	string 	CONTIENE EL ID DE USUARIO
		* @return null 		null 	REDIRECCIONA EN CASO DE EXITO
		************************************************************/
		public function actualizarPerfil($nombre, $apaterno, $amaterno, $domicilio, $new_email, $old_email, $id_usuario)
		{
			$this->conexion();
			$this->con->beginTransaction();
			try {
				$sql = "SELECT email from usuario WHERE email=:new_email AND id_usuario!=:id_usuario";
				$stmt = $this->con->prepare($sql);
				$stmt->bindParam(':new_email', $new_email);
				$stmt->bindParam(':id_usuario', $id_usuario);
				$stmt->execute();
				$usuario = 	$stmt->fetchObject();
				if (!isset($usuario->email)) {
					if ($old_email != $new_email) {
						$sql = "UPDATE usuario SET email=:new_email WHERE id_usuario=:id_usuario";
						$stmt = $this->con->prepare($sql);
						$stmt->bindParam(':new_email', $new_email);
						$stmt->bindParam(':id_usuario', $id_usuario);					
						$stmt->execute();
					}
					$sql = "UPDATE cliente SET nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, domicilio=:domicilio WHERE id_usuario=:id_usuario";
					$stmt = $this->con->prepare($sql);
					$stmt->bindParam(':nombre', $nombre);
					$stmt->bindParam(':apaterno', $apaterno);
					$stmt->bindParam(':amaterno', $amaterno);
					$stmt->bindParam(':domicilio', $domicilio);
					$stmt->bindParam(':id_usuario',$id_usuario);					
					$stmt->execute();										
					$this->con->commit();
					$_SESSION['email'] = $new_email;
					header("Location: perfil.php");
				}else{
					echo "Correo ya existente, use otro";
					$this->con->rollBack();
				}
			} catch (Exception $e) {
				$this->con->rollBack();
			}
		} #END actualizarPerfil

		/************************************************************
		* METODO: ACTUALIZA LA CONTRASEÑA DE PERFIL
		* @param  $contrasena 	string 		CONTIENE LA CONTRASEÑA NUEVA
		* @param  $contrasena2 	string 		CONTIENE LA CONTRASEÑA NUEVA REPETIDA
		* @param  $id_usuario 	string 		CONTIENE EL ID DE USUARIO
		* @return boolean 		boolean 	REGRESA UN BOLEANO DEPENDIENDO DEL EXITO DE LA TRANSACCION
		************************************************************/
		public function cambiar_contrasena($contrasena, $contrasena2, $id_usuario)
		{			
			$sql = "UPDATE usuario SET contrasena=:contrasena WHERE id_usuario=:id_usuario";
			$this->conexion();
			$stmt = $this->con->prepare($sql);
			$contrasena = md5($contrasena);
			$stmt->bindParam(':contrasena', $contrasena);
			$stmt->bindParam(':id_usuario', $id_usuario);
			$stmt->execute();
			if ($stmt->rowCount()>0) {
				return true;
			}else{
				return false;
			}
		} # END cambiar_contrasena

		/************************************************************
			  ____  _   _ ____ ___ _   _ _____ ____ ____    _     ___   ____ ___ ____ 
			 | __ )| | | / ___|_ _| \ | | ____/ ___/ ___|  | |   / _ \ / ___|_ _/ ___|
			 |  _ \| | | \___ \| ||  \| |  _| \___ \___ \  | |  | | | | |  _ | | |    
			 | |_) | |_| |___) | || |\  | |___ ___) |__) | | |__| |_| | |_| || | |___ 
			 |____/ \___/|____/___|_| \_|_____|____/____/  |_____\___/ \____|___\____|
			                                                                          
		************************************************************/		

		/************************************************************
		* METODO: AGREGA UN PRODUCTO AL CARRITO
		* @param 	$id_producto 		integer ID DEL PRODUCTO A AGREGAR			
		* @param 	$cantidad 			integer CANTIDAD DE PRODUCTO A AGREGAR
		* @return 	null 				null	REDIRECCIONA A CARRITO
		************************************************************/
		public function addCarrito($id_producto, $cantidad)
		{
			if (!isset($_SESSION['carrito'])) {
				$_SESSION['carrito'] = array();
			}			
			$datos = array('id_producto'=>$id_producto, 'cantidad'=>$cantidad);
			if(in_array($id_producto, array_column($_SESSION['carrito'], 'id_producto'))) {
				$key = array_search($id_producto, array_column($_SESSION['carrito'], 'id_producto'));
				$_SESSION['carrito'][$key]['cantidad'] += $cantidad;
			}else{
				array_push($_SESSION['carrito'], $datos);
			}
			header('Location: carrito.php');
		} #END addCarrito

		/************************************************************
		* METODO: DESTRUYE TODO EL CARRITO
		* @return 	null 				null	REDIRECCIONA A CARRITO
		************************************************************/
		public function destroyCarrito()
		{
			if (isset($_SESSION['carrito'])) {
				unset($_SESSION['carrito']);
			}
			header('Location: carrito.php');
		} # END destroyCarrito

		/************************************************************
		* METODO: ELIMINA UN SOLO PRODUCTO EN PARTICULAR DEL CARRITO
		* @param 	$id_producto 		integer ID DEL PRODUCTO A ELIMINAR		
		* @return 	null 				null	REDIRECCIONA A CARRITO
		************************************************************/
		public function eliminarProductoCarrito($id_producto)
		{
			if (is_numeric($id_producto) && isset($_SESSION['carrito'])) {
				$key_eliminar = null;
				foreach ($_SESSION['carrito'] as $key => $value) {
					if ($id_producto == $value['id_producto']) {
						$key_eliminar = $key;
					}
				}
				if (!is_null($key_eliminar)) {
					unset($_SESSION['carrito'][$key_eliminar]);
				}
				if (sizeof($_SESSION['carrito']) == 0) {
					$this->destroyCarrito();
				}
				header('Location: carrito.php');
			}
		} #END eliminarProductoCarrito

		/************************************************************
		* METODO: REALIZA LA COMPRA Y GUARDA EL REGISTRO Y DETALLES EN LA BASE DE DATOS
		* @return 	$id_carrito  integer REGRESA EL ID DE COMPRA DEL CARRITO REGISTRADO
		************************************************************/
		public function compra()
		{
			if (isset($_SESSION['carrito'])) {
				if (sizeof($_SESSION['carrito']) > 0) {
					$this->conexion();
					$this->con->beginTransaction();
					try {
						$sql = "SELECT id_cliente FROM cliente WHERE id_usuario=:id_usuario";
						$stmt = $this->con->prepare($sql);
						$id_usuario = $_SESSION['id_usuario'];
						$stmt->bindParam(':id_usuario', $id_usuario);
						$stmt->execute();
						$resultado = $stmt->fetchObject();
						$id_cliente = $resultado->id_cliente;
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
						return $id_carrito;
					} catch (Exception $e) {
						$this->con->rollBack();
						die("No se puede realizar la compra");
					}
				}
			}
			return false;
		} # END compra
	} # END class Deposito

 ?>