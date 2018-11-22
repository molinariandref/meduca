<?php 
require_once("cabecalho.php");
require_once("class/Conteudo.php");
require_once("class/ConteudoDAO.php");

$conteudo = new Conteudo();
$conteudoDAO = new ConteudoDAO($conexao); ?>

<table class="table table-bordered table-striped" id="dynamic_field">
<td width="200"><b>CONTEUDO  PRE-REQUISITO POS-REQUISITO</b></td>

<?php
    
foreach($conteudoDAO->listaNomeConteudoPrePos() as $qualConteudo) : 
?> 
<tr>
    <td><?php echo "Conteudo: " . $qualConteudo['nomeConteudo'] ?>
        <br> Pré-Requisito: <?php echo $qualConteudo['nomePreRequisito']; ?>
        <br> Pós-Requisito: <?php echo $qualConteudo['nomePosRequisito']; ?>
    </td>
    
    <form action="formularioAlterarNomeConteudo.php" method="post">
        <input type="hidden" name="qualConteudo" value="<?=$qualConteudo['nomeConteudo']?>">
        <input type="hidden" name="qualConteudoId" value="<?=$qualConteudo['id']?>">
        <td width="30"><input type="submit" value="Alterar Nome" class="btn btn-default"></td>
    </form>

    <form action="formularioReassociarConteudo.php" method="POST">
        <input type="hidden" name="qualConteudo" value="<?=$qualConteudo['nomeConteudo']?>">
        <input type="hidden" name="qualConteudoId" value="<?=$qualConteudo['id']?>">
        <input type="hidden" name="preRequisitoId" value="<?=$pre_requisito['preRequisito_id']?>">
        <input type="hidden" name="posRequisitoId" value="<?=$pos_requisito['posRequisito_id']?>">
        <td width="30"><input type="submit" value="Alterar" class="btn btn-warning"></td>
    </form>

    <form action="deletaConteudo.php" method="POST">
        <input type="hidden" name="qualConteudo" value="<?=$qualConteudo['nomeConteudo']?>">
        <input type="hidden" name="qualConteudoId" value="<?=$qualConteudo['id']?>">
        <td width="30"><input type="submit" value="Deletar" class="btn btn-danger"></td>   
    </form>

</td>
</tr>
<?php
endforeach;

require_once("rodape.php");
