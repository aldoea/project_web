<?php 
	/**
	* Clase principal del sistema Deposito del Hogar
	*/
	class Deposito
	{
		/*		
			
		*/		
		var $con = null;
		public function conexion(){
			$user = 'root';
			$password = '';
			$server = 'localhost';
			$bd = 'depot';
							# DSN 									
			$mbd = new PDO('mysql:host='.$server.';dbname='.$bd, $user, $password);
			$this -> con=$mbd;
		} # END conexion()

		public function getProductos($marca_id = null, $query = null)
		{
			$productos = array();	
			$condicion = "";
			if ($marca_id != null) {
				$condicion = "where marca.id_marca = $marca_id";
			}
			if ($query != null) {
				$condicion = "where (productos.nombre like '%$q%' or marcas.marca like '%$q%')";
			}
			if ($marca_id != null  && $query != null) {
				$condicion = "where productos.nombre like '%$q%' and marca.id_marca = $marca_id";
			}

			$this -> conexion();
			if( $resultado = $this->consultar("select producto.id, producto.nombre, producto.imagen, producto.precio, producto.precio_desc, producto.id_marca, marca.marca from producto inner join marca on producto.id_marca = marca.id $condicion order by producto.nombre;")) {				
				while ($datos = $resultado -> fetchObject()) {						
					array_push($productos, (array)$datos);
				}
				#$resultado -> close();
			}
			return $productos;
		} # END getProductos

		public function getMarcas($marca_id = null)
		{
			$condicion = "";			
			if ($marca_id != null) {
				$condicion = "where marca.id = $marca_id GROUP by 1,2 limit 1";
				echo "something bad";
			}
			$marcas = array();			
			$this -> conexion();
			if( $resultado = $this->con->query("select marca.id, marca.marca, marca.imagen, count(producto.id) as cantidad from marca inner join producto on marca.id = producto.id_marca $condicion;")){
				while ($datos = $resultado -> fetchObject()) {		
					print_r($datos);
					array_push($marcas, (array)$datos);
				}
				$resultado -> close();
			}
			return $marcas;
		} # END getMarcas

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


		public function getProyectos($proyecto_id=null)
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

		public function getProductosDeProyecto($proyecto_id=null)
		{
			$productos = array();
			$condicion = "";
			$this -> conexion();
			if ($proyecto_id != null) {
				$condicion = "where pro.id=$proyecto_id";
			}
			$sql = "SELECT p.nombre from producto p inner join producto_proyecto pp on p.id=pp.id_producto inner join proyecto pro on pp.proyecto_id=pro.id $condicion";
			if ($resultado = $this->con->query($sql)) {
				while ($datos = $resultado -> fetchObject()) {
					array_push($productos, (array)$datos);
				}				
				return $productos;
			}
		} # END getPRoductosDeProyecto


		public function deleteProducto($id_producto)
		{
			if (is_numeric($id_producto)) {
				$sql = "delete from producto where producto.id=".$id_producto;				
				return $this->ejecutar($sql);
			}
			return 0;
		} # END deleteProducto

		public function ejecutar($sql)
		{
			if ($sql != null) {
				$this->conexion();
				return $this->con->exec($sql);				
			}
		} # END ejecutar

		public function consultar($sql)
		{
			$this->conexion();
			$resultado = $this->con->query($sql);
			return $resultado;
		}


	} # END class Deposito
 ?>