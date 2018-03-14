<?php 
	/**
	* Clase principal del sistema Deposito del Hogar
	*/
	class Deposito
	{
		/*
		function __construct(argument)
		{
			# code...
		}
		*/		
		var $con = null;
		private function conexion(){
			$user = 'root';
			$password = '';
			$server = 'localhost';
			$bd = 'depot';
			$mysqli = new mysqli($server, $user, $password, $bd);
			$this -> con=$mysqli;
		} # END conexion()

		public function getProductos($marca_id = null, $q = null)
		{
			$productos = array();	
			$condicion = "";
			if ($marca_id != null) {
				$condicion = "where marca.id_marca = $marca_id";
			}
			if ($q != null) {
				$condicion = "where (productos.nombre like '%$q%' or marcas.marca like '%$q%')"
			}
			if ($marca_id != null) {
				# code...
			}

			$this -> conexion();
			if( $resultado = $this -> con -> query("select producto.nombre, producto.imagen, producto.precio, producto.precio_desc, producto.id_marca, marca.id, marca.marca from producto inner join marca on producto.id_marca = marca.id $condicion;")) {				
				while ($datos = $resultado -> fetch_object()) {						
					array_push($productos, (array)$datos);
				}
				$resultado -> close();
			}
			return $productos;
		} # END getProductos()

		public function getMarcas()
		{
			$marcas = array();			
			$this -> conexion();
			if( $resultado = $this -> con -> query("select marcas.id, marcas.marca, count(productos.id) as cantidad from marcas join productos on marcas.id = productos.id_marca GROUP by 1,2;")){
				while ($datos = $resultado -> fetch_object()) {
					array_push($marcas, (array)$datos);
				}
				$resultado -> close();
			}
			return $marcas;
		} # END getMarcas()

		public function getPublicidad()
		{
			$publicidad = array();
			$this -> conexion();
			$sql="SELECT * FROM publicidad WHERE fecha >= now() order by rand() limit 1";
			if ($resultado = $this -> conexion -> query($sql)) {
				while ($datos = $resultado -> fetch_object()) {
					$publicidad = array('id' => $datos ->id, 'publicidad' => $datos->publicidad, 'imagen' => $datos->imagen, 'fecha' => $datos->fecha);
				}
				return $publicidad;
			}
		}

	} # END class Deposito
 ?>