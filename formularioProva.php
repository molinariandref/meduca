<?php require_once("cabecalho.php"); 

$simuladoDAO = new SimuladoDAO($conexao);

$simuladoDAO->insertSimulado_usuario($_SESSION["idUsuario"]);
$_SESSION["fkid_simulado"] = $simuladoDAO->selectLasIdSimulado_usuario();

$QuestaoDAO = new QuestaoDAO($conexao);
$questao = new Questao ();
$conteudoDAO = new ConteudoDAO($conexao);
$conteudo = new Conteudo();

$contadorQuestao = 1;

$conteudo_inicial = $_POST['conteudo_inicial'];
$questao = $QuestaoDAO->listaQuestaoConteudo_fkid($conteudo_inicial);

?>

<h1>Realizar Prova</h1>
	<form action="resultadoInicialProva.php" method="post">
		<table class="table table-bordered table-striped" id="dynamic_field">

		<tr> 
			<td> <b>QUESTAO <?php echo $contadorQuestao ?></b></th> 
			<td> <b>CONTEUDO: </b><?php echo $conteudoDAO->listaConteudoEspecifico($conteudo_inicial) ?>
		</tr>

		<tr><td colspan="2">
			<?php 
			
			foreach($questao as $questao_id) :
				$ids[] = $questao_id->getId();
			endforeach;	
			
			$rand = array_rand($ids);
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
					<td><center><?php echo $alternativa->getAlternativas(); ?> </center></td>
					<input type="hidden" name="correta_id" value=<?= $alternativa->getCorreta_id(); ?>>
					</tr>
					<?php
					$id_alternativa = $id_alternativa + 1;
					?>
				<?php 
				endforeach
				?>	
				</tr>
		</table>
		<?php
			$_SESSION['contadorRepetida'] = array();
			array_push($_SESSION['contadorRepetida'], $contadorRepetida[0]);
			$_SESSION['contadorQuestao'] = $contadorQuestao;
			$_SESSION['conteudo_inicial'] = $conteudo_inicial;
			$_SESSION['qntdCorreta'] = 0;
			$_SESSION['qntdErrada'] = 0;
		?>



		<button class="btn btn-primary" type="submit">Responder</button>
</form>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
