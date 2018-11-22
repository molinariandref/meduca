<?php
    require_once("cabecalho.php");
    $usuario = new UsuarioMeduca;
    $usuario->usuarioEstaLogado();
?>
<h1>Bem vindo ao sistema Meduca!</h1> <?php

if ($usuario->usuarioEstaLogado()){
	?>
	<p class="alert-success">Você está logado. <br> Email: <b> <?php echo $_SESSION["usuario_logado"]; ?> </b></p>
	<form action="logout.php" method="POST">
        <input type="submit" value="Deslogar" class="btn btn-danger">
    </form>
	<?php
}
else {
?>	
<h1>Efetuar login</h1>
<table class="table">
	<form action="login.php" method="post">
		<tr>
			<td>Email</td>
			<td><input class="form-control" type="email" name="email"></td>
		</tr>
		
		<tr>
			<td>Senha</td>
			<td><input class="form-control" type="password" name="senha"></td>
		</tr>
		
		<tr>
			<td><button class="btn btn-primary">Login</button></td>
	</form>
	<form action="formularioCadastroUsuario.php" method="post">
		<td><button class="btn btn-warning">Registre-se</button></td>
		</tr>
	</form>
</table>
<?php
}
include("rodape.php"); 
