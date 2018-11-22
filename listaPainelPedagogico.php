<?php require_once("cabecalho.php"); 
$usuarioDAO = new UsuarioMeducaDAO($conexao);

?>	

<h1>Selecionar Aluno</h1>

	<table class="table table-bordered table-striped" id="dynamic_field">
	<tr> 
    <th>Nome Completo</th> 
    <th colspan='2'>Painel Pedagógico</th> 
    </tr>
    <?php 
    foreach($usuarioDAO->listaUsuario() as $usuario) : 
        if ($usuario["tipoUsuario"] == "Aluno") { ?>
        <tr>
            <td><?=$usuario['nome'];?></td>
            <form action="listaPPS.php" method="post">
                <input type="hidden" name="usuario" value='<?=$usuario['id']?>'>
                <td><button class="btn btn-info" type="submit">Simulado</button></td>
            </form>
            <form action="selecionaAvaliacao.php" method="post">
                <input type="hidden" name="usuario" value='<?=$usuario['id']?>'>
                <td><button class="btn btn-info" type="submit">Avaliações</button></td>
            </form>
        </tr>
        <?php } 
	endforeach	
	?>
	</table>

</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
