<?php require_once("cabecalho.php"); 


$QuestaoDAO = new QuestaoDAO($conexao);
$questao = new Questao ();
$conteudoDAO = new ConteudoDAO($conexao);
$conteudo = new Conteudo();
$avaliacao = new Avaliacao();
$avaliacaoDAO = new AvaliacaoDAO($conexao);
/*
$novaAvaliacaoConteudosId = $_SESSION['novaAvaliacaoConteudosId'];
var_dump($novaAvaliacaoConteudosId);
*/
$contador = $_SESSION['contador'];
$SESSION['totalConteudos'];
$avaliacao_questao_fkid = $avaliacaoDAO->listaAvaliacaoQuestao_fkid_temporaria();
$conteudoEspecifico = $avaliacaoDAO->listaConteudoEspecifico_temporaria();
/*
$preRequisitos = $_SESSION['conteudosPreRequisito'];

var_dump($preRequisitos);
*/
$conteudoEspecificoId = $avaliacaoDAO->listaConteudoEspecificoID_temporaria();
$_SESSION['conteudoEspecificoId'] = $conteudoEspecificoId[$contador];

echo "conteudo nome:" . $conteudoEspecifico[1] . "<br>";
echo "conteudo id:" . $conteudoEspecificoId[0];

/*

$contador = $_SESSION['contador'];
$SESSION['totalConteudos'];
$avaliacao_questao_fkid = $avaliacaoDAO->listaAvaliacaoQuestao_fkid_temporaria();
$conteudoEspecifico = $avaliacaoDAO->listaConteudoEspecifico_temporaria();

//$conteudoEspecificoId = $avaliacaoDAO->listaConteudoEspecificoID_temporaria();
$_SESSION['conteudoEspecificoId'] = $conteudoDAO->pegaId($conteudoEspecifico[$contador]);
$conteudoEspecificoId = $_SESSION['conteudoEspecificoId'];
var_dump($contes);

*/
?>
<h1>Realizar Avaliação</h1>
	<form action="resultadoAvaliacaoNova.php" method="post">
		<table class="table table-bordered table-striped" id="dynamic_field">

		<tr> 
			<td> <b>QUESTAO <?php echo $contador+1 ?></b></th> 
			<td> <b>CONTEUDO: </b><?php echo $conteudoEspecifico[$contador]?>
		</tr>

		<tr>
			<td colspan="2">
			<?php 
			$i = 0;
			$break = 0;
			$tamanho = sizeof($avaliacao_questao_fkid);
			if ($contador >= $tamanho) {
				header("Location: painelPedagogicoAvaliacaoNova.php");
				die();
			}
			else {
			foreach ($avaliacao_questao_fkid as $avac) :
				if ($contador != $i && $break == 0) {
					$i++;
				}else {
					$id = $avac->questoesId[$contador];
					$_SESSION['questaoId'] = $id;
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
		<button class="btn btn-primary" type="submit">Responder</button>
</form>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
