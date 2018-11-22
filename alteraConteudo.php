<input type="hidden" name="qualConteudo" value=<?=$continuar_conteudo;?>>       
<?php 
require_once("cabecalho.php");
require_once("class/Conteudo.php");
require_once("class/ConteudoDAO.php");

$conteudo = new Conteudo();
$conteudoDAO = new ConteudoDAO($conexao);

$alterarNomeConteudo = $_POST['alterarNomeConteudo'];
$qualConteudoId = $_POST['qualConteudoId'];

$conteudo->setNomeConteudo($alterarNomeConteudo);
$conteudo->setId($qualConteudoId);

$conteudoDAO->alteraConteudo($conteudo);
$_SESSION["success"] = "Nome de conteúdo alterado para " . $alterarNomeConteudo . " com sucesso.";
header("Location: visualizarConteudos.php");
die();

require_once("rodape.php");
