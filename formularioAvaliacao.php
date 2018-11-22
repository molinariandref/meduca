<?php require_once("cabecalho.php"); 

$QuestaoDAO = new QuestaoDAO($conexao);
$questao = new Questao ();

$conteudoDAO = new ConteudoDAO($conexao);
$conteudo = new Conteudo();
$avaliacao = new Avaliacao();
$avaliacaoDAO = new AvaliacaoDAO($conexao);

$contador = $_SESSION['contador'];
$SESSION['totalConteudos'];
$id_usuario = $_SESSION['idUsuario'];

if ($contador == 0) {
	$chaveAvaliacaoId = $_POST['chaveAvaliacao'];
	$_SESSION['chaveAvaliacaoId'] = $chaveAvaliacaoId;

	$jaFezEstaAvaliacao = $avaliacaoDAO->usuarioFezAvaliacao($chaveAvaliacaoId, $id_usuario);
	if ($jaFezEstaAvaliacao != null) {
		$_SESSION["danger"] = "Você já fez esta avaliação.<br>Para faze-la novamente entre em contato com o setor pedagógico ou professor.";
		header("Location: formularioInicializarAvaliacao.php");
		die();
	} 
} else {
	$chaveAvaliacaoId = $_SESSION['chaveAvaliacaoId'];
}
$avaliacao_questao_fkid = $avaliacaoDAO->listaAvaliacaoQuestao_fkid($chaveAvaliacaoId);
$conteudoEspecifico = $avaliacaoDAO->listaConteudoEspecifico($chaveAvaliacaoId);
$conteudoEspecificoId = $avaliacaoDAO->listaConteudoEspecificoID($chaveAvaliacaoId);
$_SESSION['conteudoEspecificoId'] = $conteudoEspecificoId[$contador];

//var_dump( $jaFezEstaAvaliacao);


?>
<h1>Realizar Avaliação</h1>
	<form action="resultadoAvaliacao.php" method="post">
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
				header("Location: painelPedagogicoAvaliacao.php");
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
