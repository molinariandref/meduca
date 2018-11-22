<?php require_once("cabecalho.php"); 

$QuestaoDAO = new QuestaoDAO($conexao);
$questao = new Questao ();
$conteudoDAO = new ConteudoDAO($conexao);
$conteudo = new Conteudo();

$qualConteudo = $_SESSION['qualConteudo'];
$qntdCorreta = $_SESSION['qntdCorreta'];
$qntdErrada = $_SESSION['qntdErrada'];

$contadorQuestao = $_SESSION['contadorQuestao'];
$contadorRepetida = $_SESSION['contadorRepetida'];

foreach ($contadorRepetida as $cr) :
	
endforeach;

$questao = $QuestaoDAO->listaQuestaoConteudo_fkid($qualConteudo);
?>

<h1>Realizar Prova</h1>
	<form action="resultadoProva.php" method="post">
		<table class="table table-bordered table-striped" id="dynamic_field">
		<tr> 
			<td> <b>QUESTAO <?php echo $contadorQuestao ?></b></th>
			<td><b>CONTEUDO: </b><?php echo $conteudoDAO->listaConteudoEspecifico($qualConteudo) ?> 
		</tr>

		<tr>
			<td colspan ="2">
			<?php 
			foreach($questao as $questao_id) :
				$ids[] = $questao_id->getId();
			?>
			<?php 
			endforeach;
			$rand = array_rand($ids);
			foreach ($contadorRepetida as $cr) :
				if ($ids[$rand] == $cr) {
					$rand = array_rand($ids);
				}
			endforeach;
			
			foreach($questao as $questao_enunciado) :
				if ($ids[$rand] == $questao_enunciado->getId()){
					echo $questao_enunciado->getEnunciado();
					//echo "<br>questao_enunciado->getId: " . $questao_enunciado->getId();
					$contadorRepetida[] = $questao_enunciado->getId();
					//echo "<br> contadorRepetida: " . $contadorRepetida;
				}
			endforeach;
			?>
			</tr></td>
			<tr> 
			<input type="hidden" name="idQuestao" value="<?= $ids[$rand] ?>">

				<?php
					$imprimeAlternativa = $QuestaoDAO->listaQuestaoAlternativa($ids[$rand]);
					$id_alternativa = 1;
					foreach ($imprimeAlternativa as $alternativa) :
					?>
					<tr>
						<td width="110"><center><input type="radio" name="id_alternativa" value=<?=$id_alternativa?>></center></td>
						<?php $id_alternativa = $id_alternativa + 1; ?>
						<td><center><?php echo $alternativa->getAlternativas();?> </center></td>
						<input type="hidden" name="correta_id" value=<?=$alternativa->getCorreta_id()?>>
					</tr>
					<?php 
					endforeach;
 				?>	
				</tr>
			</table>
		<?php
		foreach ($contadorRepetida as $cr) :
			array_push($_SESSION['contadorRepetida'], $cr);
		endforeach; 
		?>
		<button class="btn btn-primary" type="submit">Responder</button>
</form>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
