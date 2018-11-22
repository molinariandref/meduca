<?php
require_once("cabecalho.php");
$usuario = new UsuarioMeduca();
$usuarioDAO = new UsuarioMeducaDAO($conexao);
$usuario_id = $_POST['usuario'];
//echo $usuario_id;
$usuario = $usuarioDAO->selecionaUsuarioEspecificoId($usuario_id);
?>
	<h2>Usuário</h2>
	<form action="validaUsuario.php" method="post">
		<input type="hidden" name="usuario_id" value='<?=$usuario_id;?>'>
		
		<table class="table table-bordered table-striped">
            <tr>
                <td>Tipo Usuário</td>
                <td><select name="tipoUsuario" class="form-control">
			<?php
			/*

		<select name="categoria_id" class="form-control">
					<?php
					foreach($categorias as $categoria) : 
						$essaEhACategoria = $produto->getCategoria()->getId() == $categoria->getId();
						$selecao = $essaEhACategoria ? "selected='selected'" : "";
					?>
						<option value="<?=$categoria->getId()?>" <?=$selecao?>>
							<?=$categoria->getNome()?>
						</option>
					<?php 
					endforeach
					?>
				</select>
			*/
			$tipoUsuario = array("Pedagogo", "Professor", "Aluno");
			//echo "OLA " . $usuario["tipoUsuario"];
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
				<td><input class="form-control" type="text" name="nomeCompleto" value='<?php echo $usuario['nome'] ?>'></td>
			</tr>

			<tr>
				<td>E-mail</td>
				<td><input class="form-control" type="email" name="email" value='<?php echo $usuario['email'] ?>'></td>
			</tr>

			<tr>
				<td>Matricula</td>
                <td><input class="form-control" type="text" name="matricula" value='<?php echo $usuario['matricula'] ?>'></td>
			</tr>

			<tr>
				<td>CPF (Apenas números)</td>
                <td><input class="form-control" type="number" name="cpf" value='<?php echo $usuario['cpf'] ?>'></td>
			</tr>

			<tr>
				<td>Cursando (Se aluno)</td>
                <td><input class="form-control" type="text" name="cursando" value='<?php echo $usuario['cursando'] ?>'></td>
			</tr>
        
			<tr>
				<td>Leciona (Se professor)</td>
                <td><input class="form-control" type="text" name="leciona" value='<?php echo $usuario['leciona'] ?>'></td>
			</tr>
		</table>
		<?php if ($usuario["validaUsuario"] != 1) {

		?>
		<table class="table table-bordered table-striped">
		<tr>
			<th colspan='2'><center>Validar cadastro? </th>
		</tr>	
		<tr>
			<td><center><input type="radio" name="validaUsuario" value='1'> SIM</td>
			<td><center> <input type="radio" name="validaUsuario" value='-1'> NÃO</td>
		</tr>
		</table>
        <button class="btn btn-primary">Cadastrar</button>
		<?php } else { ?>
			<input type="hidden" name="validaUsuario" value='1'> 
			<button class="btn btn-primary">Atualizar Cadastro</button>
		<?php	} ?>
	</form>


<?php include("rodape.php");



?>