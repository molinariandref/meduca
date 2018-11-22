<?php require_once("cabecalho.php"); 

$avaliacaoDAO = new AvaliacaoDAO($conexao);
$chaveAvaliacao = $_POST['chaveAvaliacao'];
$_SESSION['chaveAvaliacao'] = $chaveAvaliacao;
$avaliacaoDAO->insereAvaliacao($chaveAvaliacao);
header("Location: formularioElaborarAvaliacao.php");
die();

?>

