<?php require_once("cabecalho.php"); 
$usuarioDAO = new UsuarioMeducaDAO($conexao);
$avaliacaoDAO = new AvaliacaoDAO($conexao);

$fkid_usuario = $_POST["usuario"];

$avaliacao_bruto = $avaliacaoDAO->selectQuantidadeAvaliacao($fkid_usuario);
//var_dump($avaliacao_bruto);
$avaliacao_unique = array_unique($avaliacao_bruto);
/*var_dump($avaliacao_unique);
$avaliacao_filter = array_filter($avaliacao_unique);
var_dump($avaliacao_filter);
*/
if ($avaliacao_unique == null) {
    ?>
    <p class="alert-warning"><b>O usuário selecionado ainda não realizou nenhuma avaliação. <br>Clique no botão "Voltar" para selecionar outro usuário<br></p> 
    <form action="listaPainelPedagogico.php" method="post">
        <td><button class="btn btn-warning"  type="submit">Voltar</button></td>
    </form>
    
    <?php
} else {
?><table class="table table-bordered table-striped" id="dynamic_field" style="width:100%"> 
<form action="listaPPA.php" method="post">
<tr>
<th colspan=2><center>Selecione a avaliação para expandir qual deseja Painel Pedagógico</th></center>
</tr>
<?php

foreach ($avaliacao_unique as $av) : ?>
    <tr>
    <td><input type="radio" name="conteudo" value='<?=$av?>'> </td>
    <td><?=$av?> </td>
    </tr>
<?php endforeach;
?>
</table>

<input type="hidden" name="usuario" value=<?=$fkid_usuario?>>
<button class="btn btn-primary" type="submit">Abrir painel da avaliação</button>
</form>
<br><br>

<form action="listaPainelPedagogico.php" method="post">
<td><button class="btn btn-warning"  type="submit">Voltar a seleção de usuário</button></td>
</form>

<?php
}
/*
foreach ($avaliacao as $a) : 
    ?>
          <tr>
           <td width="41%"> <center><input type="radio" name="chaveAvaliacao" value='<?=$tipo['ID']?>'></center> </td>
            <td width="60%"><?php echo $a["chaveAvaliacao"]; ?></td>
          </tr>
<?php
endforeach;?>*/?>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>*/