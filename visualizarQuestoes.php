<?php 
require_once("cabecalho.php");
require_once("class/Conteudo.php");
require_once("class/ConteudoDAO.php");

$questao = new Questao();
$questaoDAO = new QuestaoDAO($conexao); 

?>

<table class="table table-bordered table-striped" id="dynamic_field"> 
<td width="200"><b>ENUNCIADOS</b></td>
<td width="200"><b>CONTEÚDO</b></td><?php

foreach($questaoDAO->listaEnunciadoQuestao() as $enunciado) : 
?> 
<tr>
    <td width="960"><?php echo $enunciado->getEnunciado() ?></td>
    <td width="200"><?php echo $enunciado->getConteudo() ?></td>

    <form action="formularioAlteraQuestao.php" method="POST">
        <input type="hidden" name="enunciado" value="<?=$enunciado->getEnunciado(); ?>">
        <input type="hidden" name="enunciadoId" value="<?=$enunciado->getId(); ?>">
        <td width="20"><input type="submit" value="Alterar" class="btn btn-warning"></td>
    </form>

    <form action="deletaQuestao.php" method="POST">
        <input type="hidden" name="enunciado" value="<?=$enunciado->getEnunciado(); ?>">
        <input type="hidden" name="enunciadoId" value="<?=$enunciado->getId(); ?>">
        <td width="20"><input type="submit" value="Deletar" class="btn btn-danger"></td>   
    </form>

</td>
</tr>
<?php
endforeach;
?> 
<td colspan=3><b>Obs. Para consultar as alternativas dos enunciados clique em "Alterar".</b>
</table> 
<?php
require_once("rodape.php");
