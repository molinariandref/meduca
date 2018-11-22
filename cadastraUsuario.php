<?php
require_once("cabecalho.php");
$usuario = new UsuarioMeduca;
$usuarioDAO = new UsuarioMeducaDAO($conexao);

$usuario->setTipoUsuario($_POST['tipoUsuario']);
$usuario->setNomeCompleto($_POST['nomeCompleto']);
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];
$confirmaSenha = $_POST['confirmaSenha'];


//echo $usuario->getTipoUsuario();

$verificaEmail = $usuarioDAO->selecionaJaTemUsuario($email);
$verificaCpf = $usuarioDAO->selecionaJaTemCpf($cpf);

if ($verificaCpf == null) {
    $validaCpf = $usuario->validaCpf($cpf);
    if ($validaCpf == -1) {
        $_SESSION["danger"] = "Cpf deve conter no minímo 11 digítos. Tentar novamente";
        header("Location: FormularioCadastroUsuario.php");
        die();
    } elseif ($validaCpf == 0) {
        $_SESSION["danger"] = "Cpf informado inválido. Tentar novamente";
        header("Location: FormularioCadastroUsuario.php");
        die();  
    } elseif ($validaCpf == 1) {
        if ($verificaEmail == null) {
            $usuario->setEmail($_POST['email']);
            $usuario->setCpf($cpf);
            if ($senha != $confirmaSenha) {
                $_SESSION["danger"] = "Essas senhas não coincidem. Tentar novamente.";
                header("Location: FormularioCadastroUsuario.php");
                die();
            } else {
                $_SESSION["success"] = "Usuário cadastrado com sucesso. Efetuar login.";
                $usuario->setSenha($_POST['senha']);
                $usuarioDAO->insereUsuario($usuario);
                header("Location: FormularioLogin.php");
                die();
            } 
        }else {
            $_SESSION["danger"] = "Email já cadastrado.";
            header("Location: FormularioCadastroUsuario.php");
            die();
        }
    } 
}
else {
    $_SESSION["danger"] = "Cpf já cadastrado.";
    header("Location: FormularioCadastroUsuario.php");
    die();
}
