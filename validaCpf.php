<?php 
require_once ("cabecalho.php");
$cpf = $_POST['cpf'];

if (strlen($cpf) != 11) {
    $_SESSION["danger"] = "O CPF deve conter 11 digítos. Preencha novamente.";
    header("Location: cpf.php");
    die();
}

$verificaJ = $cpf[9];
$verificaK = $cpf[10];

$J_letra = 10;
$J_array = array();
for ($i = 0; $i <= 8; $i++){
    $J_array[] = $cpf[$i] * $J_letra;
    $J_letra--;
    $J_soma = $J_soma + $J_array[$i];
}

$J_resto = $J_soma % 11;
$J_subtracao = 11 - $J_resto;

if ($J_subtracao > 9) {
    $J = 0;
} else {
    $J = $J_subtracao;
}

//Conseguindo K
$K_letra = 11;
$K_array = array();
for ($ii = 0; $ii <= 9; $ii++){
    $K_array[] = $cpf[$ii] * $K_letra;
    $K_letra--;
    $K_soma = $K_soma + $K_array[$ii];
}

$K_resto = $K_soma % 11;
$K_subtracao = 11 - $K_resto;
if ($K_subtracao > 9) {
    $K = 0;

} else {
    $K = $K_subtracao;
}

if ($verificaJ == $J && $verificaK == $K){
    $_SESSION["success"] = "CPF informado validado com sucesso.";
    header("Location: cpf.php");
    die();
} else {
    $_SESSION["danger"] = "CPF informado não é válido. Informar novamente.";
    header("Location: cpf.php");
    die();
}
