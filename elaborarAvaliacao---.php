<?php require_once("cabecalho.php"); 

$nomeConteudo = $_POST['nomeConteudo'];
$contador = count($nomeConteudo);
$chaveAvaliacao = $_POST['chaveAvaliacao'];
$qntdQuestaoPorConteudo = $_POST['qntdQuestaoPorConteudo'];

$questaoDAO = new QuestaoDAO($conexao);
$questao = new Questao();
$avaliacao = new Avaliacao;
$avaliacaoDAO = new AvaliacaoDAO($conexao);
$totalQuestao_solicitado = 0;
for ($i = 0; $i < $contador; $i++ ) {
    //echo "i: " . $i . "<br>";
   // echo "qntdQuestaoPorConteudo: " . $qntdQuestaoPorConteudo[$i]. "<br>";
    $totalQuestao_solicitado += $qntdQuestaoPorConteudo[$i];
}
//echo "total solicitado" .  $totalQuestao_solicitado . "<br>";

foreach ($nomeConteudo as $conteudo) :
    $quantidadeQuestao = $questaoDAO->listaContadorQuestao($conteudo);
    $totalQuestao_banco = $totalQuestao_banco + $quantidadeQuestao;
   // echo "somador for each: " . $totalQuestao . "<br>";
endforeach;
   
echo "totalQuestao_solicitado: " . $totalQuestao_solicitado . "<br>";
echo "totalQuestao_banco: " . $totalQuestao_banco . "<br>";
if ($totalQuestao_solicitado > $totalQuestao_banco) {
    echo "Não há questões o suficiente dos conteúdos selecionados para elaborar a avaliação. Cadastre novas questões.";
}
else {
    for ($i = 0; $i < $contador; $i++ ) {
        if ($qntdQuestaoPorConteudo[$i] < $questaoDAO->listaContadorQuestao($i)) {
            echo "teste";
        }

    } 
    
}

echo $result;

 

    


 require_once("rodape.php"); 
 require_once("script.php"); 
