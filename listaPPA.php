<?php require_once("cabecalho.php"); 
$usuarioDAO = new UsuarioMeducaDAO($conexao);
$avaliacaoDAO = new AvaliacaoDAO($conexao);

$av = $_POST["conteudo"];
//echo $av;
$fkid_usuario = $_POST["usuario"];
$avaliacao = $avaliacaoDAO->selectPainelUsuarioAvaliacao($av, $fkid_usuario);

if ($avaliacao == null) {
    ?>
    <p class="alert-warning"><b>O usuário selecionado ainda não realizou nenhum simulado. <br>Clique no botão "Voltar" para selecionar outro usuário<br></p> 
    <form action="listaPainelPedagogico.php" method="post">
        <td><button class="btn btn-warning"  type="submit">Voltar</button></td>
    </form>
    
    <?php
}
?>
    <table class="table table-striped"> 
    <thead>
        <tr>
            <th>Contéudo</th>
            <th>Questão</th>
            <th>Resultado</th>
        </tr>
    </thead>
<?php
$contador = 0;
$acertou = 0;
$errou = 0;
foreach ($avaliacao as $questao):
    $score = $questao->getScore();
    if ($score == 1) {
        $acertou = $acertou + 1;
        $score = "acertou";
        $assimilou = '<img src="src/checked.png" width="28" height="28">';
    } else {
        $errou = $errou + 1;
        $score = "errou";
        $assimilou = '<img src="src/error.png" width="28" height="28">';
    }
    ?>
    <tbody>
        <tr>
        <td> <?php echo $questao->getNomeConteudo(); ?>
        <td> <?php echo $questao->getEnunciado(); ?>
        <td> <?php echo $assimilou . " " . $score; ?>
        </tr>
    </tbody>
<?php
$contador++;
endforeach; ?>
<table class="table"> 
        <tr>
            <th>Total de Questões Respondidas</th>
            <th>Total de Acertos</th>
            <th>Total de Erros</th>
        </tr> 
        <tr>
            <td><?php echo $contador; ?></td>
            <td><?php echo $acertou; ?></td>
            <td><?php echo $errou;?></td>
</table>
<form action="selecionaAvaliacao.php" method="POST">
    <input type="hidden" name="usuario" value="<?=$fkid_usuario?>">
    <td width="20"><input type="submit" value="Voltar" class="btn btn-success"></td>   
</form>
<form action="refazerAvaliacao.php" method="POST">
    <input type="hidden" name="avaliacao" value="<?=$av?>">
    <input type="hidden" name="usuario" value="<?=$fkid_usuario?>">
    <td width="20"><input type="submit" value="Refazer Avaliação" class="btn btn-danger"></td>   
</form>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>