<?php require_once("cabecalho.php"); ?>	

<h1>Informe cpf</h1>
<table class="table">
	<form action="validaCpf.php" method="post">
		<tr>
			<td>CPF</td>
			<td><input class="form-control" type="number" name="cpf" placeholder="Apenas digitos, sem ponto ou hífen."></td>
            <td><button class="btn btn-primary">Validar</button></td>
		</tr>
</form>