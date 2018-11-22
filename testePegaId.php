<?php 
require_once("cabecalho.php");
require_once("class/Questao.php");
require_once("class/QuestaoDAO.php");

$pegaId = new QuestaoDAO($conexao);
$pegaId->pegaId();

var_dump($pegaId->pegaId());

?>

