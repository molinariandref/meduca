<?php require_once("cabecalho.php"); 
$conteudoDAO = new ConteudoDAO($conexao);
$simuladoDAO = new SimuladoDAO($conexao);
$simulado = new Simulado();

$simulado = $simuladoDAO->selectSimulado_usuario($_SESSION['fkid_simulado']);
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
    foreach ($simulado as $s) : 
        $score = $s->getScore();
        if ($score == 1) {
            $acertou = $acertou + 1;
            $score = "acertou";
        } else {
            $errou = $errou + 1;
            $score = "errou";
        }
?>
    <tbody>
      <tr>
      <td> <?php echo $s->getNomeConteudo(); ?>
      <td> <?php echo $s->getEnunciado(); ?>
      <td> <?php echo $score; ?>
      </tr>
    </tbody>

<?php
    $contador++;
    endforeach;
?>
  </table> 



<!-- SEPARAÇÃO -->

<?php

$simulado = $simuladoDAO->selectSimulado_usuario($_SESSION['fkid_simulado']);
$nomeConteudo = array();
$idConteudo = array();

$i = 0;
foreach ($simulado as $s) : 
    $nomeConteudo[$i] = $s->getNomeConteudo();
    $idConteudo[$i] = $s->getIdConteudo();
    $i++;
endforeach; 

$nomeConteudo_unique = array_unique($nomeConteudo);
$idConteudo_unique = array_unique($idConteudo);

$idConteudo_filter = array();
$k = 0;
foreach ($idConteudo_unique as $unique) :
    $idConteudo_filter[$k] = $unique;
    $k++;
endforeach;

?> 
<table class="table table-striped"> 
    <thead>
      <tr>
        <th>Contéudos do simulado</th>
        <th>Número de acertos</th>
        <th>Número de erros</th>
        <th>Sugestão de acertos</th>
        <th>Sugestão de erros</th>
        <th>Assimilou?</th>

      </tr>
    </thead>
<?php
    $j = 0;
    $totalAcertos = 0;
    $totalErros = 0;
    foreach ($nomeConteudo_unique as $nome) :
    $contadorAcertos = $simuladoDAO->selectCountAcertos($idConteudo_filter[$j], $_SESSION['fkid_simulado']);
    $contadorErros = $simuladoDAO->selectCountErros($idConteudo_filter[$j], $_SESSION['fkid_simulado']);
    $select = $simuladoDAO->selectConteudoErroAcerto($nome);
    $maxErro = $select["maxErro"];
    $maxAcerto = $select["maxAcerto"];

    if ($contadorErros >= $maxErro) {
        $assimilou = '<img src="src/error.png" width="28" height="28">';
    } elseif ($contadorAcertos >= $maxAcerto) {
        $assimilou = '<img src="src/checked.png" width="28" height="28">';
    }

?>
    <tbody>
      <tr>
      <td> <?php echo $nome ?>
      <td> <?php echo $contadorAcertos; ?>
      <td> <?php echo $contadorErros; ?>
      <td> <?php echo $maxAcerto; ?>
      <td> <?php echo $maxErro; ?>
      <td><center> <?php echo $assimilou; ?>
      
      </tr>
    </tbody>

<?php
    $j++;
    $totalAcertos = $totalAcertos + $contadorAcertos;
    $totalErros = $totalErros + $contadorErros;
    endforeach;
    $totalQuestoes = $totalAcertos + $totalErros;
?>
  </table> 

<table class="table"> 
    <tr>
        <th>Total de Questões Respondidas</th>
        <th>Total de Acertos</th>
        <th>Total de Erros</th>
        <th>Total de Avanços</th>
        <th>Total de Regressos</th>
    </tr> 
    <tr>
        <td><?php echo $totalQuestoes; ?></td>
        <td><?php echo $totalAcertos; ?></td>
        <td><?php echo $totalErros;?></td>
        <td><?php echo $_SESSION["avancouConteudo"];?></td>
        <td><?php echo $_SESSION["regridiuConteudo"];?></td>
    </tr>
</table>
<form action="index.php" method="post">
    <td><button class="btn btn-success"  type="submit">Inicio</button></td>
</form>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>