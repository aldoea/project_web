<?php  
	include "header.login.php";
	if (isset($_POST['login'])) {		
		$admin->login($_POST['email'], $_POST['contrasena']);
	}
?>
<main class="container justify-content-center mx-auto mt-3">
    <div class="col-md-6 offset-md-3">
        <form class="form-signin mb-3" method="post" action="login.php">  
            <h1 class="h3 mb-3 font-weight-normal">Por favor inicie sesión</h1>
            <label for="inputEmail">Correo electronico</label>
            <input type="email" id="inputEmail" name="email" class="form-control mb-2" placeholder="Correo electronico" required="true" autofocus="">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name="contrasena" class="form-control mb-2" placeholder="Contraseña" required="true" autocomplete="off">
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Iniciar sesión" name="login">
        </form>
    </div>
    <div class="col-md-6 offset-md-3">
        <div class="btn-group" role="group" aria-label="Actions">
            <a  class="btn btn-outline-success" href="registrarse.php">Crear cuenta</a>
            <a class="btn btn-outline-info" href="recuperar.php">Recuperar contraseña</a>  
        </div>
    </div>
</main>
<?php  
	include "footer.php";
?>