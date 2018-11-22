<?php require_once("cabecalho.php");

$conteudoEspecificoId = $_SESSION['conteudosPreRequisito'][$_SESSION['contador']];
$_SESSION['contador'] = $_SESSION['contador'] + 1;
$id = $_SESSION['questaoId'];
$avaliacaoDAO = new AvaliacaoDAO($conexao);

echo "id conteudo " . $conteudoEspecificoId . "<br>";
echo $id;

//$conteudosPainel = $_POST['conteudosPainel'];

/*
$questaoDAO = new QuestaoDAO($conexao);
$pos = new Questao();
$conteudoDAO = new ConteudoDAO($conexao);*/

$teste = $_POST['id_alternativa']; //Recebe valor de formularioProva.php
$verifica = $_POST['correta_id'];


$questoesCertas = $_SESSION['questoesCertasNova'];
$questoesErradas = $_SESSION['questoesErradasNova'];

$contadorRepetida = $_SESSION['contadorRepetida'];
?>

<form action="formularioAvaliacaoNova.php" method="post"> <?php
if ($teste == $verifica){
    $_SESSION['questoesCertasNova'] = $questoesCertas + 1;
    $score = 1;
    $avaliacaoDAO->insereScore_temporaria($score, $conteudoEspecificoId, $id);
    ?>
    <p class="alert-success">Você acertou a questão. </p> 
    <?php
}

elseif ($teste != $verifica) {
    $_SESSION['questoesErradasNova'] = $questoesErradas + 1;
    $score = 0;
    $avaliacaoDAO->insereScore_temporaria($score, $conteudoEspecificoId, $id);
    ?>
    <p class="alert-danger">Você errou a questão. </p> 
    <?php
    $_SESSION['qntdErradaNova'] =  $_SESSION['qntdErradaNova'] + 1; 
} 

?>

<br/>

<button class="btn btn-primary" type="submit">Próxima</button>
</form>
