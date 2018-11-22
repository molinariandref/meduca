<?php
require_once("cabecalho.php");
$usuarioDAO = new UsuarioMeducaDAO($conexao);

$tipoUsuario = $_POST["tipoUsuario"];
$nomeCompleto = $_POST["nomeCompleto"]; 
$email = $_POST["email"];
$matricula = $_POST["matricula"];
$cpf = $_POST["cpf"];
$cursando = $_POST["cursando"];
$leciona = $_POST["leciona"];
$validaUsuario = $_POST["validaUsuario"];

$usuario = new UsuarioMeduca();
$usuario_id = $_POST['usuario_id'];
$usuario->setTipoUsuario($tipoUsuario);
$usuario->setNomeCompleto($nomeCompleto);
$usuario->setEmail($email);
$usuario->setMatricula($matricula);
$usuario->setCpf($cpf);
$usuario->setCursando($cursando);
$usuario->setLeciona($leciona);
$usuario->setValidaUsuario($validaUsuario);
$usuarioDAO->updateValidaUsuario($usuario, $usuario_id);


if ($validaUsuario == 1) {
    $_SESSION["success"] = "Usuário " . $nomeCompleto . " foi válidado com sucesso";
    header("Location: formularioPedagogoUsuario.php");
    die();
} else {
    $_SESSION["danger"] = "Usuário " . $nomeCompleto . " não pode ser válidado.<br>Aguardando vinda ao setor pedagógico. ";
    header("Location: formularioPedagogoUsuario.php");
    die();  
}


?>


<?php include("rodape.php");

?>