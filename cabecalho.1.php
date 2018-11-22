<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once("conecta.php"); 
//require_once("alertas.php"); 

function carregaClasse($nomeDaClasse) {
	require_once("class/".$nomeDaClasse.".php");
}
spl_autoload_register("carregaClasse"); //Carrega as classes automaticamente, nao preciso declarar em todos os lugares

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
					<li><a href="formularioLogin.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
				</ul>

<?php
if ($_SESSION["tipoUsuario"] == "Aluno" || $_SESSION["tipoUsuario"] == "Pedagogo") { ?>
<div class="navbar navbar-inverse navbar-fixed-top ">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">MEDUCA</a>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><a href="formularioConteudo.php">Adicionar conteúdo</a></li>
					<li><a href="formularioAssociarConteudo.php">Associar Conteúdo</a></li>
					<li><a href="formularioQuestao.php">Adicionar questão</a></li>
					<li><a href="visualizarConteudos.php">Listar Conteúdos</a></li>
					<li><a href="visualizarQuestoes.php">Listar Questões</a></li>
					<li><a href="formularioChaveAvaliacao.php">Elaborar Avaliação</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="FormularioCadastroUsuario.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					<li><a href="formularioLogin.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
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
</body>

	<div class="container">
		<div class="principal">
			<?php $alerta = new Alerta;
				  $alerta->mostraAlerta("success");
				  $alerta->mostraAlerta("danger"); ?>

			
