<?php require_once("cabecalho.php");

$conteudoEspecificoId = $_SESSION['conteudoEspecificoId'];
$_SESSION['contador'] = $_SESSION['contador'] + 1;
$id = $_SESSION['questaoId'];
$avaliacaoDAO = new AvaliacaoDAO($conexao);

$teste = $_POST['id_alternativa']; //Recebe valor de formularioProva.php
$verifica = $_POST['correta_id'];

$questoesCertas = $_SESSION['questoesCertas'];
$questoesErradas = $_SESSION['questoesErradas'];

$contadorRepetida = $_SESSION['contadorRepetida'];
?>

<form action="formularioAvaliacao.php" method="post"> <?php
if ($teste == $verifica){
    $_SESSION['questoesCertas'] = $questoesCertas + 1;
    $score = 1;
    $avaliacaoDAO->insereScore($score, $conteudoEspecificoId, $_SESSION['chaveAvaliacaoId'], $id);
    $avaliacaoDAO->insertAvaliacaoUsuario($_SESSION['idUsuario'], $id, $score, $_SESSION['chaveAvaliacaoId'], $conteudoEspecificoId);
    ?>
    <p class="alert-success">Você acertou a questão.
    <?php
}

elseif ($teste != $verifica) {
    $_SESSION['questoesErradas'] = $questoesErradas + 1;
    $score = 0;
    $avaliacaoDAO->insereScore($score, $conteudoEspecificoId, $_SESSION['chaveAvaliacaoId'], $id);
    $avaliacaoDAO->insertAvaliacaoUsuario($_SESSION['idUsuario'], $id, $score, $_SESSION['chaveAvaliacaoId'], $conteudoEspecificoId);
    ?>
    <p class="alert-danger">Você errou a questão. </p> 
    <?php
    $_SESSION['qntdErrada'] =  $_SESSION['qntdErrada'] + 1; 
} 

?>

<br/>
<p class="alert-warning">Clique em próxima para continuar. </p> 
<button class="btn btn-primary" type="submit">Próxima</button>
</form>
