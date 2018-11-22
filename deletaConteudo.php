<input type="hidden" name="qualConteudo" value=<?=$continuar_conteudo;?>>       
<?php 
require_once("cabecalho.php");
require_once("class/Conteudo.php");
require_once("class/ConteudoDAO.php");

$conteudo = new Conteudo();
$conteudoDAO = new ConteudoDAO($conexao);
$nomeConteudo = $_POST['qualConteudo'];
$qualConteudoId = $_POST['qualConteudoId'];

$conteudo->setNomeConteudo($nomeConteudo);
$conteudo->setId($qualConteudoId);

$conteudoDAO->deletaConteudo($conteudo);
$_SESSION["success"] = "Conteúdo " . $nomeConteudo . " deletado com sucesso.";
header("Location: visualizarConteudos.php");
die();

require_once("rodape.php");
