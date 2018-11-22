<?php require_once("cabecalho.php"); 

	$questao = new Questao ();
	$QuestaoDAO = new QuestaoDAO($conexao);
	$conteudoDAO = new ConteudoDAO($conexao);

	$conteudo_fkid = $questao->getConteudo_fkid();
	$chaveAvaliacao = $_POST['chaveAvaliacao'];

	//echo $nomeConteudo;
?>	

<h1>Elaborar Avaliação</h1>

<form action="elaborarAvaliacao.php" method="post">
<table class="table table-bordered table-striped" id="dynamic_field">
<tr>
	<td colspan="3"><center>Selecione os conteúdos referente a avaliação de chave: <b><?php echo $_SESSION['chaveAvaliacao']; ?></b></td>
</tr>
<tr>
	<td><b>Selecione contúdos: </b> </td>
	<td><b>Contúdos: </b> </td>
	<td><b>Qntd. de questão por conteúdo: </b> </td>
</tr>
	<?php 
	foreach($conteudoDAO->listaNomeConteudo() as $tipo) : 
		if ($tipo['id'] != 1){
	?>
	<tr>
		<td width ='175'><center><input type="checkbox" name="conteudosCheckbox[]" value="<?=$tipo['id']?>"> </td>
		<td><center><?=$tipo['nomeConteudo'];?></center></td>
		<td width ='275'><input class="form-control" type="number" name="qntdQuestaoPorConteudo_php[]"> </td>
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
