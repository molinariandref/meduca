<?php require_once("cabecalho.php"); 
$qualConteudo = $_POST['qualConteudo'];
$qualConteudoId = $_POST['qualConteudoId'];
?>	

<h1>Alterar nome de conteúdo</h1>

<form action="alteraConteudo.php" method="post">
	<table class="table table-bordered table-striped" id="dynamic_field">
		<tr> 
			<td align='center'><h3>Conteúdo</center></h3></td>
			<td><input type="text" name="alterarNomeConteudo" class="form-control" value="<?=$qualConteudo?>"></center></td>
            <input type="hidden" name="qualConteudoId" value="<?=$qualConteudoId?>">
        </tr>
		
	</table>
	<button class="btn btn-default" type="submit">Alterar nome</button>

</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
