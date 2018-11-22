<?php require_once("cabecalho.php"); 
	$alerta = new Alerta();
	$alerta->resetarSession();
	$QuestaoDAO = new QuestaoDAO($conexao);
	$questao = new Questao ();
	$conteudoDAO = new ConteudoDAO($conexao);
	$conteudo_fkid = $questao->getConteudo_fkid();
	//echo $nomeConteudo;
	//session_destroy();


?>	

<h1>Escolha o conteúdo inicial do Simulado</h1>

<form action="confirmarUsuario.php" method="post">
<table class="table table-bordered table-striped" id="dynamic_field">
<tr>
	<td colspan="2"> Selecione em qual conteúdo deseja iniciar a prova. </td>
</tr>
	<?php 
	foreach($conteudoDAO->listaNomeConteudo() as $tipo) : 
		if ($tipo['id'] != 1){
	?>
	<tr>
		<td><input type="radio" name="conteudo_inicial" value="<?=$tipo['id']?>"> </td>
		<td><?=$tipo['nomeConteudo'];?></td>
	</tr>
	<?php 
	}
	endforeach	
	?>
</table>

	<button class="btn btn-primary" type="submit">Iniciar</button>
</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
