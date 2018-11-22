<?php require_once("cabecalho.php"); 
	$alerta = new Alerta();
	$alerta->resetarSession();?>	

<h1>Elaborar Avaliação</h1>

<form action="cadastraChave.php" method="post">
<table class="table table-bordered table-striped" id="dynamic_field">
<tr>
	<td colspan="3"><center>A chave da avaliação é a maneira onde seu aluno poderá realizar avaliações cadastradas por você.</td>
</tr>
<tr>
	<td><b>Chave da avaliação:</b> </td>
	<td><input class="form-control" type="text" name="chaveAvaliacao"> </td>

</table>
	<button class="btn btn-primary" type="submit">Continuar</button>
</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
