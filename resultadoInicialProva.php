<?php require_once("cabecalho.php");

$questaoDAO = new QuestaoDAO($conexao);
$pos = new Questao();
$conteudoDAO = new ConteudoDAO($conexao);
$simuladoDAO = new SimuladoDAO($conexao);


$teste = $_POST['id_alternativa']; //Recebe valor de formularioProva.php
$verifica = $_POST['correta_id'];
$idQuestao = $_POST['idQuestao'];
$maxAcerto = $conteudoDAO->listaMaxAcerto($_SESSION['conteudo_inicial']);
$maxErro = $conteudoDAO->listaMaxErro($_SESSION['conteudo_inicial']);

$continuar_conteudo = $_SESSION['conteudo_inicial'];
$nomeConteudo = $_SESSION['nomeConteudo']; 
$_SESSION['contadorQuestao'] = $_SESSION['contadorQuestao'] + 1; 

$contadorRepetida = $_SESSION['contadorRepetida'];
?>

<form action="formularioProvaCont.php" method="post"> <?php
if ($teste == $verifica){
    $simuladoDAO->insertSimulado($continuar_conteudo, $idQuestao, 1, $_SESSION["fkid_simulado"]);
    ?>
    <p class="alert-success">Você acertou a questão. </p> 
    <?php
    $_SESSION['qntdCorreta'] =  $_SESSION['qntdCorreta'] + 1; 
    if ($_SESSION['qntdCorreta'] == $maxAcerto) {

        ?>
        <p class="alert-success">Foi atingido o número máximo de acertos estipulados para o conteúdo:  
        <?php echo $conteudoDAO->listaConteudoEspecifico($_SESSION['conteudo_inicial']) ?> <br>
        Portanto as próximas questões são de um pós-requisito.
        </p> 
        <?php
        $_SESSION['avancouConteudo'] = $_SESSION['avancouConteudo'] + 1;
        $_SESSION['qntdCorreta'] = 0;
        $pos = $questaoDAO->listaPosRequisitos($_SESSION['conteudo_inicial']);
        foreach ($pos as $p) :
            $opcoes_pos[] = $p;
        endforeach;
        $min = min($opcoes_pos);
        $max = max($opcoes_pos);
        $novoConteudo = rand($min, $max);
        $_SESSION['qualConteudo'] = $novoConteudo;
    
    } else {
        $_SESSION['qualConteudo'] = $continuar_conteudo;
    }
}
elseif ($teste != $verifica) {
    $simuladoDAO->insertSimulado($continuar_conteudo, $idQuestao, 0, $_SESSION["fkid_simulado"]);
    ?>
    <p class="alert-danger">Você errou a questão. </p> 
    <?php
    $_SESSION['qntdErrada'] =  $_SESSION['qntdErrada'] + 1; 
    if ($_SESSION['qntdErrada'] == $maxErro) {
        ?>
        <p class="alert-danger">Foi atingido o número máximo de erros estipulados para o conteúdo:  
        <?php echo $conteudoDAO->listaConteudoEspecifico($_SESSION['conteudo_inicial']) ?> <br>
        Portanto as próximas questões são de um pré-requisito.
        </p> 
        <?php
        $_SESSION['regridiuConteudo'] = $_SESSION['regridiuConteudo'] + 1;
        $_SESSION['qntdErrada'] = 0;
        $pre = $questaoDAO->listaPreRequisitos($_SESSION['conteudo_inicial']);
        foreach ($pre as $p) :
            $opcoes_pre[] = $p;
        endforeach;
        $min = min($opcoes_pre);
        $max = max($opcoes_pre);
        $novoConteudo = rand($min, $max);
        $_SESSION['qualConteudo'] = $novoConteudo;
    } else {
        $_SESSION['qualConteudo'] = $continuar_conteudo;
    }
} 

?>

<p class="alert-warning">Clique em 'próxima' para continuar. </p> 
<button class="btn btn-primary" type="submit">Próxima</button>
</form>
