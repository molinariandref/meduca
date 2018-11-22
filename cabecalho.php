<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once("conecta.php"); 
//require_once("alertas.php"); 

function carregaClasse($nomeDaClasse) {
	require_once("class/".$nomeDaClasse.".php");
}
spl_autoload_register("carregaClasse"); //Carrega as classes automaticamente, nao preciso declarar em todos os lugares

//echo "USUARIO LOGADO: " . $_SESSION["usuarioLogado"]["id"];
?>

<html>
<head>



	<meta charset="utf-8">
	<title>MEDUCA</title>

	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/loja.css" rel="stylesheet">	
	<link href="css/teste.css" rel="stylesheet">

	<link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/loja.css" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  


</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top ">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">MEDUCA</a>
			</div>
			<div>
				<ul class="nav navbar-nav">
			</ul>
			<ul class="nav navbar-nav navbar-right">
					<li><a href="FormularioCadastroUsuario.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				</ul>


<?php
if (isset($_SESSION["usuarioLogado"]) && $_SESSION["usuarioLogado"]["validaUsuario"] == 0) { 
	$_SESSION["warning"] = "<b>Este usuário está aguardando validação do setor pedagógico.<br>Em caso de demora na liberação, entre em contato com o setor pedagógico.";

} elseif (isset($_SESSION["usuarioLogado"]) && $_SESSION["usuarioLogado"]["validaUsuario"] == -1) { 
	$_SESSION["danger"] = "<b>Este cadastro apresentou inconsistências.<br>Procure o setor pedagógico para que possa ser liberado o acesso";

}
elseif ($_SESSION["tipoUsuario"] == "Professor") {
?>
<div class="navbar navbar-inverse navbar-fixed-top ">
		<div class="container">
			<div class="navbar-header">
			<a class="navbar-brand" href="index.php">MEDUCA</a>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><a href="formularioConteudo.php">Adc Conteúdo</a></li>
					<li><a href="formularioAssociarConteudo.php">Associar Conteúdo</a></li>
					<li><a href="formularioQuestao.php">Adc Questão</a></li>
					<li><a href="visualizarConteudos.php">Listar Conteúdos</a></li>
					<li><a href="visualizarQuestoes.php">Listar Questões</a></li>
					<li><a href="formularioChaveAvaliacao.php">Elaborar Avaliação</a></li>
					<li><a href="listaPainelPedagogico.php">Painel Pedagógico </a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="FormularioCadastroUsuario.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php
} elseif ($_SESSION["tipoUsuario"] == "Pedagogo") { ?>
<div class="navbar navbar-inverse navbar-fixed-top ">
		<div class="container">
			<div class="navbar-header">
			<a class="navbar-brand" href="index.php">MEDUCA</a>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><a href="formularioPedagogoUsuario.php">Validar Usuários</a></li>
					<li><a href="listaPainelPedagogico.php">Painel Pedagogico</a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="FormularioCadastroUsuario.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				</ul>
			</div>
		</div>
	</div>
<?php 
}
?>
		</div>
	</div>
</div>

<?php

//if (isset($_SESSION["usuarioLogado"])) { 
if ($_SESSION["usuarioLogado"]["validaUsuario"] == 1) {?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-50 col-md-20 sidebar">
			<ul class="nav sidebar">
			<li><a href="formularioInicializarProva.php">Realizar Simulado</a></li>
			<li><a href="formularioInicializarAvaliacao.php">Realizar Avaliação</a></li>
				<!--<li><a href="formularioElaboraProva.php">Elaborar Prova</a></li>-->
			</ul>
	</div>
</div>
<?php
}

?>



</body>

	<div class="container">
		<div class="principal">
			<?php $alerta = new Alerta;
				  $alerta->mostraAlerta("success");
				  $alerta->mostraAlerta("danger"); 
				  $alerta->mostraAlerta("warning"); ?>

			
