<?php require_once("cabecalho.php"); 
$usuarioDAO = new UsuarioMeducaDAO($conexao);
$simuladoDAO = new SimuladoDAO($conexao);

$usuarioId = $_POST["usuario"];
$simulados = $simuladoDAO->selectQuantidadeSimulado($usuarioId);
$cont = 1;
foreach ($simulados as $fkid_simulado):
    echo "<h1> Painel número " . $cont++;
    $simulado = $simuladoDAO->selectSimulado_usuario($fkid_simulado);
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
        </tr> 
        <tr>
            <td><?php echo $contador; ?></td>
            <td><?php echo $acertou; ?></td>
            <td><?php echo $errou;?></td>
        </tr>
    </table>
<?php
endforeach;

?>	


<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
