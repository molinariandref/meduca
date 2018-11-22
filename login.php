<?php 
require_once ("cabecalho.php");

$usuario = new UsuarioMeduca;
$usuarioDAO = new UsuarioMeducaDAO($conexao);

$usuario->setEmail($_POST['email']);
$usuario->setSenha($_POST['senha']);

$efetuarLogin = $usuarioDAO->selecionaUsuarioEspecifico($usuario);
if ($efetuarLogin == null) {
    header("Location: index.php");
    die();

} else {
    $_SESSION["usuario_logado"] = $usuario->getEmail();
    $_SESSION["tipoUsuario"] = $efetuarLogin["tipoUsuario"];
    $_SESSION['idUsuario'] = $efetuarLogin["id"];
    $_SESSION['usuarioLogado'] = $efetuarLogin;
    header("Location: index.php");
    die();
}

