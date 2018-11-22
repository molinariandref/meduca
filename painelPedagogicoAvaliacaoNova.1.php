<?php require_once("cabecalho.php"); 
$soma = $_SESSION['questoesCertas'] + $_SESSION['questoesErradas'];
$avaliacaoDAO = new AvaliacaoDAO($conexao);
$conteudoDAO = new ConteudoDAO($conexao);
/*echo "<b>Número de questões respondidas</b>: " . $soma;
echo "<br><b>Total de acertos</b>: " . $_SESSION['questoesCertas'];
echo "<br><b>Total de erros</b>: " . $_SESSION['questoesErradas'] . "<br>";
echo "<br>";*/
$chaveAvaliacaoId = $_SESSION['chaveAvaliacaoId'];
$conts =  $avaliacaoDAO->selectNomeConteudo($chaveAvaliacaoId);
$contsId =  $avaliacaoDAO->selectIdConteudo($chaveAvaliacaoId);
$nomeAvaliacao = $avaliacaoDAO->selectChaveAvaliacao($chaveAvaliacaoId);

$conteudosIdArray = array();
$i = 0;
$_SESSION['novaAvaliacaoConteudosId'] = array();
$reforco = $_SESSION['conteudosPreRequisito'];

$conteudosIdArray_unique = array_unique($contsId);
$k = 0;
foreach ($conteudosIdArray_unique as $unique) :
    $conteudosIdArray[$k] = $unique;
    $k++;
endforeach;

$j = 0;
?> 
<table class="table table-striped"> 
    <thead>
      <tr>
        <th><center>Avaliação base: <b><?php echo $nomeAvaliacao; ?> </b></th></center>
      </tr>
      <tr>
        <th>Contéudos da Avaliação</th>
        <th>Quantidade de Acertos</th>
        <th>Quantidade de Erros</th>
        <th>Sugestão máxima de erros</th>
      </tr>
    </thead>
<?php
foreach ($conteudosIdArray as $cia) :
    $erroMaximoPermitido = $avaliacaoDAO->selectMaxErro($cia, $chaveAvaliacaoId);
    $erroPorConteudo =  $avaliacaoDAO->listaContadorConteudo($cia, $chaveAvaliacaoId);
    $acertoPorConteudo = $avaliacaoDAO->listaContadorConteudoAcertos($cia, $chaveAvaliacaoId);
    $conteudoEspecifico = $conteudoDAO->listaConteudoEspecifico($cia);
     ?>
    <tbody>
      <tr>
        <td><?php echo $conteudoEspecifico ?></td>
        <td><?php echo $acertoPorConteudo ?></td>
        <td><?php echo $erroPorConteudo ?></td>
        <td><?php echo $erroMaximoPermitido ?></td>
      </tr>
    </tbody>
<?php
    $j++;
endforeach;
?>  </table> 

<table class="table table-striped"> 
    <thead>
      <tr>
        <th><center>Avaliação de reforço</center>
      </tr>
      <tr>
        <th>Contéudos da Avaliação</th>
        <th>Quantidade de Acertos</th>
        <th>Quantidade de Erros</th>
        <th>Sugestão máxima de erros</th>
      </tr>
    </thead>
<?php
foreach ($reforco as $r) :
    $erroMaximoPermitidoNova = $avaliacaoDAO->selectMaxErroNova($r);
    echo "<br>";
    $erroPorConteudoNova =  $avaliacaoDAO->listaContadorConteudoNova($r);
    $acertoPorConteudoNova = $avaliacaoDAO->listaContadorConteudoAcertosNova($r);
    $conteudoEspecificoNova = $conteudoDAO->listaConteudoEspecifico($r); // TA NO NORMAL, DEIXAR ASSIM PR ENQUANTO
     ?>
    <tbody>
      <tr>
        <td><?php echo $conteudoEspecificoNova ?></td>
        <td><?php echo $acertoPorConteudoNova ?></td>
        <td><?php echo $erroPorConteudoNova ?></td>
        <td><?php echo $erroMaximoPermitidoNova ?></td>
      </tr>
    </tbody>
<?php
    $j++;
endforeach;




/*
if ($_SESSION['novaAvaliacaoConteudosId'] != null) {
    $_SESSION['contador'] = 0;
    $_SESSION['questoesErradas'] = 0;
    $_SESSION['questoesCertas'] = 0;
    var_dump($_SESSION['novaAvaliacaoConteudosId']);
    ?>
    <p class="alert-danger">Deseja realizar uma nova avaliação com os conteúdos que não atingiu média? <br> </p> 
    <form action="montarAvaliacaoNova.php" method="post">
    <br>
	    <td><button class="btn btn-danger"  type="submit">Sim</button></td>
    </form>
    <form action="index.php" method="post">
	    <td><button class="btn btn-success"  type="submit">Não</button></td>
    </form>
    <?php
}
*/
?>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); 

$avaliacaoDAO->truncateAvaliacaoQuestaoTemporaria();
?>