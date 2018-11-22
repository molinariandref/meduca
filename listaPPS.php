<?php require_once("cabecalho.php"); 
$usuarioDAO = new UsuarioMeducaDAO($conexao);
$simuladoDAO = new SimuladoDAO($conexao);

$usuarioId = $_POST["usuario"];
$simulados = $simuladoDAO->selectQuantidadeSimulado($usuarioId);

if ($simulados == null) {
    ?>
    <p class="alert-warning"><b>O usuário selecionado ainda não realizou nenhum simulado. <br>Clique no botão "Voltar" para selecionar outro usuário<br></p> 
    <form action="listaPainelPedagogico.php" method="post">
        <td><button class="btn btn-warning"  type="submit">Voltar</button></td>
    </form>
    <?php
}

$flagDivisoria = 0;
foreach ($simulados as $fkid_simulado):
    $divisoria = '<img src="src/divisoria.png" width="1000"   >';
    if ($flagDivisoria == 1) {
        echo $divisoria;
    }
    $flagDivisoria = 1;
    //echo "<h1> Painel número " . $cont++ . "</h1>";
    $simulado = $simuladoDAO->selectSimulado_usuario($fkid_simulado);
    ?> 
    <table class="table table-striped"> 
        <thead>
          <tr>
            <th><center>Contéudo</center></th>
            <th><center>Questão</center></th>
            <th><center>Resultado</center></th>
          </tr>
        </thead>
    <?php
    
    $contador = 0;
    $acertou = 0;
    $errou = 0;
        foreach ($simulado as $s) : 
            $score = $s->getScore();
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
          <td> <center><?php echo $s->getNomeConteudo(); ?></center></td>
          <td> <center><?php echo $s->getEnunciado(); ?></center></td>
          <td> <center><?php echo $assimilou . " " . $score; ?></center></td>
          </tr>
        </tbody>
    
    <?php
        $contador++;
        endforeach;
    ?>
      </table>
<?php
    $simulado = $simuladoDAO->selectSimulado_usuario($fkid_simulado);
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
        <th><center>Contéudos do simulado</center></th>
        <th><center>Número de acertos</center></th>
        <th><center>Número de erros</center></th>
        <th><center>Sugestão de acertos</center></th>
        <th><center>Sugestão de erros</center></th>
        <th><center>Assimilou?</center></th>

      </tr>
    </thead>
<?php
    $j = 0;
    $totalAcertos = 0;
    $totalErros = 0;
    
    foreach ($nomeConteudo_unique as $nome) :
    $contadorAcertos = $simuladoDAO->selectCountAcertos($idConteudo_filter[$j], $fkid_simulado);
    $contadorErros = $simuladoDAO->selectCountErros($idConteudo_filter[$j], $fkid_simulado);
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
      <td> <center><?php echo $nome ?> </center></td>
      <td> <center><?php echo $contadorAcertos; ?></center></td>
      <td> <center><?php echo $contadorErros; ?></center></td>
      <td> <center><?php echo $maxAcerto; ?></center></td>
      <td> <center><?php echo $maxErro; ?></center></td>
      <td><center> <?php echo $assimilou; ?></center></td>
      
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
            <th><center>Total de Questões Respondidas</center></th>
            <th><center>Total de Acertos</center></th>
            <th><center>Total de Erros</center></th>
        </tr> 
        <tr>
            <td><center><?php echo $contador; ?></center></td>
            <td><center><?php echo $acertou; ?></center></td>
            <td><center><?php echo $errou;?></center></td>
        <?php
        $contador = 0;
        $acertou = 0;
        $errou = 0;
        ?>
        </tr>
    </table>
<?php
endforeach;
?>	
    <form action="listaPainelPedagogico.php" method="post">
        <td><button class="btn btn-info"  type="submit">Voltar</button></td>
    </form>
<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>