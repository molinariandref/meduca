<?php require_once("cabecalho.php");

$questaoDAO = new QuestaoDAO($conexao);
$pos = new Questao();
$conteudoDAO = new ConteudoDAO($conexao);

$teste = $_POST['id_alternativa']; //Recebe valor de formularioProva.php
$verifica = $_POST['correta_id'];

$maxAcerto = $conteudoDAO->listaMaxAcerto($_SESSION['conteudo_inicial']);
$maxErro = $conteudoDAO->listaMaxErro($_SESSION['conteudo_inicial']);

$continuar_conteudo = $_SESSION['conteudo_inicial'];
$nomeConteudo = $_SESSION['nomeConteudo']; 
$_SESSION['contadorQuestao'] = $_SESSION['contadorQuestao'] + 1; 

$contadorRepetida = $_SESSION['contadorRepetida'];
?>

<form action="formularioProvaCont.php" method="post"> <?php
if ($teste == $verifica){
    ?>
    <p class="alert-success">Você acertou a questão. </p> 
    <?php
    $_SESSION['qntdCorreta'] =  $_SESSION['qntdCorreta'] + 1; 
    if ($_SESSION['qntdCorreta'] == 3) {
        $_SESSION['qntdCorreta'] = 0;
        $pos = $questaoDAO->listaPosRequisitos();
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
    ?>
    <p class="alert-danger">Você errou a questão. </p> 
    <?php
        $_SESSION['qntdErrada'] =  $_SESSION['qntdErrada'] + 1; 
    if ($qntdErrada == 3) {
        $qntdErrada = 0;
        $pre = $questaoDAO->listaPreRequisitos();
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

<br/>

<button class="btn btn-primary" type="submit">Próxima</button>
</form>
