<?php require_once("cabecalho.php"); 

	$QuestaoDAO = new QuestaoDAO($conexao);
	$questao = new Questao ();
	$conteudoDAO = new ConteudoDAO($conexao);
	$conteudo_fkid = $questao->getConteudo_fkid();
	//echo $nomeConteudo;


?>	

<h1>Elaborar Prova</h1>

<form action="elaborarProva.php" method="post">
<table class="table table-bordered table-striped" id="dynamic_field">
<tr>
	<td colspan="2"> Selecione os conteúdos da prova, para que está seja criada automaticamente. </td>
</tr>
	<?php 
	foreach($conteudoDAO->listaNomeConteudo() as $tipo) : 
		if ($tipo['id'] != 1){
	?>
	<tr>
		
		<td><input type="checkbox" name="nomeConteudo[]" value="<?=$tipo['id']?>"> </td>
		<td><?=$tipo['nomeConteudo'];?></td>
	</tr>
	<?php 
	}
	endforeach	
	?>
</table>
	<button class="btn btn-primary" type="submit">Criar</button>
</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
