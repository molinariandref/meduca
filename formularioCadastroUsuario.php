<?php
require_once("cabecalho.php");
// require_once("logica-usuario.php");
$usuario = new UsuarioMeduca();
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

<?php
//if(usuarioEstaLogado()) {
?>
	<!--<p class="text-success">Você está logado como <?php // usuarioLogado() ?>. <a href="logout.php">Deslogar</a></p> -->
<?php/*
} else {*/
?>
	<h2>Cadastro de usuário</h2>
	<form action="cadastraUsuario.php" method="post">
		<table class="table table-bordered table-striped">
            <tr>
                <td>Tipo Usuário</td>
                <td><select name="tipoUsuario" class="form-control">
			<?php
			$tipoUsuario = array("Pedagogo", "Professor", "Aluno");
            foreach($tipoUsuario as $tipo) : 
			?>
            <option value="<?=$tipo?>" <?=$selecao?>> <?=$tipo?>
			</option>
			<?php 
			endforeach
			?>
		</select> </td>
		
			<tr>
				<td>Nome completo</td>
				<td><input class="form-control" type="text" name="nomeCompleto"></td>
			</tr>

			<tr>
				<td>E-mail</td>
				<td><input class="form-control" type="email" name="email"></td>
			</tr>
	
			<tr>
				<td>Senha</td>
				<td><input class="form-control" type="password" name="senha"></td>
			</tr>

			<tr>
				<td>Confirmar senha</td>
				<td><input class="form-control" type="password" name="confirmaSenha"></td>
			</tr>

			<tr>
				<td>CPF (Apenas números)</td>
                <td><input class="form-control" type="number" name="cpf"></td>
			</tr>
         

		</table>
        <button class="btn btn-primary">Cadastrar</button>
	</form>
<?php
 //}
?>

<?php include("rodape.php");

}

?>