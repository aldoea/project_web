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
			if( $resultado = $this -> con -> query("select producto.nombre, producto.imagen, producto.precio, producto.precio_desc, producto.id_marca, marca.id, marca.marca from producto inner join marca on producto.id_marca = marca.id $condicion order by producto.nombre;")) {				
				while ($datos = $resultado -> fetch_object()) {						
					array_push($productos, (array)$datos);
				}
				$resultado -> close();
			}
			return $productos;
		} # END getProductos()

		public function getMarcas($marca_id = null)
		{
			$condicion = "";			
			if ($marca_id != null) {
				$condicion = "where marca.id = $marca_id GROUP by 1,2 limit 1";
			}
			$marcas = array();			
			$this -> conexion();
			if( $resultado = $this -> con -> query("select marca.id, marca.marca, marca.imagen, count(producto.id) as cantidad from marca join producto on marca.id = producto.id_marca $condicion;")){
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