<?php require_once("cabecalho.php"); 
	$alerta = new Alerta();
	$alerta->resetarSession();
	$QuestaoDAO = new QuestaoDAO($conexao);
	$questao = new Questao ();
	$conteudoDAO = new ConteudoDAO($conexao);
	$conteudo_fkid = $questao->getConteudo_fkid();
	$avaliacaoDAO = new AvaliacaoDAO($conexao);
?>	


<h1>Chave da Avaliação</h1>

<form action="formularioAvaliacao.php" method="post">
<table class="table table-bordered table-striped" id="dynamic_field">
<tr>
	<td colspan="2"> Informe qual avaliação seu professor deseja que realize. </td>
</tr>
	<?php 
	foreach($avaliacaoDAO->listaAvaliacao() as $tipo) : 
	?>
		<tr>
			<td><input type="radio" name="chaveAvaliacao" value='<?=$tipo['ID']?>'> </td>
		<td><?=$tipo['chaveAvaliacao'];?></td>
		</tr>
		<?php 
	endforeach	
	?>
</table>
	<button class="btn btn-primary" type="submit">Iniciar</button>
</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
