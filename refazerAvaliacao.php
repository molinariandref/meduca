<?php require_once("cabecalho.php");

$avaliacaoDAO = new AvaliacaoDAO($conexao);
$usuarioDAO = new UsuarioMeducaDAO($conexao);

$fkid_usuario = $_POST['usuario'];
$chaveAvaliacao = $_POST['avaliacao'];

$nomeUsuario = $usuarioDAO->selecionaUsuarioEspecificoId($fkid_usuario);
$fkid_avaliacao = $avaliacaoDAO->descobreIdAvaliacao($chaveAvaliacao);
$avaliacaoDAO->usuarioRefazerAvaliacao($fkid_avaliacao, $fkid_usuario);

$_SESSION["success"] = "O usuário <b>" . $nomeUsuario['nome'] . " <br></b>poderá refazer a avaliação <b>". $chaveAvaliacao . "</b> novamente";
header("Location: listaPainelPedagogico.php");
die();



?>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
