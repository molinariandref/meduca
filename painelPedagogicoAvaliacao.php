<?php require_once("cabecalho.php"); 
$soma = $_SESSION['questoesCertas'] + $_SESSION['questoesErradas'];
$avaliacaoDAO = new AvaliacaoDAO($conexao);
$conteudoDAO = new ConteudoDAO($conexao);
$chaveAvaliacaoId = $_SESSION['chaveAvaliacaoId'];
$conts =  $avaliacaoDAO->selectNomeConteudo($chaveAvaliacaoId);
$contsId =  $avaliacaoDAO->selectIdConteudo($chaveAvaliacaoId);

$conteudosIdArray = array();
$i = 0;
$_SESSION['novaAvaliacaoConteudosId'] = array();

$conteudosIdArray_unique = array_unique($contsId);
$k = 0;
foreach ($conteudosIdArray_unique as $unique) :
    $conteudosIdArray[$k] = $unique;
    $k++;
endforeach;

//var_dump($conteudosIdArray);
$j = 0;
?> 
<table class="table table-striped"> 
    <thead>
      <tr>
        <th>Contéudos da Avaliação</th>
        <th>Quantidade de Acertos</th>
        <th>Quantidade de Erros</th>
        <th>Sugestão máxima de erros</th>
        <th>Assimilou?</th>
      </tr>
    </thead>
<?php
foreach ($conteudosIdArray as $cia) :
    //echo "CIA: ". $cia;
    $erroMaximoPermitido = $avaliacaoDAO->selectMaxErro($cia, $chaveAvaliacaoId);
    $erroPorConteudo =  $avaliacaoDAO->listaContadorConteudo($cia, $chaveAvaliacaoId);
    $acertoPorConteudo = $avaliacaoDAO->listaContadorConteudoAcertos($cia, $chaveAvaliacaoId);
    $conteudoEspecifico = $conteudoDAO->listaConteudoEspecifico($cia);
    if ($erroPorConteudo >= $erroMaximoPermitido) {
        $assimilou = '<img src="src/error.png" width="28" height="28">';
    } else {
        $assimilou = '<img src="src/checked.png" width="28" height="28">';
    }
  //  echo "<b>" . $conteudoDAO->listaConteudoEspecifico($cia) . "</b>: ". $acertoPorConteudo . " <b>..........................Número máximo de erros sugerido</b>: <br>";
     ?>
    <tbody>
      <tr>
        <td><?php echo $conteudoEspecifico ?></td>
        <td><?php echo $acertoPorConteudo ?></td>
        <td><?php echo $erroPorConteudo ?></td>
        <td><?php echo $erroMaximoPermitido ?></td>
        <td><center><?php echo $assimilou ?></td>
      </tr>
    </tbody>
<?php

    if ($erroPorConteudo >= $erroMaximoPermitido) {
        ?>
        <p class="alert-danger">Média minima do conteúdo: <?php echo $conteudoEspecifico ?> não foi atingida. <br> </p> 
        <?php
        $_SESSION['novaAvaliacaoConteudosId'][] = $cia;
    }
    $j++;
endforeach;

?>  </table> 

<table class="table"> 
    <tr>
        <th>Total de Questões Respondidas</th>
        <th>Total de Acertos</th>
        <th>Total de Erros</th>
    </tr> 
    <tr>
        <td><?php echo $soma; ?></td>
        <td><?php echo $_SESSION['questoesCertas']; ?></td>
        <td><?php echo $_SESSION['questoesErradas'];?></td>
    </tr>
</table>
<?php

if ($_SESSION['novaAvaliacaoConteudosId'] != null) {
    $_SESSION['contador'] = 0;
    //var_dump($_SESSION['novaAvaliacaoConteudosId']);
    ?>
    <p class="alert-danger bg-danger">Você não atingiu a média em todos os conteúdos previstos na presente avaliação. <br> Deseja realizar uma outra avaliação apenas com os pré-requisito dos conteúdos em que não atingiu média? <br> </p> 
    <form action="montarAvaliacaoNova.php" method="post">
    <br>
	    <td><button class="btn btn-danger"  type="submit">Sim</button></td>
    </form>
    <form action="index.php" method="post">
	    <td><button class="btn btn-success"  type="submit">Não</button></td>
    </form>
    <?php
} else {
    ?>
    <p class="alert-success"><b>PARABÉNS!</b> <br> Você atingiu a média em todos os conteúdos previstos na presente avaliação. <br> Clique no botão a baixo para regressar a tela inicial. <br> </p>
    
    <form action="index.php" method="post">
	    <td><button class="btn btn-success"  type="submit">Inicio</button></td>
    </form>
    <?php
}
?>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>