<?php  
	include "header.login.php";	
	if (isset($_POST['registro'])) {
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
		$email=(isset($_POST['email']) ? $_POST['email'] : null);
		$contrasena=(isset($_POST['contrasena']) ? $_POST['contrasena'] : null);
		$contrasena2=(isset($_POST['contrasena2']) ? $_POST['contrasena2'] : null);
		$errores=array();

		if (!strlen($nombre < 1)) {
			array_push($errores, "Nombre muy corto");
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errores, "El correo electrónico es invalido");
		}
		if($contrasena != $contrasena2){
			array_push($errores, "Las contraseñas no coinciden");
		}
		if (count($errores) == 0) {
			$admin->con->beginTransaction();
			try {				
				// abniente de una transaccion
				// 1-Comprobar el email que se esta registrando no exista en la bd
				$sql = "SELECT email FROM usuario where email=:email";
				$stmt = $admin->con->prepare($sql);
				$stmt->bindParam(':email', $email);
				$stmt->execute();
				$usuario_email = $stmt->fetchObject();
				if (!isset($usuario_email->email)) {
					// 2. si no existe el email se inserta en usuario
					$sql = "INSERT INTO usuario(email, contrasena) values(:email,:contrasena)";
					$stmt = $admin->con->prepare($sql);
					$stmt->bindParam(':email', $email);
					$contrasena = md5($contrasena);
					$stmt->bindParam(':contrasena',$contrasena);
					$stmt->execute();
					// 3- se obtine el id del usuario
					$sql = "SELECT id_usuario FROM usuario where email=:email";
					$stmt = $admin->con->prepare($sql);
					$stmt->bindParam(':email', $email);					
					$stmt->execute();
					$user = $stmt->fetchObject();
					$id_usuario = $user->id_usuario;
					// 4. se inserta en la tabla usuario_rol y se asigna el cliente
					$sql = "INSERT INTO usuario_rol(id_usuario, id_rol) VALUES(:id_usuario, 1)";
					$stmt = $admin->con->prepare($sql);
					$stmt->bindParam(':id_usuario', $id_usuario);
					$stmt->execute();
					// 5. se inserta en la tabla cliente utilizando el id
					$sql = "INSERT INTO cliente(nombre,id_usuario) values(:nombre, :id_usuario)";
					$stmt = $admin->con->prepare($sql);
					$stmt->bindParam('nombre', $nombre);
					$stmt->bindParam('id_usuario',$id_usuario);
					$stmt->execute();
					$admin->con->commit();
					// 6. se confirma al usuario los mensajes					
					$admin->login($email,$contrasena2);					
				}else{
					$admin->con->rollBack();
					$msg = "Registro fallido, ya existe una cuenta con ese correo";
				}// END if email not exist				
				 
			} catch (Exception $e) {
				$admin->con->rollBack();
				$msg = "Registro fallido";
			}
			echo $msg;
		}else{
			foreach ($errores as $error) {
				echo $error;
				echo "<br/>";
			}
		}
	}
?>
<main class="container justify-content-center mx-auto mt-3">
	<div class="col-md-6 offset-md-3">
		<h1>Registrarse en la tienda en linea</h1>
		<form class="form-signin" method="post" action="registrarse.php">
			<label>Nombre</label>
			<input class="form-control mb-2" type="text" name="nombre" required="">
			<label>Email</label>
			<input class="form-control mb-2" type="email" name="email" required="">
			<label>Contraseña</label>
			<input class="form-control mb-2" type="password" name="contrasena" required="">
			<label>Repite la contraseña</label>
			<input class="form-control mb-2" type="password" name="contrasena2" required="">
			<input class="btn btn-lg btn-primary btn-block" type="submit" name="registro">
		</form>
	</div>
</main>
<?php  
	include "footer.php";	
?>