<?php require_once("cabecalho.php"); 

$nomeConteudo = $_POST['nomeConteudo'];
$chaveAvaliacao = $_POST['chaveAvaliacao'];
$qntdQuestaoPorConteudo = $_POST['qntdQuestaoPorConteudo'];
/*
    foreach($nomeConteudo as $conteudo) : 
        echo $conteudo."</br>";
    endforeach;
    */
    

$questaoDAO = new QuestaoDAO($conexao);
$questao = new Questao();
$avaliacao = new Avaliacao;
$avaliacaoDAO = new AvaliacaoDAO($conexao);

foreach ($nomeConteudo as $conteudo) :
    $quantidadeQuestao = $questaoDAO->listaContadorQuestao($conteudo);
    $soma = $soma + $quantidadeQuestao;
endforeach;
if ($soma != $qntdQuestao) {
    echo "Não há questões o suficiente dos conteúdos selecionados para elaborar a avaliação. Cadastre novas questões.";
}
elseif ($soma > $qntdQuestao) {
    
}

echo $result;
function montaProva() {

}
 

    


 require_once("rodape.php"); 
 require_once("script.php"); 
