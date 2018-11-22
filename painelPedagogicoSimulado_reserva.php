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

<table class="table"> 
    <tr>
        <th>Total de Questões Respondidas</th>
        <th>Total de Acertos</th>
        <th>Total de Erros</th>
        <th>Total de Avanços</th>
        <th>Total de Regressos</th>
    </tr> 
    <tr>
        <td><?php echo $contador; ?></td>
        <td><?php echo $acertou; ?></td>
        <td><?php echo $errou;?></td>
        <td><?php echo $_SESSION["avancouConteudo"];?></td>
        <td><?php echo $_SESSION["regridiuConteudo"];?></td>
    </tr>
</table>
<form action="index.php" method="post">
    <td><button class="btn btn-success"  type="submit">Inicio</button></td>
</form>

<form action="painelPedagogicoSimulado2.php" method="post">
    <td><button class="btn btn-success"  type="submit">JOTA</button></td>
</form>


<?php

?>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>