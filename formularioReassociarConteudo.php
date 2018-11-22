<?php require_once("cabecalho.php"); ?>	

<h1>Nova associação de conteúdos</h1>
<?php 
$qualConteudo = $_POST['qualConteudo'];
$qualConteudoId = $_POST['qualConteudoId'];
$preRequisitoId = $_POST['preRequisitoId'];
$posRequisitoId = $_POST['posRequisitoId'];

//echo "qualConteudo: " . $qualConteudo . "<br>qualConteudoId: ". $qualConteudoId . "<br>preRequisitoId: " . $preRequisitoId . "<br>posRequisitoId: " . $posRequisitoId;

?>
<form action="associaConteudo.php" method="post">
	<table class="table table-bordered table-striped" id="dynamic_field">
    <tr>
			<td><h3><center>Conteúdo</center></h3></td>
			<td colspan="3"><input type="text" name="reassociarConteudo" class="form-control" value="<?=$qualConteudo?>" readonly="readonly" ></center>
			<?php
            $tipoConteudo = new ConteudoDAO($conexao);
			?>
	</tr>

		<tr>
			<td><h3><center>Pré-requisito </center></h3></td>
			<td colspan="2"><select name="preRequisito[]" class="form-control">
			<?php
			foreach($tipoConteudo->listaNomeConteudo() as $preRequisito) : 
				if ($preRequisito['id'] == $preRequisitoId){ ?>
					<option value="<?=$preRequisito['id']?>" selected>
					<?=$preRequisito['nomeConteudo']; ?> 
				<?php
				} else {
				?>
					<option value="<?=$preRequisito['id']?>"> 
					<?=$preRequisito['nomeConteudo']; ?>
				<?php
				}
				?>
				</option>
				<?php 
				
			endforeach
			?>
			<td><center><button type="button" name="maisPreRequisito" id="maisPreRequisito" class="btn btn-success"> + </button></center></td> 

		</tr>
    
		<tr>
			<td><h3><center>Pós-requisito </center></h3></td>
			<td colspan="2"><select name="posRequisito[]" class="form-control">
			<?php
			foreach($tipoConteudo->listaNomeConteudo() as $posRequisito) : 
				if ($posRequisito['id'] == $posRequisitoId){ ?>
					<option value="<?=$posRequisito['id']?>" selected>
					<?=$posRequisito['nomeConteudo']; ?> 
				<?php
				} else {
					?>
					<option value="<?=$posRequisito['id']?>"> 
					<?=$posRequisito['nomeConteudo']; ?> 
				<?php } ?>
				</option>
				<?php 
			endforeach
			?>
			<td><center><button type="button" name="maisPosRequisito" id="maisPosRequisito" class="btn btn-success"> + </button></center></td> 

		</tr>
		
		<tr>
		<td colspan="4"><h3><center>Caso necessite associar mais de um pré ou pós requisito num mesmo conteúdo, clique no botão "+"</center></h3></td>
		</tr>
	</table>
	<button class="btn btn-warning" type="submit">Reassociar conteúdos </button>

</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
