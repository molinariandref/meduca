<?php require_once("cabecalho.php"); 
$conteudo_inicial = $_POST['conteudo_inicial'];

?>	

<h1>Tem certeza que deseja continuar com esse usuário?</h1>
<p class="alert-success">Você está logado como: <br> Email: <b> <?php echo $_SESSION["usuario_logado"]; ?> </b></p>

<form action="logout.php" method="POST">
    <input type="submit" value="Não sou eu, deslogar" class="btn btn-danger">
</form>

<form action="formularioProva.php" method="POST">
    <input type="submit" value="Continuar" class="btn btn-success">
    <input type="hidden" name="conteudo_inicial" value="<?= $conteudo_inicial ?>">
</form>

