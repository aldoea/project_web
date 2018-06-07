<?php  
	include "header.login.php";
	if (isset($_POST['login'])) {		
		$admin->login($_POST['email'], $_POST['contrasena'], true);
	}
?>
<main class="container justify-content-center mx-auto mt-3">
    <div class="col-md-6 offset-md-3">
      <form class="form-signin" method="post" action="login.php">  
        <h1 class="h3 mb-3 font-weight-normal">Por favor inicie sesión</h1>
        <label for="inputEmail" class="sr-only">Correo electronico</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Correo electronico" required="true" autofocus="" autocomplete="off">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="contrasena" class="form-control" placeholder="Contraseña" required="true" autocomplete="off">
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="iniciarsesion" name="login">
      </form>
    </div>
</main>
<?php  
	include "footer.php";
?>