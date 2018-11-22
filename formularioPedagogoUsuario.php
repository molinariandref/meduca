<?php require_once("cabecalho.php"); 
$usuarioDAO = new UsuarioMeducaDAO($conexao);

?>	

<h1>Lista de Usuários</h1>

<form action="detalharUsuario.php" method="post">
	<table class="table table-bordered table-striped" id="dynamic_field">
	<tr> 
    <th>Selecione</th> 
    <th>Nome </th> 
    <th>Cadastro válido?</th> 
    </tr>
    <?php 
    foreach($usuarioDAO->listaUsuario() as $usuario) : 
        $validaUsuario = $usuario['validaUsuario'];
	?>
		<tr>
            <td><input type="radio" name="usuario" value='<?=$usuario['id']?>'> </td>
            <td><?=$usuario['nome'];?></td>
            <?php 
            if ($validaUsuario == 1) { ?>
            <td>Sim</td>
            <?php } 
            elseif($validaUsuario == 0) { ?>
            <td>Não</td>
            <?php }elseif($validaUsuario == -1) { ?>
            <td>Inconcistente.</td>
            <?php }
            ?>
		</tr>
	<?php 
	endforeach	
	?>
	</table>
	<button class="btn btn-primary" type="submit">Detalhar usuário</button>

</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
