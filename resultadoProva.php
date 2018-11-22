<?php require_once("cabecalho.php");

$questaoDAO = new QuestaoDAO($conexao);
$pos = new Questao();
$conteudoDAO = new ConteudoDAO($conexao);
$simuladoDAO = new SimuladoDAO($conexao);
$idQuestao = $_POST['idQuestao'];
$teste = $_POST['id_alternativa']; //Recebe valor de formularioProva.php
$verifica = $_POST['correta_id'];

$maxAcerto = $conteudoDAO->listaMaxAcerto($_SESSION['qualConteudo']);
$maxErro = $conteudoDAO->listaMaxErro($_SESSION['qualConteudo']);

$_SESSION['contadorQuestao'] = $_SESSION['contadorQuestao'] + 1;

$contadorRepetida = $_SESSION['contadorRepetida'];

?>

<form action="formularioProvaCont.php" method="post"> <?php
if ($teste == $verifica){
        $simuladoDAO->insertSimulado($_SESSION["qualConteudo"], $idQuestao, 1, $_SESSION["fkid_simulado"]);
        $_SESSION['qntdCorreta'] = $_SESSION['qntdCorreta'] + 1; 
        ?>
        <p class="alert-success">Você acertou a questão. </p> 
        <?php
    if ($_SESSION['qntdCorreta'] == $maxAcerto && $_SESSION['regridiuConteudo'] == 0 && $_SESSION['avancouConteudo'] < 2) {     
        ?>
        <p class="alert-success">Foi atingido o número máximo de acertos estipulados para o conteúdo:  
        <?php echo $conteudoDAO->listaConteudoEspecifico($_SESSION['qualConteudo']) ?> <br>
        Portanto as próximas questões são de um pós-requisito.
        </p> 
        <?php
        $_SESSION['avancouConteudo'] = $_SESSION['avancouConteudo'] + 1;
        $_SESSION['qntdCorreta'] = 0;
        $pos = $questaoDAO->listaPosRequisitos($_SESSION['qualConteudo']);
        $contador = 0;
        foreach ($pos as $p) :
            $opcoes_pos[] = $p;
        endforeach;
        $min = min($opcoes_pos);
        $max = max($opcoes_pos);
        $novoConteudo = rand($min, $max);
        $_SESSION['qualConteudo'] = $novoConteudo;
    } elseif ($_SESSION['qntdCorreta'] == $maxAcerto && ($_SESSION['regridiuConteudo'] >= 2 || $_SESSION['avancouConteudo'] >= 2))  {
        $_SESSION["success"] = "Simulado finalizado com sucesso.";
        header("Location: painelPedagogicoSimulado.php");
        die();
    } elseif ($_SESSION['qntdCorreta'] == $maxAcerto && $_SESSION['regridiuConteudo'] != 0) {
        $_SESSION["success"] = "Simulado finalizado com sucesso.";
        header("Location: painelPedagogicoSimulado.php");
        die();
    }
}
elseif ($teste != $verifica) {
    $simuladoDAO->insertSimulado($_SESSION["qualConteudo"], $idQuestao, 0, $_SESSION["fkid_simulado"]);
    ?>
        <p class="alert-danger">Você errou a questão. </p> 
    <?php
    //echo "<br>" . "id informado " . $teste . " <br> id da correta" . $verifica;
    $_SESSION['qntdErrada'] = $_SESSION['qntdErrada'] + 1;
    if ($_SESSION['qntdErrada'] == $maxErro && ($_SESSION['avancouConteudo'] == 0 && $_SESSION['regridiuConteudo'] < 2)) {
        ?>
        <p class="alert-danger">Foi atingido o número máximo de erros estipulados para o conteúdo:  
        <?php echo $conteudoDAO->listaConteudoEspecifico($_SESSION['qualConteudo']) ?> <br>
        Portanto as próximas questões são de um pré-requisito.
        </p> 
        <?php
        $_SESSION['regridiuConteudo'] = $_SESSION['regridiuConteudo'] + 1;
        $_SESSION['qntdErrada'] = 0;
        $pre = $questaoDAO->listaPreRequisitos($_SESSION['qualConteudo']);
        foreach ($pre as $p) :
            $opcoes_pre[] = $p;
        endforeach;
        $min = min($opcoes_pre);
        $max = max($opcoes_pre);
        $novoConteudo = rand($min, $max);
        $_SESSION['qualConteudo'] = $novoConteudo;
    } elseif ($_SESSION['qntdErrada'] == $maxErro && ($_SESSION['regridiuConteudo'] == 2 || $_SESSION['avancouConteudo'] == 2))  {
        $_SESSION["success"] = "Simulado finalizado com sucesso.";
        header("Location: painelPedagogicoSimulado.php");
        die();
    } elseif ($_SESSION['qntdErrada'] == $maxErro && $_SESSION['avancouConteudo'] != 0) {
        $_SESSION["success"] = "Simulado finalizado com sucesso.";
        header("Location: painelPedagogicoSimulado.php");
        die();
    }
} 
foreach ($contadorRepetida as $cr) :
    array_push($_SESSION['contadorRepetida'], $cr);
endforeach; 
?>
<p class="alert-warning">Clique em 'próxima' para continuar. </p> 
<button class="btn btn-primary" type="submit">Próxima</button>
</form>
