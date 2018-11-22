<?php
require_once("cabecalho.php");
$usuario = new UsuarioMeduca;
$usuario->logout();
$_SESSION["success"] = "Deslogado com sucesso.";
header("Location: index.php");
die();
