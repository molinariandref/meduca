<?php 
require_once("cabecalho.php");
require_once("class/Conteudo.php");
require_once("class/ConteudoDAO.php");

$conteudo = new Conteudo();
$conteudoDao = new ConteudoDAO($conexao);

$conteudo->setNomeConteudo($_POST['nomeConteudo']);
$conteudo->setPreRequisito($_POST['preRequisito']);
$conteudo->setPosRequisito($_POST['posRequisito']);

if ($conteudoDao->insereConteudo($conteudo)) { 
?>
    <p class="text-success">O conteúdo <?= $conteudo->getNomeConteudo() ?> foi adicionado com sucesso.</p>   
<?php
} else {
    $msg = mysqli_error($conexao);
?>
    <p class="text-danger">O conteúdo <?= $conteudo->getNomeConteudo() ?> não foi adicionado. Erro: <?= $msg?></p>
<?php
}


/*echo "<pre>";  
print_r($array);
echo "</pre>";  
*/

/*
echo "<pre>";
print_r($questao->qntdAlternativas);
echo "</pre>";
*/

require_once("rodape.php");
