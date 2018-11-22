<?php require_once("cabecalho.php"); 
$chaveAvaliacao = $_SESSION['chaveAvaliacao'];
$nomeConteudo = $_POST['nomeConteudo'];
$contador = count($nomeConteudo);
$qntdQuestaoPorConteudo = $_POST['qntdQuestaoPorConteudo'];

$questaoDAO = new QuestaoDAO($conexao);
$conteudoDAO = new conteudoDAO($conexao);
$questao = new Questao();
$avaliacao = new Avaliacao;
$avaliacaoDAO = new AvaliacaoDAO($conexao);
$validador = 0;

for ($i= 0; $i < $contador; $i++) {
    $quantidadeQuestao = $questaoDAO->listaContadorQuestao($nomeConteudo[$i]);
    $questoesBanco = $questoesBanco + $quantidadeQuestao;
    if ($quantidadeQuestao < $qntdQuestaoPorConteudo[$i]){
        echo "Não há questões suficientes cadastradas para o conteúdo <b>" . $conteudoDAO->listaConteudoEspecifico($nomeConteudo[$i]) . "</b> Cadastre novas questões e tente novamente. <br><br>";
        $avaliacaoDAO->removeAvaliacao($chaveAvaliacao);
        $validador = 1;
    }
}

for ($i= 0; $i < $contador; $i++) {
    $quantidadeQuestao = $questaoDAO->listaContadorQuestao($nomeConteudo[$i]);
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
            $conteudo_fkid = $conteudoDAO->
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
}
require_once("rodape.php"); 
require_once("script.php"); 
