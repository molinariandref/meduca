<?php require_once("cabecalho.php"); 
$questao = new Questao();
$enunciado = $_POST['enunciado'];
$id = $_POST['id'];
?>	

<h1>Alterar questão</h1>

<form action="alteraQuestao.php" method="post">
	<table class="table table-bordered table-striped" id="dynamic_field">
	<tr>
		<td><h3><center>Revincular Conteudo</center></h3></td>
		<td colspan="2"><select name="tipoConteudo" class="form-control">
		<?php
			$tipoConteudo = new ConteudoDAO($conexao);
			foreach($tipoConteudo->listaNomeConteudo() as $tipo) : 
		?>
				<option value="<?=$tipo['nomeConteudo']?>"> 
					<?=$tipo['nomeConteudo']; ?> 
				</option>
			<?php 
			endforeach
			?>
	</tr>

	<tr>
		<td><h3><center>Alterar enunciado</center></h3></td>
		<td colspan="2"><center><textarea class="form-control" name="enunciado"><?=$enunciado ?></textarea></center></td>
		
	</tr>
	
	<tr>
		<td><h3><center>Alternativas</center></h3></td>
		<td><h3><center>Inserir/Remover</center></h3></td>
		<td><h3><center>Selecione a correta</center></h3></td>
	</tr>

	<tr>
		<td><center><input type="text" name="qntdAlternativas[]" placeholder="Alternativa 1" class="form-control" /></center></td>
		<td><center><button type="button" name="adicionar" id="adicionar" class="btn btn-success"> + </button></center></td> 
		<td><center><input type="radio" name="correta_id" value="1"></center></td>
	</tr>
	</table>
	<button class="btn btn-primary" type="submit">Cadastrar questão</button>

</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
