<?php require_once("cabecalho.php"); 
$chaveAvaliacao = $_SESSION['chaveAvaliacao'];

$conteudosCheckbox = $_POST['conteudosCheckbox'];
echo "Id Valores do Checkbox: ";
var_dump($conteudosCheckbox);
$contador = count($conteudosCheckbox);
echo "qntdQuestaoPorConteudoBruto_php: ";
$qntdQuestaoPorConteudoBruto_php = $_POST['qntdQuestaoPorConteudo_php'];
var_dump($qntdQuestaoPorConteudoBruto_php);
echo "qntdQuestaoPorConteudoLimpo_php: ";
$qntdQuestaoPorConteudoFilter_php = array_filter($qntdQuestaoPorConteudoBruto_php);
var_dump($qntdQuestaoPorConteudoFilter_php);
$k = 0;
foreach ($qntdQuestaoPorConteudoFilter_php as $filter) :
    $qntdQuestaoPorConteudo_php[$k] = $filter;
    $k++;
endforeach;

var_dump($qntdQuestaoPorConteudo_php);

//$qntdQuestaoPorConteudo_php2 = $_POST['qntdQuestaoPorConteudo_php'];

$questaoDAO = new QuestaoDAO($conexao);
$conteudoDAO = new conteudoDAO($conexao);
$questao = new Questao();
$avaliacao = new Avaliacao;
$avaliacaoDAO = new AvaliacaoDAO($conexao);
$validador = 0;

$i=0;
//echo $conteudosCheckbox[0];
echo "foreach I:<br>";
foreach ($conteudosCheckbox as $conteudo) :
    echo "<br>PASSADA DO I : " . $i . "<br>";
    $qntdQuestaoPorConteudo_banco = $questaoDAO->listaContadorQuestao($conteudo);
    //echo $i."<br>";
    //echo "qntdQuestao pode : " . $quantidadeQuestao . "<br>";
    echo "qntdQuestaoPorConteudo_banco: " . $qntdQuestaoPorConteudo_banco;
    echo "<br> qntdQuestaoPorConteudo_php: " . $qntdQuestaoPorConteudo_php[$i] . "<br>"; 
    if ($qntdQuestaoPorConteudo_banco < $qntdQuestaoPorConteudo_php[$i]) {
        echo $i;
        echo "<br>";
        echo "banco: " . $qntdQuestaoPorConteudo_banco;
        echo "<br>";
        echo "php: " .  $qntdQuestaoPorConteudo_php[$i];
        echo "<br>";
    /*  echo "Não há questões suficientes cadastradas para o conteúdo: <b>" . $conteudoDAO->listaConteudoEspecifico($conteudo) . 
        "<br></b> Cadastre novas questões para o conteúdo e tente novamente. <br><br>";*/
        $avaliacaoDAO->removeAvaliacao($chaveAvaliacao);
        $validador = 1;
    }
$i++;
endforeach;

if ($validador == 1) {
    echo "O que deseja fazer? <br><br>";
    ?>
    <form action="index.php" method="POST">
        <input type="submit" value="Inicio" class="btn btn-danger">  
    </form>

    <form action="formularioQuestao.php" method="POST">
        <input type="submit" value="Cadastrar questão" class="btn btn-success">  
    </form>

    <form action="formularioChaveAvaliacao.php">
        <input type="submit" value="Cadastrar nova avaliação" class="btn btn-warning">  
    </form>
    <?php
}
else {
    
$j = 0;    echo "<br>";

echo "foreach J:";

foreach ($conteudosCheckbox as $conteudo) :
    echo "<br>";

    //echo "entra no foreach?";
    $quantidadeQuestao = $questaoDAO->listaContadorQuestao($conteudo);
    $questoesBanco = $questoesBanco + $quantidadeQuestao;

    $avaliacao->setChaveAvaliacao($chaveAvaliacao);
    $avaliacao_fkid = $avaliacaoDAO->selecionaAvaliacao($avaliacao->getChaveAvaliacao());
//   $conteudo_fkid = $questaoDAO->selectConteudo_fkid($conteudo);
// echo "<br>CONTEUDO FKID : " . $conteudo_fkid . "<br>";
    echo "<br>"; 
    $questao = $questaoDAO->listaQuestaoConteudo_fkid($conteudo);
  //  var_dump($questao);
    //echo "<br><br> -------------------------------- <br>" .$questao . "";
// echo "<br>lista questao conteudo fkid: " . $questao . "<br><br>";
$contadorWhile = 0;
//echo "<br>qntdQuestaoPorConteudo_php: " . $qntdQuestaoPorConteudo_php[$j] . "<br>";
echo "<br>";
    while ($qntdQuestaoPorConteudo_php[$j] > $contadorWhile) {
        $ids = array();
        foreach($questao as $questao_id) :
            $ids[] = $questao_id->getId();
        endforeach;	
        $rand = array_rand($ids);
        // $conteudo_fkid->getConteudo_fkid();
    $avaliacaoDAO->insereAvaliacao_questoes($avaliacao_fkid, $ids[$rand], $conteudo);
    $contadorWhile++;
    echo "qntd passadas (numero questao) : " . $j . "<br>";
};
    //var_dump($questao);
    //echo "questao " . $questao[$j];
    // echo $avaliacao_fkid . "<br>";
    $j++;
endforeach;
/*
echo "<br> -----------------------------------------------------<br>";
$array = $avaliacaoDAO->listaAvaliacao();
foreach ($array as $a):
echo $a['chaveAvaliacao'] . "<br>";
endforeach;
*/
}
require_once("rodape.php"); 
require_once("script.php"); 
