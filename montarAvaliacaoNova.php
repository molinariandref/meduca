<?php 
require_once("cabecalho.php"); 

$contador = $_SESSION['contador'];
$novaAvaliacaoConteudosId = $_SESSION['novaAvaliacaoConteudosId'];
$chaveAvaliacaoId = $_SESSION['chaveAvaliacaoId'];

$avaliacaoDAO = new AvaliacaoDAO($conexao);
$questaoDAO = new QuestaoDAO($conexao);
$conteudoDAO = new ConteudoDAO($conexao);
$questao = new Questao();

$i = 0;
$flag = 0;

foreach ($novaAvaliacaoConteudosId as $conteudosId) :
    $qntdQuestaoPorConteudo_atual = $questaoDAO->listaContadorQuestao_porAvaliacao($chaveAvaliacaoId, $conteudosId);
    $pre = $questaoDAO->listaPreRequisitos($conteudosId);
    //var_dump($pre);
    foreach ($pre as $p) :
        $opcoes_pre[] = $p;
        $min = min($opcoes_pre);
        $max = max($opcoes_pre);
        $novoConteudo = rand($min, $max);
        $qntdQuestaoPorConteudo_banco = $questaoDAO->listaContadorQuestao($p);    
        if ($qntdQuestaoPorConteudo_banco < $qntdQuestaoPorConteudo_atual) { 
        ?>
            <p class="alert-danger">Não há questões de pré-requisito o suficiente para o conteudo: <b> <?php echo $conteudoDAO->listaConteudoEspecifico($conteudosId) ?> </b></p>
            <?php
            $flag = 1;
        }
    else {
            $novasQuestoes = $questaoDAO->listaQuestaoConteudo_fkid($p);
            $_SESSION['conteudosPreRequisito'][] = $p;
            $contadorWhile = 0;
            while ($qntdQuestaoPorConteudo_atual > $contadorWhile) {
                $ids = array();
                foreach($novasQuestoes as $questao_id) :
                    $ids[] = $questao_id->getId();
                endforeach;	
                $rand = array_rand($ids);
                $avaliacaoDAO->insereAvaliacao_questoes_temporaria($ids[$rand], $p);
                $contadorWhile++;
            };
            $contadorWhile=0;
        }
        $i++;
    endforeach;
endforeach;
//var_dump( $_SESSION['conteudosPreRequisito']);

if ($flag == 0) {
?>
<form action="formularioAvaliacaoNova.php" method="post">
<td><button class="btn btn-success"  type="submit">Iniciar nova avaliação</button></td>
</form>
<?php
} 
else { 
?>
<form action="index.php" method="post">
<p class="alert-danger">Comunique o professor ou pedagogo responsável pela avaliação pelo erro. </b></p>
<td><button class="btn btn-danger"  type="submit">Voltar pro início</button></td>
</form>
<?php 
} 
?>