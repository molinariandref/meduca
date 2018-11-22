<?php require_once("cabecalho.php"); ?>	

<h1>Cadastramento de conteúdos</h1>

<form action="cadastraConteudo.php" method="post">
	<table class="table table-bordered table-striped" id="dynamic_field">
		<tr> 
			<td  width ="100"><h3>Nome do conteúdo </center></h3></td>
			<td  width = "75"><h3>Quantidade de acertos</center></h3></td>
			<td  width = "75"><h3>Maximo de erros permitido</center></h3></td>
			<td  width = "55"><h3>+/x</center></h3></td>
		</tr>
		<tr> 
			<td><input type="text" name="nomeConteudo[]" placeholder="Informar conteúdo" class="form-control" /></center></td>
			<td ><input type="number" name="maxAcerto[]"  placeholder="Informar quantidade máxima de acertos" class="form-control" /></center></td>
			<td ><input type="number" name="maxErro[]"  placeholder="Informar quantidade máximo de erros" class="form-control" /></center></td>
			<td><center><button type="button" name="maisConteudo" id="maisConteudo" class="btn btn-success"> + </button></center></td> 
		</tr>
		
		

	</table>
	<button class="btn btn-primary" type="submit">Cadastrar conteúdo</button>

</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
