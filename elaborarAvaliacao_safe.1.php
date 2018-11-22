<?php require_once("cabecalho.php"); 
$chaveAvaliacao = $_SESSION['chaveAvaliacao'];
$conteudosCheckbox = $_POST['conteudosCheckbox'];
$contador = count($conteudosCheckbox);
$qntdQuestaoPorConteudo_php = $_POST['qntdQuestaoPorConteudo'];

$questaoDAO = new QuestaoDAO($conexao);
$conteudoDAO = new conteudoDAO($conexao);
$questao = new Questao();
$avaliacao = new Avaliacao;
$avaliacaoDAO = new AvaliacaoDAO($conexao);
$validador = 0;

$i=0;
//echo $conteudosCheckbox[0];
foreach ($conteudosCheckbox as $conteudo) :
    $qntdQuestaoPorConteudo_banco = $questaoDAO->listaContadorQuestao($conteudo);
    //echo "qntdQuestao pode : " . $quantidadeQuestao . "<br>";
    /*echo "quantidadeQuestaoBanco: " . $qntdQuestaoPorConteudo_banco;
    echo "<br> qntdQuestaoPorConteudo: " . $qntdQuestaoPorConteudo_php[$i] . "<br>"; */
    if ($qntdQuestaoPorConteudo_banco < $qntdQuestaoPorConteudo_php[$i]) {
        echo "Não há questões suficientes cadastradas para o conteúdo: <b>" . $conteudoDAO->listaConteudoEspecifico($conteudo) . 
        "<br></b> Cadastre novas questões para o conteúdo e tente novamente. <br><br>";
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
    
$j = 0;
foreach ($conteudosCheckbox as $conteudo) :

    $avaliacao->setChaveAvaliacao($chaveAvaliacao);
    $avaliacao_fkid = $avaliacaoDAO->selecionaAvaliacao($avaliacao->getChaveAvaliacao());
    echo "<br>";
    $questao = $questaoDAO->listaQuestaoConteudo_fkid($avaliacao_fkid);
    //echo "questao " . $questao[$j];
    // echo $avaliacao_fkid . "<br>";
    $j++;
endforeach;
/*for ($i= 0; $i < $contador; $i++) {
    $quantidadeQuestao = $questaoDAO->listaContadorQuestao($nomeConteudo[$i]);
    echo $quantidadeQuestao;
    $questoesBanco = $questoesBanco + $quantidadeQuestao;
    if ($validador == 0) {
        $avaliacao->setChaveAvaliacao($chaveAvaliacao);
        $chaveAvaliacaoId = $avaliacaoDAO->selecionaAvaliacao($avaliacao->getChaveAvaliacao());
        $questao = $questaoDAO->listaQuestaoConteudo_fkid($nomeConteudo[$i]);
        $contadorWhile = 0;
        while ($qntdQuestaoPorConteudo[$i] > $contadorWhile) {
            $ids = array();
            foreach($questao as $questao_id) :
                $ids[] = $questao_id->getId();
            endforeach;	
            $rand = array_rand($ids);
   
            // $conteudo_fkid->getConteudo_fkid();
            $avaliacaoDAO->insereAvaliacao_questoes($chaveAvaliacaoId, $ids[$rand]);
            $contadorWhile++;
        };
    }
}
$lastId = $avaliacaoDAO->lastId();
$avaliacao_fkid = $avaliacaoDAO->descobrirAvaliacao_fkid($lastId);
$avaliacoes =  $avaliacaoDAO->selectQuestoes_fkid($avaliacao_fkid);
$conteudoEspecifico = array();
for($i=0; $i<sizeof($avaliacoes); $i++){
    $conteudoEspecifico[$i] = $avaliacaoDAO->selectConteudo($avaliacoes[$i]);
    $avaliacaoDAO->updateConteudo_fkid($conteudoEspecifico[$i][0], $avaliacoes[$i]);
}*/
}
require_once("rodape.php"); 
require_once("script.php"); 
