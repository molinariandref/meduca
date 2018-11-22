<?php require_once("cabecalho.php"); 

$nomeConteudo = $_POST['nomeConteudo'];
/*foreach($nomeConteudo as $conteudo) : 
    echo $conteudo."</br>";
endforeach;*/

$questaoDAO = new QuestaoDAO($conexao);
$questao = new Questao();


    


 require_once("rodape.php"); 
 require_once("script.php"); 
