<?php require_once("cabecalho.php"); 

$conteudosPainel = $_POST['conteudosPainel'];

$QuestaoDAO = new QuestaoDAO($conexao);
$questao = new Questao ();

$conteudoDAO = new ConteudoDAO($conexao);
$conteudo = new Conteudo();
$avaliacao = new Avaliacao();
$avaliacaoDAO = new AvaliacaoDAO($conexao);

//$contadorQuestao = 1;
$chaveAvaliacaoId = $_POST['chaveAvaliacao'];
$chaveAvaliacaoId = 1; // SO TA FAZENDO A 1, ATUALIZAR PRA FAZER A 2 TBMMMM
echo "chaveAvaliacaoId = " . $chaveAvaliacaoId . "<br>"; 
$avaliacao_questao_fkid = $avaliacaoDAO->listaAvaliacaoQuestao_fkid($chaveAvaliacaoId);
//var_dump($questao);
//echo "----------------------------- CÓDIGO -----------------------------<bR>";
$contador = $_SESSION['contador'];/*
foreach ($questao as $q) :
	//echo $q->getChaveAvaliacao() . "
	echo "TESTE" .$q->questoesId[$j] . "<br>";
	$j++;
endforeach;*/
?>
<h1>Realizar Avaliação</h1>
	<form action="resultadoAvaliacao.php" method="post">
		<table class="table table-bordered table-striped" id="dynamic_field">
		<tr> 
		<?php
			foreach ($avaliacao_questao_fkid as $avac) :
			$id = $avac->questoesId[$contador];
		?>
			<td> <b>QUESTAO <?php echo $contador+1 ?></b></th> 
			<td> <b>CONTEUDO: </b><?php echo $conteudoDAO->listaConteudoEspecifico()?>
		<?php
			break;
			endforeach;
		?>
		</tr>

		<tr>
			<td colspan="2">
			<?php 
			$i = 0;
			$break = 0;
			$tamanho = sizeof($avaliacao_questao_fkid);
			if ($contador >= $tamanho) {
				header("Location: painelPedagogicoAvaliacao.php");
				die();
			}
			else {
			foreach ($avaliacao_questao_fkid as $avac) :
				if ($contador != $i && $break == 0) {
					$i++;
				}else {
					$id = $avac->questoesId[$contador];
					$questao = $QuestaoDAO->listaQuestao($id);
					echo $questao->getEnunciado(); 
			?>
		</tr>
			<?php
				$imprimeAlternativa = $QuestaoDAO->listaQuestaoAlternativa($id);
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
				$break = 1;
				endforeach;
				break;
			}
			endforeach;
		}
			?>
		</table>
		<input type="hidden" name="conteudosPainel[]" value="<?=$conteudosPainel;?>">
		<button class="btn btn-primary" type="submit">Responder</button>
</form>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
