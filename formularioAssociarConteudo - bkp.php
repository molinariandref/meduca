<?php require_once("cabecalho.php"); ?>	

<h1>Associação de conteúdos</h1>

<form action="associaConteudo.php" method="post">
	<table class="table table-bordered table-striped" id="dynamic_field">
        
    <tr>
			<td><h3><center>Conteúdo</center></h3></td>
			<td colspan="2"><select name="conteudo" class="form-control">
			<?php
            $tipoConteudo = new ConteudoDAO($conexao);

			foreach($tipoConteudo->listaNomeConteudo() as $conteudo) : 
				?>
				<option value="<?=$conteudo['id']?>"> 
				<?=$conteudo['nomeConteudo']; ?> 
				</option>
				<?php 
			endforeach


			?>
		</tr>
		
		<tr>
			<td><h3><center>Pré-requisito </center></h3></td>
			<td colspan="2"><select name="preRequisito" class="form-control">
			<?php
			foreach($tipoConteudo->listaNomeConteudo() as $preRequisito) : 
				?>
				<option value="<?=$preRequisito['id']?>"> 
				<?=$preRequisito['nomeConteudo']; ?> 
				</option>
				<?php 
			endforeach
			?>
		</tr>
    
		<tr>
			<td><h3><center>Pós-requisito </center></h3></td>
			<td colspan="2"><select name="posRequisito" class="form-control">
			<?php
			foreach($tipoConteudo->listaNomeConteudo() as $posRequisito) : 
				?>
				<option value="<?=$posRequisito['id']?>"> 
				<?=$posRequisito['nomeConteudo']; ?> 
				</option>
				<?php 
			endforeach
			?>
		</tr>

	</table>
	<button class="btn btn-primary" type="submit">Associar conteúdos </button>

</form>

<?php require_once("rodape.php"); ?>
